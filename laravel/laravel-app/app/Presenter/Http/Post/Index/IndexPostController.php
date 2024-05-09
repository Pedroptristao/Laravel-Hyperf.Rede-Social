<?php

declare(strict_types=1);

namespace App\Presenter\Http\Post\Index;

use App\Application\Post\Index\IndexPostQuery;
use App\Application\Post\Index\IndexPostQueryHandler;
use App\Domain\Post\PostNotFound;
use App\Presenter\Resources\JsonOutputInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IndexPostController
{
    public function __construct(
        private readonly IndexPostQueryHandler $loadHandler
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $perPage = $request->query('perPage');
            $query = new IndexPostQuery();
            $posts = $this->loadHandler->handle($query, $perPage);
        } catch (PostNotFound $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'details' => $e->getDetails()
            ], Response::HTTP_NOT_FOUND);
        }
        return new JsonResponse(JsonOutputInterface::collection($posts), Response::HTTP_OK);
    }
}
