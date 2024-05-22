<?php

declare(strict_types=1);

namespace App\Application\User\Delete;

use App\Application\Query;

class DeleteUserQuery implements Query
{
    public function __construct(
        public readonly int $id,
    ) {
    }
}
