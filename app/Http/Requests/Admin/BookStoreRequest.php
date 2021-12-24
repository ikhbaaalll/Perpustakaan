<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required'],
            'publisher' => ['required'],
            'isbn' => ['required', Rule::unique('books')],
            'author' => ['required'],
            'date_of_entry' => ['required', 'date'],
            'quantity' => ['required', 'integer'],
            'description' => ['required', 'string']
        ];
    }
}
