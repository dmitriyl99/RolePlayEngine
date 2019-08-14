<?php


namespace App\Repositories\Locations;


use App\Area;

interface AreaRepositoryInterface
{
    /**
     * Create an area
     *
     * @param $area_data array
     * @return Area
    */
    public function create(array $area_data);

    /**
     * Update an area
     *
     * @param $area_id int
     * @param $area_data array
     * @return Area
    */
    public function update(int $area_id, array $area_data);

    /**
     * Get an area by id
     *
     * @param $area_id int
     * @return Area
     */
    public function getById($area_id);

    /**
     * Get an area by slug
     *
     * @param $area_slug string
     * @return Area
    */
    public function getBySlug($area_slug);

    /**
     * Get all areas
     *
     * @return mixed
    */
    public function getAll();

    /**
     * Delete an area
     *
     * @param $area_id int
    */
    public function delete($area_id);
}
