<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $books = Book::query()
            ->with('category')
            ->get();

        $loan = Loan::query()
            ->with('book.category')
            ->where('user_id', auth()->id())
            ->get();

        $count = [
            'waiting' => $loan->where('status', Loan::STATUS_WAITING)->count(),
            'onloan' => $loan->where('status', Loan::STATUS_ON_LOAN)->count(),
            'done' => $loan->where('status', Loan::STATUS_DONE)->count(),
        ];

        $loans = $loan->where('status', '!=', 3);

        $loans->transform(function ($loan) {
            if ($loan->status == Loan::STATUS_WAITING) {
                $loan->status = 'Menunggu';
            } else if ($loan->status == Loan::STATUS_ON_LOAN) {
                $loan->status = 'Meminjam';
            }

            return $loan;
        });

        return view('pages.user.index', compact('books', 'count', 'loans'));
    }
}
