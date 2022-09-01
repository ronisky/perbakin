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
use App\Helpers\DateFormatHelper;
use App\Helpers\LogHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Club\Repositories\ClubRepository;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_usersRepository     = new UsersRepository;
        $this->_groupRepository     = new UserGroupRepository;
        $this->_clubRepository     = new ClubRepository;
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
            return view('exceptions.unauthorize');
        }

        $users      = $this->_usersRepository->getAll();
        $groups     = $this->_groupRepository->getAll();
        $clubs     = $this->_clubRepository->getAll();

        return view('users::index', compact('users', 'groups', 'clubs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
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
            return view('exceptions.unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules(''));

        if ($validator->fails()) {
            return redirect('users')
                ->withErrors($validator)
                ->withInput();
        }

        $request['user_status'] = 0;

        DB::beginTransaction();
        $this->_usersRepository->insert(DataHelper::_normalizeParams($request->all(), true));
        $this->_logHelper->store($this->module, $request->user_name, 'create');
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
            return view('exceptions.unauthorize');
        }

        $getDetail  = $this->_usersRepository->getById($id);

        if ($getDetail) {
            $dateIn = DateFormatHelper::dateIn($getDetail->date_of_birth);
            $result = [
                'date_of_birth_id' => $dateIn,
                $getDetail
            ];
            return DataHelper::_successResponse($result, 'Data berhasil ditemukan');
        } else {
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
        }
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
            return view('exceptions.unauthorize');
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
            return view('exceptions.unauthorize');
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
            $request['user_status'] = 1;
        }

        DB::beginTransaction();
        $this->_usersRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
        $this->_logHelper->store($this->module, $request->user_username, 'update');
        DB::commit();


        return redirect('users')->with('successMessage', 'Data pengguna berhasil diubah');
    }

    public function updateProfile(Request $request, $id)
    {
        $getDetail  = $this->_usersRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);
        DB::beginTransaction();
        // check and update club 
        $request->club_id_update == null ? $request['club_id'] = $request->club_id : $request['club_id'] = $request->club_id_update;

        if ($request->user_image <> "") {
            if ($getDetail->user_image != null) {
                Storage::delete('public/' . $filePath . $getDetail->user_image);
            }

            // update data
            $file = $request->user_image;
            $fileName = DataHelper::getFileName($file);
            $request->file('user_image')->storeAs($filePath, $fileName, 'public');

            if ($request['user_password'] == null) {
                $dataUser = [
                    'user_kta' => $request->user_kta,
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_image'    => $fileName,
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'occupation' => $request->occupation,
                    'user_address' => $request->user_address,
                    'club_id' => $request->club_id,
                    'user_club_gen' => $request->user_club_gen,
                    'user_club_cab' => $request->user_club_cab,
                ];
            } else {
                if (!Hash::check($request->user_password_check, Auth::user()->user_password)) {
                    return redirect('setting')->with('errorMessage', 'Password salah!');
                }

                $dataUser = [
                    'user_name'     => $request->user_name,
                    'user_email'    => $request->user_email,
                    'user_image'    => $fileName,
                    'user_password' => Hash::make($request->user_password),
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'occupation' => $request->occupation,
                    'user_address' => $request->user_address,
                    'club_id' => $request->club_id,
                    'user_club_gen' => $request->user_club_gen,
                    'user_club_cab' => $request->user_club_cab,
                ];
            }
            $this->_usersRepository->update(array_merge($dataUser, DataHelper::_signParams(false, true)), $id);
        } else {
            if ($request['user_password'] == null) {
                $dataUser = [
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'occupation' => $request->occupation,
                    'user_address' => $request->user_address,
                    'club_id' => $request->club_id,
                    'user_club_gen' => $request->user_club_gen,
                    'user_club_cab' => $request->user_club_cab,
                ];
            } else {
                if (!Hash::check($request->user_password_check, Auth::user()->user_password)) {
                    return redirect('setting')->with('errorMessage', 'Password salah!');
                }

                $dataUser = [
                    'user_name' => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_password' => Hash::make($request->user_password),
                    'place_of_birth' => $request->place_of_birth,
                    'date_of_birth' => $request->date_of_birth,
                    'occupation' => $request->occupation,
                    'user_address' => $request->user_address,
                    'club_id' => $request->club_id,
                    'user_club_gen' => $request->user_club_gen,
                    'user_club_cab' => $request->user_club_cab,
                ];
            }
            $this->_usersRepository->update(array_merge($dataUser, DataHelper::_signParams(false, true)), $id);
        }

        $this->_logHelper->store($this->module, $request->user_name, 'update');
        DB::commit();

        return redirect('setting')->with('successMessage', 'Profil berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatestatus(Request $request, $id)
    {
        $statusValue = $request->user_status;
        if ($statusValue == 1) {
            if ($id != 1) {
                $getUser    = $this->_usersRepository->getById($id);
                if (!$getUser) {
                    return DataHelper::_errorResponse(null, 'User tidak ditemukan');
                }

                $currentDate = date('Y-m');
                $userActived = date("Y-m", strtotime($getUser->user_active_date));

                $compareDate = strtotime($userActived) < strtotime($currentDate);
                if (!$compareDate) {
                    DB::beginTransaction();
                    try {
                        $this->_usersRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
                        $this->_logHelper->store($this->module, $request->user_id, 'update');

                        DB::commit();
                        return DataHelper::_successResponse(null, 'Status user berhasil diubah');
                    } catch (\Throwable $th) {

                        DB::rollBack();
                        return DataHelper::_errorResponse(null, 'Gagal mengubah data');
                    }
                }
                return DataHelper::_errorResponse(null, 'Opps! Masa aktif KTA user sudah tidak aktif, silahkan perbaharui keanggotaan terlebih dahulu');
            } else {
                return DataHelper::_errorResponse(null, 'Data super admin tidak bisa diubah');
            }
        } else {
            if ($id != 1) {
                DB::beginTransaction();
                try {
                    $this->_usersRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
                    $this->_logHelper->store($this->module, $request->user_id, 'update');

                    DB::commit();
                    return DataHelper::_successResponse(null, 'Status user berhasil diubah');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return DataHelper::_errorResponse(null, 'Gagal mengubah data');
                }
            } else {
                return DataHelper::_errorResponse(null, 'Data super admin tidak bisa diubah');
            }
        }
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
            return view('exceptions.unauthorize');
        }
        // Check detail to db
        $detail  = $this->_usersRepository->getById($id);

        if (!$detail) {
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
        } elseif ($detail->user_id == 1) {
            return DataHelper::_errorResponse(null, 'Data tidak bisa dihapus!');
        } else {
            DB::beginTransaction();
            $this->_usersRepository->delete($id);
            $this->_logHelper->store($this->module, $detail->user_id, 'delete');
            DB::commit();

            return DataHelper::_successResponse($detail, 'Pengguna berhasil dihapus');
        }
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
            return view('exceptions.unauthorize');
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
            return view('exceptions.unauthorize');
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
                'user_username' => 'required|unique:sys_users',
                'user_name' => 'required',
                'user_email' => 'required|unique:sys_users',
                'user_phone' => 'required|unique:sys_users',
                // 'place_of_birth' => 'required',
                // 'date_of_birth' => 'required',
                // 'occupation' => 'required',
                // 'user_address' => 'required',
                'user_kta' => 'required',
                'user_active_date' => 'required',
                // 'club_id' => 'required',
                // 'user_club_gen' => 'required',
                // 'user_club_cab' => 'required',
                // 'user_password' => 'required',
                'group_id' => 'required',
            ];
        } else {
            return [
                'user_username' => 'required',
                // 'user_email' => 'required',
                // 'user_name' => 'required',
                // 'user_phone' => 'required',
                // 'place_of_birth' => 'required',
                // 'date_of_birth' => 'required',
                // 'occupation' => 'required',
                // 'user_address' => 'required',
                // 'user_kta' => 'required',
                // 'user_active_date' => 'required',
                // 'club_id' => 'required',
                // 'user_club_gen' => 'required',
                // 'user_club_cab' => 'required',
                // 'user_password' => 'required',
                // 'group_id' => 'required',
            ];
        }
    }
}
