<?php

namespace App\Http\Controllers;

use App\Repositories\Locations\AreaRepositoryInterface;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    /**
     * Area repository
     *
     * @var AreaRepositoryInterface
    */
    protected $areaRepository;

    /**
     * Create a new instance
     *
     * @param AreaRepositoryInterface $areaRepository
     * @return void
    */
    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    /**
     * Get locations and places for area
     *
     * @param string $slug
     * @return \Illuminate\Http\Response
     */
    public function area($slug)
    {
        $area = $this->areaRepository->getBySlug($slug);
        if ($area == null)
            abort(404);
        $data = [
            'area' => $area
        ];

        return view('locations/area', $data);
    }

    /**
     * Get location's places
     *
     * @param string $areaSlug
     * @param string $locationSlug
     * @return \Illuminate\Http\Response
    */
    public function location(string $areaSlug, string $locationSlug)
    {
        $area = $this->areaRepository->getBySlug($areaSlug);
        if ($areaSlug == null)
            abort(404);
        $location = $area->locations()->where('slug', $locationSlug)->first();
        if ($location == null)
            abort(404);

        $data = [
            'area' => $area,
            'location' => $location
        ];
        return view('locations/location', $data);
    }

    /**
     * Get place by area
     *
     * @param string $areaSlug
     * @param string $placeSlug
     * @return \Illuminate\Http\Response
    */
    public function areaPlace(string $areaSlug, string $placeSlug)
    {
        $area = $this->areaRepository->getBySlug($areaSlug);
        if ($area == null)
            abort(404);
        $place = $area->places()->where('slug', $placeSlug)->first();
        if ($place == null)
            abort(404);

        $data = [
            'area' => $area,
            'place' => $place
        ];
        return view('location/area_place', $data);
    }

    public function locationPlace(string $areaSlug, string $locationSlug, string $placeSlug)
    {
        $area = $this->areaRepository->getBySlug($areaSlug);
        if ($area == null)
            abort(404);
        $location = $area->locations()->where('slug', $locationSlug)->first();
        if ($location == null)
            abort(404);
        $place = $location->places()->where('slug', $placeSlug)->first();
        if ($place == null)
            abort(404);

        $data = [
            'area' => $area,
            'location' => $location,
            'place' => $place
        ];

        return view('locations/location_place', $data);
    }
}
