<?php

namespace Modules\Home\Http\Controllers;

use App\Helpers\DateFormatHelper;
use App\Helpers\LogHelper;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Crypt;
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
        $clubs    = $this->_clubRepository->getAllByParamsLimit(['club_status' => 1], 8);
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $sponsorships   = $this->_sponsorshipRepository->getAllByParamsLimit(['sponsorship_status' => 1], 3);
        $articles   = $this->_articleRepository->getAllByParamsLimit(['publish_status' => 1], 8);

        return view('home::index', compact('visimisi', 'galleries', 'clubs', 'banners', 'sponsorships', 'articles'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function histories()
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
    public function galleries()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $galleries    = $this->_galleryRepository->getAllByParams(['gallery_status' => 1]);

        return view('home::galleries', compact('banners', 'galleries'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function homeclubs()
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $clubs    = $this->_clubRepository->getAllByParams(['club_status' => 1]);

        return view('home::homeclubs', compact('banners', 'clubs'));
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
     * Display a listing of the resource.
     * @return Renderable
     */
    public function detailArticle($id)
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $article   = $this->_articleRepository->getByParams(['publish_status' => 1, 'article_id' => Crypt::decrypt($id)]);
        $image = $article->image_thumbnail_path;
        $title = $article->article_title;
        $content = $article->article_content;
        $created = DateFormatHelper::dateEng($article->created_at);
        return view('home::details', compact('banners', 'image', 'title', 'content', 'created'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function detailClub($id)
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $club   = $this->_clubRepository->getByParams(['club_status' => 1, 'club_id' => Crypt::decrypt($id)]);
        $image = $club->club_logo_path;
        $title = $club->club_name;
        $content = $club->club_description;
        $created = DateFormatHelper::dateEng($club->created_at);
        return view('home::details', compact('banners', 'image', 'title', 'content', 'created'));
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function detailImage($id)
    {
        $banners    = $this->_bannerRepository->getAllByParams(['banner_status' => 1]);
        $images   = $this->_galleryRepository->getByParams(['gallery_status' => 1, 'gallery_id' => Crypt::decrypt($id)]);
        $image = $images->gallery_image_path;
        $title = $images->gallery_title;
        $content = $images->gallery_description;
        $created = DateFormatHelper::dateEng($images->created_at);
        return view('home::details', compact('banners', 'image', 'title', 'content', 'created'));
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
