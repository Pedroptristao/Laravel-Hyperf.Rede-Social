<?php

declare(strict_types=1);

namespace App\Application\UserFriendship\Load;

use App\Application\Query;
use App\Application\QueryHandler;
use App\Domain\UserFriendship\Friendship;
use App\Domain\UserFriendship\Friendships;
class LoadUserFriendshipQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly Friendships $friendships
    ) {
    }

    /**
     * @param LoadUserFriendshipQuery $command
     */
    public function handle(Query $command, string | null $perPage): Friendship
    {   
        return $this->friendships->get($command->id);
    }
}
