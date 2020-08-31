<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceRequest;
use App\Repositories\Locations\PlaceRepositoryInterface;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    protected PlaceRepositoryInterface $placeRepository;

    /**
     * PlaceController constructor.
     * @param PlaceRepositoryInterface $placeRepository
     */
    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->placeRepository = $placeRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PlaceRequest $request)
    {
        $place = $this->placeRepository->create($request->all());
        return redirect()->back()->with('success', "Игровое место \"{$place->name}\" добавлено");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function edit(string $slug)
    {
        $place = $this->placeRepository->getBySlug($slug);
        return view('admin.places.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PlaceRequest $request, $id)
    {
        $place = $this->placeRepository->update($id, $request->all());
        return redirect()->route('place', ['areaSlug' => $place->location->area->slug,
            'locationSlug' => $place->location->slug, 'placeSlug' => $place->slug])->with('success', 'Игровое место изменено');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->placeRepository->delete($id);
        return redirect()->back()->with('success', 'Место игры удалено');
    }
}
