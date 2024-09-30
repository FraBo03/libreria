<?php

namespace App\Http\Controllers;

use App\Events\LoanUpdated;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index() {
        $loans = Loan::with(['book', 'user'])->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        // Recupera solo i libri che non sono attualmente in prestito (dove il campo returned_at è null)
        $books = Book::whereDoesntHave('loans', function($query) {
            $query->whereNull('returned_at');
        })->get();
        
        $users = User::all();  // Recupera tutti gli utenti

        return view('loans.create', compact('books', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'user_id' => 'required|exists:users,id',
            'borrowed_at' => 'required|date',
            'due_at' => 'nullable|date',
        ]);

        $loan = Loan::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'borrowed_at' => $request->borrowed_at,
            'due_at' => $request->due_at,
            'returned_at' => $request->returned_at,
        ]);

        event(new LoanUpdated($loan));

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    public function edit($id){
        $loan = Loan::findOrFail($id);

        // Recupera tutti i libri disponibili più il libro attualmente selezionato
        $books = Book::whereDoesntHave('loans', function($query) use ($loan) {
            $query->whereNull('returned_at')->where('id', '!=', $loan->book_id);
        })->orWhere('id', $loan->book_id)->get();

        $users = User::all();  // Recupera tutti gli utenti

        return view('loans.edit', compact('loan', 'books', 'users'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
        ]);
    
        $loan = Loan::findOrFail($id);


        $loan->update([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'borrowed_at' => $request->borrowed_at,
            'due_at' => $request->due_at,
            'returned_at' => $request->returned_at,
        ]);

        event(new LoanUpdated($loan));

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    public function reader() {
        $user = Auth::user();

        $loans = Loan::where('user_id', $user->id)->get();

        return view('reader', ['user' => $user, 'loans' => $loans]);
       
        
    }
}