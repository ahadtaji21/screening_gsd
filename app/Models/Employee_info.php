<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_info extends Model
{
    use HasFactory;

    public function screening()
    {
        return $this->hasMany(Screening_detail::class, 'employee_info_id', 'id');
    }

    public function countries()
    {
        return $this->hasOne(Country::class, 'id', 'country_of_birth');
    }
    

    public function nationalityId()
    {
        return $this->hasOne(Country::class, 'id', 'nationality');
    }

    /*public function ethnicityId()
    {
        return $this->hasOne(Country::class, 'id', 'ethnicity');
    }*/

    /*public function regionId()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function field_office()
    {
        return $this->hasOne(Field_office::class, 'id', 'field_office_id');
    }*/

    public function createdById()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedById()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
