<?php

namespace Modules\Banner\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Banner\Repositories\BannerRepository;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_bannerRepository = new BannerRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "Banner";
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

        $banners    = $this->_bannerRepository->getAll();
        return view('banner::index', compact('banners'));
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
        return view('banner::create');
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
            // return redirect('banner')
            //     ->withErrors($validator)
            //     ->withInput();
            return redirect('banner')->with('errorMessage', 'Gagal menambahkan data! pastikan data yang anda masukan sesuai.');
        }

        DB::beginTransaction();
        $file = $request->banner_image_path;
        $fileName = DataHelper::getFileName($file);
        $filePath = DataHelper::getFilePath(false, true);
        $request->file('banner_image_path')->storeAs($filePath, $fileName, 'public');

        $dataBanner = [
            'banner_title' => $request->banner_title,
            'banner_description' => $request->banner_description,
            'banner_image_path' => $fileName,
            'banner_status' => 1,
        ];

        $this->_bannerRepository->insert(array_merge($dataBanner, DataHelper::_signParams(true)));
        $this->_logHelper->store($this->module, $request->banner_title, 'create');
        DB::commit();

        return redirect('banner')->with('successMessage', 'Banner berhasil ditambahkan');
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
        return view('banner::show');
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
        return view('banner::edit');
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
            // return redirect('banner')
            //     ->withErrors($validator)
            //     ->withInput();
            return redirect('banner')->with('errorMessage', 'Gagal mengubah data! pastikan data yang anda masukan sesuai.');
        }

        DB::beginTransaction();
        $getDetail  = $this->_bannerRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        if ($request->hasFile('banner_image_path')) {
            // delete storage data
            Storage::delete('public/' . $filePath . $getDetail->banner_image_path);

            // update data
            $file = $request->banner_image_path;
            $fileName = DataHelper::getFileName($file);
            $request->file('banner_image_path')->storeAs($filePath, $fileName, 'public');

            $dataBanner = [
                'banner_title' => $request->banner_title,
                'banner_description' => $request->banner_description,
                'banner_image_path' => $fileName,
                'banner_status' => $request->banner_status,
            ];
        } else {
            // update data
            $dataBanner = [
                'banner_title' => $request->banner_title,
                'banner_description' => $request->banner_description,
                'banner_status' => $request->banner_status,
            ];
        }

        $this->_bannerRepository->update(array_merge($dataBanner, DataHelper::_signParams(false, true)), $id);
        $this->_logHelper->store($this->module, $request->banner_title, 'update');

        DB::commit();

        return redirect('banner')->with('successMessage', 'Data banner berhasil diubah');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function updatestatus(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->_bannerRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
            $this->_logHelper->store($this->module, $request->banner_id, 'update');

            DB::commit();
            return DataHelper::_successResponse(null, 'Status banner berhasil diubah');
        } catch (\Throwable $th) {

            DB::rollBack();
            return DataHelper::_errorResponse(null, 'Gagal mengubah data');
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
        $detail  = $this->_bannerRepository->getById($id);

        if (!$detail) {
            return redirect('banner');
        }

        DB::beginTransaction();
        $getDetail  = $this->_bannerRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        $dataImage = $getDetail->banner_image_path;
        if ($dataImage) {
            // delete storage data
            Storage::delete('public/' . $filePath . $dataImage);
        }
        $this->_bannerRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->banner_title, 'delete');

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
        $getDetail  = $this->_bannerRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'banner_title' => 'required|unique:banners',
                'banner_description' => "required",
                'banner_image_path' => 'required|max:5012|mimes:jpg,jpeg,bmp,png',
            ];
        } else {
            return [
                'banner_title' => 'required|unique:banners,banner_title,' . $id . ',banner_id',
            ];
        }
    }
}
