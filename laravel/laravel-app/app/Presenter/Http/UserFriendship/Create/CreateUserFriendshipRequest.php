<?php

declare(strict_types=1);

namespace App\Presenter\Http\UserFriendship\Create;

use App\Application\Friendship\Create\CreateFriendshipCommand;
use App\Application\UserFriendship\Create\CreateUserFriendshipCommand;
use DateTimeImmutable;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserFriendshipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'friend_id' => 'required|exists:users,id|different:user_id',
        ];
    }

    /**
     * Convert the request to a CreateFriendshipCommand object.
     */
    public function toCommand(): CreateUserFriendshipCommand
    {
        return new CreateUserFriendshipCommand(
            (int) $this->input('user_id'),
            (int) $this->input('friend_id'),
            new DateTimeImmutable()
        );
    }
}
