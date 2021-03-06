<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Repositories\Locations\AreaRepositoryInterface;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    protected AreaRepositoryInterface $areaRepository;

    /**
     * AreaController constructor.
     * @param AreaRepositoryInterface $areaRepository
     */
    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
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
        return view('admin.areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AreaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AreaRequest $request)
    {
        $area = $this->areaRepository->create($request->all());

        return redirect()->route('area', $area->slug)->with('success', "Зона \"$area->name\" создана");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function edit(string $slug)
    {
        $area = $this->areaRepository->getBySlug($slug);
        return view('admin.areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AreaRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AreaRequest $request, $id)
    {
        $area = $this->areaRepository->update($id, $request->all());
        return redirect()->route('area', $area->slug)->with('success', 'Игровая зона удалена отредактирована');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->areaRepository->delete($id);
        return redirect()->back()->with('success', 'Игровая зона удалена');
    }

    /**
     * Get Area locations
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function locations($id)
    {
        return response()->json($this->areaRepository->getById($id)->locations, 200);
    }
}
