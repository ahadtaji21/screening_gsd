<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class regionName extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Region::create([
            'id' => '0',
            'name' => 'All',
            'created_at' => date('Y-m-d'),
        ]);
        
        Region::create([
            'id' => '1',
            'name' => 'Asia',
            'created_at' => date('Y-m-d'),
        ]);

        Region::create([
            'id' => '2',
            'name' => 'West Africa',
            'created_at' => date('Y-m-d'),
        ]);

        Region::create([
            'id' => '3',
            'name' => 'East Africa',
            'created_at' => date('Y-m-d'),
        ]);

        Region::create([
            'id' => '4',
            'name' => 'MENAEE',
            'created_at' => date('Y-m-d'),
        ]);

    }
}
