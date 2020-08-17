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
    public function update($userId, $userData);

    /**
     * Delete a user
     *
     * @param int $user_id
    */
    public function delete($userId);

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

    /**
     * Get all game masters
     *
     * @return array
    */
    public function getAllGameMasters();

    /**
     * Get user by slug
     *
     * @param string $slug
     * @return mixed
     */
    public function getBySlug(string $slug);
}
