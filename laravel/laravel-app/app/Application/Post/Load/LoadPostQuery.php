<?php

declare(strict_types=1);

namespace App\Application\Post\Load;

use App\Application\Query;

class LoadPostQuery implements Query
{
    public function __construct(
        public readonly int $id,
    ) {
    }
}
