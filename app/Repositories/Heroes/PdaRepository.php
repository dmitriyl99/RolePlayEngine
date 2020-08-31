<?php


namespace App\Repositories\Heroes;

use App\Pda;
use Illuminate\Database\Eloquent\Collection;


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
        $pda = Pda::find($pda_id);
        $pda->update($pda_data);
        return $pda;
    }

    /**
     * Get all pdas
     *
     * @return Collection|void
     */
    public function all()
    {
        return Pda::with('user', 'hero')->orderBy('created_at', 'desc')->get();
    }
}
