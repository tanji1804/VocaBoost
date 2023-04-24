<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    
    protected $table = 'cards';
    protected $primaryKey = 'id';
    protected $guarded = array('id');
    
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
