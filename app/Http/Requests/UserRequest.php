<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->whereNull('deleted_at')->ignore($userId),
            ],
            'registration_number' => ['required', 'string', 'regex:/^\d+$/', 'digits_between:1,19'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve ser um texto.',
            'name.max' => 'O nome não pode ultrapassar 255 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.unique' => 'Já existe um usuário com este e-mail.',

            'registration_number.required' => 'O número de matrícula é obrigatório.',
            'registration_number.string' => 'O número de matrícula deve ser uma sequência de dígitos.',
            'registration_number.regex' => 'O número de matrícula deve conter apenas números.',
            'registration_number.digits_between' => 'O número de matrícula deve ter entre 1 e 19 dígitos.',
        ];
    }
}
