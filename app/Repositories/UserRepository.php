<?php


namespace App\Repositories;


use App\Role;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use PhpParser\Builder;

class UserRepository implements UserRepositoryInterface
{

    public function store(array $data) : User
    {
        $user = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'signature' => $data['signature'],
            'password' => Hash::make($data['password']),
        ]);
        $user
            ->roles()
            ->attach(Role::where('name', Role::PLAYER)->first());
        $user->saveImage(request()->file('avatar'));
        return $user;
    }

    public function update(User $user, array $userData) : User
    {
        $user->update($userData);
        $user->saveImage(request()->file('avatar'));

        return $user;
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function getAll()
    {
        return User::all();
    }

    public function getAllDescOrdering()
    {
        return User::orderBy('created_at', 'desc');
    }

    public function getAllGameMasters()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', Role::GAME_MASTER);
        })->get();
    }
}
