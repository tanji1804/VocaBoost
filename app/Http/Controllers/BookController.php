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
    public function index()
    {
        return view('book.index');
    }
    
    // create book
    public function create(BookRequest $request)
    {
        $this->validate($request, Book::$rules);
        
        $book = new Book;
        $form = $request->all();
        $form += array('user_id' => Auth::id());
        
        // if($form['book_name'] === null){
        //     $form['book_name'] = 'untitled';
        // }
        
        
        unset($form['_token']);
        // dd($form);
        $book->fill($form);
        $book->save();
        
        return redirect('/');
    }
    
    //  edit book
    public function edit()
    {
        return view('book.edit');
    }
    
    // update book
    public function update()
    {
        
    }
    
    // delete book
    public function delete()
    {
        
    }
}
