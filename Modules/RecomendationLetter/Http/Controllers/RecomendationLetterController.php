<?php

namespace Modules\RecomendationLetter\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use App\Mail\LetterSubmission;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Modules\FirearmCategory\Repositories\FirearmCategoryRepository;
use Modules\LetterCategory\Repositories\LetterCategoryRepository;
use Modules\RecomendationLetter\Repositories\LetterRequirementRepository;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;
use Modules\UserGroup\Repositories\UserGroupRepository;
use Modules\Users\Repositories\UsersRepository;
use PDF;

class RecomendationLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_userRepository   = new UsersRepository;
        $this->_userGroupRepository   = new UserGroupRepository;
        $this->_recomendationLetterRepository   = new RecomendationLetterRepository;
        $this->_letterRequirementRepository   = new LetterRequirementRepository;
        $this->_letterCategoryRepository   = new LetterCategoryRepository;
        $this->_firearmCategoryRepository   = new FirearmCategoryRepository;
        $this->module = "RecomendationLetter";

        $this->_logHelper       = new LogHelper;
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

        if (Auth::user()->user_id == 1 || Auth::user()->user_id == 2) {
            $letters = $this->_recomendationLetterRepository->getAll();
        } else {
            $params = [
                'letters.created_by' => Auth::user()->user_id,
            ];
            $letters = $this->_recomendationLetterRepository->getAllByParams($params);
        }
        $letter_categories = $this->_letterCategoryRepository->getAll();
        $firearm_categories = $this->_firearmCategoryRepository->getAll();
        $user = $this->_userRepository->getById(Auth::user()->user_id);

        return view('recomendationletter::index', compact('letters', 'letter_categories', 'firearm_categories', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('recomendationletter::create');
    }
    private function _validationRulesImage($categoryId)
    {
        switch ($categoryId) {
            case '1':
                return [
                    'file_buku_pas_senpi' => 'required|mimes:pdf|max:2048',
                    'file_kta' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_foto_4x6' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'firearm_category_id' => 'required',
                    'merek' => 'required',
                    'kaliber' => 'required',
                    'no_pabrik' => 'required',
                    'no_buku_pas_senpi' => 'required',
                    'nama_pemilik' => 'required',
                    'jumlah' => 'required',
                    'penyimpanan' => 'required',
                    'letter_category_id' => 'required',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'pemohon' => 'required'
                ];
                break;
            case '2':
                return [
                    'file_surat_hibah_senpi' => 'required|mimes:pdf|max:2048',
                    'file_buku_pas_senpi' => 'required|mimes:pdf|max:2048',
                    'file_foto_senjata' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_kta' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_sertif_menembak' => 'required|mimes:pdf|max:2048',
                    'file_skck' => 'required|mimes:pdf|max:2048',
                    'file_surat_sehat' => 'required|mimes:pdf|max:2048',
                    'file_tes_psikotes' => 'required|mimes:pdf|max:2048',
                    'file_kk' => 'required|mimes:pdf|max:2048',
                    'file_foto_4x6' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'firearm_category_id' => 'required',
                    'merek' => 'required',
                    'kaliber' => 'required',
                    'no_pabrik' => 'required',
                    'no_buku_pas_senpi' => 'required',
                    'nama_pemilik' => 'required',
                    'jumlah' => 'required',
                    'penyimpanan' => 'required',
                    'letter_category_id' => 'required',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'mutasi_alasan' => 'required',
                    'pemohon' => 'required'
                ];
                break;
            case '3':
                return [
                    'firearm_category_id' => 'required',
                    'merek' => 'required',
                    'kaliber' => 'required',
                    'no_pabrik' => 'required',
                    'no_buku_pas_senpi' => 'required',
                    'tanggal_dikeluarkan' => 'required',
                    'nama_pemilik' => 'required',
                    'jumlah' => 'required',
                    'letter_category_id' => 'required',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'name' => 'required',
                    'name2' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'occupation2' => 'required',
                    'address' => 'required',
                    'address2' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'no_kta2' => 'required',
                    'membership' => 'required',
                    'pemohon' => 'required',
                    'pemohon_pihak_2' => 'required',

                ];
                break;
            case '4':
                return [
                    'file_si_impor_senjata' => 'required|mimes:pdf|max:2048',
                    'file_sba_penitipan_senpi' => 'required|mimes:pdf|max:2048',
                    'file_kta' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_sertif_menembak' => 'required|mimes:pdf|max:2048',
                    'file_skck' => 'required|mimes:pdf|max:2048',
                    'file_surat_sehat' => 'required|mimes:pdf|max:2048',
                    'file_tes_psikotes' => 'required|mimes:pdf|max:2048',
                    'file_kk' => 'required|mimes:pdf|max:2048',
                    'file_foto_4x6' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'firearm_category_id' => 'required',
                    'merek' => 'required',
                    'kaliber' => 'required',
                    'no_pabrik' => 'required',
                    'no_buku_pas_senpi' => 'required',
                    'no_si_impor' => 'required',
                    'bap_senpi' => 'required',
                    'jumlah' => 'required',
                    'penyimpanan' => 'required',

                    'letter_category_id' => 'required',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'mutasi_alasan' => 'required',
                    'pemohon' => 'required'
                ];
                break;
            case '5':
                return [
                    'l5_lampiran1' => 'required|mimes:pdf|max:2048',
                    'nama_anggota_senjata_digunakan' => 'required|mimes:pdf|max:2048',
                    'file_kta' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_buku_pas_senpi' => 'required|mimes:pdf|max:2048',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'letter_category_id' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'waktu_mulai' => 'required',
                    'waktu_selesai' => 'required',
                    'dalam_event' => 'required',
                    'lokasi1' => 'required',
                    'jumlah_anggota' => 'required',
                    'pemohon' => 'required',
                ];
                break;
            case '6':
                return [
                    'surat_rekomendasi_pengcab' => 'required|mimes:pdf|max:2048',
                    'file_nama_anggota_senjata_digunakan' => 'required|mimes:pdf|max:2048',
                    'file_kta' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_buku_pas_senpi' => 'required|mimes:pdf|max:2048',
                    'file_surat_sehat' => 'required|mimes:pdf|max:2048',
                    'l6_undangan_berburu' => 'required|mimes:pdf|max:2048',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'letter_category_id' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'waktu_mulai' => 'required',
                    'waktu_selesai' => 'required',
                    'dalam_event' => 'required',
                    'lokasi1' => 'required',
                    'jumlah_anggota' => 'required',
                    'pemohon' => 'required',
                ];
                break;
            case '7':
                return [
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'letter_category_id' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'dalam_event' => 'required',
                    'l7_alasan_pengunduran' => 'required',
                    'tembusan1' => 'required',
                    'tembusan2' => 'required',
                    'pemohon' => 'required'
                ];
                break;

            case '8':
                return [
                    'l8_kta_anggota_baru' => 'required|mimes:pdf|max:2048',
                    'file_ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'l8_adart' => 'required|mimes:pdf|max:2048',
                    'l8_struktur_organisasi' => 'required|mimes:pdf|max:2048',
                    'l8_nama_para_pengurus' => 'required|mimes:pdf|max:2048',
                    'l8_pas_foto_pengurus' => 'required|mimes:pdf|max:2048',
                    'l8_data_anggota_club' => 'required|mimes:pdf|max:2048',
                    'l8_surat_keterangan_domisili' => 'required|mimes:pdf|max:2048',
                    'file_skck' => 'required|mimes:pdf|max:2048',
                    'biaya_administrasi' => 'required|mimes:pdf|max:2048',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'letter_category_id' => 'required',
                    'dasar_adart' => 'required',
                    'pemohon' => 'required'
                ];
                break;
            case '9':
                return [
                    'file_ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_kta_club' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'surat_rekomendasi_club' => 'required|mimes:pdf|max:2048',
                    'file_kta' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_foto_4x6' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'letter_category_id' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'mutasi_dari' => 'required',
                    'mutasi_menuju' => 'required',
                    'l9_cabang' => 'required',
                    'mutasi_alasan' => 'required',
                    'pemohon' => 'required'
                ];
                break;

            case '10':
                return [
                    'file_kta_club' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_ktp' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'file_buku_pas_senpi' => 'required|mimes:pdf|max:2048',
                    'file_foto_4x6' => 'required|mimes:jpg,jpeg,png|max:2048',
                    'letter_place' => 'required',
                    'letter_date' => 'required',
                    'letter_category_id' => 'required',
                    'name' => 'required',
                    'place_of_birth' => 'required',
                    'date_of_birth' => 'required',
                    'occupation' => 'required',
                    'address' => 'required',
                    'club' => 'required',
                    'no_kta' => 'required',
                    'membership' => 'required',
                    'firearm_category_id' => 'required',
                    'merek' => 'required',
                    'kaliber' => 'required',
                    'no_buku_pas_senpi' => 'required',
                    'tanggal_dikeluarkan' => 'required',
                    'jumlah' => 'required',
                    'nama_pemilik' => 'required',
                    'pemohon' => 'required',
                ];
                break;
            default:
                # code...
                break;
        }
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

        $categoryId = $request->letter_category_id;
        // check status pengajuan surat
        $params = [
            'letter_category_id'    => $categoryId,
            'created_by'            => Auth::user()->user_id,
            'letter_status'         => 1
        ];
        $check = $this->_recomendationLetterRepository->getByParams($params);
        if ($check) {
            return redirect('recomendationletter')->with('errorMessage', 'Gagal! Pengajuan sebelumnya masih diproses mohon ditunggu sampai pengajuan selesai! atau hubungi admin.');
        }

        switch ($categoryId) {
            case '1':
                DB::beginTransaction();
                try {

                    if (!$request->hasFile('file_buku_pas_senpi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_kta')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }
                    if (!$request->hasFile('file_ktp')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('file_foto_4x6')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }

                    $validatorImage = Validator::make($request->all(), $this->_validationRulesImage($categoryId));
                    if ($validatorImage->fails()) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran file/ gambar yang dimasukan sesuai.');
                    }

                    $filePath = DataHelper::getFilePath(null, null, true);

                    $file_buku_pas_senpi = $request->file_buku_pas_senpi;
                    $name_file_buku_pas_senpi = DataHelper::getFileName($file_buku_pas_senpi);
                    $request->file('file_buku_pas_senpi')->storeAs($filePath . "category-" . $categoryId, $name_file_buku_pas_senpi, 'public');

                    $file_kta = $request->file_kta;
                    $name_file_kta = DataHelper::getFileName($file_kta);
                    $request->file('file_kta')->storeAs($filePath . "category-" . $categoryId, $name_file_kta, 'public');

                    $file_ktp = $request->file_ktp;
                    $name_file_ktp = DataHelper::getFileName($file_ktp);
                    $request->file('file_ktp')->storeAs($filePath . "category-" . $categoryId, $name_file_ktp, 'public');

                    $file_foto_4x6 = $request->file_foto_4x6;
                    $name_file_foto_4x6 = DataHelper::getFileName($file_foto_4x6);
                    $request->file('file_foto_4x6')->storeAs($filePath . "category-" . $categoryId, $name_file_foto_4x6, 'public');

                    $data = [
                        'file_buku_pas_senpi' => $name_file_buku_pas_senpi,
                        'file_kta' => $name_file_kta,
                        'file_ktp' => $name_file_ktp,
                        'file_foto_4x6' => $name_file_foto_4x6,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $data = [
                        'firearm_category_id' => $request->firearm_category_id,
                        'merek' => $request->merek,
                        'kaliber' => $request->kaliber,
                        'no_pabrik' => $request->no_pabrik,
                        'no_buku_pas_senpi' => $request->no_buku_pas_senpi,
                        'nama_pemilik' => $request->nama_pemilik,
                        'jumlah' => $request->jumlah,
                        'penyimpanan' => $request->penyimpanan
                    ];
                    $firearmId = $this->_recomendationLetterRepository->insertGetIdFirearm(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->merek, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'firearm_id' => $firearmId,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');


                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '2':
                DB::beginTransaction();
                try {

                    if (!$request->hasFile('file_surat_hibah_senpi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_buku_pas_senpi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_foto_senjata')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_kta')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }
                    if (!$request->hasFile('file_ktp')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('file_sertif_menembak')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_skck')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_surat_sehat')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_tes_psikotes')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_kk')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_foto_4x6')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }

                    $validatorImage = Validator::make($request->all(), $this->_validationRulesImage($categoryId));
                    if ($validatorImage->fails()) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran file/ gambar yang dimasukan sesuai.');
                    }

                    $filePath = DataHelper::getFilePath(null, null, true);

                    $file_surat_hibah_senpi = $request->file_surat_hibah_senpi;
                    $name_file_surat_hibah_senpi = DataHelper::getFileName($file_surat_hibah_senpi);
                    $request->file('file_surat_hibah_senpi')->storeAs($filePath . "category-" . $categoryId, $name_file_surat_hibah_senpi, 'public');

                    $file_buku_pas_senpi = $request->file_buku_pas_senpi;
                    $name_file_buku_pas_senpi = DataHelper::getFileName($file_buku_pas_senpi);
                    $request->file('file_buku_pas_senpi')->storeAs($filePath . "category-" . $categoryId, $name_file_buku_pas_senpi, 'public');

                    $file_foto_senjata = $request->file_foto_senjata;
                    $name_file_foto_senjata = DataHelper::getFileName($file_foto_senjata);
                    $request->file('file_foto_senjata')->storeAs($filePath . "category-" . $categoryId, $name_file_foto_senjata, 'public');

                    $file_kta = $request->file_kta;
                    $name_file_kta = DataHelper::getFileName($file_kta);
                    $request->file('file_kta')->storeAs($filePath . "category-" . $categoryId, $name_file_kta, 'public');


                    $file_ktp = $request->file_ktp;
                    $name_file_ktp = DataHelper::getFileName($file_ktp);
                    $request->file('file_ktp')->storeAs($filePath . "category-" . $categoryId, $name_file_ktp, 'public');

                    $file_sertif_menembak = $request->file_sertif_menembak;
                    $name_file_sertif_menembak = DataHelper::getFileName($file_sertif_menembak);
                    $request->file('file_sertif_menembak')->storeAs($filePath . "category-" . $categoryId, $name_file_sertif_menembak, 'public');

                    $file_skck = $request->file_skck;
                    $name_file_skck = DataHelper::getFileName($file_skck);
                    $request->file('file_skck')->storeAs($filePath . "category-" . $categoryId, $name_file_skck, 'public');

                    $file_surat_sehat = $request->file_surat_sehat;
                    $name_file_surat_sehat = DataHelper::getFileName($file_surat_sehat);
                    $request->file('file_surat_sehat')->storeAs($filePath . "category-" . $categoryId, $name_file_surat_sehat, 'public');

                    $file_tes_psikotes = $request->file_tes_psikotes;
                    $name_file_tes_psikotes = DataHelper::getFileName($file_tes_psikotes);
                    $request->file('file_tes_psikotes')->storeAs($filePath . "category-" . $categoryId, $name_file_tes_psikotes, 'public');

                    $file_kk = $request->file_kk;
                    $name_file_kk = DataHelper::getFileName($file_kk);
                    $request->file('file_kk')->storeAs($filePath . "category-" . $categoryId, $name_file_kk, 'public');

                    $file_foto_4x6 = $request->file_foto_4x6;
                    $name_file_foto_4x6 = DataHelper::getFileName($file_foto_4x6);
                    $request->file('file_foto_4x6')->storeAs($filePath . "category-" . $categoryId, $name_file_foto_4x6, 'public');

                    $data = [
                        'file_surat_hibah_senpi' => $name_file_surat_hibah_senpi,
                        'file_buku_pas_senpi' => $name_file_buku_pas_senpi,
                        'file_foto_senjata' => $name_file_foto_senjata,
                        'file_kta' => $name_file_kta,
                        'file_ktp' => $name_file_ktp,
                        'file_sertif_menembak' => $name_file_sertif_menembak,
                        'file_skck' => $name_file_skck,
                        'file_surat_sehat' => $name_file_surat_sehat,
                        'file_tes_psikotes' => $name_file_tes_psikotes,
                        'file_kk' => $name_file_kk,
                        'file_foto_4x6' => $name_file_foto_4x6,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $data = [
                        'firearm_category_id' => $request->firearm_category_id,
                        'merek' => $request->merek,
                        'kaliber' => $request->kaliber,
                        'no_pabrik' => $request->no_pabrik,
                        'no_buku_pas_senpi' => $request->no_buku_pas_senpi,
                        'nama_pemilik' => $request->nama_pemilik,
                        'jumlah' => $request->jumlah,
                        'penyimpanan' => $request->penyimpanan
                    ];
                    $firearmId = $this->_recomendationLetterRepository->insertGetIdFirearm(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->merek, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'firearm_id' => $firearmId,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'mutasi_alasan' => $request->mutasi_alasan,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');


                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '3':
                DB::beginTransaction();
                try {

                    $data = [
                        'firearm_category_id' => $request->firearm_category_id,
                        'merek' => $request->merek,
                        'kaliber' => $request->kaliber,
                        'no_pabrik' => $request->no_pabrik,
                        'no_buku_pas_senpi' => $request->no_buku_pas_senpi,
                        'tanggal_dikeluarkan' => $request->tanggal_dikeluarkan,
                        'nama_pemilik' => $request->nama_pemilik,
                        'jumlah' => $request->jumlah,
                    ];
                    $firearmId = $this->_recomendationLetterRepository->insertGetIdFirearm(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->merek, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'firearm_id' => $firearmId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'name2' => $request->name2,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'occupation2' => $request->occupation2,
                        'address' => $request->address,
                        'address2' => $request->address2,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'no_kta2' => $request->no_kta2,
                        'membership' => $request->membership,
                        'pemohon' => $request->pemohon,
                        'pemohon_pihak_2' => $request->pemohon_pihak_2,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');


                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '4':
                DB::beginTransaction();
                try {
                    if (!$request->hasFile('file_si_impor_senjata')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_sba_penitipan_senpi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_kta')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }
                    if (!$request->hasFile('file_ktp')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('file_sertif_menembak')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_skck')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_surat_sehat')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_tes_psikotes')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_kk')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_foto_4x6')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }

                    $validatorImage = Validator::make($request->all(), $this->_validationRulesImage($categoryId));
                    if ($validatorImage->fails()) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran file/ gambar yang dimasukan sesuai.');
                    }

                    $filePath = DataHelper::getFilePath(null, null, true);

                    $file_si_impor_senjata = $request->file_si_impor_senjata;
                    $name_file_si_impor_senjata = DataHelper::getFileName($file_si_impor_senjata);
                    $request->file('file_si_impor_senjata')->storeAs($filePath . "category-" . $categoryId, $name_file_si_impor_senjata, 'public');

                    $file_sba_penitipan_senpi = $request->file_sba_penitipan_senpi;
                    $name_file_sba_penitipan_senpi = DataHelper::getFileName($file_sba_penitipan_senpi);
                    $request->file('file_sba_penitipan_senpi')->storeAs($filePath . "category-" . $categoryId, $name_file_sba_penitipan_senpi, 'public');

                    $file_kta = $request->file_kta;
                    $name_file_kta = DataHelper::getFileName($file_kta);
                    $request->file('file_kta')->storeAs($filePath . "category-" . $categoryId, $name_file_kta, 'public');

                    $file_ktp = $request->file_ktp;
                    $name_file_ktp = DataHelper::getFileName($file_ktp);
                    $request->file('file_ktp')->storeAs($filePath . "category-" . $categoryId, $name_file_ktp, 'public');

                    $file_sertif_menembak = $request->file_sertif_menembak;
                    $name_file_sertif_menembak = DataHelper::getFileName($file_sertif_menembak);
                    $request->file('file_sertif_menembak')->storeAs($filePath . "category-" . $categoryId, $name_file_sertif_menembak, 'public');

                    $file_skck = $request->file_skck;
                    $name_file_skck = DataHelper::getFileName($file_skck);
                    $request->file('file_skck')->storeAs($filePath . "category-" . $categoryId, $name_file_skck, 'public');

                    $file_surat_sehat = $request->file_surat_sehat;
                    $name_file_surat_sehat = DataHelper::getFileName($file_surat_sehat);
                    $request->file('file_surat_sehat')->storeAs($filePath . "category-" . $categoryId, $name_file_surat_sehat, 'public');

                    $file_tes_psikotes = $request->file_tes_psikotes;
                    $name_file_tes_psikotes = DataHelper::getFileName($file_tes_psikotes);
                    $request->file('file_tes_psikotes')->storeAs($filePath . "category-" . $categoryId, $name_file_tes_psikotes, 'public');

                    $file_kk = $request->file_kk;
                    $name_file_kk = DataHelper::getFileName($file_kk);
                    $request->file('file_kk')->storeAs($filePath . "category-" . $categoryId, $name_file_kk, 'public');

                    $file_foto_4x6 = $request->file_foto_4x6;
                    $name_file_foto_4x6 = DataHelper::getFileName($file_foto_4x6);
                    $request->file('file_foto_4x6')->storeAs($filePath . "category-" . $categoryId, $name_file_foto_4x6, 'public');

                    $data = [
                        'file_si_impor_senjata' => $name_file_si_impor_senjata,
                        'file_sba_penitipan_senpi' => $name_file_sba_penitipan_senpi,
                        'file_kta' => $name_file_kta,
                        'file_ktp' => $name_file_ktp,
                        'file_sertif_menembak' => $name_file_sertif_menembak,
                        'file_skck' => $name_file_skck,
                        'file_surat_sehat' => $name_file_surat_sehat,
                        'file_tes_psikotes' => $name_file_tes_psikotes,
                        'file_kk' => $name_file_kk,
                        'file_foto_4x6' => $name_file_foto_4x6,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $data = [
                        'firearm_category_id' => $request->firearm_category_id,
                        'merek' => $request->merek,
                        'kaliber' => $request->kaliber,
                        'no_pabrik' => $request->no_pabrik,
                        'no_buku_pas_senpi' => $request->no_buku_pas_senpi,
                        'no_si_impor' => $request->no_si_impor,
                        'bap_senpi' => $request->bap_senpi,
                        'nama_pemilik' => $request->nama_pemilik,
                        'jumlah' => $request->jumlah,
                        'penyimpanan' => $request->penyimpanan
                    ];
                    $firearmId = $this->_recomendationLetterRepository->insertGetIdFirearm(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->merek, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'firearm_id' => $firearmId,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'mutasi_alasan' => $request->mutasi_alasan,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');

                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '5':
                DB::beginTransaction();
                try {
                    if (!$request->hasFile('l5_lampiran1')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('nama_anggota_senjata_digunakan')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_kta')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }
                    if (!$request->hasFile('file_buku_pas_senpi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }

                    $validatorImage = Validator::make($request->all(), $this->_validationRulesImage($categoryId));
                    if ($validatorImage->fails()) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran file/ gambar yang dimasukan sesuai.');
                    }

                    $filePath = DataHelper::getFilePath(null, null, true);

                    $l5_lampiran1 = $request->l5_lampiran1;
                    $name_l5_lampiran1 = DataHelper::getFileName($l5_lampiran1);
                    $request->file('l5_lampiran1')->storeAs($filePath . "category-" . $categoryId, $name_l5_lampiran1, 'public');

                    $nama_anggota_senjata_digunakan = $request->nama_anggota_senjata_digunakan;
                    $name_nama_anggota_senjata_digunakan = DataHelper::getFileName($nama_anggota_senjata_digunakan);
                    $request->file('nama_anggota_senjata_digunakan')->storeAs($filePath . "category-" . $categoryId, $name_nama_anggota_senjata_digunakan, 'public');

                    $file_kta = $request->file_kta;
                    $name_file_kta = DataHelper::getFileName($file_kta);
                    $request->file('file_kta')->storeAs($filePath . "category-" . $categoryId, $name_file_kta, 'public');

                    $file_buku_pas_senpi = $request->file_buku_pas_senpi;
                    $name_file_buku_pas_senpi = DataHelper::getFileName($file_buku_pas_senpi);
                    $request->file('file_buku_pas_senpi')->storeAs($filePath . "category-" . $categoryId, $name_file_buku_pas_senpi, 'public');

                    $data = [
                        'l5_lampiran1' => $name_l5_lampiran1,
                        'nama_anggota_senjata_digunakan' => $name_nama_anggota_senjata_digunakan,
                        'file_kta' => $name_file_kta,
                        'file_buku_pas_senpi' => $name_file_buku_pas_senpi,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'waktu_mulai' => $request->waktu_mulai,
                        'waktu_selesai' => $request->waktu_selesai,
                        'dalam_event' => $request->dalam_event,
                        'lokasi1' => $request->lokasi1,
                        'lokasi2' => $request->lokasi2,
                        'lokasi3' => $request->lokasi3,
                        'lokasi4' => $request->lokasi4,
                        'jumlah_anggota' => $request->jumlah_anggota,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');

                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '6':
                DB::beginTransaction();
                try {

                    if (!$request->hasFile('surat_rekomendasi_pengcab')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }
                    if (!$request->hasFile('file_nama_anggota_senjata_digunakan')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_kta')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_buku_pas_senpi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('file_surat_sehat')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('l6_undangan_berburu')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }

                    $validatorImage = Validator::make($request->all(), $this->_validationRulesImage($categoryId));
                    if ($validatorImage->fails()) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran file/ gambar yang dimasukan sesuai.');
                    }

                    $filePath = DataHelper::getFilePath(null, null, true);

                    $file_nama_anggota_senjata_digunakan = $request->file_nama_anggota_senjata_digunakan;
                    $name_file_nama_anggota_senjata_digunakan = DataHelper::getFileName($file_nama_anggota_senjata_digunakan);
                    $request->file('file_nama_anggota_senjata_digunakan')->storeAs($filePath . "category-" . $categoryId, $name_file_nama_anggota_senjata_digunakan, 'public');

                    $file_kta = $request->file_kta;
                    $name_file_kta = DataHelper::getFileName($file_kta);
                    $request->file('file_kta')->storeAs($filePath . "category-" . $categoryId, $name_nama_anggota_senjata_digunakan, 'public');

                    $surat_rekomendasi_pengcab = $request->surat_rekomendasi_pengcab;
                    $name_surat_rekomendasi_pengcab = DataHelper::getFileName($surat_rekomendasi_pengcab);
                    $request->file('surat_rekomendasi_pengcab')->storeAs($filePath . "category-" . $categoryId, $name_surat_rekomendasi_pengcab, 'public');

                    $file_buku_pas_senpi = $request->file_buku_pas_senpi;
                    $name_file_buku_pas_senpi = DataHelper::getFileName($file_buku_pas_senpi);
                    $request->file('file_buku_pas_senpi')->storeAs($filePath . "category-" . $categoryId, $name_file_buku_pas_senpi, 'public');

                    $file_surat_sehat = $request->file_surat_sehat;
                    $name_file_surat_sehat = DataHelper::getFileName($file_surat_sehat);
                    $request->file('file_surat_sehat')->storeAs($filePath . "category-" . $categoryId, $name_file_surat_sehat, 'public');

                    $l6_undangan_berburu = $request->l6_undangan_berburu;
                    $name_l6_undangan_berburu = DataHelper::getFileName($l6_undangan_berburu);
                    $request->file('l6_undangan_berburu')->storeAs($filePath . "category-" . $categoryId, $name_l6_undangan_berburu, 'public');

                    $data = [
                        'surat_rekomendasi_pengcab' => $name_surat_rekomendasi_pengcab,
                        'file_nama_anggota_senjata_digunakan' => $name_file_nama_anggota_senjata_digunakan,
                        'file_kta' => $name_file_kta,
                        'file_buku_pas_senpi' => $name_file_buku_pas_senpi,
                        'file_surat_sehat' => $name_file_surat_sehat,
                        'l6_undangan_berburu' => $name_l6_undangan_berburu,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'dalam_event' => $request->dalam_event,
                        'lokasi1' => $request->lokasi1,
                        'waktu_mulai' => $request->waktu_mulai,
                        'waktu_selesai' => $request->waktu_selesai,
                        'jumlah_anggota' => $request->jumlah_anggota,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');

                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '7':
                DB::beginTransaction();
                try {
                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'dalam_event' => $request->dalam_event,
                        'l7_alasan_pengunduran' => $request->l7_alasan_pengunduran,
                        'tembusan1' => $request->tembusan1,
                        'tembusan2' => $request->tembusan2,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');

                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '8':
                DB::beginTransaction();
                try {
                    if (!$request->hasFile('l8_kta_anggota_baru')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_ktp')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('l8_adart')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('l8_struktur_organisasi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('l8_nama_para_pengurus')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }
                    if (!$request->hasFile('l8_pas_foto_pengurus')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('l8_data_anggota_club')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('l8_surat_keterangan_domisili')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('file_skck')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }
                    if (!$request->hasFile('biaya_administrasi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File foto harus dipilih!');
                    }

                    $validatorImage = Validator::make($request->all(), $this->_validationRulesImage($categoryId));
                    if ($validatorImage->fails()) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran file/ gambar yang dimasukan sesuai.');
                    }

                    $filePath = DataHelper::getFilePath(null, null, true);

                    $l8_kta_anggota_baru = $request->l8_kta_anggota_baru;
                    $name_l8_kta_anggota_baru = DataHelper::getFileName($l8_kta_anggota_baru);
                    $request->file('l8_kta_anggota_baru')->storeAs($filePath . "category-" . $categoryId, $name_l8_kta_anggota_baru, 'public');

                    $file_ktp = $request->file_ktp;
                    $name_file_ktp = DataHelper::getFileName($file_ktp);
                    $request->file('file_ktp')->storeAs($filePath . "category-" . $categoryId, $name_file_ktp, 'public');

                    $l8_adart = $request->l8_adart;
                    $name_l8_adart = DataHelper::getFileName($l8_adart);
                    $request->file('l8_adart')->storeAs($filePath . "category-" . $categoryId, $name_l8_adart, 'public');

                    $l8_struktur_organisasi = $request->l8_struktur_organisasi;
                    $name_l8_struktur_organisasi = DataHelper::getFileName($l8_struktur_organisasi);
                    $request->file('l8_struktur_organisasi')->storeAs($filePath . "category-" . $categoryId, $name_l8_struktur_organisasi, 'public');

                    $l8_nama_para_pengurus = $request->l8_nama_para_pengurus;
                    $name_l8_nama_para_pengurus = DataHelper::getFileName($l8_nama_para_pengurus);
                    $request->file('l8_nama_para_pengurus')->storeAs($filePath . "category-" . $categoryId, $name_l8_nama_para_pengurus, 'public');

                    $l8_pas_foto_pengurus = $request->l8_pas_foto_pengurus;
                    $name_l8_pas_foto_pengurus = DataHelper::getFileName($l8_pas_foto_pengurus);
                    $request->file('l8_pas_foto_pengurus')->storeAs($filePath . "category-" . $categoryId, $name_l8_pas_foto_pengurus, 'public');

                    $l8_data_anggota_club = $request->l8_data_anggota_club;
                    $name_l8_data_anggota_club = DataHelper::getFileName($l8_data_anggota_club);
                    $request->file('l8_data_anggota_club')->storeAs($filePath . "category-" . $categoryId, $name_l8_data_anggota_club, 'public');

                    $l8_surat_keterangan_domisili = $request->l8_surat_keterangan_domisili;
                    $name_l8_surat_keterangan_domisili = DataHelper::getFileName($l8_surat_keterangan_domisili);
                    $request->file('l8_surat_keterangan_domisili')->storeAs($filePath . "category-" . $categoryId, $name_l8_surat_keterangan_domisili, 'public');

                    $file_skck = $request->file_skck;
                    $name_file_skck = DataHelper::getFileName($file_skck);
                    $request->file('file_skck')->storeAs($filePath . "category-" . $categoryId, $name_file_skck, 'public');

                    $biaya_administrasi = $request->biaya_administrasi;
                    $name_biaya_administrasi = DataHelper::getFileName($biaya_administrasi);
                    $request->file('biaya_administrasi')->storeAs($filePath . "category-" . $categoryId, $name_biaya_administrasi, 'public');

                    $data = [
                        'l8_kta_anggota_baru' => $name_l8_kta_anggota_baru,
                        'file_ktp' => $name_file_ktp,
                        'l8_adart' => $name_l8_adart,
                        'l8_struktur_organisasi' => $name_l8_struktur_organisasi,
                        'l8_nama_para_pengurus' => $name_l8_nama_para_pengurus,
                        'l8_pas_foto_pengurus' => $name_l8_pas_foto_pengurus,
                        'l8_data_anggota_club' => $name_l8_data_anggota_club,
                        'l8_surat_keterangan_domisili' => $name_l8_surat_keterangan_domisili,
                        'file_skck' => $name_file_skck,
                        'biaya_administrasi' => $name_biaya_administrasi,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'dasar_adart' => $request->dasar_adart,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');


                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '9':
                DB::beginTransaction();
                try {
                    if (!$request->hasFile('file_ktp')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('file_kta_club')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('surat_rekomendasi_club')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_kta')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_foto_4x6')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }


                    $filePath = DataHelper::getFilePath(null, null, true);

                    $file_ktp = $request->file_ktp;
                    $name_file_ktp = DataHelper::getFileName($file_ktp);
                    $request->file('file_ktp')->storeAs($filePath . "category-" . $categoryId, $name_file_ktp, 'public');

                    $file_kta_club = $request->file_kta_club;
                    $name_file_kta_club = DataHelper::getFileName($file_kta_club);
                    $request->file('file_kta_club')->storeAs($filePath . "category-" . $categoryId, $name_file_kta_club, 'public');

                    $surat_rekomendasi_club = $request->surat_rekomendasi_club;
                    $name_surat_rekomendasi_club = DataHelper::getFileName($surat_rekomendasi_club);
                    $request->file('surat_rekomendasi_club')->storeAs($filePath . "category-" . $categoryId, $name_surat_rekomendasi_club, 'public');

                    $file_kta = $request->file_kta;
                    $name_file_kta = DataHelper::getFileName($file_kta);
                    $request->file('file_kta')->storeAs($filePath . "category-" . $categoryId, $name_file_kta, 'public');

                    $file_foto_4x6 = $request->file_foto_4x6;
                    $name_file_foto_4x6 = DataHelper::getFileName($file_foto_4x6);
                    $request->file('file_foto_4x6')->storeAs($filePath . "category-" . $categoryId, $name_file_foto_4x6, 'public');

                    $data = [
                        'file_ktp' => $name_file_ktp,
                        'file_kta_club' => $name_file_kta_club,
                        'surat_rekomendasi_club' => $name_surat_rekomendasi_club,
                        'file_kta' => $name_file_kta,
                        'file_foto_4x6' => $name_file_foto_4x6,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'mutasi_dari' => $request->mutasi_dari,
                        'mutasi_menuju' => $request->mutasi_menuju,
                        'l9_cabang' => $request->l9_cabang,
                        'mutasi_alasan' => $request->mutasi_alasan,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');

                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            case '10':
                DB::beginTransaction();
                try {
                    if (!$request->hasFile('file_kta_club')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_ktp')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File ktp harus dipilih!');
                    }
                    if (!$request->hasFile('file_buku_pas_senpi')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File buku pas senpi harus dipilih!');
                    }
                    if (!$request->hasFile('file_foto_4x6')) {
                        return redirect('recomendationletter')->with('errorMessage', 'Gagal! File kta harus dipilih!');
                    }


                    $filePath = DataHelper::getFilePath(null, null, true);

                    $file_kta_club = $request->file_kta_club;
                    $name_file_kta_club = DataHelper::getFileName($file_kta_club);
                    $request->file('file_kta_club')->storeAs($filePath . "category-" . $categoryId, $name_file_kta_club, 'public');

                    $file_ktp = $request->file_ktp;
                    $name_file_ktp = DataHelper::getFileName($file_ktp);
                    $request->file('file_ktp')->storeAs($filePath . "category-" . $categoryId, $name_file_ktp, 'public');

                    $file_buku_pas_senpi = $request->file_buku_pas_senpi;
                    $name_file_buku_pas_senpi = DataHelper::getFileName($file_buku_pas_senpi);
                    $request->file('file_buku_pas_senpi')->storeAs($filePath . "category-" . $categoryId, $name_file_buku_pas_senpi, 'public');

                    $file_foto_4x6 = $request->file_foto_4x6;
                    $name_file_foto_4x6 = DataHelper::getFileName($file_foto_4x6);
                    $request->file('file_foto_4x6')->storeAs($filePath . "category-" . $categoryId, $name_file_foto_4x6, 'public');

                    $data = [
                        'file_kta_club' => $name_file_kta_club,
                        'file_ktp' => $name_file_ktp,
                        'file_buku_pas_senpi' => $name_file_buku_pas_senpi,
                        'file_foto_4x6' => $name_file_foto_4x6,
                    ];
                    $letterRequirementId = $this->_letterRequirementRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, "upload file letters required category-" . $categoryId, 'create');

                    $data = [
                        'firearm_category_id' => $request->firearm_category_id,
                        'merek' => $request->merek,
                        'kaliber' => $request->kaliber,
                        'no_pabrik' => $request->no_pabrik,
                        'no_buku_pas_senpi' => $request->no_buku_pas_senpi,
                        'tanggal_dikeluarkan' => $request->tanggal_dikeluarkan,
                        'nama_pemilik' => $request->nama_pemilik,
                        'jumlah' => $request->jumlah,
                        'penyimpanan' => $request->penyimpanan
                    ];
                    $firearmId = $this->_recomendationLetterRepository->insertGetIdFirearm(array_merge($data, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->merek, 'create');

                    $dataLetter = [
                        'letter_category_id' => $request->letter_category_id,
                        'firearm_id' => $firearmId,
                        'letter_requirement_id' => $letterRequirementId,
                        'letter_place' => $request->letter_place,
                        'letter_date' => $request->letter_date,
                        'name' => $request->name,
                        'place_of_birth' => $request->place_of_birth,
                        'date_of_birth' => $request->date_of_birth,
                        'occupation' => $request->occupation,
                        'address' => $request->address,
                        'club' => $request->club,
                        'no_kta' => $request->no_kta,
                        'membership' => $request->membership,
                        'pemohon' => $request->pemohon,
                        'letter_status' => 1
                    ];

                    $letter_id = $this->_recomendationLetterRepository->insertGetIdLetter(array_merge($dataLetter, DataHelper::_signParams(true)));
                    $this->_logHelper->store($this->module, $request->pemohon, 'create');

                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'admin']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);
                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }
                    Mail::to($email)->send(new LetterSubmission($letter_id));

                    DB::commit();
                    return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
                } catch (\Throwable $th) {

                    DB::rollBack();
                    return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
                }
                break;
            default:
                return redirect('recomendationletter')->with('errorMessage', 'Kategori surat tidak ditemukan!');
                break;
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

        $getDetailLetter  = $this->_recomendationLetterRepository->getByIdLetter($id);

        $user = $this->_userRepository->getById($getDetailLetter->created_by);
        $idLetterRequirement = $getDetailLetter->letter_requirement_id;
        $idLetterRequirement != null ?  $letterRequireFile =  $this->_letterRequirementRepository->getById($getDetailLetter->letter_requirement_id) :  $letterRequireFile = null;
        $result = [
            $user,
            $getDetailLetter,
            $letterRequireFile,
        ];
        if ($getDetailLetter) {
            return DataHelper::_successResponse($result, 'Data berhasil ditemukan');
        } else {
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('recomendationletter::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
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
        $detail  = $this->_recomendationLetterRepository->getById($id);

        if (!$detail) {
            return redirect('sysmenu');
        }

        DB::beginTransaction();
        $this->_recomendationLetterRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->name, 'delete');
        $this->_recomendationLetterRepository->deleteFirearm($detail->firearm_id);
        $this->_logHelper->store($this->module, $detail->firearm_id, 'delete');
        DB::commit();

        return redirect('recomendationletter')->with('successMessage', 'Surat berhasil dihapus');
    }



    public function downloadLetter($id)
    {
        switch ($id) {
            case 11:
                $letterName = '\data-anggota.docx';
                break;

            case 12:
                $letterName = '\pendaftaran-anggota-baru.docx';
                break;

            default:
                # code...
                break;
        }
        $filePath = public_path('storage\downloads\letters' . $letterName);
        $headers = ['Content-Type: application/docx'];
        $fileName = time() . '.docx';

        return response()->download($filePath, $fileName, $headers);
    }

    /**
     * Print letter on PDF view file.
     * @return Location
     */
    public function printLetter($id)
    {
        $letter = $this->_recomendationLetterRepository->getByIdLetter($id);
        $category = $letter->letter_category_id;
        switch ($category) {
            case 1:
                return view('recomendationletter::letters.print_letter_1', compact('letter'));
                break;

            case 2:
                return view('recomendationletter::letters.print_letter_2', compact('letter'));
                break;

            case 4:
                return view('recomendationletter::letters.print_letter_4', compact('letter'));
                break;

            case 10:
                return view('recomendationletter::letters.print_letter_10', compact('letter'));
                break;

            default:
                # code...
                break;
        }
    }
}
