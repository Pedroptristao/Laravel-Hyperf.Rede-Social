<?php

declare(strict_types=1);

namespace App\Presenter\Http\Post\Create;

use App\Application\Post\Create\CreatePostCommand;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'post_image_path' => 'string',
            'body' => 'string',
            'published' => 'required|boolean',
            'user_id' => 'required|exists:users,id',
        ];
    }
    

    public function toCommand(): CreatePostCommand
    {
        return new CreatePostCommand(
            ...$this->safe()->all()
        );
    }
}
