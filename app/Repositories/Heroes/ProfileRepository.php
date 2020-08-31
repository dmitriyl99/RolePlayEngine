<?php

namespace App\Repositories\Heroes;

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
        $profile = Profile::find($profile_id);
        $profile->update($profile_data);
        return $profile;
    }

    /**
     * Gets all non-confirmed profiles
     *
     * @return collection
     */
    public function getNonConfirmedProfiles()
    {
        return Profile::where('confirmed', false)
                ->orderBy('created_at', 'desc')
                ->get();
    }

    /**
     * Confirm the profile
     *
     * @param int $profile_id
     * @return Profile|false
     */
    public function confirmProfile($profile_id)
    {
        $profile = $this->getProfileById($profile_id);
        if ($profile->corrections()->where('corrected', false)->exists())
            return false;
        $profile->confirmed = true;
        $profile->save();
        return $profile;
    }

    /**
     * @inheritDoc
     */
    public function getConfirmedProfiles()
    {
        return Profile::where('confirmed', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function getProfileById($profileId)
    {
        return Profile::findOrFail($profileId);
    }
}
