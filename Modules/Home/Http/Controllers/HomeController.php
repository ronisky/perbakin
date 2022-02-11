<?php

namespace Modules\Home\Http\Controllers;

use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Repositories\ArticleRepository;
use Modules\Banner\Repositories\BannerRepository;
use Modules\Club\Repositories\ClubRepository;
use Modules\Faq\Repositories\FaqRepository;
use Modules\Gallery\Repositories\GalleryRepository;
use Modules\History\Repositories\HistoryRepository;
use Modules\Sponsorship\Repositories\SponsorshipRepository;
use Modules\VisiMisi\Repositories\VisiMisiRepository;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->_faqRepository = new FaqRepository;
        $this->_historyRepository = new HistoryRepository;
        $this->_articleRepository = new ArticleRepository;
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
        $articles   = $this->_articleRepository->getAllByParamsLimit(['publish_status' => 1], 8);

        return view('home::index', compact('visimisi', 'galleries', 'clubes', 'banners', 'sponsorships', 'articles'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function history()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $histories   = $this->_historyRepository->getFirst();

        return view('home::history', compact('histories', 'banners'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function sponsorships()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $sponsorships   = $this->_sponsorshipRepository->getAllByParams(['sponsorship_status' => 1]);

        return view('home::sponsorship', compact('banners', 'sponsorships'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function aboutUs()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $visimisi    = $this->_visiMisiRepository->getAllByParams(['status' => 1]);

        return view('home::about_us', compact('visimisi', 'banners'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function management()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);

        return view('home::management', compact('banners'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function contact()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $faqs    = $this->_faqRepository->getAllByParams(['faq_status' => 1]);

        return view('home::contact', compact('banners', 'faqs'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function gallery()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $galleries    = $this->_galleryRepository->getAllByParams(['gallery_status' => 1]);

        return view('home::gallery', compact('banners', 'galleries'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function clube()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $clubes    = $this->_clubRepository->getAllByParams(['club_status' => 1]);

        return view('home::clube', compact('banners', 'clubes'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function articles()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $articles   = $this->_articleRepository->getAllByParams(['publish_status' => 1]);

        return view('home::article', compact('banners', 'articles'));
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
