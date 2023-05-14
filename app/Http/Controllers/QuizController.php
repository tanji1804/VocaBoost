<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Card;
use App\Models\QuizResultHistory;

class QuizController extends Controller
{
    public function question(Request $request)
        {
            // type
            //  0: all books
            //  1: my books
            //  2: this book
            $type = $request->type;
            
            switch($type){
                case 0:
                    $book = null;
                    $question_book = Card::all();
                    break;
                case 1:
                    $book = null;
                    $question_book = Card::where('user_id', Auth::id())->get();
                    break;
                case 2:
                    $book = Book::find($request->id);
                    $question_book = collect($book->cards);
                    break;
            }
            
            $max_points = count($question_book);
            
            return view('quiz.question', [
                'book' => $book,
                'question_book' => $question_book,
                'max_points' => $max_points,
                'type' => $type,
            ]);
        }
        
        public function result(Request $request)
        {
            $type = $request->type;
            $max_points = $request->max_points; 
            $book = Book::find($request->book_id);
            
            
            $form = $request->all();
            unset($form['book_id'],$form['max_points'] , $form['_token']);
            
            $chosen_cards = $form;
            $points = 0;
            
            foreach($chosen_cards as $ques_id => $cho_id){
                if($ques_id == $cho_id){
                    $points++;
                }
            }
            
            $history = new QuizResultHistory;
            $history->user_id = Auth::id();
            $history->book_id = $request->book_id;
            $history->max_points = $request->max_points;
            $history->result = $points;
            $history->save();
            
            $histories = QuizResultHistory::where('book_id', $request->book_id)->get()->reverse();
            
            return view('quiz.result', [
                'book' => $book,
                'max_points' => $max_points,
                'type' => $type,
                'points' => $points,
                'histories' => $histories,
                ]);
        }

}
