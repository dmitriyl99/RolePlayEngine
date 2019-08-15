<?php


namespace App\Repositories\Rpg;


use App\Quest;

class QuestRepository implements QuestRepositoryInterface
{

    /**
     * Get quest by it's id
     *
     * @param $quest_id int Quest ID
     * @return Quest
     */
    public function getById($quest_id)
    {
        return Quest::find($quest_id);
    }

    /**
     * Delete quest
     *
     * @param $quest_id int Quest ID
     */
    public function delete($quest_id)
    {
        Quest::destroy($quest_id);
    }

    /**
     * Edit quest
     *
     * @param $quest_id int Quest ID
     * @param $quest_data array New data for quest
     */
    public function update($quest_id, $quest_data)
    {
        Quest::find($quest_id)->update($quest_data);
    }
}
