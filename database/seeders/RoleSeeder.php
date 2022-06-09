<?php

namespace Database\Seeders;

use App\Models\Role;
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
        Role::create([
            'name' => 'Administrator',
            'display_name' => 'Admin',
            'description' => 'All permission',
        ]);

        Role::create([
            'name' => 'Lawyer',
            'display_name' => 'Lawyer',
            'description' => 'Restricted permission',
        ]);

        Role::create([
            'name' => 'User',
            'display_name' => 'User',
            'description' => 'Restricted permission',
        ]);
    }
}
