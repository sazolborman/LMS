<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bootcamp extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->hasMany(BootcampModule::class, 'bootcamp_id', 'id');
    }
    public function bootcampcategory()
    {
        return $this->belongsTo(BootcampCategory::class, 'category_id', 'id');
    }
}
