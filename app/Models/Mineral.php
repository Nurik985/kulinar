<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mineral extends Model
{

    protected $fillable = [
        'ing_id',
        'datas',
    ];

    use HasFactory;
}
