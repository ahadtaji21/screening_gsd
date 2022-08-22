<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreeningDetail extends Model
{
    use HasFactory;

     /**
     * Get the employee that owns the screening.
     */
    public function employeeInfo()
    {
        return $this->belongsTo(EmployeeInfo::class);
    }
}
