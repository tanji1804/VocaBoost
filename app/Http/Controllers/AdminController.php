<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    
    public function users()
    {
        $users = User::whereNotIn('id', [Auth::id()])->get();
        
        return view('admin.users', [
                'users' => $users,
            ]);
    }
    
    public function books()
    {
        $books = Book::all();
        
        return view('admin.books', [
                'books' => $books,
            ]);
    }
    
    public function cards(Request $request)
    {
        $book = Book::find($request->book_id);
        $cards = $book->cards;
        
        return view('admin.cards',[
                'book' => $book,
                'cards' => $cards,
            ]);
    }
}
