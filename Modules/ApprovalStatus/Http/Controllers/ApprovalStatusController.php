<?php

namespace Modules\ApprovalStatus\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Modules\ApprovalStatus\Repositories\ApprovalStatusRepository;

class ApprovalStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_approvalStatusRepository = new ApprovalStatusRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "ApprovalStatus";
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

        $approvalstatuses    = $this->_approvalStatusRepository->getAll();
        return view('approvalstatus::index', compact('approvalstatuses'));
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
        return view('approvalstatus::create');
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
            return redirect('approvalstatus')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $this->_approvalStatusRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->approval_status_name, 'create');
        DB::commit();

        return redirect('approvalstatus')->with('successMessage', 'Data status berhasil ditambahkan');
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
        return view('approvalstatus::show');
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
        return view('approvalstatus::edit');
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
            return redirect('approvalstatus')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        $this->_approvalStatusRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->approval_status_name, 'update');

        DB::commit();

        return redirect('approvalstatus')->with('successMessage', 'Data status berhasil diubah');
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
        $detail  = $this->_approvalStatusRepository->getById($id);

        if (!$detail) {
            return redirect('approvalstatus');
        }

        DB::beginTransaction();

        $this->_approvalStatusRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->approval_status_name, 'delete');

        DB::commit();

        return redirect('approvalstatus')->with('successMessage', 'Data status berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_approvalStatusRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'approval_status_name' => 'required|unique:approval_statuses',
            ];
        } else {
            return [
                'approval_status_name' => 'required|unique:approval_statuses,approval_status_name,' . $id . ',approval_status_id',
            ];
        }
    }
}
