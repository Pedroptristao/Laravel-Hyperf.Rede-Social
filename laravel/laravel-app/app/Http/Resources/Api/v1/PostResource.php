<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Route;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'post',
            'attributes' => [
                'title' => $this->title,
                'post_image_path' => $this->post_image_path,
                'body' => $this->body,
                'published' => $this->published
            ],
            'relationships' => [],
            'links' => [
                'self' => route('apiv1postsshow', $this->id),
                'parent' => route('apiv1postsindex')
            ]
        ];
    }
}
