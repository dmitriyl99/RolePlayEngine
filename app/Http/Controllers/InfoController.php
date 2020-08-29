<?php

namespace App\Http\Controllers;

use App\Repositories\Heroes\PdaRepositoryInterface;
use App\Repositories\Heroes\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Profile repository
     *
     * @var ProfileRepositoryInterface
     */
    protected ProfileRepositoryInterface $profileRepository;

    /**
     * Pda repository
     *
     * @var PdaRepositoryInterface
     */
    protected PdaRepositoryInterface $pdaRepository;

    /**
     * InfoController constructor.
     * @param ProfileRepositoryInterface $profileRepository
     * @param PdaRepositoryInterface $pdaRepository
     */
    public function __construct(ProfileRepositoryInterface $profileRepository, PdaRepositoryInterface $pdaRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->pdaRepository = $pdaRepository;
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

    /**
     * Show concrete profile
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProfile(int $id)
    {
        return view('info.profile', ['profile' => $this->profileRepository->getProfileById($id)]);
    }

    /**
     * Show all pdas
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pdas()
    {
        $pdas = $this->pdaRepository->all();
        return view('info.pdas', compact('pdas'));
    }
}
