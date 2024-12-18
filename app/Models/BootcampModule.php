<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampModule extends Model
{
    use HasFactory;
    public function bootcamp()
    {
        return $this->belongsTo(Bootcamp::class, 'bootcamp_id', 'id');
    }

    public function live_class()
    {
        return $this->hasMany(BootcampLiveClass::class, 'module_id', 'id');
    }
}
