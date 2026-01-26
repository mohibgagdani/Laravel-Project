<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_name' => 'required|exists:users,name',
            'book_title' => 'required|exists:books,title',
            'issue_date' => 'required|date',
        ];
    }
}
