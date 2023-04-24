<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Card;
use App\Models\Book;
use App\Http\Requests\CardRequest;

class CardController extends Controller
{
    // card.create
    public function create(CardRequest $request)
    {
        $card = new Card;
        $book = Book::find($request->book_id);
        $form = $request->all();
        
        unset($form['_token']);
        
        $card->fill($form);
        $card->save();
        
        return redirect(route('book.index', ['id' => $book->id]));
    }
    
    //  card.edit
    public function edit()
    {
        
    }
    
    // card.delete
    public function delete(Request $request)
    {
        $card = Card::find($request->card_id);
        $card->delete();
        return redirect('book');
    }
}
