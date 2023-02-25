<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'media_id', 'user_id', 'popularity', 'title', 'overview', 'vote_average', 'poster_path', 'release_date'
    ];

    protected $casts = [
        'note' => 'float',
        'popularity' => 'float',
        'release_date' => 'date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
