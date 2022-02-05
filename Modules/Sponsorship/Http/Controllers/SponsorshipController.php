<?php

namespace Modules\Sponsorship\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
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
        return view('sponsorship::show');
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
                        ->where('sponsorship_level', $request->sponsorship_level)
                        ->where('sponsorship_status', '1');
                })
            ];
        } else {
            return [
                'sponsorship_name' => Rule::unique('sponsorships')->where(function ($query) use ($request, $id) {
                    return $query->where('sponsorship_id',  $id)
                        ->where('sponsorship_category_id', $request->sponsorship_category_id)
                        ->where('sponsorship_name', $request->sponsorship_name)
                        ->where('sponsorship_level', $request->sponsorship_level)
                        ->where('sponsorship_status', '1');
                })
            ];
        }
    }
}
