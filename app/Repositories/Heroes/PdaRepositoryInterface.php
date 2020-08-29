<?php


namespace App\Repositories\Heroes;


use App\Pda;
use Illuminate\Database\Eloquent\Collection;

interface PdaRepositoryInterface
{
    /**
     * Get all pdas
     *
     * @return Collection
     */
    public function all();

    /**
     * Create a hero PDA
     *
     * @param $pda_data array
     * @return Pda
    */
    public function create($pda_data);

    /**
     * Updates a hero PDA
     * @param $pda_id int
     * @param $pda_data array
     */
    public function update($pda_id, $pda_data);
}
