<?php

declare(strict_types=1);

namespace App\Domain\Post;
use App\Application\Query;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Posts
{
    public function get(int $id): Post;

    public function index(Query $query, string | null $perPage): LengthAwarePaginator;

    public function create(Post $post): void;

    public function delete(int $id): array;
}
