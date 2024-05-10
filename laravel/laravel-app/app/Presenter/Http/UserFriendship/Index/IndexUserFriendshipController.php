<?php

declare(strict_types=1);

namespace App\Presenter\Http\UserFriendship\Index;

use App\Application\UserFriendship\Index\IndexUserFriendshipQuery;
use App\Application\UserFriendship\Index\IndexUserFriendshipQueryHandler;
use App\Domain\UserFriendship\FriendshipNotFound;
use App\Presenter\Resources\JsonOutputInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexUserFriendshipController
{
    public function __construct(
        private readonly IndexUserFriendshipQueryHandler $loadHandler
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $perPage = $request->query('perPage');
            $query = new IndexUserFriendshipQuery();
            $friendships = $this->loadHandler->handle($query, $perPage);
        } catch (FriendshipNotFound $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details' => $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(JsonOutputInterface::collection($friendships), Response::HTTP_OK);
    }
}
