<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_player = new Role();
        $role_player->name = Role::PLAYER;
        $role_player->description = 'A player user';
        $role_player->save();

        $role_game_master = new Role();
        $role_game_master->name = Role::GAME_MASTER;
        $role_game_master->description = 'A Game Master User';
        $role_game_master->save();

        $role_admin = new Role();
        $role_admin->name = Role::ADMIN;
        $role_admin->description = 'An Admin user';
        $role_admin->save();
    }
}
