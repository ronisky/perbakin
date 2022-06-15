<?php

namespace Modules\Club\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Club\Repositories\ClubRepository;

class ClubController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_clubRepository = new ClubRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "Club";
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

        $clubs    = $this->_clubRepository->getAll();

        return view('club::index', compact('clubs'));
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
        return view('club::create');
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
            return redirect('club')
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();
        $file = $request->club_logo_path;
        $fileName = DataHelper::getFileName($file);
        $filePath = DataHelper::getFilePath(false, true);
        $request->file('club_logo_path')->storeAs($filePath, $fileName, 'public');

        $dataClub = [
            'club_name' => $request->club_name,
            'club_description' => $request->club_description,
            'club_phone' => $request->club_phone,
            'club_email' => $request->club_email,
            'club_website' => $request->club_website,
            'club_whatsapp' => $request->club_whatsapp,
            'club_instagram' => $request->club_instagram,
            'club_facebook' => $request->club_facebook,
            'club_twitter' => $request->club_twitter,
            'club_youtube' => $request->club_youtube,
            'club_logo_path' => $fileName,
            'club_status' => 1,
        ];

        $this->_clubRepository->insert(array_merge($dataClub, DataHelper::_signParams(true)));
        $this->_logHelper->store($this->module, $request->club_name, 'create');
        DB::commit();

        return redirect('club')->with('successMessage', 'Club berhasil ditambahkan');
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
        return view('club::show');
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
        return view('club::edit');
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
            return redirect('club')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $getDetail  = $this->_clubRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        if ($request->club_logo_path <> "") {
            // delete storage data
            Storage::delete('public/' . $filePath . $getDetail->club_logo_path);

            // update data
            $file = $request->club_logo_path;
            $fileName = DataHelper::getFileName($file);
            $request->file('club_logo_path')->storeAs($filePath, $fileName, 'public');

            $dataClub = [
                'club_name' => $request->club_name,
                'club_description' => $request->club_description,
                'club_phone' => $request->club_phone,
                'club_email' => $request->club_email,
                'club_website' => $request->club_website,
                'club_whatsapp' => $request->club_whatsapp,
                'club_instagram' => $request->club_instagram,
                'club_facebook' => $request->club_facebook,
                'club_twitter' => $request->club_twitter,
                'club_youtube' => $request->club_youtube,
                'club_logo_path' => $fileName,
                'club_status' => $request->club_status,
            ];

            $this->_clubRepository->update(array_merge($dataClub, DataHelper::_signParams(false, true)), $id);
        } else {
            // update data
            $dataClub = [
                'club_name' => $request->club_name,
                'club_description' => $request->club_description,
                'club_phone' => $request->club_phone,
                'club_email' => $request->club_email,
                'club_website' => $request->club_website,
                'club_whatsapp' => $request->club_whatsapp,
                'club_instagram' => $request->club_instagram,
                'club_facebook' => $request->club_facebook,
                'club_twitter' => $request->club_twitter,
                'club_youtube' => $request->club_youtube,
                'club_status' => $request->club_status,
            ];

            $this->_clubRepository->update(array_merge($dataClub, DataHelper::_signParams(false, true)), $id);
        }

        $this->_logHelper->store($this->module, $request->club_name, 'update');

        DB::commit();

        return redirect('club')->with('successMessage', 'Data klub berhasil diubah');
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
        $detail  = $this->_clubRepository->getById($id);

        if (!$detail) {
            return redirect('club');
        }

        DB::beginTransaction();
        $getDetail  = $this->_clubRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        $dataImage = $getDetail->club_logo_path;
        if ($dataImage) {
            // delete storage data
            Storage::delete('public/' . $filePath . $dataImage);
        }
        $this->_clubRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->club_name, 'delete');

        DB::commit();

        return DataHelper::_successResponse(null, 'Data berhasil dihapus');
    }

    /**
     * Get data the specified resource in storage.
     * @param int $id
     * @return Response
     */
    public function getdata($id)
    {
        $getDetail  = $this->_clubRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'club_name' => 'required|unique:clubs',
                'club_phone' => "required",
                'club_email' => "required",
                'club_description' => "required",
                'club_logo_path' => 'required|max:5012|mimes:jpg,jpeg,bmp,png',
            ];
        } else {
            return [
                'club_name' => 'required|unique:clubs,club_name,' . $id . ',club_id',
            ];
        }
    }
}
