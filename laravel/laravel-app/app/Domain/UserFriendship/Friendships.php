<?php

declare(strict_types=1);

namespace App\Domain\UserFriendship;
use App\Application\Query;
use App\Domain\UserFriendship\Friendship;
use Illuminate\Pagination\LengthAwarePaginator;

interface Friendships
{
    public function get(int $id): Friendship;

    public function index(Query $query, string | null $perPage): LengthAwarePaginator;

    public function create(Friendship $post): void;
}
