<?php

declare(strict_types=1);

namespace App\Domain\User;
use App\Application\Query;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Users
{
    public function get(int $id): User;

    public function index(Query $query, string | null $perPage): LengthAwarePaginator;

    public function create(User $user): void;
}
