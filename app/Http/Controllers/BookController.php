<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\BookRequest;


class BookController extends Controller
{
    // book.index
    public function index(Request $request)
    {
        $book = Book::find($request->book_id);
        $user_id = Auth::id();
        
        return view('book.index', ['book' => $book, 'user_id' => $user_id]);
    }
    
    // book.create
    public function create(BookRequest $request)
    {
        $book = new Book;
        $form = $request->all();
        $form += array('user_id' => Auth::id());
        
        unset($form['_token']);
        
        $book->fill($form);
        $book->save();
        
        return redirect('/');
    }
    
    //  book.edit
    public function edit(Request $request)
    {
        $book = Book::find($request->book_id);
        $book_name_form = $request->book_name;
        $book->book_name = $book_name_form;
        
        unset($book['_token']);
        
        $book->save();
        
        $user_id = Auth::id();
        
        return view('book.index', ['book' => $book, 'user_id' => $user_id]);
    }
    
    // book.delete
    public function delete(Request $request)
    {
        $book = Book::find($request->book_id);
        $book->delete();
        return redirect('/');
    }
}
