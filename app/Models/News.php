<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'external_url',
        'published_at',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function (News $news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}