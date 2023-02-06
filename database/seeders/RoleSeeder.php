<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $superAdmin = Role::create(['name' => 'Super-Admin', 'guard_name' => 'web']);
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $leader = Role::create(['name' => 'Leader', 'guard_name' => 'web']);
        $teamMember = Role::create(['name' => 'Team-Member', 'guard_name' => 'web']);
        //* Super Admin
        $superAdmin->syncPermissions([
            'view-dashboard',
            'manage-users',
            'manage-teams',
            'manage-projects',
        ]);
        //* Admin
        $admin->syncPermissions([
            'view-dashboard',
            'manage-teams',
            'manage-projects',
        ]);
        //* Leader
        $leader->syncPermissions([
            'view-dashboard',
            'manage-projects',
        ]);
        //* Team Member
        $teamMember->syncPermissions([
            'view-dashboard',
        ]);
    }
}
