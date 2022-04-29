<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\Post\Comment;

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
            'text' => 'required'
        ];
    }
}
