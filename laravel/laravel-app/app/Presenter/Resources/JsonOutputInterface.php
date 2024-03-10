<?php

declare(strict_types=1);

namespace App\Presenter\Resources;

use App\Domain\User\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonOutputInterface extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'user',
            'attributes' => $this->extractAttributes($request),
            'relationships' => [],
            'links' => [
                'self' => route('api:v1:user:show', $this->id),
                'parent' => route('api:v1:user:index')
            ]
        ];
    }

    public function show($data): array
{
    return [
        'id' => $this->id,
        'type' => 'user',
        'attributes' => $this->extractAttributes($data),
        'relationships' => [],
        'links' => [
            'self' => route('api:v1:user:show', $this->id),
            'parent' => route('api:v1:user:index')
        ]
    ];
}


    protected function extractAttributes($request): array
    {
        $attributes = $this->resource->toArray();

        unset($attributes['password'], $attributes['remember_token']);

        return $attributes;
    }
}
