<?php

declare(strict_types=1);

namespace App\Presenter\Http\User\Index;

use App\Application\User\Index\IndexUserQuery;
use App\Application\User\Index\IndexUserQueryHandler;
use App\Domain\User\UserNotFound;
use App\Infrastructure\Database\Models\UserModel;
use App\Presenter\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexUserController
{
    public function __construct(
        private readonly IndexUserQueryHandler $loadHandler
    ) {
    }

    public function __invoke(): JsonResponse
    {
        try {
            $query = new IndexUserQuery();
            $users = $this->loadHandler->handle($query);
        } catch (UserNotFound $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details' => $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(UserResource::collection($users), Response::HTTP_OK);
    }
}
