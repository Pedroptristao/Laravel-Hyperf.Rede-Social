<?php

declare(strict_types=1);

namespace App\Domain\UserFriendship;

use App\Domain\EntityNotFound;

class FriendshipNotFound extends EntityNotFound
{
    public function __construct(int $id)
    {
        parent::__construct('Friendship', ['id' => $id]);
    }
}
