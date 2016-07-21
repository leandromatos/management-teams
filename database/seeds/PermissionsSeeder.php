<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");

        $permissions = [
            [
                'label'      => 'Manage funds of the business',
                'name'       => 'manage_founds',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'label'      => 'Edit the teams of the business',
                'name'       => 'edit_team',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }

        $admin       = Role::find(1);
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
            $admin->givePermissionTo($permission);
        }

        $manager     = Role::find(2);
        $permissions = Permission::find(1);
        $manager->givePermissionTo($permission);
    }
}
