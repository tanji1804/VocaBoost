<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Card;
use App\Http\Requests\BookRequest;


class BookController extends Controller
{
    // book.index
    public function index(Request $request)
    {
        $book = Book::find($request->id);
        
        $cards = $book->cards;
        $user_id = Auth::id();
        
        return view('book.index', ['book' => $book, 'user_id' => $user_id, 'cards' => $cards]);
    }
    
    // book.create
    public function create(BookRequest $request)
    {
        $book = new Book;
        $form = $request->all();
        $form['user_id'] = Auth::id();
        
        unset($form['_token']);
        
        $book->fill($form);
        $book->save();
        
        return redirect('/');
    }
    
    //  book.edit
    public function edit(Request $request)
    {
        $book = Book::find($request->id);
        $name_form = $request->name;
        
        if($name_form === null){
            $book->name = "untitled";
        }else{
            $book->name = $name_form;
        }
        
        unset($book['_token']);
        
        $book->update();
        
        return redirect(route('book.index', ['id' => $book->id]));
    }
    
    // book.delete
    public function delete(Request $request)
    {
        $book = Book::find($request->id);
        
        Card::where('book_id', $request->id)->delete();
        $book->delete();
        
        return redirect('/');
    }
}
