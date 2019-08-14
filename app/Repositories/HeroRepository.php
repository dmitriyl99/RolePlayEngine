<?php

namespace App\Respositories;

use App\Hero;

class HeroRepository implements HeroRepositoryInterface 
{
    /**
     * Get's a hero by it's id
     * 
     * @param int
     * @return collection
     */
    public function get($hero_id) 
    {
        return Hero::find($hero_id);
    }

    /**
     * Get's all heroes
     * 
     * @return mixed
     */
    public function getAll() 
    {
        return Hero::all();
    }

    /**
     * Deletes a hero
     * 
     * @param int
     */
    public function delete($hero_id) 
    {
        $hero = $this->get($hero_id);
        $hero->profile()->delete();
        $hero->pda()->delete();
        $hero->delete();
    }

    /**
     * Creates a hero
     * 
     * @param array
     */
    public function create($hero_data)
    {
        return Hero::create($hero_data);
    }

    /**
     * Updates a hero
     * 
     * @param int
     * @param array
     */
    public function update($hero_id, $hero_data) 
    {
        return Hero::find($hero_id)->update($hero_data);
    }
}
