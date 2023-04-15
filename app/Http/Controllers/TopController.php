<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use Auth;

class TopController extends Controller
{
    public function index()
    {
        $all_books = Book::all();
        
        if(Auth::check()){
            $user_id = auth()->user()->id;
            $my_books = Book::where('user_id', $user_id)->get();
            return view('welcome', ['my_books' => $my_books, 'all_books' => $all_books]);
        }
        
        return view('welcome', ['all_books' => $all_books]);
    }
}
