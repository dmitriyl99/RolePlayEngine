<?php


namespace App\Repositories;

use App\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Store user
     *
     * @param array $userData
     * @return User
     */
    public function store(array $userData) : User;

    /**
     * Update a user
     *
     * @param User $user
     * @param array $userData
     *
     * @return User
     */
    public function update(User $user, array $userData) : User;

    /**
     * Delete a user
     *
     * @param User $user
     */
    public function delete(User $user);

    /**
     * Get all users
     *
     * @return Collection
    */
    public function getAll();

    /**
     * Get all users ordering by descending
     *
     * @return Collection
    */
    public function getAllDescOrdering();

    /**
     * Get all game masters
     *
     * @return Collection
    */
    public function getAllGameMasters();
}
