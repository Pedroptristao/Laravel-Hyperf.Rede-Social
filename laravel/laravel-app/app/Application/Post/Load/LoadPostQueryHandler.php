<?php

declare(strict_types=1);

namespace App\Application\Post\Load;

use App\Application\Query;
use App\Application\QueryHandler;
use App\Domain\Post\Post;
use App\Domain\Post\Posts;
class LoadPostQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly Posts $posts
    ) {
    }

    /**
     * @param LoadPostQuery $command
     */
    public function handle(Query $command, string | null $perPage): Post
    {   
        return $this->posts->get($command->id);
    }
}
