<?php

namespace Modules\Faq\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Modules\Faq\Repositories\FaqRepository;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_faqRepository = new FaqRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "Faq";
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

        $faqs    = $this->_faqRepository->getAll();
        return view('faq::index', compact('faqs'));
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
        return view('faq::create');
    }

    protected function _storeDataFaq($request)
    {
        $validator = Validator::make($request, $this->_validationRules(''));

        if ($validator->fails()) {
            return redirect('faq')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $this->_faqRepository->insert(DataHelper::_normalizeParams($request, true));
        $this->_logHelper->store($this->module, $request['faq_question'], 'create');
        DB::commit();
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

        if ($request['faq_name'] == null) {

            $request['faq_name'] = Auth::user()->user_name;
            $request['faq_email'] = Auth::user()->user_email;
            $request['faq_phone'] = Auth::user()->user_phone;
            $request['faq_nik'] = Auth::user()->user_kta;
            $request['faq_status'] = 1;

            $this->_storeDataFaq($request->all());

            return redirect('faq')->with('successMessage', 'Data faq berhasil ditambahkan');
        } else {
            $request['faq_status'] = 0;

            $this->_storeDataFaq($request->all());

            return redirect('home/contact')->with('successMessage', 'Data faq berhasil ditambahkan');
        }
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

        $getDetail  = $this->_faqRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
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
        return view('faq::edit');
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
            return redirect('faq')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        $this->_faqRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->faq_id, 'update');

        DB::commit();

        return redirect('faq')->with('successMessage', 'Data FAQ berhasil diubah');
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
            $this->_faqRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
            $this->_logHelper->store($this->module, $request->faq_id, 'update');

            DB::commit();
            return DataHelper::_successResponse(null, 'Status faq berhasil diubah');
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
            return redirect('unauthorize');
        }
        // Check detail to db
        $detail  = $this->_faqRepository->getById($id);

        if (!$detail) {
            return redirect('faq');
        }

        DB::beginTransaction();

        $this->_faqRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->faq_name, 'delete');

        DB::commit();

        return redirect('faq')->with('successMessage', 'Data FAQ berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_faqRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'faq_name' => 'required',
                'faq_email' => 'required',
                'faq_phone' => 'required',
                'faq_nik' => 'required',
                'faq_question' => 'required|unique:faqs',
            ];
        } else {
            return [
                'faq_question' => 'required|unique:faqs,faq_question,' . $id . ',faq_id',
            ];
        }
    }
}
