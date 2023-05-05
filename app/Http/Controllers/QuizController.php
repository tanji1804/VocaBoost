<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class QuizController extends Controller
{
    public function question(Request $request)
        {
            $book = Book::find($request->id);
            $shuf_cards = $book->cards->shuffle();
            
            return view('quiz.quiz', [
                'book' => $book,
                'shuf_cards' => $shuf_cards,
            ]);
        }
        
        public function result(Request $request)
        {
            dd($request);
        }

}
