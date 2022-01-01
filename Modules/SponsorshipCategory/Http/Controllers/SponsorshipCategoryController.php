<?php

namespace Modules\SponsorshipCategory\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Modules\SponsorshipCategory\Repositories\SponsorshipCategoryRepository;

class SponsorshipCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_sponsorshipCategoryRepository = new SponsorshipCategoryRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "SponsorshipCategory";
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

        $sponsorship_categories    = $this->_sponsorshipCategoryRepository->getAll();
        return view('sponsorshipcategory::index', compact('sponsorship_categories'));
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
        return view('sponsorshipcategory::create');
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
            return redirect('sponsorshipcategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $this->_sponsorshipCategoryRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->sponsorship_category_name, 'create');
        DB::commit();

        return redirect('sponsorshipcategory')->with('successMessage', 'Data kategori sponsorship berhasil ditambahkan');
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
        return view('sponsorshipcategory::show');
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
        return view('sponsorshipcategory::edit');
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
            return redirect('sponsorshipcategory')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        $this->_sponsorshipCategoryRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->sponsorship_category_name, 'update');

        DB::commit();

        return redirect('sponsorshipcategory')->with('successMessage', 'Data kategori sponsorship berhasil diubah');
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
        $detail  = $this->_sponsorshipCategoryRepository->getById($id);

        if (!$detail) {
            return redirect('sponsorshipcategory');
        }

        DB::beginTransaction();

        $this->_sponsorshipCategoryRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->sponsorship_category_name, 'delete');

        DB::commit();

        return redirect('sponsorshipcategory')->with('successMessage', 'Data kategori sponsorship berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_sponsorshipCategoryRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'sponsorship_category_name' => 'required|unique:sponsorship_categories',
            ];
        } else {
            return [
                'sponsorship_category_name' => 'required|unique:sponsorship_categories,sponsorship_category_name,' . $id . ',sponsorship_category_id',
            ];
        }
    }
}
