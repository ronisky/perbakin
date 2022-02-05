<?php

namespace Modules\VisiMisi\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\VisiMisi\Repositories\VisiMisiRepository;

class VisiMisiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_visiMisiRepository = new VisiMisiRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "VisiMisi";
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

        $visimisi    = $this->_visiMisiRepository->getAll();
        return view('visimisi::index', compact('visimisi'));
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
        return view('visimisi::create');
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
            return redirect('visimisi')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $file = $request->image_path;
        $fileName = DataHelper::getFileName($file);
        $filePath = DataHelper::getFilePath(false, true);
        $request->file('image_path')->storeAs($filePath, $fileName, 'public');

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $fileName,
        ];

        $this->_visiMisiRepository->insert(array_merge($data, DataHelper::_signParams(true)));
        $this->_logHelper->store($this->module, $request->title, 'create');
        DB::commit();

        return redirect('visimisi')->with('successMessage', 'Data berhasil ditambahkan');
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
        return view('visimisi::show');
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
        return view('visimisi::edit');
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
        // dd($id);
        $validator = Validator::make($request->all(), $this->_validationRules($id));

        if ($validator->fails()) {
            return redirect('visimis')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $getDetail  = $this->_visiMisiRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        if ($request->image_path <> "") {
            // delete storage data
            Storage::delete('public/' . $filePath . $getDetail->image_path);

            // update data
            $file = $request->image_path;
            $fileName = DataHelper::getFileName($file);
            $request->file('image_path')->storeAs($filePath, $fileName, 'public');

            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $fileName,
                'status' => $request->status,
            ];

            $this->_visiMisiRepository->update(array_merge($data, DataHelper::_signParams(false, true)), $id);
        } else {
            // update data
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
            ];

            $this->_visiMisiRepository->update(array_merge($data, DataHelper::_signParams(false, true)), $id);
        }

        $this->_logHelper->store($this->module, $request->banner_name, 'update');

        DB::commit();

        return redirect('visimisi')->with('successMessage', 'Data berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatestatus(Request $request, $id)
    {
        if ($request->status == 1) {

            $check = $this->_visiMisiRepository->getById($id);

            $param = [
                'title' => $check->title,
                'status' => '1'
            ];
            $compareDate = $this->_visiMisiRepository->getAllByParams($param);

            if (sizeof($compareDate) != 0) {
                return DataHelper::_errorResponse($compareDate, 'Anda hanya bisa mengaktifkan satu data dengan tipe yang sama. Silahkan nonaktifkan terlebih dahulu data yang lain!');
            }

            try {
                $this->_visiMisiRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
                $this->_logHelper->store($this->module, $request->visi_misi_id, 'update');

                DB::commit();
                return DataHelper::_successResponse($compareDate, 'Status berhasil diubah');
            } catch (\Throwable $th) {

                DB::rollBack();
                return DataHelper::_errorResponse(null, 'Gagal mengubah data');
            }
        } else {
            DB::beginTransaction();
            try {
                $this->_visiMisiRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
                $this->_logHelper->store($this->module, $request->visi_misi_id, 'update');

                DB::commit();
                return DataHelper::_successResponse(null, 'Status berhasil diubah');
            } catch (\Throwable $th) {

                DB::rollBack();
                return DataHelper::_errorResponse(null, 'Gagal mengubah data');
            }
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
        $detail  = $this->_visiMisiRepository->getById($id);

        if (!$detail) {
            return redirect('visimisi');
        }

        DB::beginTransaction();
        $getDetail  = $this->_visiMisiRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        $dataImage = $getDetail->image_path;
        if ($dataImage) {
            // delete storage data
            Storage::delete('public/' . $filePath . $dataImage);
        }
        $this->_visiMisiRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->title, 'delete');

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
        $getDetail  = $this->_visiMisiRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'title' => 'required',
                'description' => "required",
            ];
        } else {
            return [
                'title' => 'required',
                'description' => "required",
            ];
        }
    }
}
