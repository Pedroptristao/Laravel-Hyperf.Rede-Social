<?php

declare(strict_types=1);

namespace App\Presenter\Http\Post\Delete;

use App\Application\Post\Delete\DeletePostQuery;
use App\Application\Post\Delete\DeletePostQueryHandler;
use App\Domain\Post\PostNotFound;
use App\Presenter\Resources\JsonOutputInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DeletePostController
{
    public function __construct(
        private readonly DeletePostQueryHandler $deleteHandler
    ) {
    }

    public function __invoke(int $postId): JsonResponse | Response
    {
        try {
            $query = new DeletePostQuery($postId);
            $post = $this->deleteHandler->handle($query, null);
        } catch (PostNotFound $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details' => $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }
        $jsonOutput = new JsonOutputInterface($post);
        return new JsonResponse($jsonOutput->delete($post), Response::HTTP_OK);
    }
}
