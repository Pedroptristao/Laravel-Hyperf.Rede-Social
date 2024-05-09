<?php

declare(strict_types=1);

namespace App\Application\Post\Index;

use App\Application\Query;
use App\Application\QueryHandler;
use App\Domain\Post\Post;
use App\Domain\Post\Posts;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class IndexPostQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly Posts $posts
    ) {
    }

    /**
     * @return Post[]
     */
    public function handle(Query $query, string | null $perPage): LengthAwarePaginator
    {
        return $this->posts->index($query, $perPage);
    }
}
