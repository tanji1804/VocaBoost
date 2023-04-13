<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'book_id';
    protected $guarded = array('id');
    
    public static $rules = array(
        'book_name' => 'string',
    );
}
