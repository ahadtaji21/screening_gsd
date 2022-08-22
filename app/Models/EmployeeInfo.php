<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    use HasFactory;

    /**
     * Get the screening details for the employee.
     */
    public function screening()
    {
        return $this->hasMany(ScreeningDetail::class, 'employee_info_id', 'id');
    }
}
