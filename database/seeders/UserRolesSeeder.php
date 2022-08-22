<?php

namespace Database\Seeders;

use App\Models\User_Role;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_Role::create([
            'role_name' => 'Administrator',
            'created_by' => '1',
        ]);
        
        User_Role::create([
            'role_name' => 'Operator',
            'created_by' => '1',
        ]);

        User_Role::create([
            'role_name' => 'Viewer',
            'created_by' => '1',
        ]);
    }
}
