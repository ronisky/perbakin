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
            return redirect('unauthorize');
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
        return view('recomendationletterapproval::show');
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
                    ];
                    $result = $this->_updateStatus($data, $id);

                    if ($result) {
                        Mail::to($email)->send(new LetterSubmission($id));
                        return DataHelper::_successResponse($email, 'Status surat berhasil diubah');
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
                        'letter_status'    => 1,
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
                            'admin_status'      => $request->status_code,
                            'admin_status_by'   => $user_id,
                            'admin_note'        => $data,
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
                            'admin_status'  => $request->status_code,
                            'admin_status_by'   => $user_id,
                            'admin_note'    => $other_note,
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
                            'sekum_status'  => $request->status_code,
                            'sekum_status_by'   => $user_id,
                            'sekum_note'    => $data,
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
                            'sekum_status'  => $request->status_code,
                            'sekum_status_by'   => $user_id,
                            'sekum_note'    => $other_note,
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
                            'ketua_status'  => $request->status_code,
                            'ketua_status_by'   => $user_id,
                            'ketua_note'    => $data,
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
                            'ketua_status'  => $request->status_code,
                            'ketua_status_by'   => $user_id,
                            'ketua_note'    => $other_note,
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
            return redirect('unauthorize');
        }
        // Check detail to db
        $detail  = $this->_recomendationLetterRepository->getById($id);

        if (!$detail) {
            return DataHelper::_errorResponse(null, "Data suart tidak ditemukan");
        }

        DB::beginTransaction();
        $this->_recomendationLetterRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->name, 'delete');
        if ($detail->firearm_id != null) {
            $this->_firearmRepository->delete($detail->firearm_id);
            $this->_logHelper->store($this->module, $detail->firearm_id, 'delete');
        }
        if ($detail->letter_requirement_id != null) {
            $this->_letterRequirementRepository->delete($detail->letter_requirement_id);
            $this->_logHelper->store($this->module, $detail->letter_requirement_id, 'delete');
        }
        DB::commit();

        return DataHelper::_successResponse(null, "Data berhasil dihapus.");
    }
}
