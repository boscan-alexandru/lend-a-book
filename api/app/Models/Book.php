<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTomany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'name',
        'cover',
    ];


    public function borrowers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
