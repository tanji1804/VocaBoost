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
            $choises = $shuf_cards;
            
            return view('quiz.question', [
                'book' => $book,
                'shuf_cards' => $shuf_cards,
                'choises' => $choises,
            ]);
        }
        
        public function result(Request $request)
        {
            $total_points = count(explode("},", $request->shuf_cards)); 
            $book = Book::find($request->book_id);
            $form = $request->all();
            
            unset($form['book_id'], $form['_token']);
            
            $chosen_cards = $form;
            $points = 0;
            $result = [];
            
            foreach($chosen_cards as $ques_id => $cho_id){
                if($ques_id == $cho_id){
                    $points++;
                }
            }
            
            return view('quiz.result', [
                'book' => $book,
                'total_points' => $total_points,
                'points' => $points,
                ]);
        }

}
