<?php

declare(strict_types=1);

namespace App\Application\Post\Delete;

use App\Application\Query;
use App\Application\QueryHandler;
use App\Domain\Post\Post;
use App\Domain\Post\Posts;
class DeletePostQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly Posts $posts
    ) {
    }

    /**
     * @param DeletePostQuery $command
     */
    public function handle(Query $command, string | null $perPage): array
    {   
        return $this->posts->delete($command->id);
    }
}
