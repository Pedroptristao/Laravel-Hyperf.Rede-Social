<?php

declare(strict_types=1);

namespace App\Application\UserFriendship\Create;

use App\Application\Command;
use App\Application\CommandHandler;
use App\Domain\UserFriendship\Friendship;
use App\Domain\UserFriendship\Friendships;

class CreateUserFriendshipCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly Friendships $friendships
    ) {
    }

    public function handle(Command $command)
    {
        $friendship = Friendship::create(null, ...$command->getProperties());
        
        $this->friendships->create($friendship);
    }
}
