<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screening_status_log extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function createdById()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
