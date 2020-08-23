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
     * Create a post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createPost(Request $request)
    {
        $user = auth()->user();
        $postContent = $request->get('content');
        $heroId = $request->get('hero_id');
        $areaId = $request->get('area_id');
        $locationId = $request->get('location_id');
        $placeId = $request->get('place_id');

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

        return redirect()->route('place', [
            'areaSlug' => $area->slug,
            'locationSlug' => $location->slug,
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
