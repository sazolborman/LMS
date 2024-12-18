<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BootcampLiveClass extends Model
{
    use HasFactory;

    public function module()
    {
        return $this->belongsTo(BootcampModule::class, 'module_id', 'id');
    }
}
