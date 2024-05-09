<?php

declare(strict_types=1);

namespace App\Application\User\Index;

use App\Application\Query;
use App\Application\QueryHandler;
use App\Domain\User\User;
use App\Domain\User\Users;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexUserQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly Users $users
    ) {
    }

    /**
     * @return User[]
     */
    public function handle(Query $query, string | null $perPage): LengthAwarePaginator
    {
        return $this->users->index($query, $perPage);
    }
}
