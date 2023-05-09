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
    
    public function getOtherCardsInThisBook($how_many)
    {
        return Card::whereNotIn('id', [$this->id])
                    ->where('book_id', $this->book_id)
                    ->inRandomOrder()
                    ->limit($how_many)
                    ->get();
    }
    
    public function getChoiseCards($how_many)
    {
        $choises = collect([$this]);
        foreach($this->getOtherCardsInThisBook($how_many) as $not_anser_card){
            $choises->push($not_anser_card);
        }
        
        return $choises->shuffle();
    }
}
