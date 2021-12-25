<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::query()
            ->with(['user', 'book.category'])
            ->when(
                request()->query('status') && in_array(request()->query('status'), [1, 2, 3]),
                fn ($query) => $query->where('status', request()->query('status')),
                fn ($query) => $query,
            )
            ->orderBy('status', 'ASC')
            ->get();

        $loans->transform(function ($loan) {
            if ($loan->status == Loan::STATUS_WAITING) {
                $loan->status = 'Menunggu';
            } else if ($loan->status == Loan::STATUS_ON_LOAN) {
                $loan->status = 'Meminjam';
            } else {
                $loan->status = 'Selesai';
            }

            return $loan;
        });

        return view('pages.admin.loan.index', compact('loans'));
    }

    public function update(Loan $loan)
    {
        $loan->update([
            'status' => request('validation')
        ]);

        switch (request('validation')) {
            case 3: {
                    Book::query()->find($loan->book_id)->increment('quantity', $loan->quantity);
                    $loan->update(
                        ['date_of_return_confirmation' => now()->setTimezone('Asia/Jakarta')->toDateString()]
                    );
                }
                break;
            case 1: {
                    Book::query()->find($loan->book_id)->increment('quantity', $loan->quantity);
                    $loan->delete();
                }
                break;
            default:
                break;
        }

        return redirect()->route('admin.loan.index')->with('status', 'Sukses mengubah status');
    }
}
