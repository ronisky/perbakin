<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Helpers\DataHelper;
use App\Mail\WelcomeMember;
use App\Repositories\UserForgotRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Modules\Club\Repositories\ClubRepository;
use Modules\Users\Repositories\UsersRepository;

class UserController extends Controller
{

    public function __construct()
    {

        $this->_userRepository      = new UsersRepository;
        $this->_forgotRepository    = new UserForgotRepository;
        $this->_clubRepository     = new ClubRepository;
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('dashboard');
        }

        return view('user.login');
    }

    public function register()
    {
        return view('user.registration');
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
        $validator = Validator::make($request->all(), $this->_rules(''));

        if ($validator->fails()) {
            return redirect('login')->with('error', 'Nomor KTA atau kata sandi salah!');
        }

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
                $update_data = [
                    'user_status' => 0,
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                DB::beginTransaction();
                $this->_userRepository->update($update_data, $id);
                // $this->_logHelper->store('user', $getUser->user_username, 'update');
                DB::commit();

                return redirect('login')->with('error', 'Upps! Kartu anggota anda sudah tidak aktif, Silahkan hubungi admin untuk mengaktifkan!');
            }
        }

        if (Auth::attempt(['user_username' => $credentials['user_username'], 'user_password' => $credentials['password'], 'user_status' => 1])) {
            if ($getUser->group_id == 5) {
                return redirect()->intended('recomendationletter');
            } else {
                return redirect()->intended('dashboard');
            }
        } else {
            return redirect('login')->with('error', 'Nomor KTA atau kata sandi salah!');
        }
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), $this->_rules('register'));

        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }

        $userData = [
            'user_kta'      => $request->user_kta,
            'user_email'    => $request->user_email,
            'user_phone'    => $request->user_phone,
            'user_status'   => 0
        ];

        $user = $this->_userRepository->getByParams($userData);
        if (!$user) {
            return redirect('register')->with('error', 'Pendaftaran Gagal! pastikan Nomor KTA / Email / Nomor Hp anda terdaftar di Perbakin Kab. Bandung || (atau) Hubungi admin.');
        } else {
            $clearspace = str_replace(" ", "", strtoupper($request->user_kta));
            $preusername = str_replace("/", "", $clearspace);
            $username = substr($preusername, 0, -4);

            $update_data = [
                'user_username'     => $username,
                'user_password'     => Hash::make($request->password),
                'user_status'       => 1,
                'updated_at'        => date('Y-m-d H:i:s'),
            ];

            DB::beginTransaction();
            $this->_userRepository->update($update_data, $user->user_id);
            // $this->_logHelper->store('user', $username, 'update');

            Mail::to($request->user_email)->send(new WelcomeMember($user->user_id, $request->password));

            DB::commit();

            return redirect('register')->with('success', 'Selamat Anda berhasil terdaftar sebagai anggota, silahkan cek email (inbox / folder spam) untuk melihat data pendafataran Anda.');
        }
    }

    public function settingProfile()
    {
        $getDetail  = $this->_userRepository->getById(Auth::user()->user_id);
        $clubs    = $this->_clubRepository->getAll();
        return view('user.setting', compact('getDetail', 'clubs'));
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

    private function _rules($tag)
    {
        if ($tag != 'register') {
            $rules = array(
                'user_username'     => 'required',
                'password'     => 'required',
            );
        } else {
            $rules = array(
                'user_kta'          => 'required',
                'user_email'        => 'required|email',
                'user_phone'        => 'required',
                'password' => [
                    'required', 'confirmed', Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols(),
                ],
            );
        }


        return $rules;
    }
}
