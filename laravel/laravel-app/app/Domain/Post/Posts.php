<?php

declare(strict_types=1);

namespace App\Domain\Post;
use App\Application\Query;
use Illuminate\Database\Eloquent\Collection;

interface Posts
{
    public function get(int $id): Post;

    public function index(Query $query): Collection;

    public function create(Post $post): void;
}
