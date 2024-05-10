<?php

declare(strict_types=1);

namespace App\Presenter\Http\UserFriendship\Create;

use App\Application\UserFriendship\Create\CreateUserFriendshipCommandHandler;
use App\Presenter\Http\UserFriendship\Create\CreateUserFriendshipRequest;
use Illuminate\Http\JsonResponse;

class CreateUserFriendshipController
{
    public function __construct(
        private readonly CreateUserFriendshipCommandHandler $createHandler
    ) {
    }

    public function __invoke(CreateUserFriendshipRequest $request): JsonResponse
    {
        $this->createHandler->handle($request->toCommand());

        return response()->json(
            $request->toCommand(),
            JsonResponse::HTTP_CREATED
        );

    }
}
