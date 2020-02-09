<?php

namespace App\Repositories\Heroes;

interface ProfileRepositoryInterface
{
    /**
     * Creates a profile
     *
     * @param array
     * @return App\Profile
     */
    public function create($profile_data);

    /**
     * Updates a profile
     *
     * @param int
     * @param array
     * @return App\Profile
     */
    public function update($profile_id, $profile_data);

    /**
     * Gets all non-confirmed profiles
     *
     * @return collection
     */
    public function getNonConfirmedProfiles();

    /**
     * Gets all confirmed profiles
     *
     * @return collection
     */
    public function getConfirmedProfiles();

    /**
     * Confirm the profile
     *
     * @param int
     * @return \App\Profile
     */
    public function confirmProfile($profile_id);
}
