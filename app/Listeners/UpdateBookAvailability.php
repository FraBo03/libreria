<?php

namespace App\Listeners;

use App\Events\LoanUpdated;
use App\Models\Book;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateBookAvailability
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoanUpdated $event): void
    {
        $loan = $event->loan;
        $book = Book::findOrFail($loan->book_id);
        $book->availability = $loan->returned_at ? true : false;
        $book->save();
    }
}
