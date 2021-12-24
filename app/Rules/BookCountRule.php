<?php

namespace App\Rules;

use App\Models\Book;
use Illuminate\Contracts\Validation\Rule;

class BookCountRule implements Rule
{
    public $book;

    public function __construct(int $book)
    {
        $this->book = Book::find($book);
    }

    public function passes($attribute, $value)
    {
        return $this->book->quantity >= (int)$value;
    }

    public function message()
    {
        return 'Quantity of books not available, books left ' . $this->book->quantity;
    }
}
