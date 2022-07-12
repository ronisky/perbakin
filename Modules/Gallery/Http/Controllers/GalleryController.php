<?php

namespace Modules\Gallery\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Modules\Gallery\Repositories\GalleryRepository;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_galleryRepository = new GalleryRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "Gallery";
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }

        $galleries    = $this->_galleryRepository->getAll();

        return view('gallery::index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return view('exceptions.unauthorize');
        }
        return view('gallery::create');
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
            return view('exceptions.unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules(''));

        if ($validator->fails()) {
            return redirect('gallery')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $file = $request->gallery_image_path;
        $fileName = DataHelper::getFileName($file);
        $filePath = DataHelper::getFilePath(false, true);
        $request->file('gallery_image_path')->storeAs($filePath, $fileName, 'public');

        $dataGallery = [
            'gallery_title' => $request->gallery_title,
            'gallery_description' => $request->gallery_description,
            'gallery_image_path' => $fileName,
            'gallery_status' => 1,
        ];

        $this->_galleryRepository->insert(array_merge($dataGallery, DataHelper::_signParams(true)));
        $this->_logHelper->store($this->module, $request->gallery_title, 'create');
        DB::commit();

        return redirect('gallery')->with('successMessage', 'Data gallery berhasil ditambahkan');
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
        return view('gallery::show');
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
            return view('exceptions.unauthorize');
        }
        return view('gallery::edit');
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
            return view('exceptions.unauthorize');
        }

        $validator = Validator::make($request->all(), $this->_validationRules($id));

        if ($validator->fails()) {
            return redirect('gallery')
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        $getDetail  = $this->_galleryRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        if ($request->gallery_image_path <> "") {
            // delete storage data
            Storage::delete('public/' . $filePath . $getDetail->gallery_image_path);

            // update data
            $file = $request->gallery_image_path;
            $fileName = DataHelper::getFileName($file);
            $request->file('gallery_image_path')->storeAs($filePath, $fileName, 'public');

            $dataGallery = [
                'gallery_title' => $request->gallery_title,
                'gallery_description' => $request->gallery_description,
                'gallery_image_path' => $fileName,
                'gallery_status' => $request->gallery_status,
            ];

            $this->_galleryRepository->update(array_merge($dataGallery, DataHelper::_signParams(false, true)), $id);
        } else {
            // update data
            $dataGallery = [
                'gallery_title' => $request->gallery_title,
                'gallery_description' => $request->gallery_description,
                'gallery_status' => $request->gallery_status,
            ];

            $this->_galleryRepository->update(array_merge($dataGallery, DataHelper::_signParams(false, true)), $id);
        }

        $this->_logHelper->store($this->module, $request->gallery_title, 'update');

        DB::commit();

        return redirect('gallery')->with('successMessage', 'Data gallery berhasil diubah');
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
            $this->_galleryRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
            $this->_logHelper->store($this->module, $request->gallery_id, 'update');

            DB::commit();
            return DataHelper::_successResponse(null, 'Status gallery berhasil diubah');
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
            return view('exceptions.unauthorize');
        }

        // Check detail to db
        $detail  = $this->_galleryRepository->getById($id);

        if (!$detail) {
            return redirect('gallery');
        }

        DB::beginTransaction();
        $getDetail  = $this->_galleryRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        $dataImage = $getDetail->gallery_image_path;
        if ($dataImage) {
            // delete storage data
            Storage::delete('public/' . $filePath . $dataImage);
        }
        $this->_galleryRepository->delete($id);
        $this->_logHelper->store($this->module, $detail->gallery_title, 'delete');

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
        $getDetail  = $this->_galleryRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($id = '')
    {
        if ($id == '') {
            return [
                'gallery_title' => 'required|unique:galleries',
                'gallery_description' => "required",
                'gallery_image_path' => 'required|max:5012|mimes:jpg,jpeg,bmp,png',
            ];
        } else {
            return [
                'gallery_title' => 'required|unique:galleries,gallery_title,' . $id . ',gallery_id',
                'gallery_description' => "required",
            ];
        }
    }
}
