<?php

namespace App\Http\Controllers;

use App\Notifications\NewProfile;
use App\Notifications\ProfileConfirmed;
use App\Repositories\Heroes\HeroRepositoryInterface;
use App\Repositories\Heroes\PdaRepositoryInterface;
use App\Repositories\Heroes\ProfileRepositoryInterface;
use App\Repositories\Rpg\QuestRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class HeroController extends Controller
{
    /**
     * Profile repository
     *
     * @var ProfileRepositoryInterface
    */
    protected $profileRepository;

    /**
     * PDA repository
     *
     * @var PdaRepositoryInterface
    */
    protected $pdaRepository;

    /**
     * Hero repository
     *
     * @var HeroRepositoryInterface
    */
    protected $heroRepository;

    /**
     * Quest repository
     *
     * @var QuestRepositoryInterface
    */
    protected $questRepository;

    /**
     * Users' respository
     *
     * @var UserRepositoryInterface
    */
    protected $userRepository;

    /**
     * Create a new instance
     *
     * @param ProfileRepositoryInterface $profileRepository
     * @param PdaRepositoryInterface $pdaRepository
     * @param HeroRepositoryInterface $heroRepository
     * @param QuestRepositoryInterface $questRepository
     * @param UserRepositoryInterface $userRepository
     *
     * @return void
     */
    public function __construct(ProfileRepositoryInterface $profileRepository,
                                PdaRepositoryInterface $pdaRepository,
                                HeroRepositoryInterface $heroRepository,
                                QuestRepositoryInterface $questRepository,
                                UserRepositoryInterface $userRepository)
    {
        $this->profileRepository = $profileRepository;
        $this->pdaRepository = $pdaRepository;
        $this->heroRepository = $heroRepository;
        $this->questRepository = $questRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new hero
     *
     * @return \Illuminate\Http\Response
    */
    public function createHero()
    {
        return view('users.hero.create');
    }

    /**
     * Store a new hero
     *
     * @param Request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    */
    public function storeHero(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'max:255',
            'content' => 'required|max:50000'
        ]);
        $user = auth()->user();
        $heroName = $request->get('name');
        $nickname = $request->get('nickname');
        $profileContent = $request->get('content');
        $heroData = [
            'name' => $heroName,
            'nickname' => $nickname
        ];
        $newHero = $user->heroes()->create($heroData);
        $profileData = [
            'content' => $profileContent
        ];
        $newProfile = $newHero->profile()->create($profileData);
        $gameMasters = $this->userRepository->getAllGameMasters();
        Notification::send($gameMasters, new NewProfile($newProfile));
        $heroName = $newHero->getName();

        return redirect('profile')->with('success', "Заявка на персонажа $heroName отправлена!");
    }

    /**
     * Show page for edit hero
     *
     * @param int $heroId
     *
     * @return \Illuminate\Http\Response
    */
    public function editHero(int $heroId)
    {
        $hero = $this->heroRepository->get($heroId);
        abort_if($hero->user->id != auth()->user()->id, 401);
        if ($hero->profile->confirmed)
        {
            $heroName = ($hero->nickname) ? $hero->nickaname : $hero->name;
            return redirect()->back()->with('warning', "Анкета персонажа $heroName уже принята.");
        }
        return view('users.hero.edit', ['hero' => $hero]);
    }

    /**
     * Update hero
     *
     * @param Request $request
     * @param int $heroId
     * @return \Illuminate\Http\Response
    */
    public function updateHero(Request $request, int $heroId)
    {
        $hero = $this->heroRepository->get($heroId);
        abort_if($hero->user->id != auth()->user()->id, 401);
        $heroName = ($hero->nickname) ? $hero->nickaname : $hero->name;
        if ($hero->profile->confirmed)
        {
            return redirect()->back()->with('warning', "Анкета персонажа $heroName уже принята.");
        }
        $request->validate([
            'name' => 'required|max:255',
            'nickname' => 'max:255',
            'content' => 'required|max:50000'
        ]);
        $heroName = $request->get('name');
        $nickname = $request->get('nickname');
        $profileContent = $request->get('content');
        $heroData = [
            'name' => $heroName,
            'nickname' => $nickname
        ];
        $this->heroRepository->update($heroId, $heroData);
        $profileData = [
            'content' => $profileContent
        ];
        $this->profileRepository->update($hero->profile->id, $profileData);

        return redirect()->route('user')->with('success', "Анкета персонажа $heroName обновлена");
    }

    /**
     * Create a PDA for hero
     *
     * @param int $heroId
     * @return \Illuminate\Http\Response
    */
    public function createPda(int $heroId)
    {
        $hero = $this->heroRepository->get($heroId);
        abort_if($hero->user->id != auth()->user()->id, 401);
        $heroName = $hero->getName();
        if($hero->pda)
            return redirect()->back()->with('warning', "КПК для персонажа $heroName уже создан");
        return view('users.pda.create', compact('hero'));
    }

    /**
     * Store a new pda for hero
     *
     * @param Request $request
     * @param int $heroId
     * @return \Illuminate\Http\Response
    */
    public function storePda(Request $request, int $heroId)
    {
        $hero = $this->heroRepository->get($heroId);
        abort_if($hero->user->id != auth()->user()->id, 401);
        $heroName = $hero->getName();
        if($hero->pda)
            return redirect()->back()->with('warning', "КПК для персонажа $heroName уже создан");
        if (!$hero->profile->confirmed)
            return redirect()->back()->with('warning', "Анкета персонажа $heroName ещё не принята");
        $request->validate([
            'content' => 'required|max:50000'
        ]);
        $content = $request->get('content');
        $data = [
            'content' => $content
        ];
        $hero->pda()->create($data);
        return redirect()->route('user')->with('success', "КПК для персонажа $heroName создан!");
    }

    /**
     * Show page for edit PDA
     *
     * @param int $heroId
     * @param int $heroId
     * @return \Illuminate\Http\Response
    */
    public function editPda(int $heroId)
    {
        $hero = $this->heroRepository->get($heroId);
        abort_if($hero->user->id != auth()->user()->id, 401);
        $heroName = $hero->getName();
        if (!$hero->pda)
            return redirect()->back()->with('warning', "У персонажа $heroName ещё нет КПК");
        $data = [
            'pda' => $hero->pda
        ];

        return view('users.pda.edit', $data);
    }

    /**
     * Update a hero pda
     *
     * @param Request $request
     * @param int $heroId
     * @return \Illuminate\Http\Response
    */
    public function updatePda(Request $request, int $heroId)
    {
        $hero = $this->heroRepository->get($heroId);
        abort_if($hero->user->id != auth()->user()->id, 401);
        $heroName = $hero->getName();
        if (!$hero->pda)
            return redirect()->back()->with('warning', "У персонажа $heroName ещё нет КПК");
        $request->validate([
            'content' => 'required|max:255'
        ]);
        $pdaContent = $request->get('content');
        $pdaData = [
            'content' => $pdaContent
        ];
        $hero->pda()->update($pdaData);
        return redirect()->route('user')->with('success', "КПК персонажа $heroName обновлен!");
    }

    /**
     * Confirm the profile for user
     *
     * @param int $profileId
     * @return \Illuminate\Http\Response
    */
    public function confirmProfile(int $profileId)
    {
        $user = auth()->user();
        $user->authorizeRole('game_master');
        $profile = $this->profileRepository->confirmProfile($profileId);
        $ownerUser = $profile->hero->user;
        $ownerUser->addRole('player');
        $ownerUser->notify(new ProfileConfirmed($profile));
        $heroName = $profile->hero->getName();

        return redirect()->back()->with('success', "Анкета персонажа $heroName принята!");
    }
}
