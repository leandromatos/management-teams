<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();

        $userOne = User::find(1);
        $admin   = Role::find(1);
        $userOne->assignRole($admin);

        $userTwo = User::find(2);
        $manager = Role::find(2);
        $userTwo->assignRole($manager);
    }
}
