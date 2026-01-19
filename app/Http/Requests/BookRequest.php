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
        $bookId = $this->route('book');
        
        return [
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $bookId,
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:1',
        ];
    }
}
