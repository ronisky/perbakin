<?php

namespace Modules\LetterCategory\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Modules\LetterCategory\Repositories\LetterCategoryRepository;

class LetterCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_letterCategoryRepository = new LetterCategoryRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "letterCategory";
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

        $letter_categories    = $this->_letterCategoryRepository->getAll();

        return view('lettercategory::index', compact('letter_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('lettercategory::create');
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
            return redirect('lettercategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $this->_letterCategoryRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->letter_category_name, 'create');
        DB::commit();

        return redirect('lettercategory')->with('successMessage', 'Surat rekomendasi berhasil ditambahkan');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('lettercategory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('lettercategory::edit');
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
            return redirect('lettercategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        $this->_letterCategoryRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->letter_category_name, 'update');

        DB::commit();

        return redirect('lettercategory')->with('successMessage', 'Surat rekomendasi berhasil diubah');
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
        $detail  = $this->_letterCategoryRepository->getById($id);

        if (!$detail) {
            return redirect('lettercategory');
        }

        DB::beginTransaction();

        $this->_letterCategoryRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->letter_category_name, 'delete');

        DB::commit();

        return redirect('lettercategory')->with('successMessage', 'Surat rekomendasi berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_letterCategoryRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'letter_category_name' => 'required|unique:letter_categories',
            ];
        } else {
            return [
                'letter_category_name' => 'required|unique:letter_categories,letter_category_name,' . $id . ',letter_category_id',
            ];
        }
    }
}
