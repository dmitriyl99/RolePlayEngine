<?php


namespace App\Repositories\Locations;


use App\Place;

class PlaceRepository implements PlaceRepositoryInterface
{
    /**
     * Get a place by it's ID
     *
     * @param $place_id int
     *
     * @return Place
     */
    public function getById($place_id)
    {
        return Place::findOrFail($place_id);
    }

    /**
     * Get a place by slug
     *
     * @param $place_slug string
     *
     * @return Place
     */
    public function getBySlug($place_slug)
    {
        return Place::where('slug', $place_slug)->firstOrFail();
    }

    /**
     * Update a place
     *
     * @param $place_id int
     * @param $place_data array
     *
     * @return Place
     */
    public function update($place_id, $place_data)
    {
        /** @var Place $place */
        $place = Place::findOrFail($place_id);
        $place->update($place_data);
        $place->saveImage(request()->file('image'));
        return $place;
    }

    /**
     * Delete a place
     *
     * @param $place_id int
     */
    public function delete($place_id)
    {
        Place::destroy($place_id);
    }

    public function create($placeData)
    {
        $place = Place::create($placeData);
        $place->saveImage(request()->file('image'));
        return $place;
    }
}
