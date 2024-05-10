<?php

declare(strict_types=1);

namespace App\Application\UserFriendship\Create;

use App\Application\Command;
use DateTimeImmutable;

class CreateUserFriendshipCommand extends Command
{
    public function __construct(
        public readonly int $user_id,
        public readonly int $friend_id,
        public readonly DateTimeImmutable $friends_since,
    )  {
    }
}
