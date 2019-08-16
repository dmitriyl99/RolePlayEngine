<?php


namespace App\Repositories;

use App\User;

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

    /**
     * Get a user by it's ID
     *
     * @param int $user_id
     * @return User
    */
    public function getById($user_id);
}
