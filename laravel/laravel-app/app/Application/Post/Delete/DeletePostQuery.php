<?php

declare(strict_types=1);

namespace App\Application\Post\Delete;

use App\Application\Query;

class DeletePostQuery implements Query
{
    public function __construct(
        public readonly int $id,
    ) {
    }
}
