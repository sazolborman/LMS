<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->hasMany(Section::class, 'course_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
