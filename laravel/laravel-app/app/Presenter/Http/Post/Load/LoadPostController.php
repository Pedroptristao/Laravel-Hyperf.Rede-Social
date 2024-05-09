<?php

declare(strict_types=1);

namespace App\Presenter\Http\Post\Load;

use App\Application\Post\Load\LoadPostQuery;
use App\Application\Post\Load\LoadPostQueryHandler;
use App\Domain\Post\PostNotFound;
use App\Presenter\Resources\JsonOutputInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoadPostController
{
    public function __construct(
        private readonly LoadPostQueryHandler $loadHandler
    ) {
    }

    public function __invoke(int $postId): JsonResponse | Response
    {
        try {
            $query = new LoadPostQuery($postId);
            $post = $this->loadHandler->handle($query);
        } catch (PostNotFound $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details' => $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }
        $jsonOutput = new JsonOutputInterface($post);
        return new JsonResponse($jsonOutput->show($post), Response::HTTP_OK);
    }
}
