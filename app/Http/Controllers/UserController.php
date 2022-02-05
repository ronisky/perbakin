<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use App\Repositories\UserForgotRepository;
use Exception;
use Modules\Users\Repositories\UsersRepository;

class UserController extends Controller
{

    public function __construct()
    {

        $this->_userRepository      = new UsersRepository;
        $this->_forgotRepository    = new UserForgotRepository;
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('user.login');
    }

    public function forgot()
    {

        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('user.forgot');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), $this->_rules(), DataHelper::_rulesMessage())->validate();
        $request['user_username'] = strtoupper($request->user_username);
        $credentials = $request->only('user_username', 'password');

        $getUser    = $this->_userRepository->getByUsername($credentials['user_username']);
        if (!$getUser) {
            return redirect('login')->with('error', 'Nomor KTA atau kata sandi salah!');
        }

        $currentDate = date('Y-m');
        $userActived = date("Y-m", strtotime($getUser->user_active_date));

        $compareDate = strtotime($userActived) < strtotime($currentDate);
        if ($compareDate == true) {
            $id = $getUser->user_id;
            if ($id != 1) {
                $this->_userRepository->update(['user_status' => 0, 'updated_at' => date('Y-m-d H:i:s'), 'updated_by' => 1], $id);
                return redirect('login')->with('error', 'Upps! Kartu anggota anda sudah tidak aktif, Silahkan hubungi admin untuk mengaktifkan!');
            }
        }

        if (Auth::attempt(['user_username' => $credentials['user_username'], 'user_password' => $credentials['password'], 'user_status' => 1])) {
            return redirect()->intended('dashboard');
        } else {
            return redirect('login')->with('error', 'Nomor KTA atau kata sandi salah!');
        }
    }

    public function settingProfile()
    {
        $getDetail  = $this->_userRepository->getById(Auth::user()->user_id);

        return view('user.setting', compact('getDetail'));
    }

    public function changepassword(Request $request)
    {

        $currpass   = $request->input('current_password');
        $password   = $request->input('user_password');

        if (!Hash::check($currpass, Auth::user()->user_password)) {
            return redirect('setting')->with('error', 'Kata sandi sekarang salah');
        }

        $this->_userRepository->update(DataHelper::_normalizeParams(['user_password' => $password], false, true), Auth::user()->user_id);

        return redirect('setting')->with('message', 'Kata sandi berhasil diubah');
    }

    public function sendforgot(Request $request)
    {

        $username   = $request->input('username');

        $getUser    = $this->_userRepository->getByUsername($username);

        if (!$getUser) {
            return redirect('forgot')->with('error', 'Nama pengguna tidak ditemukan!');
        }

        try {

            $this->_forgotRepository->insert(DataHelper::_normalizeParams(['user_id' => $getUser->user_id, 'created_by' => $getUser->user_id, 'created_at' => date('Y-m-d H:i:s')], false));

            return redirect('forgot')->with('success', 'Lupa kata sandi berhasil dikirim!');
        } catch (Exception $e) {
            return redirect('forgot')->with('error', 'Terjadi kesalahan!');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('home');
    }

    private function _rules()
    {

        $rules = array(
            'user_username'     => 'required',
            'password'     => 'required',
        );

        return $rules;
    }
}
