<?php

namespace Modules\Article\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Article\Repositories\ArticleRepository;
use Modules\ArticleCategory\Repositories\ArticleCategoryRepository;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_articleRepository = new ArticleRepository;
        $this->_articleCategoryRepository = new ArticleCategoryRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "Article";
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }

        $articles    = $this->_articleRepository->getAll();
        $article_categories     = $this->_articleCategoryRepository->getAll();

        return view('article::index', compact('articles', 'article_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }

        return view('article::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }
        if ($request->article_content == null) {
            return redirect('article')->with('errorMessage', 'Konten atau body artikel harus diisi!');
        }

        $validator = Validator::make($request->all(), $this->_validationRules(''));

        if ($validator->fails()) {
            return redirect('article')
                ->withErrors($validator)
                ->withInput();
        }

        if (!$request->image_thumbnail_path <> "") {
            return redirect('article')->with('errorMessage', 'Gagal! Gambar artikel wajib diisi!');
        }

        DB::beginTransaction();
        $file = $request->image_thumbnail_path;
        $fileName = DataHelper::getFileName($file);
        $filePath = DataHelper::getFilePath(false, true);
        $request->file('image_thumbnail_path')->storeAs($filePath, $fileName, 'public');

        $dataArticle = [
            'article_author' => Auth::user()->user_name,
            'article_category_id' => $request->article_category_id,
            'article_title' => $request->article_title,
            'article_content' => $request->article_content,
            'image_thumbnail_path' => $fileName,
            'publish_status' => 1,
        ];

        $this->_articleRepository->insert(array_merge($dataArticle, DataHelper::_signParams(true)));
        $this->_logHelper->store($this->module, $request->article_title, 'create');
        DB::commit();

        return redirect('article')->with('successMessage', 'Artikel berhasil ditambahkan');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }

        return view('article::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }

        return view('article::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules($id));

        if ($validator->fails()) {
            return redirect('article')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $getDetail  = $this->_articleRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        if ($request->hasFile('image_thumbnail_path')) {
            // delete storage data
            Storage::delete('public/' . $filePath . $getDetail->image_thumbnail_path);

            // update data
            $file = $request->image_thumbnail_path;
            $fileName = DataHelper::getFileName($file);
            $request->file('image_thumbnail_path')->storeAs($filePath, $fileName, 'public');

            $dataBanner = [
                'article_author' => Auth::user()->user_name,
                'article_category_id' => $request->article_category_id,
                'article_title' => $request->article_title,
                'article_content' => $request->article_content,
                'image_thumbnail_path' => $fileName,
                'publish_status' => $request->publish_status,
            ];
        } else {
            // update data
            $dataBanner = [
                'article_author' => Auth::user()->user_name,
                'article_category_id' => $request->article_category_id,
                'article_title' => $request->article_title,
                'article_content' => $request->article_content,
                'publish_status' => $request->publish_status,
            ];
        }

        $this->_articleRepository->update(array_merge($dataBanner, DataHelper::_signParams(false, true)), $id);
        $this->_logHelper->store($this->module, $request->article_title, 'update');

        DB::commit();

        return redirect('article')->with('successMessage', 'Data artikel berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatestatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->_articleRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
            $this->_logHelper->store($this->module, $request->article_id, 'update');

            DB::commit();
            return DataHelper::_successResponse(null, 'Status artikel berhasil diubah');
        } catch (\Throwable $th) {

            DB::rollBack();
            return DataHelper::_errorResponse(null, 'Gagal mengubah data');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }

        // Check detail to db
        $detail  = $this->_articleRepository->getById($id);

        if (!$detail) {
            return redirect('article');
        }

        DB::beginTransaction();
        $getDetail  = $this->_articleRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        $dataImage = $getDetail->image_thumbnail_path;
        if ($dataImage) {
            // delete storage data
            Storage::delete('public/' . $filePath . $dataImage);
        }
        $this->_articleRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->article_title, 'delete');

        DB::commit();

        return DataHelper::_successResponse(null, 'Data berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_articleRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'article_title' => 'required|unique:articles',
                'article_content' => "required",
                'article_category_id' => "required",
            ];
        } else {
            return [
                'article_title' => 'required|unique:articles,article_title,' . $id . ',article_id',
                'article_content' => "required",
                'article_category_id' => "required",
            ];
        }
    }
}
