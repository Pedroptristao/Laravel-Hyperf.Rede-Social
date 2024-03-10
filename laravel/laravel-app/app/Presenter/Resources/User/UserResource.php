<?php

declare(strict_types=1);

namespace App\Presenter\Resources\User;

use App\Domain\User\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'user',
            'attributes' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'profile_photo_path' => $this->profile_photo_path,
                'theme' => $this->theme
            ],
            'relationships' => [],
            'links' => [
                'self' => route('api:v1:user:show', $this->id),
                'parent' => route('api:v1:user:index')
            ]
        ];
    }
    
    public static function show(User $user): array
    {
        return [
            'type' => 'user',
            'id' => $user->id,
            'attributes' => 
            [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'profile_photo_path' => $user->profile_photo_path,
                'theme' => $user->theme
            ],
            'relationships' => []
        ];
    }
}
