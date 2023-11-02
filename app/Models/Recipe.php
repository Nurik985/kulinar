<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function scopeSearch($query, $value)
    {
        $query->where('name','LIKE',"$value%")->orWhere('name','LIKE',"% $value%");
    }
}
