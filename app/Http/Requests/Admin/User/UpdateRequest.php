<?php

declare(strict_types=1);

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:15',
            'email' => 'required|email',
            'password' => 'required|min:8|max:30',
            'role' => 'required',
            'permissions' => ''
        ];
    }
}
