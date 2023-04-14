<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\BookRequest;


class BookController extends Controller
{
    // index
    public function index(Request $request)
    {
        $book = Book::find($request->book_id);
        $user_id = Auth::id();
        
        return view('book.index', ['book' => $book, 'user_id' => $user_id]);
    }
    
    // create book
    public function create(BookRequest $request)
    {
        $this->validate($request, Book::$rules);
        
        $books = new Book;
        $form = $request->all();
        $form += array('user_id' => Auth::id());
        
        unset($form['_token']);
        
        $books->fill($form);
        $books->save();
        
        return redirect('/');
    }
    
    //  edit book
    public function edit()
    {
        
    }
    
    // update book
    public function update()
    {
        
    }
    
    // delete book
    public function delete(Request $request)
    {
        $book = Book::find($request->book_id);
        $book->delete();
        return redirect('/');
    }
}
