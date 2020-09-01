<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * User's Repository
     *
     * @var UserRepositoryInterface
    */
    protected UserRepositoryInterface $userRepository;


    /**
     * Create a new instance
     *
     * @param UserRepositoryInterface $userRepository
     *
     * @return void
    */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();

        return view('users.profile', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        auth()->user()->authorizeRole(['game_master', 'admin']);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        auth()->user()->authorizeRole(['game_master', 'admin']);

        $request->validate([
            'nickname' => 'required|unique:users|max:255'
        ]);

        $this->userRepository->update($user, $request->all());
        return redirect()->back();
    }

    /**
     * Ban user
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ban(Request $request, User $user)
    {
        auth()->user()->authorizeRole(['admin']);

        $request->validate([
            'reason' => 'required|max:255',
            'hours' => 'required|integer'
        ]);
        $hours = $request->input('hours');
        $expired = now()->addHours((int)$hours);
        $user->ban($request->input('reason'), $expired);
        return redirect()->back()->with('warning', "Пользователь {$user->nickname} отправлен на банановые острова на $hours часов");
    }

    /**
     * Unban the user
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unban(User $user)
    {
        auth()->user()->authorizeRole(['admin']);
        $user->unban();
        return redirect()->back()->with('warning', "Пользователь {$user->nickname} разбанен");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {

        $this->userRepository->delete($user);
        return redirect()->back();
    }

    public function changeAvatar(Request $request)
    {
        abort_if(!Auth::check(), 403);
        /** @var User $user */
        $user = Auth::user();
        $user->saveImage($request->file('avatar'));
        return redirect()->back()->with('success', 'Аватар изменён');
    }
}
