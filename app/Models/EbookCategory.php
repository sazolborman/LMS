<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookCategory extends Model
{
    use HasFactory;
    public function ebook()
    {
        return $this->hasMany(Ebook::class, 'category', 'id');
    }
}
