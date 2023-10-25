<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, $value){
        $query->where('h1','like',"%{$value}%")->orWhere('url','like',"%{$value}%");
    }
}
