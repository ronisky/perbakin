<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Club\Repositories\ClubRepository;
use Modules\RecomendationLetter\Repositories\RecomendationLetterRepository;
use Modules\Sponsorship\Repositories\SponsorshipRepository;
use Modules\Users\Repositories\UsersRepository;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->_usersRepository     = new UsersRepository;
        $this->_clubRepository     = new ClubRepository;
        $this->_sponsorRepository     = new SponsorshipRepository;
        $this->_articleRepository     = new ArticleRepository;
        $this->_letterRepository     = new RecomendationLetterRepository;
        $this->module               = "Users";
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $user = $this->_usersRepository->getById(Auth::user()->user_id);

        $userAll = $this->_usersRepository->getAll();
        $clubAll = $this->_clubRepository->getAll();
        $sponsorAll = $this->_sponsorRepository->getAll();
        $articleAll = $this->_articleRepository->getAllByParams(['publish_status' => 1]);
        $processLetterAll = $this->_letterRepository->getAllByParams(['letter_status' => 1]);
        $successLetterAll = $this->_letterRepository->getAllByParams(['letter_status' => 3]);

        $totalUser = count($userAll);
        $totalClub = count($clubAll);
        $totalSponsor = count($sponsorAll);
        $totalArticle = count($articleAll);

        $letterProcess = count($processLetterAll);
        $letterSuccess = count($successLetterAll);


        return view('dashboard::index', compact('user', 'totalUser', 'totalClub', 'totalSponsor', 'totalArticle', 'letterProcess', 'letterSuccess'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
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
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
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
        //
    }
}
