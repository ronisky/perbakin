<?php

namespace Modules\Sponsorship\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Sponsorship\Repositories\SponsorshipRepository;
use Modules\SponsorshipCategory\Repositories\SponsorshipCategoryRepository;

class SponsorshipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_sponsorshipRepository = new SponsorshipRepository;
        $this->_sponsorshipCategoryRepository = new SponsorshipCategoryRepository;
        $this->_logHelper           = new LogHelper;
        $this->module               = "Sponsorship";
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

        $sponsorships    = $this->_sponsorshipRepository->getAll();
        $sponsorship_categories   = $this->_sponsorshipCategoryRepository->getAll();
        return view('sponsorship::index', compact('sponsorships', 'sponsorship_categories'));
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
        return view('sponsorship::create');
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
        $validator = Validator::make($request->all(), $this->_validationRules($request, ''));

        if ($validator->fails()) {
            return redirect('sponsorship')
                ->withErrors($validator)
                ->withInput();
        }

        $sponsorship_category  = $this->_sponsorshipCategoryRepository->getById($request->sponsorship_category_id);
        $endDate = date('Y-m-d', strtotime("$request->sponsorship_start_date +$sponsorship_category->day_show day"));


        DB::beginTransaction();
        if ($request->hasFile('sponsorship_resource_path')) {

            if (!$request->sponsorship_resource_path <> "") {
                return redirect('sponsorship')->with('errorMessage', 'Gagal! Gambar sponsor wajib diisi!');
            }

            $validatorImage = Validator::make($request->all(), $this->_validationRulesImage());
            if ($validatorImage->fails()) {
                return redirect('sponsorship')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran gambar yang dimasukan sesuai.');
            }

            $file = $request->sponsorship_resource_path;
            $fileName = DataHelper::getFileName($file);
            $filePath = DataHelper::getFilePath(false, true);
            $request->file('sponsorship_resource_path')->storeAs($filePath, $fileName, 'public');

            $dataSponsorship = [
                'sponsorship_category_id' => $request->sponsorship_category_id,
                'sponsorship_name' => $request->sponsorship_name,
                'sponsorship_type' => $request->sponsorship_type,
                'sponsorship_description' => $request->sponsorship_description,
                'sponsorship_duration' => $sponsorship_category->day_show,
                'sponsorship_start_date' => $request->sponsorship_start_date,
                'sponsorship_end_date' => $endDate,
                'sponsorship_resource_path' => $fileName,
                'sponsorship_status' => 1,
            ];
        } else {
            $dataSponsorship = [
                'sponsorship_category_id' => $request->sponsorship_category_id,
                'sponsorship_name' => $request->sponsorship_name,
                'sponsorship_type' => $request->sponsorship_type,
                'sponsorship_description' => $request->sponsorship_description,
                'sponsorship_duration' => $sponsorship_category->day_show,
                'sponsorship_start_date' => $request->sponsorship_start_date,
                'sponsorship_end_date' => $endDate,
                'sponsorship_resource_path' => $request->sponsorship_resource_path,
                'sponsorship_status' => 1,
            ];
        }

        $this->_sponsorshipRepository->insert(array_merge($dataSponsorship, DataHelper::_signParams(true)));
        $this->_logHelper->store($this->module, $request->sponsorship_name, 'create');
        DB::commit();

        return redirect('sponsorship')->with('successMessage', 'Banner berhasil ditambahkan');
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

        $getDetail  = $this->_sponsorshipRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
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
        return view('sponsorship::edit');
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
        $validator = Validator::make($request->all(), $this->_validationRules($request, $id));

        if ($validator->fails()) {
            return redirect('sponsorship')
                ->withErrors($validator)
                ->withInput();
        }

        $sponsorship_category  = $this->_sponsorshipCategoryRepository->getById($request->sponsorship_category_id);
        $endDate = date('Y-m-d', strtotime("$request->sponsorship_start_date +$sponsorship_category->day_show day"));


        DB::beginTransaction();
        if ($request->hasFile('sponsorship_resource_path')) {
            $validatorImage = Validator::make($request->all(), $this->_validationRulesImage());
            if ($validatorImage->fails()) {
                return redirect('sponsorship')->with('errorMessage', 'Gagal menambahkan data! Pastikan format dan ukuran gambar yang dimasukan sesuai.');
            }

            $filePath = DataHelper::getFilePath(false, true);
            $getDetail  = $this->_sponsorshipRepository->getById($id);

            // delete storage data
            Storage::delete('public/' . $filePath . $getDetail->sponsorship_resource_path);

            // store data file
            $file = $request->sponsorship_resource_path;
            $fileName = DataHelper::getFileName($file);
            $request->file('sponsorship_resource_path')->storeAs($filePath, $fileName, 'public');

            $dataSponsorship = [
                'sponsorship_category_id' => $request->sponsorship_category_id,
                'sponsorship_name' => $request->sponsorship_name,
                'sponsorship_type' => $request->sponsorship_type,
                'sponsorship_description' => $request->sponsorship_description,
                'sponsorship_duration' => $sponsorship_category->day_show,
                'sponsorship_start_date' => $request->sponsorship_start_date,
                'sponsorship_end_date' => $endDate,
                'sponsorship_resource_path' => $fileName,
                'sponsorship_status' => 1,
            ];
        } elseif (str_contains($request->sponsorship_resource_path, 'https://www.youtube.com/')) {
            $dataSponsorship = [
                'sponsorship_category_id' => $request->sponsorship_category_id,
                'sponsorship_name' => $request->sponsorship_name,
                'sponsorship_type' => $request->sponsorship_type,
                'sponsorship_description' => $request->sponsorship_description,
                'sponsorship_duration' => $sponsorship_category->day_show,
                'sponsorship_start_date' => $request->sponsorship_start_date,
                'sponsorship_end_date' => $endDate,
                'sponsorship_resource_path' => $request->sponsorship_resource_path,
                'sponsorship_status' => 1,
            ];
        } else {
            $dataSponsorship = [
                'sponsorship_category_id' => $request->sponsorship_category_id,
                'sponsorship_name' => $request->sponsorship_name,
                'sponsorship_type' => $request->sponsorship_type,
                'sponsorship_description' => $request->sponsorship_description,
                'sponsorship_duration' => $sponsorship_category->day_show,
                'sponsorship_start_date' => $request->sponsorship_start_date,
                'sponsorship_end_date' => $endDate,
                'sponsorship_status' => 1,
            ];
        }

        $this->_sponsorshipRepository->update(array_merge($dataSponsorship, DataHelper::_signParams(false, true)), $id);
        $this->_logHelper->store($this->module, $request->sponsorship_name, 'update');
        DB::commit();

        return redirect('sponsorship')->with('successMessage', 'Banner berhasil diubah');
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
            $this->_sponsorshipRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
            $this->_logHelper->store($this->module, $request->sponsorship_id, 'update');

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
        $detail  = $this->_sponsorshipRepository->getById($id);

        if (!$detail) {
            return redirect('banner');
        }

        DB::beginTransaction();
        $getDetail  = $this->_sponsorshipRepository->getById($id);
        $filePath = DataHelper::getFilePath(false, true);

        $dataImage = $getDetail->sponsorship_resource_path;

        if (str_contains($dataImage, 'https://www.youtube.com/')) {
            $this->_sponsorshipRepository->delete($id);
        } else {
            // delete storage data
            Storage::delete('public/' . $filePath . $dataImage);
            $this->_sponsorshipRepository->delete($id);
        }
        $this->_logHelper->store($this->module, $detail->sponsorship_name, 'delete');

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
        $getDetail  = $this->_sponsorshipRepository->getById($id);
        if ($getDetail)
            return DataHelper::_successResponse($getDetail, 'Data berhasil ditemukan');
        else
            return DataHelper::_errorResponse(null, 'Data tidak ditemukan');
    }

    private function _validationRules($request, $id = '')
    {
        if ($id == '') {
            return [
                'sponsorship_name' => Rule::unique('sponsorships')->where(function ($query) use ($request) {
                    return $query->where('sponsorship_category_id', $request->sponsorship_category_id)
                        ->where('sponsorship_name', $request->sponsorship_name)
                        ->where('sponsorship_type', $request->sponsorship_type)
                        ->where('sponsorship_status', '1');
                }),
            ];
        } else {
            return [
                'sponsorship_name' => Rule::unique('sponsorships')->where(function ($query) use ($request, $id) {
                    return $query->where('sponsorship_id',  $id)
                        ->where('sponsorship_category_id', $request->sponsorship_category_id)
                        ->where('sponsorship_name', $request->sponsorship_name)
                        ->where('sponsorship_type', $request->sponsorship_type)
                        ->where('sponsorship_start_date', $request->sponsorship_start_date)
                        ->where('sponsorship_description', $request->sponsorship_description)
                        ->where('sponsorship_resource_path', $request->sponsorship_resource_path)
                        ->where('sponsorship_status', $request->sponsorship_status);
                }),
            ];
        }
    }
    private function _validationRulesImage()
    {
        return [
            'sponsorship_resource_path' => 'required|mimes:jpg,jpeg,bmp,png,gif|max:5120',
        ];
    }
}
