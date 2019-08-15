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
        return Place::find($place_id);
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
        return Place::where('slug', $place_slug)->first();
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
        return Place::find($place_id)->update($place_data);
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
}
