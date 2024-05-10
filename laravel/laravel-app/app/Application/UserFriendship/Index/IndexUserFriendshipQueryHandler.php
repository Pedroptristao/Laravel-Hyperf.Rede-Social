<?php

declare(strict_types=1);

namespace App\Application\UserFriendship\Index;

use App\Application\Query;
use App\Application\QueryHandler;
use App\Domain\UserFriendship\Friendship;
use App\Domain\UserFriendship\Friendships;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexUserFriendshipQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly Friendships $friendships
    ) {
    }

    /**
     * @return Friendship[]
     */
    public function handle(Query $query, string | null $perPage): LengthAwarePaginator
    {
        return $this->friendships->index($query, $perPage);
    }
}
