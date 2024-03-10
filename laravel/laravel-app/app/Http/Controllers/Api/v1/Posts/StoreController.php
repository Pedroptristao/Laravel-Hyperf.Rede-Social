<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\Posts\StoreRequest;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        dd('oi');
    }
}
