<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_user',
        'text',
        'status',
        'answer',
        'id_recipe',
        'id_comment_answer',
        'please',
        'email',
        'imgs',
    ];

    public function scopeSearch($query, $value)
    {
        $query->where('text', 'like', "%{$value}%");
    }
}
