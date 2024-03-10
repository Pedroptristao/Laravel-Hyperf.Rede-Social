<?php

declare(strict_types=1);

namespace App\Http\Requests\api\v1\Posts;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string'
            ],
            'post_image_path' => [
                'nullable'
            ],
            'body' => [
                'nullable',
                'string'
            ]
        ];
    }
}
