<?php

declare(strict_types=1);

namespace App\Presenter\Resources;

use App\Domain\User\User;
use App\Infrastructure\Database\Models\PostModel;
use App\Infrastructure\Database\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JsonOutputInterface extends JsonResource
{

    public function toArray(Request $request): array
    {
        $relationships = $this->getRelations();
        $attributes = $this->extractAttributes($request);

        foreach ($relationships as $relation => $value) {
            unset($attributes[$relation]);
        }

        return [
            'id' => $this->id,
            'attributes' => $attributes,
            'relationships' => $relationships,
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
        'attributes' => $this->extractAttributes($data),
        'relationships' => $this->relationships,
        'links' => [
            'self' => route($this->route_self, $this->id),
            'parent' => route($this->route_parent)
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
