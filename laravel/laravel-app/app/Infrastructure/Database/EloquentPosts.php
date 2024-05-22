<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Application\Query;
use App\Domain\Post\Post;
use App\Domain\Post\PostNotFound;
use App\Domain\Post\Posts;
use App\Infrastructure\Database\Models\PostModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

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

    public function index(Query $query, string | null $perPage): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage('page');
        if(!$perPage) {
            $perPage = 10;
        }
        $paginatedResults = $this->model->with('user')->paginate($perPage, ['*'], 'page', $page);
    
        $transformedResults = $paginatedResults->getCollection()->transform(function ($post) {
            $post->route_self = 'api:v1:posts:show';
            return $post;
        });
        
        return $paginatedResults->setCollection($transformedResults);
    }

    public function create(Post $post): void
    {
        $this->model->create($post->toArray());
    }

    public function delete(int $id): array
    {
        try {
            $postModel = PostModel::findOrFail($id);
            $postArray = $postModel->toArray();

            $postModel->delete();

            return $postArray;
        } catch (ModelNotFoundException) {
            throw new PostNotFound($id);
        }
    }
}
