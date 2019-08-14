<?php


namespace App\Repositories;


use App\Pda;

interface PdaRepositoryInterface
{
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
