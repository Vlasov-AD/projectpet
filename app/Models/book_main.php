<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\commentary;
use App\Models\id_genres;
use App\Models\userdatabases;
use Laravel\Scout\Searchable;

class book_main extends Model
{
    use HasFactory, Searchable;
    public $table = "book_main";
    protected $primaryKey = 'ID_book';
    public $timestamps = false;

    protected $fillable = [
        'Name_book',
        'Annotation_book',
        'Image_cover',
        'Genre_id',
        'Price_book',
        'Discount_book',
        'Author_book',
        'Edition_book',
        'PageNumbers_book',
        'Size_book',
        'PublicationYear_book',
        'ISBN_book',
        'Mass_book',
    ];

    public function comments(){
    	return $this->hasMany(commentary::class, 'Book_ID', 'ID_book');
    }

    public function genre(){
    	return $this->belongsTo(id_genres::class, 'Genre_id', 'ID_genre');
    }
}
