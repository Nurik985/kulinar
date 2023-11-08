<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Heading extends Model
{
    use HasFactory;

    use InsertOnDuplicateKey;

    protected $guarded = [];


    // protected function parentSect(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => ucfirst($value),
    //     );
    // }

    // protected $casts = [
    //     'parent_sect' => 'array',
    // ];



    public function sections(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Section::class);
    }

    public function scopeSearch($query, $value)
    {
        $res = $query->where('name', 'like', "%{$value}%");
    }
}
