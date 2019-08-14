<?php


namespace App\Repositories;

use App\Pda;


class PdaRepository implements PdaRepositoryInterface
{

    /**
     * Create a hero PDA
     *
     * @param $pda_data array
     * @return Pda
     */
    public function create($pda_data)
    {
        return Pda::create($pda_data);
    }

    /**
     * Updates a hero PDA
     * @param $pda_id int
     * @param $pda_data array
     * @return Pda
     */
    public function update($pda_id, $pda_data)
    {
        return Pda::find($pda_id)->update($pda_data);
    }
}
