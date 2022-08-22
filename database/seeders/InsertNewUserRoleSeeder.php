<?php

namespace Database\Seeders;

use App\Models\User_Role;
use Illuminate\Database\Seeder;

class InsertNewUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User_Role::create([
            'role_name' => 'SuperAdmin',
            'created_by' => '4',
        ]);
    }
}
