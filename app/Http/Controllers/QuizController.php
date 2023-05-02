<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class QuizController extends Controller
{
    public function quiz(Request $request)
    {
        $book = Book::find($request->id);
        $cards = $book->cards;
        $card_keys = [];
        $cards_num = count($cards) - 1;
        
        
        foreach($cards as $key=>$card){
            array_push($card_keys, $key);
        }
        shuffle($card_keys);
        
        return view('quiz.quiz', [
            'book' => $book,
            'cards' => $cards,
            'card_keys' => $card_keys,
            'cards_num' => $cards_num,
            ]);
    }
}
