<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Card;

class QuizController extends Controller
{
    public function question(Request $request)
        {
            $book = Book::find($request->id);
            $shuf_cards = $book->cards->shuffle();
            $choises = [];
            
            foreach($shuf_cards as $card){
                array_push($choises, $card);
            }
            
            return view('quiz.question', [
                'book' => $book,
                'shuf_cards' => $shuf_cards,
                'choises' => $choises,
            ]);
        }
        
        public function result(Request $request)
        {
            return view('quiz.result');
        }

}
