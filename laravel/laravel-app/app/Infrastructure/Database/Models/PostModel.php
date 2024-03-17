<?php

declare(strict_types=1);

namespace App\Infrastructure\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class PostModel extends Model
{
    use HasApiTokens;
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'post_image_path',
        'body',
        'published',
        'user_id'
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(UserModel::class);
    }
}
