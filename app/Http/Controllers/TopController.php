<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;

class TopController extends Controller
{
    public function index()
    {
        $all_books = Book::all();
        
        
        return view('welcome', ['all_books' => $all_books]);
    }
}
