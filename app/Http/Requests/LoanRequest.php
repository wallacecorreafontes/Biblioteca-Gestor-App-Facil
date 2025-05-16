<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'book_id' => ['required', 'integer', 'exists:books,id'],
            'due_date' => ['required', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'O campo usuário é obrigatório.',
            'user_id.integer' => 'O campo usuário deve ser um número inteiro.',
            'user_id.exists' => 'O usuário selecionado não existe.',

            'book_id.required' => 'O campo livro é obrigatório.',
            'book_id.integer' => 'O campo livro deve ser um número inteiro.',
            'book_id.exists' => 'O livro selecionado não existe.',

            'due_date.required' => 'A data de devolução é obrigatória.',
            'due_date.date' => 'A data de devolução deve ser uma data válida.',
            'due_date.after_or_equal' => 'A data de devolução deve ser hoje ou uma data futura.',
        ];
    }
}
