<?php

namespace Database\Factories;

use App\Models\EmployeeInfo;
use App\Models\Field_office;
use App\Models\ScreeningDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScreeningDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ScreeningDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // '1-pending, 2-in-progress, 3-completed',
        $screening_status = $this->faker->randomElement(['1', '2']);
        $type_of_staff = $this->faker->randomElement(['Employee', 'Part-time', 'Consultant', 'Short Term', 'Intern', 'Volunteer']);
        $screening_result = $this->faker->randomElement(['NFM', 'FMF', 'PMF']);
        $field_office_id = $this->faker->randomElement(['17', '12', '28']);

        return [
            'reference_no' => $this->faker->countryCode()."-".$this->faker->unique()->regexify('[0-8]{10}'),
            'employee_info_id' => EmployeeInfo::factory(),
            'region_id' => 3,
            'field_office_id' => $field_office_id,
            'type_of_staff' => $type_of_staff,
            'designation_id' => $this->faker->numberBetween(1, 589),
            'department_id' => $this->faker->numberBetween(1, 100),
            'line_manager_designation' => $this->faker->numberBetween(1, 100),
            'contract_start_date' => $this->faker->date(),
            'contract_end_date' => $this->faker->date(),
            'screening_result' => $screening_result,
            'screening_date' => $this->faker->date(),
            'comments' => $this->faker->sentence(),
            'screening_status' => $screening_status,
            'employee_status' => 0,
            'employee_status_dated' => $this->faker->date(),
            'record_status' => 1,
            'created_by' => 1,
            'is_deleted' => 0,
        ];
    }
}
