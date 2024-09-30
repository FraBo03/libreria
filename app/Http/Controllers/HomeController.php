<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function homepage() {
        return view('home');
    }
}