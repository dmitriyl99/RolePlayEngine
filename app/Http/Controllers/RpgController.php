<?php

namespace App\Http\Controllers;

use App\Repositories\Locations\AreaRepositoryInterface;
use App\Repositories\Rpg\PostRepositoryInterface;
use Illuminate\Http\Request;

class RpgController extends Controller
{
    /**
     * Post Repository
     *
     * @var PostRepositoryInterface
    */
    protected $postRepository;

    /**
     * Area Respository
     *
     * @var AreaRepositoryInterface
    */
    protected $areaRepository;

    /**
     * Create a new instance
     *
     * @param PostRepositoryInterface $postRepository
     * @param AreaRepositoryInterface $areaRepository
     * @return void
    */
    public function __construct(PostRepositoryInterface $postRepository,
                                AreaRepositoryInterface $areaRepository)
    {
        $this->middleware('auth');
        $this->postRepository = $postRepository;
        $this->areaRepository = $areaRepository;
    }

    /**
     * Create a post for place in location
     *
     * @param int $areaId
     * @param int $locationId
     * @param int $placeId
     * @return \Illuminate\Http\Response
    */
    public function createPostForLocationPlace(Request $request, int $areaId, int $locationId, int $placeId)
    {
        $user = auth()->user();
        $user->authorizeRole('player');
        $postContent = $request->get('content');
        $heroId = $request->get('heroId');

        $area = $this->areaRepository->getById($areaId);
        if ($area == null)
            abort(404);
        $location = $area->locations()->find($locationId);
        if ($location == null)
            abort(404);
        $place = $location->places()->find($placeId);
        if ($place == null)
            abort(404);

        $postData = [
            'content' => $postContent,
            'user_id' => $user->id,
            'hero_id' => $heroId,
            'place_id' => $placeId,
            'area_id' => $areaId,
            'location_id' => $locationId
        ];

        $this->postRepository->create($postData);

        return redirect()->route('location_place', [
            'areaSlug' => $area->slug,
            'locationSlug' => $location->slug,
            'placeSlug' => $place->slug
        ])->withCookie(cookie('lastHeroId', $heroId, 525600));
    }

    /**
     * Create a post for place in area
     *
     * @param int $areaId
     * @param int $placeId
     * @return \Illuminate\Http\Response
    */
    public function createPostForAreaPlace(Request $request, int $areaId, int $placeId)
    {
        $area = $this->areaRepository->getById($areaId);
        abort_if($area == null, 404);
        $place = $area->places()->find($placeId);
        abort_if($place == null, 404);

        $user = auth()->user();
        $user->authorizeRole('player');
        $postContent = $request->get('content');
        $heroId = $request->get('heroId');

        $postData = [
            'content' => $postContent,
            'user_id' => $user->id,
            'hero_id' => $heroId,
            'area_id' => $areaId,
            'place_id' => $placeId
        ];

        $this->postRepository->create($postData);

        return redirect()->route('area_place', [
            'areaSlug' => $area->slug,
            'placeSlug' => $place->slug
        ])->withCookie(cookie('lastHeroId', $heroId, 525600));

    }

    /**
     * Edit a post
     * @param int $postId
     * @return \Illuminate\Http\Response
     */
    public function editPost(int $postId)
    {
        $post = $this->postRepository->getById($postId);
        abort_if($post == null, 404);
        $user = auth()->user();
        if ($post->user()->id !== $user->id) {
            $user->authorizeRole(['game_master', 'admin']);
        }
        $data = [
            'post' => $post
        ];

        return view('rpg/edit_post', $data);
    }
}
