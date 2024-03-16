<?php

declare(strict_types=1);

namespace App\Domain\User;
use App\Application\Query;
use Illuminate\Database\Eloquent\Collection;

interface Users
{
    public function get(int $id): User;

    public function index(Query $query): Collection;

    public function create(User $user): void;
}
