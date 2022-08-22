<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*public function createdById()
    {
        return $this->hasMany(Employee_info::class, 'id', 'created_by');
    }*/

    public function designationId()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }

    public function departmentId()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function regionID()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function fieldOfficeIds()
    {
        return $this->hasMany(Field_office::class, 'id', 'field_office_id');
    }
}
