<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke() {
        return PostResource::collection(Post::all());
    }
}