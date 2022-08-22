<?php

namespace Database\Seeders;

use App\Models\Screening_status;
use Illuminate\Database\Seeder;

class screeningStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Screening_status::create([
            'name' => 'Pending',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);

        Screening_status::create([
            'name' => 'Completed',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);
    }
}
