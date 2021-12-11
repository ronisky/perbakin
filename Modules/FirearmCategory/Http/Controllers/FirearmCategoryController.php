<?php

namespace Modules\FirearmCategory\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Modules\FirearmCategory\Repositories\FirearmCategoryRepository;

class FirearmCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_firearmCategoryRepository   = new FirearmCategoryRepository;
        $this->_logHelper                   = new LogHelper;
        $this->module                       = "FirearmCategory";
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

        $firearm_categories    = $this->_firearmCategoryRepository->getAll();

        return view('firearmcategory::index', compact('firearm_categories'));
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
        return view('firearmcategory::create');
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
            return redirect('firearmcategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $this->_firearmCategoryRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->firearm_category_name, 'create');
        DB::commit();

        return redirect('firearmcategory')->with('successMessage', 'Jenis senjata berhasil ditambahkan');
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
        return view('firearmcategory::show');
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
        return view('firearmcategory::edit');
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
            return redirect('firearmcategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        $this->_firearmCategoryRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->firearm_category_name, 'update');

        DB::commit();

        return redirect('firearmcategory')->with('successMessage', 'Jenis senjata berhasil diubah');
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
        $detail  = $this->_firearmCategoryRepository->getById($id);

        if (!$detail) {
            return redirect('firearmcategory');
        }

        DB::beginTransaction();

        $this->_firearmCategoryRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->firearm_category_name, 'delete');

        DB::commit();

        return redirect('firearmcategory')->with('successMessage', 'Jenis senjata berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_firearmCategoryRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'firearm_category_name' => 'required|unique:firearm_categories',
            ];
        } else {
            return [
                'firearm_category_name' => 'required|unique:firearm_categories,firearm_category_name,' . $id . ',firearm_category_id',
            ];
        }
    }
}
