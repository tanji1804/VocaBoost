<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    // create card
    public function create(cardRequest $request)
    {
        
    }
    
    //  edit card
    public function edit()
    {
        
    }
    
    // update card
    public function update()
    {
        
    }
    
    // delete card
    public function delete(Request $request)
    {
        $card = Card::find($request->card_id);
        $card->delete();
        return redirect('/');
    }
}
