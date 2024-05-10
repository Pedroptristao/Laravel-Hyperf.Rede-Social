<?php

declare(strict_types=1);

namespace App\Application\UserFriendship\Load;

use App\Application\Query;

class LoadUserFriendshipQuery implements Query
{
    public function __construct(
        public readonly int $id,
    ) {
    }
}
