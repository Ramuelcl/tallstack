<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class requestUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules($user): array
    {
        $rules1 = [];
        $rules1 = [
            'name' => 'required|min:6|max:30',
            'email' => ['required', 'email', 'min:10', 'max:40', Rule::unique('users', 'email')->ignore($user)],
            'profile_photo_path' => 'image|max:2048',
            'is_active' => 'boolean',
        ];
        $rules2 = [];
        if (!$user) {
            $rules2 = [
                'password' => 'required|min:2|max:30|confirmed',
                // 'password_confirm' => 'required|equal:password',
            ];
        }
        return array_merge($rules1, $rules2);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'se requieren como mínimo 6 caracteres',
            'name.max' => 'se requieren como máximo 30 caracteres',
            //
            'email.required' => 'El campo nombre es obligatorio',
            'email.email' => 'debe ser de tipo eMail (nombre@empresa.ext)',
            'name.min' => 'se requieren como mínimo 10 caracteres',
            'email.max' => 'se requieren como máximo 40 caracteres',
            //
            'profile_photo_path.image' => 'solo admite de tipo imagenes',
            'profile_photo_path.max' => 'para el nombre máximo 2048 caracteres',
            //
            'is_active.boolean' => 'sólo 1 o 0',
            //
            'password.required' => 'required|min:6|max:30',
            'password.min' => 'se requieren como mínimo 2 caracteres',
            'password.max' => 'se requieren como máximo 30 caracteres',
            'password.confirmed' => 'la confirmación no es la misma',
        ];
    }
}
