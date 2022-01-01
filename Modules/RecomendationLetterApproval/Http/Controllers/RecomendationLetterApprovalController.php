<?php

namespace Modules\RecomendationLetterApproval\Http\Controllers;

use App\Helpers\DataHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\FirearmCategory\Repositories\FirearmCategoryRepository;
use Modules\LetterCategory\Repositories\LetterCategoryRepository;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;
use Modules\RecomendationLetterApproval\Repositories\RecomendationLetterApprovalRepository;

class RecomendationLetterApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_recomendationLetterApprovalRepository   = new RecomendationLetterApprovalRepository;
        $this->_letterCategoryRepository   = new LetterCategoryRepository;
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

        $letters = $this->_recomendationLetterApprovalRepository->getAll();
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
        DB::beginTransaction();
        try {
            $this->_recomendationLetterApprovalRepository->update(DataHelper::_normalizeParams($request->all(), false, true), $id);
            $this->_logHelper->store($this->module, $request->letter_id, 'update');

            DB::commit();

            return DataHelper::_successResponse($request->all(), 'Status surat berhasil diubah');
        } catch (\Throwable $th) {

            DB::rollBack();
            return DataHelper::_errorResponse(null, 'Gagal mengubah status');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Print letter on PDF view file.
     * @return Location
     */
    public function printLetter($id)
    {

        $letters = $this->_recomendationLetterRepository->getByIdLetter($id);
        $data = array(
            'items' => '',
            'items' => '</td>',
            'items' => '</td>',
            'items' => '</td>'
        );
        $pdf = PDF::loadview('recomendationletter::letter', ['letters' => $letters, 'data' => $data]);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream();
    }
}
