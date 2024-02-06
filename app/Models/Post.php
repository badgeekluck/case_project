<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'content', 'status'
    ];

    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
