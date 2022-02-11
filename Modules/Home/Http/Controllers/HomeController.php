<?php

namespace Modules\Home\Http\Controllers;

use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Banner\Repositories\BannerRepository;
use Modules\Club\Repositories\ClubRepository;
use Modules\Gallery\Repositories\GalleryRepository;
use Modules\Sponsorship\Repositories\SponsorshipRepository;
use Modules\VisiMisi\Repositories\VisiMisiRepository;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->_sponsorshipRepository = new SponsorshipRepository;
        $this->_bannerRepository = new BannerRepository;
        $this->_clubRepository = new ClubRepository;
        $this->_galleryRepository = new GalleryRepository;
        $this->_visiMisiRepository = new VisiMisiRepository;
        $this->_logHelper           = new LogHelper;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $visimisi    = $this->_visiMisiRepository->getAllByParams(['status' => 1]);
        $galleries    = $this->_galleryRepository->getAllByParamsLimit(['gallery_status' => 1], 12);
        $clubes    = $this->_clubRepository->getAllByParamsLimit(['club_status' => 1], 8);
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $sponsorships   = $this->_sponsorshipRepository->getAllByParamsLimit(['sponsorship_status' => 1], 3);

        return view('home::index', compact('visimisi', 'galleries', 'clubes', 'banners', 'sponsorships'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('home::create');
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
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('home::edit');
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
