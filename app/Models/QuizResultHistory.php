<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResultHistory extends Model
{
    use HasFactory;
    
    protected $table = 'quiz_result_historyes';
    protected $guarded = array('id');
    
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
