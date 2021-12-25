<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\BookStoreRequest;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->with('category')
            ->get();

        return view('pages.user.book.index', compact('books'));
    }

    public function store(BookStoreRequest $bookStoreRequest)
    {
        Loan::create($bookStoreRequest->validated() + [
            'status' => Loan::STATUS_WAITING,
            'user_id' => auth()->id()
        ]);

        Book::query()->find($bookStoreRequest->book_id)
            ->decrement('quantity', $bookStoreRequest->quantity);

        return redirect()->route('user.dashboard')->with('status', 'Sukses meminjam buku.');
    }

    public function history()
    {
        $loans = Loan::where('user_id', auth()->id())
            ->where('status', Loan::STATUS_DONE)
            ->get();

        return view('pages.user.loan.index', compact('loans'));
    }
}
