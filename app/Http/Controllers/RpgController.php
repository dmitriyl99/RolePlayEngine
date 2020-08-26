<?php

namespace App\Http\Controllers;

use App\Repositories\Locations\AreaRepositoryInterface;
use App\Repositories\Rpg\PostRepositoryInterface;
use App\Role;
use App\User;
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
     * @param Request $request
     * @param int $postId
     * @return \Illuminate\View\View
     */
    public function editPost(Request $request, int $postId)
    {
        $post = $this->postRepository->getById($postId);
        abort_if($post == null, 404);
        $user = auth()->user();
        if ($post->user->id !== $user->id) {
            $user->authorizeRole(['game_master', 'admin']);
        }
        $data = [
            'post' => $post,
            'redirect_url' => $request->query('redirect_url')
        ];

        return view('rpg.posts.edit', $data);
    }

    /**
     *
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePost(Request $request, int $id)
    {
        $post = $this->postRepository->getById($id);
        $user = auth()->user();
        if ($post->user->id !== $user->id) {
            $user->authorizeRole(['game_master', 'admin']);
        }
        $request->validate([
            'content' => 'required|max:50000'
        ]);
        $this->postRepository->update($id, ['content' => $request->get('content')]);
        return redirect($request->get('redirect_url'))->with('success', 'Пост отредактирован');
    }

    /**
     * Delete a post
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePost(int $id)
    {
        /** @var User $user */
        $user = auth()->user();
        abort_if(!$user->hasRole(Role::ADMIN), 401);
        $this->postRepository->delete($id);
        return redirect()->back()->with('success', 'Пост удалён');
    }
}
