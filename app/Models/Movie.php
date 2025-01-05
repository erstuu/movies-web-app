<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title', 
        'synopsis', 
        'year', 
        'available', 
        'genre_id'
    ];

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function castMovies(): HasMany
    {
        return $this->hasMany(CastMovie::class);
    }
}
