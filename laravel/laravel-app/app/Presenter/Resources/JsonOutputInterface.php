<?php

declare(strict_types=1);

namespace App\Presenter\Resources;

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
            'attributes' => $attributes,
            'relationships' => $relationships,
            'links' => [
                'self' => route($this->route_self, $this->id),
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

    public function delete($data): array
    {
        return [
            'message' => 'Deletado com sucesso',
            'data' => $data
        ];
    }


    protected function extractAttributes($request): array
    {
        $attributes = $this->resource->toArray();
        unset($attributes['password'], $attributes['remember_token'], $attributes['route_self'], $attributes['is_friends_with']);

        return $attributes;
    }
}
