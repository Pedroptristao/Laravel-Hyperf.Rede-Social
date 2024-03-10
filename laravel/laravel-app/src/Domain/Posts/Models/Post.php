<?php

declare(strict_types=1);

namespace Domain\Posts\Models;

use Domain\Posts\Models\Builders\PostBuilder;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'post_image_path',
        'body',
        'published',
        'user_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function newEloquentBuilder($query): PostBuilder {
        return new PostBuilder(
            $query
        );
    }
}
