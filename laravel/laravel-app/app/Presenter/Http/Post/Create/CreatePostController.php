<?php

declare(strict_types=1);

namespace App\Presenter\Http\Post\Create;

use App\Application\Post\Create\CreatePostCommandHandler;
use Illuminate\Http\JsonResponse;

class CreatePostController
{
    public function __construct(
        private readonly CreatePostCommandHandler $createHandler
    ) {
    }

    public function __invoke(CreatePostRequest $request): JsonResponse
    {
        $this->createHandler->handle($request->toCommand());

        return response()->json(
            $request->toCommand(),
            JsonResponse::HTTP_CREATED
        );

    }
}
