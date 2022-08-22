<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeInfo;
use App\Models\Field_office;
use App\Models\Region;
use App\Models\Screening_comment;
use App\Models\Screening_document_checklist;
use App\Models\Screening_status;
use App\Models\ScreeningDetail;
use App\Models\User;
use App\Models\User_Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User_Role::truncate();
        // User::truncate();
        Department::truncate();
        Designation::truncate();
        Region::truncate();
        Field_office::truncate();
        Screening_document_checklist::truncate();
        Screening_status::truncate();
        Screening_comment::truncate();
        EmployeeInfo::truncate();
        ScreeningDetail::truncate();
        
        $this->call([
            // UserRolesSeeder::class,
            DepartmentsSeeder::class,
            DesignationSeeder::class,
            FieldOfficesSeeder::class,
            checklistSeeder::class,
            screeningStatus::class,
            regionName::class,
        ]);

        // \App\Models\User::factory(5)->create();
        \App\Models\ScreeningDetail::factory(100)->create();

    }
}
