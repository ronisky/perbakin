<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

use Modules\UserGroup\Repositories\UserGroupRepository;
use Modules\Users\Repositories\UsersRepository;
use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\DB;
use Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_usersRepository     = new UsersRepository;
        $this->_groupRepository     = new UserGroupRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "Users";
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        $users      = $this->_usersRepository->getAll();
        $groups     = $this->_groupRepository->getAll();

        return view('users::index', compact('users', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules(''));

        if ($validator->fails()) {
            return redirect('users')
                ->withErrors($validator)
                ->withInput();
        }

        $request['user_status'] = '1';

        DB::beginTransaction();
        $this->_usersRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->name, 'create');
        DB::commit();

        return redirect('users')->with('successMessage', 'Pengguna berhasil ditambahkan');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules($id));

        if ($validator->fails()) {
            return redirect('users')
                ->withErrors($validator)
                ->withInput();
        }

        if (empty($request->input('user_password'))) {
            unset($request['user_password']);
        }

        if ($id == 1) {
            $request['user_status'] = '1';
        }

        DB::beginTransaction();

        $this->_usersRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->user_username, 'update');
        DB::commit();

        return redirect('users')->with('successMessage', 'Pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }
        // Check detail to db
        $detail  = $this->_usersRepository->getById($id);
        if (!$detail) {
            return redirect('users');
        } elseif ($detail->user_id == 1) {
            return redirect('users');
        }

        DB::beginTransaction();
        $this->_usersRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->user_id, 'delete');
        DB::commit();

        return redirect('users')->with('successMessage', 'Pengguna berhasil dihapus');
    }


    /**
     * Reset the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function reset($id)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        // Check detail to db
        $detail  = $this->_usersRepository->getById($id);

        if (!$detail) {
            return redirect('users');
        }

        DB::beginTransaction();

        if (in_array($detail->group_id, [7, 8])) {
            $request['user_pasword'] = Hash::make('sekolah123');
        } else {
            $request['user_pasword'] = Hash::make('user123');
        }

        $this->_usersRepository->update(DataHelper::_normalizeParams($request, false, true), $id);
        $this->_logHelper->store($this->module, $detail->user_username, 'update');

        DB::commit();

        return redirect('users')->with('successMessage', 'Kata sandi pengguna berhasil direset');
    }

    /**
     * Reset the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function status($id, $status)
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        // Check detail to db
        $detail  = $this->_usersRepository->getById($id);

        if (!$detail) {
            return redirect('users');
        }

        DB::beginTransaction();

        $request['user_status'] = $status;

        $this->_usersRepository->update(DataHelper::_normalizeParams($request, false, true), $id);
        $this->_logHelper->store($this->module, $detail->user_username, 'update');

        DB::commit();

        $display = $status ? 'diaktifkan' : 'dinon-aktifkan';

        return redirect('users')->with('successMessage', 'Pengguna berhasil ' . $display);
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_usersRepository->getById($id);

        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'user_email' => 'required|unique:sys_users',
                'user_name' => 'required',
                'user_password' => 'required',
                'group_id' => 'required',
            ];
        } else {
            return [
                'user_email' => 'required|unique:sys_users,user_email,' . $id . ',user_id',
                'user_name' => 'required',
                'group_id' => 'required',
            ];
        }
    }
}
