<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create(['name' => 'view-dashboard', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'manage-users', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'manage-teams', 'guard_name' => 'web']);
        $permission = Permission::create(['name' => 'manage-projects', 'guard_name' => 'web']);
    }
}
