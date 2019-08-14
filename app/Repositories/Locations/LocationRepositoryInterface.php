<?php


namespace App\Repositories\Locations;


use App\Location;

interface LocationRepositoryInterface
{
    /**
     * Create a location
     *
     * @param $location_data array
     * @return Location
    */
    public function create($location_data);

    /**
     * Get Location by it's ID
     *
     * @param $location_id int
     * @return Location
    */
    public function getById($location_id);

    /**
     * Get location by it's slug
     *
     * @param $location_slug string
     * @return Location
    */
    public function getBySlug($location_slug);

    /**
     * Update a location
     *
     * @param $location_id int
     * @param $location_data array
     *
     * @return Location
    */
    public function update($location_id, $location_data);

    /**
     * Delete a location
     *
     * @param $location_id int
    */
    public function delete($location_id);
}
