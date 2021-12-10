<?php

namespace Modules\RecomendationLetter\Http\Controllers;

use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;

class RecomendationLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_recomendationLetterRepository   = new RecomendationLetterRepository;
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

        $letters = $this->_recomendationLetterRepository->getAll();

        return view('recomendationletter::index', compact('letters'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('recomendationletter::create');
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
        return view('recomendationletter::show');
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
        DB::commit();


        return redirect('recomendationletter')->with('successMessage', 'Surat berhasil dihapus');
    }
}
