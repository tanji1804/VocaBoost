<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Card extends Model
{
    use HasFactory;
    
    protected $table = 'cards';
    protected $guarded = array('id');
    
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function getOtherCards($how_many, $type)
    {
        // type
        //  0: all books
        //  1: my books
        //  2: this book
        if($type == 0){
            return Card::whereNotIn('id', [$this->id])
                    ->inRandomOrder()
                    ->limit($how_many -1)
                    ->get();
        }elseif($type == 1){
            $book = Book::find($this->book_id);
            return Card::whereNotIn('id', [$this->id])
                    ->where('user_id', $book->user_id)
                    ->inRandomOrder()
                    ->limit($how_many -1)
                    ->get();
        }elseif($type == 2){
            return Card::whereNotIn('id', [$this->id])
                    ->where('book_id', $this->book_id)
                    ->inRandomOrder()
                    ->limit($how_many -1)
                    ->get();
        }
    }
    
    public function getChoiseCards($how_many, $type)
    {
        $choises = collect([$this]);
        foreach($this->getOtherCards($how_many, $type) as $not_anser_card){
            $choises->push($not_anser_card);
        }
        
        return $choises->shuffle();
    }
}
