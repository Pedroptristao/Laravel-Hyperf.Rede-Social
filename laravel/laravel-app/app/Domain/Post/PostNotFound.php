<?php

declare(strict_types=1);

namespace App\Domain\Post;

use App\Domain\EntityNotFound;

class PostNotFound extends EntityNotFound
{
    public function __construct(int $id)
    {
        parent::__construct('Post', ['id' => $id]);
    }
}
