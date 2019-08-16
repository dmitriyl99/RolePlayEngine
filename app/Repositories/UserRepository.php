<?php


namespace App\Repositories;


use App\User;

class UserRepository implements UserRepositoryInterface
{

    /**
     * Update a user
     *
     * @param int $user_id
     * @param array $user_data
     */
    public function update($user_id, $user_data)
    {
        User::find($user_id)->update($user_data);
    }

    /**
     * Delete a user
     *
     * @param int $user_id
     */
    public function delete($user_id)
    {
        User::destroy($user_id);
    }

    /**
     * Get all users
     *
     * @return mixed
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * Get all users ordering by descending
     *
     * @return mixed
     */
    public function getAllDescOrdering()
    {
        return User::order_by('id', 'desc')
            ->get()->toArray();
    }
}
