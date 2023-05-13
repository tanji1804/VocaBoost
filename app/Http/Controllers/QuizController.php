<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Card;
use App\Models\AllCard;

class QuizController extends Controller
{
    public function question(Request $request)
        {
            $type = $request->type;
            if($type == 2){
                $book = Book::find($request->id);
                $max_points = $book->cards->count();
            }
            
            return view('quiz.question', [
                'book' => $book,
                'max_points' => $max_points,
                'type' => $type,
            ]);
        }
        
        public function result(Request $request)
        {
            $max_points = $request->max_points; 
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
                'max_points' => $max_points,
                'points' => $points,
                ]);
        }

}
