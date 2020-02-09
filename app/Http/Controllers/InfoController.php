<?php

namespace App\Http\Controllers;

use App\Repositories\Heroes\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Profile repository
     *
     * @var ProfileRepositoryInterface
     */
    protected $profileRepository;

    /**
     * InfoController constructor.
     * @param ProfileRepositoryInterface $profileRepository
     */
    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    /**
     * Show info about profiles
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profiles()
    {
        $data = [
            'nonConfirmedProfiles' => $this->profileRepository->getNonConfirmedProfiles(),
            'confirmedProfiles' => $this->profileRepository->getConfirmedProfiles()
        ];

        return view('info.profiles', $data);
    }

    public function showProfile(int $id)
    {
        return view('info.profile', ['profile' => $this->profileRepository->getProfileById($id)]);
    }
}
