<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class QuizController extends Controller
{
    public function quiz(Request $request)
        {
            $book = Book::find($request->id);
            $shuf_cards = $book->cards->shuffle();
            $cards_num = $shuf_cards->count() - 1;
        
            return view('quiz.quiz', [
                'book' => $book,
                'shuf_cards' => $shuf_cards,
                'cards_num' => $cards_num,
            ]);
        }

}
