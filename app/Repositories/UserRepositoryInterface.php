<?php


namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Update a user
     *
     * @param int $user_id
     * @param array $user_data
    */
    public function update($user_id, $user_data);

    /**
     * Delete a user
     *
     * @param int $user_id
    */
    public function delete($user_id);

    /**
     * Get all users
     *
     * @return mixed
    */
    public function getAll();

    /**
     * Get all users ordering by descending
     *
     * @return mixed
    */
    public function getAllDescOrdering();
}
