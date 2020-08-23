<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Location;
use App\Repositories\Locations\AreaRepositoryInterface;
use App\Repositories\Locations\LocationRepositoryInterface;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    private LocationRepositoryInterface $locationRepository;

    /**
     * LocationController constructor.
     * @param LocationRepositoryInterface $locationRepository
     */
    public function __construct(LocationRepositoryInterface $locationRepository)
    {
        $this->locationRepository = $locationRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = auth()->user();
        $user->authorizeRole('admin');
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LocationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LocationRequest $request)
    {
        $location = $this->locationRepository->create($request->all());
        return redirect()->back()->with('success', "Локация \"{$location->name}\" создана");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function edit(string $slug)
    {
        $location = $this->locationRepository->getBySlug($slug);
        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LocationRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LocationRequest $request, $id)
    {
        $this->locationRepository->update($id, $request->all());
        return redirect()->route('home')->with('success', 'Локация изменена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->locationRepository->delete($id);
        return redirect()->back()->with('success', 'Локация удалена');
    }
}
