<?php

namespace Modules\RecomendationLetter\Http\Controllers;

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

use PDF;

class RecomendationLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_recomendationLetterRepository   = new RecomendationLetterRepository;
        $this->_letterCategoryRepository   = new LetterCategoryRepository;
        $this->_firearmCategoryRepository   = new FirearmCategoryRepository;
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
        $letter_categories = $this->_letterCategoryRepository->getAll();
        $firearm_categories = $this->_firearmCategoryRepository->getAll();

        return view('recomendationletter::index', compact('letters', 'letter_categories', 'firearm_categories'));
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
        // Authorize
        if (Gate::denies(__FUNCTION__, $this->module)) {
            return redirect('unauthorize');
        }

        DB::beginTransaction();
        try {

            $data = [
                'firearm_category_id' => $request->firearm_category_id,
                'merek' => $request->merek,
                'kaliber' => $request->kaliber,
                'no_pabrik' => $request->no_pabrik,
                'no_buku_pas_senpi' => $request->no_buku_pas_senpi,
                'nama_pemilik' => $request->nama_pemilik,
                'jumlah' => $request->jumlah,
                'penyimpanan' => $request->penyimpanan
            ];
            $firearmId = $this->_recomendationLetterRepository->insertGetId(array_merge($data, DataHelper::_signParams(true)));
            $this->_logHelper->store($this->module, $request->merek, 'create');
            $dataLetter = [
                'letter_category_id' => $request->letter_category_id,
                'firearm_id' => $firearmId,
                'letter_place' => $request->letter_place,
                'letter_date' => date('Y-m-d'),
                'letter_purpose_name' => 'Ketua Umum Pengcab PERBAKIN',
                'letter_purpose_place' => 'Soreang',
                'name' => $request->name,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'occupation' => $request->occupation,
                'address' => $request->address,
                'club' => $request->club,
                'no_kta' => $request->no_kta,
                'membership' => $request->membership,
                'pemohon' => $request->pemohon,
                'letter_status' => 1
            ];

            $this->_recomendationLetterRepository->insert(array_merge($dataLetter, DataHelper::_signParams(true)));
            $this->_logHelper->store($this->module, $request->letter_place, 'create');

            DB::commit();
            return redirect('recomendationletter')->with('successMessage', 'Pengajuan surat berhasil dikirim');
        } catch (\Throwable $th) {

            DB::rollBack();
            return redirect('recomendationletter')->with('errorMessage', 'Gagal mengirim data');
        }
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
        $this->_recomendationLetterRepository->deleteFirearm($detail->firearm_id);
        $this->_logHelper->store($this->module, $detail->firearm_id, 'delete');
        DB::commit();

        return redirect('recomendationletter')->with('successMessage', 'Surat berhasil dihapus');
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
