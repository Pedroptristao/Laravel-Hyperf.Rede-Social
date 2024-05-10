<?php

declare(strict_types=1);

namespace App\Infrastructure\Database;

use App\Application\Query;
use App\Domain\UserFriendship\Friendship;
use App\Domain\UserFriendship\FriendshipNotFound;
use App\Domain\UserFriendship\Friendships;
use App\Infrastructure\Database\Models\UserFriendshipModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class EloquentUserFriendships implements Friendships
{
    public function __construct(
        private readonly UserFriendshipModel $model
    ) {
    }

    /**
     * @throws FriendshipNotFound
     */
    public function get(int $id): Friendship
    {
        try {
            $friendship = UserFriendshipModel::findOrFail($id)->toArray();
        } catch (ModelNotFoundException) {
            throw new FriendshipNotFound($id);
        }
        return Friendship::fromArray($friendship);
    }

    public function index(Query $query, ?string $perPage): LengthAwarePaginator
    {
        $page = Paginator::resolveCurrentPage('page');
        if (!$perPage) {
            $perPage = 10;
        }
        $paginatedResults = $this->model->with('user', 'friend')->paginate($perPage, ['*'], 'page', $page);

        $transformedResults = $paginatedResults->getCollection()->transform(function ($friendship) {
            $friendship->route_self = 'api:v1:userfriendship:show';
            return $friendship;
        });

        return $paginatedResults->setCollection($transformedResults);
    }

    public function create(Friendship $friendship): void
    {
        $this->model->create($friendship->toArray());
    }
}
