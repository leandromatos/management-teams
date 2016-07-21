<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");

        $roles = [
            [
                'label'      => 'Admin',
                'name'       => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Manager',
                'name'       => 'manager',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}
