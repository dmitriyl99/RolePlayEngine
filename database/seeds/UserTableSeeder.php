<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();

        $admin_user = new User();
        $admin_user->nickname = 'skaydi';
        $admin_user->email = 'dm1triyl99@yandex.com';
        $admin_user->password = bcrypt('demononex2');
        $admin_user->save();
        $admin_user->roles()->attach($role_admin);
    }
}
