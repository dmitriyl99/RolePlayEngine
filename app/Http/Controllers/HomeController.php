<?php

namespace App\Http\Controllers;

use App\Repositories\Locations\AreaRepositoryInterface;
use App\Repositories\Rpg\PostRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Areas repository
     *
     * @var AreaRepositoryInterface
    */
    protected $areasRepository;

    /**
     * Post repository
     *
     * @var PostRepositoryInterface
    */
    protected $postsRepository;

    /**
     * Create a new controller instance.
     *
     * @param $areaRepository AreaRepositoryInterface
     * @param $postRepository PostRepositoryInterface
     *
     * @return void
     */
    public function __construct(AreaRepositoryInterface $areaRepository, PostRepositoryInterface $postRepository)
    {
        $this->areasRepository = $areaRepository;
        $this->postsRepository = $postRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allAreas = $this->areasRepository->getAll();
        $fileLastPosts = $this->postsRepository->getLastPosts(5);

        $data = [
            'areas' => $allAreas,
            'fiveLastPosts' => $fileLastPosts
        ];

        return view('home', $data);
    }
}
