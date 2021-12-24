<?php

namespace App\Http\Requests\User;

use App\Rules\BookCountRule;
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
            'book_id' => ['required', Rule::exists('books', 'id')],
            'quantity' => ['required', new BookCountRule($this->book_id), 'integer'],
            'date_of_loan' => ['date', 'after_or_equal:today'],
            'date_of_return' => ['date', 'after:date_of_loan']
        ];
    }
}
