<?php

declare(strict_types=1);

namespace App\Presenter\Http\User\Create;

use App\Application\User\Create\CreateUserCommandHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{
    public function __construct(
        private readonly CreateUserCommandHandler $createHandler
    ) {
    }

    public function __invoke(CreateUserRequest $request): JsonResponse
    {
        $this->createHandler->handle($request->toCommand());

        return response()->json(
            $request->toCommand(),
            JsonResponse::HTTP_CREATED
        );

    }
}
