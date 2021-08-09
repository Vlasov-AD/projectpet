<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\userdatabases;
use App\Models\book_main;

class commentary extends Model
{
    use HasFactory;
    public $table = 'commentary';
    public $timestamps = false;

    public function book(){
    	return $this->belongsTo(book_main::class, 'Book_ID', 'ID_book' );
    }

    public function user(){
    	return $this->belongsTo(User::class, 'User_id', 'id');
    }
}
