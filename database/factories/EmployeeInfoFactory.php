<?php

namespace Database\Factories;

use App\Models\EmployeeInfo;
use App\Models\Field_office;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmployeeInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Male', 'Female']);
        //$field_office_id = $this->faker->randomElement(['17', '12', '28']);
        return [
            //'reference_no' => $this->faker->countryCode()."-".$this->faker->unique()->regexify('[0-8]{10}'),
            'employee_name' => $this->faker->name($gender),
            'father_name' => $this->faker->name(),
            'dob' => $this->faker->dateTime(),
            'country_of_birth' => $this->faker->numberBetween(1, 195),
            //'region_id' => 3, //$this->faker->numberBetween(3),
            //'field_office_id' => $this->faker->numberBetween(1, 232),
            //'field_office_id' => $field_office_id, //Field_office::all()->random(17, 12, 28), //->region_id,
            'address' => $this->faker->address(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $gender,
            'nic' => $this->faker->iban(),
            'nationality' => $this->faker->numberBetween(1, 195),
            'ethnicity' => 'eastern',
            'created_by' => 1,
        ];
    }
}
