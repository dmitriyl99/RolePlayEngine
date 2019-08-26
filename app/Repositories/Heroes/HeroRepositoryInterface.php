<?php

namespace App\Repositories\Heroes;

interface HeroRepositoryInterface
{
    /**
     * Get's a hero by it's ID
     * 
     * @param int
     * 
     * @return \App\Hero
     */
    public function get($hero_id);

    /**
     * Get's a all heroes
     * 
     * @return mixed
     */
    public function getAll();

    /**
     * Deletes a hero
     * 
     * @param int
     */
    public function delete($hero_id);

    /**
     * Creates a hero
     * 
     * @param array
     */
    public function create($hero_data);

    /**
     * Updates a hero
     * 
     * @param int
     * @param array
     */
    public function update($hero_id, $hero_data);
}
