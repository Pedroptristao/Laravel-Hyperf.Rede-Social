<?php

declare(strict_types=1);

namespace App\Presenter\Http\User\Delete;

use App\Application\User\Delete\DeleteUserQuery;
use App\Application\User\Delete\DeleteUserQueryHandler;
use App\Domain\User\UserNotFound;
use App\Presenter\Resources\JsonOutputInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteUserController
{
    public function __construct(
        private readonly DeleteUserQueryHandler $deleteHandler
    ) {
    }

    public function __invoke(int $userId): JsonResponse | Response
    {
        try {
            $query = new DeleteUserQuery($userId);
            $user = $this->deleteHandler->handle($query, null);
        } catch (UserNotFound $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details' => $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }
        $jsonOutput = new JsonOutputInterface($user);
        return new JsonResponse($jsonOutput->delete($user), Response::HTTP_OK);
    }
}
