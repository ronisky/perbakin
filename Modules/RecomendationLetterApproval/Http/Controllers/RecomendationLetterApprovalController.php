<?php

namespace Modules\RecomendationLetterApproval\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use App\Mail\LetterSubmission;
use App\Mail\LetterSubmissionFaild;
use App\Mail\LetterSubmissionSuccess;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Modules\FirearmCategory\Repositories\FirearmCategoryRepository;
use Modules\LetterCategory\Repositories\LetterCategoryRepository;
use Modules\RecomendationLetter\Repositories\FirearmRepository;
use Modules\RecomendationLetter\Repositories\LetterRequirementRepository;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;
use Modules\UserGroup\Repositories\UserGroupRepository;
use Modules\Users\Repositories\UsersRepository;

class RecomendationLetterApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_userGroupRepository   = new UserGroupRepository;
        $this->_userRepository   = new UsersRepository;
        $this->_recomendationLetterRepository   = new RecomendationLetterRepository;
        $this->_letterCategoryRepository   = new LetterCategoryRepository;
        $this->_letterRequirementRepository   = new LetterRequirementRepository;
        $this->_firearmRepository   = new FirearmRepository;
        $this->_firearmCategoryRepository   = new FirearmCategoryRepository;
        $this->module = "RecomendationLetterApproval";

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
            return view('exceptions.unauthorize');
        }

        $letters = $this->_recomendationLetterRepository->getAll();
        $letter_categories = $this->_letterCategoryRepository->getAll();
        $firearm_categories = $this->_firearmCategoryRepository->getAll();

        return view('recomendationletterapproval::index', compact('letters', 'letter_categories', 'firearm_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('recomendationletterapproval::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
            return view('exceptions.unauthorize');
        }

        $getDetailLetter  = $this->_recomendationLetterRepository->getById($id);

        $user = $this->_userRepository->getById($getDetailLetter->created_by);
        $idLetterRequirement = $getDetailLetter->letter_requirement_id;
        $idFirearm = $getDetailLetter->firearm_id;

        $idLetterRequirement != null ?  $letterRequireFile =  $this->_letterRequirementRepository->getById($getDetailLetter->letter_requirement_id) :  $letterRequireFile = null;
        $idFirearm !=  null ? $letterFirearm = $this->_firearmRepository->getById($idFirearm) : $letterFirearm = null;
        $result = [
            $user,
            $getDetailLetter,
            $letterRequireFile,
            $letterFirearm,
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
        return view('recomendationletterapproval::edit');
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
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatestatus(Request $request, $id)
    {
        $status         = $request->status;
        $status_code    = $request->status_code;
        $user_id        = Auth::user()->user_id;

        if ($status_code == 1) {
            switch ($status) {
                case 'admin':
                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'sekum']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);

                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }

                    $data = [
                        'admin_status'      => $request->status_code,
                        'admin_status_by'   => $user_id,
                        'admin_note'        => null,
                        'letter_status'     => 2,
                    ];
                    $result = $this->_updateStatus($data, $id);

                    if ($result) {
                        Mail::to($email)->send(new LetterSubmission($id));
                        return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                    } else {
                        return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                    }

                    break;
                case 'sekum':
                    $userGroup = $this->_userGroupRepository->getByParams(['group_name' => 'ketua']);
                    $users = $this->_userRepository->getAllByParams(['group_id' => $userGroup->group_id]);

                    $email = [];
                    foreach ($users as $user) {
                        array_push($email, $user->user_email);
                    }

                    $data = [
                        'sekum_status'      => $request->status_code,
                        'sekum_status_by'   => $user_id,
                        'sekum_note'        => null,
                        'letter_status'     => 2,
                    ];
                    $result = $this->_updateStatus($data, $id);

                    if ($result) {
                        Mail::to($email)->send(new LetterSubmission($id));
                        return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                    } else {
                        return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                    }

                    break;
                case 'ketua':
                    $userletter = $this->_recomendationLetterRepository->getByParams(['letter_id' => $id]);
                    $user = $this->_userRepository->getByParams(['user_kta' => $userletter->no_kta]);

                    $email = $user->user_email;

                    $data = [
                        'ketua_status'  => $request->status_code,
                        'ketua_status_by'   => $user_id,
                        'ketua_note'    => null,
                        'letter_status'    => 3,
                    ];
                    $result = $this->_updateStatus($data, $id);
                    if ($result) {
                        Mail::to($email)->send(new LetterSubmissionSuccess($id));
                        return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                    } else {
                        return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                    }

                    break;

                default:
                    return DataHelper::_errorResponse(null, 'Opps! Maaf status gagal diubah.');
                    break;
            }
        } else {
            switch ($status) {
                case 'admin':
                    $userletter = $this->_recomendationLetterRepository->getByParams(['letter_id' => $id]);
                    $user = $this->_userRepository->getByParams(['user_kta' => $userletter->no_kta]);

                    $email = $user->user_email;

                    $checkData = $request->checkbox;
                    $other_note = $request->other_note;
                    if ($checkData != null) {
                        if ($request->other_note != null) {
                            array_push($checkData, $request->other_note);
                        }
                        $data = implode("|", $checkData);

                        $updateData = [
                            'admin_status'      => 2,
                            'admin_status_by'   => $user_id,
                            'admin_note'        => $data,
                            'letter_status'     => 4,
                        ];

                        $result = $this->_updateStatus($updateData, $id);
                        if ($result) {
                            Mail::to($email)->send(new LetterSubmissionFaild($id, 'admin'));
                            return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                        } else {
                            return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                        }
                    } elseif ($other_note != null) {
                        $updateData = [
                            'admin_status'  => 2,
                            'admin_status_by'   => $user_id,
                            'admin_note'    => $other_note,
                            'letter_status'     => 4,
                        ];

                        $result = $this->_updateStatus($updateData, $id);
                        if ($result) {
                            Mail::to($email)->send(new LetterSubmissionFaild($id, 'admin'));
                            return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                        } else {
                            return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                        }
                    } else {
                        return DataHelper::_errorResponse(null, 'Opps! Maaf status gagal diubah.');
                    }

                    break;
                case 'sekum':
                    $userletter = $this->_recomendationLetterRepository->getByParams(['letter_id' => $id]);
                    $user = $this->_userRepository->getByParams(['user_kta' => $userletter->no_kta]);

                    $email = $user->user_email;

                    $checkData = $request->checkbox;
                    $other_note = $request->other_note;
                    if ($checkData != null) {
                        if ($request->other_note != null) {
                            array_push($checkData, $request->other_note);
                        }
                        $data = implode("|", $checkData);

                        $updateData = [
                            'sekum_status'  => 2,
                            'sekum_status_by'   => $user_id,
                            'sekum_note'    => $data,
                            'letter_status'     => 4,
                        ];

                        $result = $this->_updateStatus($updateData, $id);
                        if ($result) {
                            Mail::to($email)->send(new LetterSubmissionFaild($id, 'sekum'));
                            return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                        } else {
                            return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                        }
                    } elseif ($other_note != null) {
                        $updateData = [
                            'sekum_status'  => 2,
                            'sekum_status_by'   => $user_id,
                            'sekum_note'    => $other_note,
                            'letter_status'     => 4,
                        ];

                        $result = $this->_updateStatus($updateData, $id);
                        if ($result) {
                            Mail::to($email)->send(new LetterSubmissionFaild($id, 'sekum'));
                            return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                        } else {
                            return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                        }
                    } else {
                        return DataHelper::_errorResponse(null, 'Opps! Maaf status gagal diubah.');
                    }

                    break;
                case 'ketua':
                    $userletter = $this->_recomendationLetterRepository->getByParams(['letter_id' => $id]);
                    $user = $this->_userRepository->getByParams(['user_kta' => $userletter->no_kta]);

                    $email = $user->user_email;

                    $checkData = $request->checkbox;
                    $other_note = $request->other_note;
                    if ($checkData != null) {
                        if ($request->other_note != null) {
                            array_push($checkData, $request->other_note);
                        }
                        $data = implode("|", $checkData);

                        $updateData = [
                            'ketua_status'  => 2,
                            'ketua_status_by'   => $user_id,
                            'ketua_note'    => $data,
                            'letter_status'     => 4,
                        ];

                        $result = $this->_updateStatus($updateData, $id);
                        if ($result) {
                            Mail::to($email)->send(new LetterSubmissionFaild($id, 'ketua'));
                            return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                        } else {
                            return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                        }
                    } elseif ($other_note != null) {
                        $updateData = [
                            'ketua_status'  => 2,
                            'ketua_status_by'   => $user_id,
                            'ketua_note'    => $other_note,
                            'letter_status'     => 4,
                        ];

                        $result = $this->_updateStatus($updateData, $id);
                        if ($result) {
                            Mail::to($email)->send(new LetterSubmissionFaild($id, 'ketua'));
                            return DataHelper::_successResponse(null, 'Status surat berhasil diubah');
                        } else {
                            return DataHelper::_errorResponse(null, 'Gagal mengubah status');
                        }
                    } else {
                        return DataHelper::_errorResponse(null, 'Opps! Maaf status gagal diubah.');
                    }

                    break;

                default:
                    return DataHelper::_errorResponse(null, 'Opps! Maaf status gagal diubah.');
                    break;
            }
        }
    }

    protected function _updateStatus($data, $id)
    {
        DB::beginTransaction();
        try {
            $this->_recomendationLetterRepository->update(DataHelper::_normalizeParams($data, false, true), $id);
            $this->_logHelper->store($this->module, $id, 'update');

            DB::commit();

            return true;
        } catch (\Throwable $th) {

            DB::rollBack();
            return false;
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
            return view('exceptions.unauthorize');
        }
        // Check detail to db
        $detail  = $this->_recomendationLetterRepository->getById($id);

        if (!$detail) {
            return DataHelper::_errorResponse(null, "Data suart tidak ditemukan");
        }

        DB::beginTransaction();
        $this->_recomendationLetterRepository->delete($id);
        $this->_logHelper->store($this->module, "category-" . $detail->letter_category_id . "-name-" . $detail->name, 'delete');

        if ($detail->firearm_id != null) {
            $this->_firearmRepository->delete($detail->firearm_id);
            $this->_logHelper->store($this->module, $detail->firearm_id, 'delete');
        }

        if ($detail->letter_requirement_id != null) {
            $letterReq = $this->_letterRequirementRepository->getById($detail->letter_requirement_id);

            $filePathLetter = DataHelper::getFilePath(null, null, true);
            $filePath = $filePathLetter . "category-" . $detail->letter_category_id . "/";

            if ($letterReq->file_buku_pas_senpi != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_buku_pas_senpi);
            }
            if ($letterReq->file_kta != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_kta);
            }
            if ($letterReq->file_kta_club != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_kta_club);
            }
            if ($letterReq->file_ktp != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_ktp);
            }
            if ($letterReq->file_surat_hibah_senpi != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_surat_hibah_senpi);
            }
            if ($letterReq->file_foto_senjata != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_foto_senjata);
            }
            if ($letterReq->file_sertif_menembak != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_sertif_menembak);
            }
            if ($letterReq->file_skck != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_skck);
            }
            if ($letterReq->file_surat_sehat != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_surat_sehat);
            }
            if ($letterReq->file_tes_psikotes != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_tes_psikotes);
            }
            if ($letterReq->file_kk != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_kk);
            }
            if ($letterReq->file_si_impor_senjata != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_si_impor_senjata);
            }
            if ($letterReq->file_sba_penitipan_senpi != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_sba_penitipan_senpi);
            }
            if ($letterReq->izin_penggunaan_lapangan != null) {
                Storage::delete('public/' . $filePath . $letterReq->izin_penggunaan_lapangan);
            }
            if ($letterReq->surat_rekomendasi_pengcab != null) {
                Storage::delete('public/' . $filePath . $letterReq->surat_rekomendasi_pengcab);
            }
            if ($letterReq->surat_rekomendasi_club != null) {
                Storage::delete('public/' . $filePath . $letterReq->surat_rekomendasi_club);
            }
            if ($letterReq->ad_art_klub != null) {
                Storage::delete('public/' . $filePath . $letterReq->ad_art_klub);
            }
            if ($letterReq->struktur_organisasi != null) {
                Storage::delete('public/' . $filePath . $letterReq->struktur_organisasi);
            }
            if ($letterReq->daftar_nama_pengurus != null) {
                Storage::delete('public/' . $filePath . $letterReq->daftar_nama_pengurus);
            }
            if ($letterReq->data_anggota_klub != null) {
                Storage::delete('public/' . $filePath . $letterReq->data_anggota_klub);
            }
            if ($letterReq->suket_domisili_sekretariat != null) {
                Storage::delete('public/' . $filePath . $letterReq->suket_domisili_sekretariat);
            }
            if ($letterReq->biaya_administrasi != null) {
                Storage::delete('public/' . $filePath . $letterReq->biaya_administrasi);
            }

            if ($letterReq->file_foto_2x3 != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_foto_2x3);
            }
            if ($letterReq->file_foto_3x4 != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_foto_3x4);
            }
            if ($letterReq->file_foto_4x6 != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_foto_4x6);
            }

            if ($letterReq->l5_lampiran1 != null) {
                Storage::delete('public/' . $filePath . $letterReq->l5_lampiran1);
            }
            if ($letterReq->l6_undangan_berburu != null) {
                Storage::delete('public/' . $filePath . $letterReq->l6_undangan_berburu);
            }
            if ($letterReq->file_nama_anggota_senjata_digunakan != null) {
                Storage::delete('public/' . $filePath . $letterReq->file_nama_anggota_senjata_digunakan);
            }
            if ($letterReq->l8_kta_anggota_baru != null) {
                Storage::delete('public/' . $filePath . $letterReq->l8_kta_anggota_baru);
            }
            if ($letterReq->l8_adart != null) {
                Storage::delete('public/' . $filePath . $letterReq->l8_adart);
            }
            if ($letterReq->l8_struktur_organisasi != null) {
                Storage::delete('public/' . $filePath . $letterReq->l8_struktur_organisasi);
            }
            if ($letterReq->l8_nama_para_pengurus != null) {
                Storage::delete('public/' . $filePath . $letterReq->l8_nama_para_pengurus);
            }
            if ($letterReq->l8_pas_foto_pengurus != null) {
                Storage::delete('public/' . $filePath . $letterReq->l8_pas_foto_pengurus);
            }
            if ($letterReq->l8_data_anggota_club != null) {
                Storage::delete('public/' . $filePath . $letterReq->l8_data_anggota_club);
            }
            if ($letterReq->l8_surat_keterangan_domisili != null) {
                Storage::delete('public/' . $filePath . $letterReq->l8_surat_keterangan_domisili);
            }

            $this->_letterRequirementRepository->delete($detail->letter_requirement_id);
            $this->_logHelper->store($this->module, $detail->letter_requirement_id, 'delete');
        }
        DB::commit();

        return DataHelper::_successResponse(null, "Data berhasil dihapus.");
    }

    /**
     * Print letter on PDF view file.
     * @return Location
     */
    public function printLetter($id)
    {
        $letter = [];
        $letters = $this->_recomendationLetterRepository->getById($id);

        array_push($letter, $letters);
        $category = $letters->letter_category_id;
        if ($letters->firearm_id != null) {
            $firearms = $this->_firearmRepository->getById($letters->firearm_id);
            array_push($letter, $firearms);
        }
        switch ($category) {
            case 1:
                return view('recomendationletter::letters.print_letter_1', compact('letter'));
                break;

            case 2:
                return view('recomendationletter::letters.print_letter_2', compact('letter'));
                break;

            case 3:
                return view('recomendationletter::letters.print_letter_3', compact('letter'));
                break;

            case 4:
                return view('recomendationletter::letters.print_letter_4', compact('letter'));
                break;

            case 5:
                return view('recomendationletter::letters.print_letter_5', compact('letter'));
                break;

            case 6:
                return view('recomendationletter::letters.print_letter_6', compact('letter'));
                break;

            case 7:
                return view('recomendationletter::letters.print_letter_7', compact('letter'));
                break;

            case 8:
                return view('recomendationletter::letters.print_letter_8', compact('letter'));
                break;

            case 9:
                return view('recomendationletter::letters.print_letter_9', compact('letter'));
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
