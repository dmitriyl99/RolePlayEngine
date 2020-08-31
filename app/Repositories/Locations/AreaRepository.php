<?php


namespace App\Repositories\Locations;


use App\Area;

class AreaRepository implements AreaRepositoryInterface
{

    /**
     * Create an area
     *
     * @param $area_data array
     * @return Area
     */
    public function create(array $area_data)
    {
        return Area::create($area_data);
    }

    /**
     * Update an area
     *
     * @param $area_id int
     * @param $area_data array
     * @return Area
     */
    public function update(int $area_id, array $area_data)
    {
        $area = Area::findOrFail($area_id);
        $area->update($area_data);
        return $area;
    }

    /**
     * Get an area by id
     *
     * @param $area_id int
     * @return Area
     */
    public function getById($area_id)
    {
        return Area::findOrFail($area_id);
    }

    /**
     * Get an area by slug
     *
     * @param $area_slug string
     * @return Area
     */
    public function getBySlug($area_slug)
    {
        return Area::where('slug', $area_slug)->firstOrFail();
    }

    /**
     * Get all areas
     *
     * @return mixed
     */
    public function getAll()
    {
        return Area::all();
    }

    /**
     * Delete an area
     *
     * @param $area_id int
     */
    public function delete($area_id)
    {
        Area::destroy($area_id);
    }
}
