<?php

namespace App\Models;

use Database\Seeders\UserRolesSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field_office extends Model
{
    use HasFactory;

    public function regionID()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }
}
