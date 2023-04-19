<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;

class CardController extends Controller
{
    // card.create
    public function create(cardRequest $request)
    {
        $card = new Card;
        $form = $request->all();
        dd($form);
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
