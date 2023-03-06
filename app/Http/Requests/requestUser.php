<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules(): array
    {
        return [
            'name' => 'required|min:6|max:30',
            'email' => 'required|email|min:10|max:40',
            'password' => 'required|min:6|max:30',
            'password_confirm' => 'required|equal:password',
            'profile_photo_path' => 'max:2048',
            'is_active' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'se requieren como mínimo 6 caracteres',
            'name.max' => 'se requieren como máximo 30 caracteres',
            // 'email' => 'required|email|min:6|max:30',
            // 'password' => 'required|min:6|max:30',
            // 'password_confirm' => 'required|min:6|max:30',
            // 'profile_photo_path' => 'required|min:6|max:30',
            // 'is_active' => 'required|min:6|max:30',
        ];
    }
}
