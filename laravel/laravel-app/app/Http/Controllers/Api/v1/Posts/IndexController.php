<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\PostResource;
use Domain\Posts\Models\Post;
use Illuminate\Http\JsonResponse;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class IndexController extends Controller
{
    public function __invoke(): JsonResponse {

        $posts = QueryBuilder::for(
            Post::class
        )->allowedIncludes(
            ['user']
        )->allowedFilters(
            [
                AllowedFilter::scope('published'),
                AllowedFilter::scope('notPublished'),
            ]
        )->paginate(3);

        return response()->json(
            PostResource::collection(
                $posts
            ),
            200
        );
    }
}
