<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\book_main;

class id_genres extends Model
{
    use HasFactory;

    public function books(){
    	return $this->hasMany(book_main::class, 'ID_book', 'ID_genre');
    }
}
