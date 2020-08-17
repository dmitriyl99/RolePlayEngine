<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepositoryInterface;
use App\User;
use Illuminate\Http\Request;

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
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show(string $slug)
    {
        $user = $this->userRepository->getBySlug($slug);

        return view('users.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $userId)
    {
        auth()->user()->authorizeRole(['game_master', 'admin']);

        $user = $this->userRepository->getById($userId);

        if ($user == null) {
            abort(404);
        }

        $data = [
            'user' => $user,
        ];

        return view('users/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $userId)
    {
        auth()->user()->authorizeRole(['game_master', 'admin']);

        $user = $this->userRepository->getById($userId);

        if ($user == null)
            abort(404);

        $validatedData = $request->validate([
            'nickname' => 'required|unique:users|max:255'
        ]);

        $user->update($validatedData);
        $previousUrl = url()->previous();
        return redirect($previousUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $userId)
    {

        $this->userRepository->delete($userId);
        return redirect(url()->previous());
    }
}
