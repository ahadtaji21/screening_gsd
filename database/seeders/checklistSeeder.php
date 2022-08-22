<?php

namespace Database\Seeders;

use App\Models\Screening_document_checklist;
use Illuminate\Database\Seeder;

class checklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Screening_document_checklist::create([
            'name' => 'NIC',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);

        Screening_document_checklist::create([
            'name' => 'Resume',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);

        Screening_document_checklist::create([
            'name' => 'Academic Credentials',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);

        Screening_document_checklist::create([
            'name' => 'Experience Letters',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);

        Screening_document_checklist::create([
            'name' => 'Police Character Certificate',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);

        Screening_document_checklist::create([
            'name' => 'Other',
            'is_deleted' => '0',
            'created_at' => date('Y-m-d'),
        ]);
    }
}
