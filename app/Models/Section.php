<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'h1',
        'title',
        'description',
        'url',
        'text',
        'fade_home',
    ];

    public function scopeSearch($query, $value){
        $query->where('h1','like',"%{$value}%")->orWhere('url','like',"%{$value}%");
    }
}
