<?php

declare(strict_types=1);

namespace App\Presenter\Http\UserFriendship\Load;

use App\Application\UserFriendship\Load\LoadUserFriendshipQuery;
use App\Application\UserFriendship\Load\LoadUserFriendshipQueryHandler;
use App\Domain\UserFriendship\FriendshipNotFound;
use App\Presenter\Resources\JsonOutputInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoadUserFriendshipController
{
    public function __construct(
        private readonly LoadUserFriendshipQueryHandler $loadHandler
    ) {
    }

    public function __invoke(int $friendshipId): JsonResponse | Response
    {
        try {
            $query = new LoadUserFriendshipQuery($friendshipId);
            $friendship = $this->loadHandler->handle($query, null);
        } catch (FriendshipNotFound $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details' => $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }
        $jsonOutput = new JsonOutputInterface($friendship);
        return new JsonResponse($jsonOutput->show($friendship), Response::HTTP_OK);
    }
}
