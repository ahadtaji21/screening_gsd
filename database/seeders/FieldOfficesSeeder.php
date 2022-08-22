<?php

namespace Database\Seeders;

use App\Models\Field_office;
use Illuminate\Database\Seeder;

class FieldOfficesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field_office::create([
            'name' => 'Afghanistan',
            'acronym' => 'AF',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Albania',
            'acronym' => 'AL',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Bangladesh',
            'acronym' => 'BD',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Bosnia',
            'acronym' => 'BA',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Chad',
            'acronym' => 'TD',
            'region_id' => '2',
            ]);

        Field_office::create([
            'name' => 'China',
            'acronym' => 'CN',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Ethiopia',
            'acronym' => 'ET',
            'region_id' => '3',
        ]);

        Field_office::create([
            'name' => 'India',
            'acronym' => 'IN',
            'region_id' => '1',
        ]);

        Field_office::create([
            'name' => 'Indonesia',
            'acronym' => 'ID',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Iraq',
            'acronym' => 'IQ',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Jordan',
            'acronym' => 'JO',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Kenya',
            'acronym' => 'KE',
            'region_id' => '3',
            ]);

        Field_office::create([
            'name' => 'Kosovo',
            'acronym' => 'KS',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Lebanon',
            'acronym' => 'LB',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Malawi',
            'acronym' => 'MW',
            'region_id' => '2',
            ]);

        Field_office::create([
            'name' => 'Mali',
            'acronym' => 'ML',
            'region_id' => '2',
            ]);

        Field_office::create([
            'name' => 'Myanmar',
            'acronym' => 'MM',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Nepal',
            'acronym' => 'NP',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Niger',
            'acronym' => 'NE',
            'region_id' => '2',
            ]);

        Field_office::create([
            'name' => 'Pakistan',
            'acronym' => 'PK',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Palestine Gaza',
            'acronym' => 'PS-G',
            'region_id' => '1',
        ]);

        Field_office::create([
            'name' => 'Palestine West Bank',
            'acronym' => 'PS-W',
            'region_id' => '1',
        ]);

        Field_office::create([
            'name' => 'Philippines',
            'acronym' => 'PH',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Russian Federation',
            'acronym' => 'RU',
            'region_id' => '4',
        ]);

        Field_office::create([
            'name' => 'Somalia',
            'acronym' => 'SO',
            'region_id' => '3',
            ]);

        Field_office::create([
            'name' => 'South Sudan',
            'acronym' => 'SS',
            'region_id' => '3',
            ]);

        Field_office::create([
            'name' => 'Sri Lanka',
            'acronym' => 'LK',
            'region_id' => '1',
            ]);

        Field_office::create([
            'name' => 'Sudan',
            'acronym' => 'SD',
            'region_id' => '3',
            ]);

        Field_office::create([
            'name' => 'Syria',
            'acronym' => 'SY',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Tunisia',
            'acronym' => 'TN',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Turkey',
            'acronym' => 'TR',
            'region_id' => '4',
            ]);

        Field_office::create([
            'name' => 'Yemen',
            'acronym' => 'YE',
            'region_id' => '4',
            ]);
    }
}
