<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening_detail extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'questions' => 'array'
    ];


    public function Employee_info()
    {
        return $this->belongsTo(Employee_info::class);
    }

    public function regionId()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

    public function field_office()
    {
        return $this->hasOne(Field_office::class, 'id', 'field_office_id');
    }

    public function designationsId()
    {
        return $this->hasOne(Designation::class, 'id', 'designation_id');
    }

    public function lineManagerDesignationsId()
    {
        return $this->hasOne(Designation::class, 'id', 'line_manager_designation');
    }

    public function departmentsId()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }

    public function onBehalfUserId()
    {
        return $this->hasOne(User::class, 'id', 'on_behalf_user');
    }

    public function scCreatedById()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function scUpdatedById()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }

    public function screeningStatusLogId()
    {
        return $this->hasMany(Screening_status_log::class, 'screening_detail_id', 'id');
    }

    public function screeningComments()
    {
        return $this->hasMany(Screening_comment::class, 'screening_detail_id', 'id');
    }

    public function ScreeningDocumentDetail()
    {
        return $this->hasMany(Screening_document_detail_checklist::class);
    }
}
