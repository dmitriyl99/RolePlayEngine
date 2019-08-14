<?php

namespace App\Repositories;

use App\Profile;

class ProfileRepository implements ProfileRepositoryInterface
{
    /**
     * Creates an profile
     * 
     * @param array
     * @return App\Profile
     */
    public function create($profile_data)
    {
        return Profile::create($profile_data);
    }

    /**
     * Updates the profile
     * 
     * @param int
     * @param array
     * @return App\Profile
     */
    public function update($profile_id, $profile_data)
    {
        return Profile::find($profile_id)->update($profile_data);
    }

    /**
     * Gets all non-confirmed profiles
     * 
     * @return collection
     */
    public function getNonConfirmedProfiles()
    {
        return Profile::where('confirmed', false)
                ->orderBy('creation_date', 'desc')
                ->get();
    }

    /**
     * Confirm the profile
     * 
     * @param int
     */
    public function confirmProfile($profile_id) 
    {
        $profile = Profile::find($profile_id);
        $profile->confirmed = true;
        $profile->save();
    }
}
