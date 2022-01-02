<?php

namespace Modules\ArticleCategory\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Modules\ArticleCategory\Repositories\ArticleCategoryRepository;

class ArticleCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_articleCategoryRepository = new ArticleCategoryRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "ArticleCategory";
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        $article_categories    = $this->_articleCategoryRepository->getAll();
        return view('articlecategory::index', compact('article_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }
        return view('articlecategory::create');
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
            return redirect('unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules(''));

        if ($validator->fails()) {
            return redirect('articlecategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $this->_articleCategoryRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->article_category_name, 'create');
        DB::commit();

        return redirect('articlecategory')->with('successMessage', 'Data kategori artikel berhasil ditambahkan');
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
            return redirect('unauthorize');
        }
        return view('articlecategory::show');
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
            return redirect('unauthorize');
        }
        return view('articlecategory::edit');
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
            return redirect('unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules($id));

        if ($validator->fails()) {
            return redirect('articlecategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        $this->_articleCategoryRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->article_category_id, 'update');

        DB::commit();

        return redirect('articlecategory')->with('successMessage', 'Data kategori artikel berhasil diubah');
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
            return redirect('unauthorize');
        }
        // Check detail to db
        $detail  = $this->_articleCategoryRepository->getById($id);

        if (!$detail) {
            return redirect('articlecategory');
        }

        DB::beginTransaction();

        $this->_articleCategoryRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->article_category_name, 'delete');

        DB::commit();

        return redirect('articlecategory')->with('successMessage', 'Data kategori berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_articleCategoryRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'article_category_name' => 'required|unique:article_categories',
            ];
        } else {
            return [
                'article_category_name' => 'required|unique:article_categories,article_category_name,' . $id . ',article_category_id',
            ];
        }
    }
}
