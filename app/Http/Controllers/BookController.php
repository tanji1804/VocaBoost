<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    // add book
    public function add()
    {
        return view('book.create');
    }
    
    // create book
    public function create(Request $request)
    {
        
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
    public function delete()
    {
        
    }
}
