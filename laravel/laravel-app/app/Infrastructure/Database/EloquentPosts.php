<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Application\Query;
use App\Domain\Post\Post;
use App\Domain\Post\PostNotFound;
use App\Domain\Post\Posts;
use App\Infrastructure\Database\Models\PostModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentPosts implements Posts
{
    public function __construct(
        private readonly PostModel $model
    ) {
    }

    /**
     * @throws PostNotFound
     */
    public function get(int $id): Post
    {
        try {
            $post = PostModel::with('user')->findOrFail($id)->toArray();
        } catch (ModelNotFoundException) {
            throw new PostNotFound($id);
        }
        return Post::fromArray($post);
    }

    public function index(Query $query): Collection
    {
        return $this->model->with('user')->get()->transform(
            function ($post) {
                $post->route_self = 'api:v1:posts:show';
                return $post;
            }
        );
    }

    public function create(Post $post): void
    {
        $this->model->create($post->toArray());
    }
}
