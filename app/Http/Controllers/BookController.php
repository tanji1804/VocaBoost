<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    // index
    public function index()
    {
        return view('book.index');
    }
    
    // create book
    public function create(Request $request)
    {
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
