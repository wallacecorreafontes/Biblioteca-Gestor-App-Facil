<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:available,borrowed'],
            'registration_number' => ['required', 'string', 'regex:/^\d+$/', 'digits_between:1,19'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O nome é obrigatório.',
            'title.string' => 'O nome deve ser um texto.',
            'title.max' => 'O nome não pode ultrapassar 255 caracteres.',

            'author.required' => 'O autor é obrigatório.',
            'author.string' => 'O autor deve ser um texto.',
            'author.max' => 'O autor não pode ultrapassar 255 caracteres.',

            'status.required' => 'A situação é obrigatória.',

            'registration_number.required' => 'O número de matrícula é obrigatório.',
            'registration_number.string' => 'O número de matrícula deve ser uma sequência de dígitos.',
            'registration_number.regex' => 'O número de matrícula deve conter apenas números.',
            'registration_number.digits_between' => 'O número de matrícula deve ter entre 1 e 19 dígitos.',
        ];
    }
}
