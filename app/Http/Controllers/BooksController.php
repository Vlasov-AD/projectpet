<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book_main;
use App\Models\id_genres;
use App\Models\commentary;
use App\Models\AdvertSlide;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ErrorRequestController;
use Illuminate\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


use App\Mail\DemoEmail;
use Illuminate\Support\Facades\Mail;


class BooksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * Вывод книг на странице mainpage.blade.php
     */
    public function index(ErrorRequestController $request)//Вывод на главной странице
    {       
            //Проверка get запросов   
            $countBook = book_main::count();
            $countDiscount = book_main::where('Discount_book','!=',0)
                                        ->count();
           
            $rules = $request->rulesIndex($countBook, $countDiscount);
            
            $messages=$request->messages();

            $validate = Validator::make($request->all(), $rules, $messages);
          
            if ($validate->fails()){

            return redirect('/')->withErrors($validate->errors());
            }
            
            //Отображение по категориям для бестселлеров_______________________________
        
            if (!isset($request['GenreID'])){
                $books_best = book_main::orderBy('View_book', 'DESC')
                                         ->paginate(5,['*'],'PageBest');
            
            }else{
                $books_best = book_main::where('Genre_id', intval($_GET['GenreID']))
                                         ->orderBy('View_book', 'DESC')
                                         ->paginate(5,['*'],'PageBest');
            }
            //Добавление запросов в URL
            if(isset($request['GenreID'])){
                $books_best->appends('GenreID', $request->query('GenreID',1))->links();
            }

            if(isset($request['PageNew'])){
                $books_best->appends('PageNew', $request->query('PageNew',1))->links();
            }

             if(isset($request['PageSpecial'])){
                $books_best->appends('PageSpecial', $request->query('PageSpecial',1))->links();
            }
            

            //Отображение по категориям для новинок_______________________________________
            if (!isset($request['GenreID'])){
                $books_new = book_main::orderBy('Date_book', 'DESC')
                                        ->paginate(5,['*'],'PageNew');
            
            }else{
                $books_new = book_main::where('Genre_id', intval($_GET['GenreID']))
                                        ->orderBy('Date_book', 'DESC')
                                        ->paginate(5,['*'],'PageNew');
            }
            
            //Добавление запросов в URL
            if(isset($request['GenreID'])){
                $books_new->appends('GenreID', $request->query('GenreID',1))->links();
            }

            if(isset($request['PageBest'])){
                $books_new->appends('PageBest', $request->query('PageBest',1))->links();
            }

             if(isset($request['PageSpecial'])){
                $books_new->appends('PageSpecial', $request->query('PageSpecial',1))->links();
            }

            //Отображение по категориям для кинг со скидкой________________________________
            if (!isset($request['GenreID'])){
                $books_special = book_main::where('Discount_book','!=',0)
                                            ->orderBy('View_book', 'DESC')
                                            ->paginate(5,['*'],'PageSpecial');

            
            }else{
                $books_special = book_main::where('Genre_id', intval($_GET['GenreID']))
                                            ->where('Discount_book','!=',0)
                                            ->orderBy('View_book', 'DESC')
                                            ->paginate(5,['*'],'PageSpecial');

            }

            //Добавление запросов в URL
            if(isset($request['GenreID'])){
                $books_special->appends('GenreID', $request->query('GenreID',1))->links();
            }

            if(isset($request['PageBest'])){
                $books_special->appends('PageBest', $request->query('PageBest',1))->links();
            }

             if(isset($request['PageNew'])){
                $books_special->appends('PageNew', $request->query('PageNew',1))->links();
            }

            //Получение имен изображений для слайда
            $slide_images = AdvertSlide::all();

            //Получаем массив id книг в корзине
            if(!empty($_COOKIE['cartBooksArray']))
            {
              $idsInCart = json_decode($_COOKIE['cartBooksArray']);  
              
            }else
            {
                $idsInCart = null;
            }  

            return view('pages.mainpage')->with('books_best', $books_best)
                                         ->with('books_new', $books_new)
                                         ->with('books_special', $books_special)
                                         ->with('slide_images', $slide_images)
                                         ->with('idsInCart', $idsInCart);
                                         
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * Создание новой книги 
     */
    public function create(ErrorRequestController $request)//Создание новой книги
    {
        $rules = $request->rulesCreateEditBook();
        $messages = $request->messages();
        $validate = Validator::make($request->all(), $rules, $messages);

        if($validate->fails()){
            return redirect()->back()->withInput()->withErrors($validate);
        }
        if(!empty($request['image']))
        {
            //загрузка изображения на сервер + путь
            $fileNameWthExt = $request['image']->getClientOriginalName();
            //without extension
            $fileName = pathinfo($fileNameWthExt, PATHINFO_FILENAME);
            //extension
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            //Upload Image
            $path = $request->file('image')->storeAs('public/image_covers/', $fileNameToStore);  
        }else
        {
            $fileNameToStore = 'defaultCover.jpg'; 
        }
       

        //создание
        book_main::create([
        'Name_book' => $request['nameBook'],
        'Annotation_book' => $request['annotationBook'],
        'Image_cover' => $fileNameToStore,
        'Genre_id' =>$request['genreBook'],
        'Price_book' => $request['priceBook'],
        'Discount_book' => $request['discountBook'],
        'Author_book' => $request['authorBook'],
        'Edition_book' => $request['editionBook'],
        'PageNumbers_book' => $request['pageNumbersBook'],
        'Size_book' => $request['sizeBook'],
        'PublicationYear_book' => $request['publicationYeatBook'],
        'ISBN_book' => $request['ISBNBook'],
        'Mass_book' => $request['massBook'],
        ]);
        session()->put('successCreateBook','Книга создана успешно!!');
       return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Сохранение комментария пользователя в БД
     */
    public function store(Request $request)//Добавление комментария
    {   if(Auth::user()){
        $validate = Validator::make($request->all(),
            ['text_comment' => 'required|string'], 
            ['text_comment.required' => 'Вы не ввели комментарий!',
             'text_comment.string' => 'Вы ввели некорректные данные!']);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate);
        }

        $comment = new commentary;
            $comment->Book_ID = $request->input('BookID');
            $comment->User_id = Auth::user()->id;
            $comment->Comment = $request ->input('text_comment');
        
            $comment->save();
            session()->put('successAddComment','Комментарий добавлен!');
        }

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Отображении книги на productpage.blade.php
     */
    public function show(ErrorRequestController $request)//Вывод книги
    {   
        //Проверка существования книги
        $countBook = book_main::count();
        //получаем массив существующих ID для валидации
        foreach (book_main::all() as  $object) {
            $array_id [] = $object->ID_book;
        }


        $rulesShow = $request->rulesShow($array_id);
       
        $messages = $request->messages();
        
        $validate = Validator::make($request->all(), $rulesShow, $messages);
        
        if ($validate->fails()){
            return redirect('/')->withErrors($validate);
        }


        //Получение данных для вывода на странице
        $book = book_main::where('ID_book', $request['BookID'])->first();
        $suggestions = book_main::where('Genre_id', $book->Genre_id)
                                  ->where('ID_book','!=', $book->ID_book)
                                  ->orderBy('View_book', 'DESC')
                                  ->get();

        //если корзина не пуст
        if(!empty($_COOKIE['cartBooksArray']))
        {
          $idsInCart = json_decode($_COOKIE['cartBooksArray']);

          if(is_array($idsInCart))//если несколько книг
            {
                $bookInCart = in_array($book->ID_book, $idsInCart);

            }else
            {
                if($idsInCart == $book->ID_book)
                {
                    $bookInCart = true;
                }else
                {
                    $bookInCart = false;
                }
            }   
        }else
        {
            $bookInCart = false;
        }
        
        

        $book->View_book = $book->View_book + 1;
        $book->save(); 
        
        return view('pages\productpage')->with('book', $book)
                                        ->with('suggestions', $suggestions)
                                        ->with('bookInCart', $bookInCart);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * Редактирование книги
     */
    public function edit(ErrorRequestController $request, $id)//
    {
        if(Auth::user() and Auth::user()->id == 25)
        {   
            $book = book_main::where('ID_book', $id)->first();

            $rules = $request->rulesCreateEditBook();
            $messages = $request->messages();
            $validate = Validator::make($request->all(), $rules, $messages);
            if($validate->fails())
            {
                return redirect()->back()->withErrors($validate);
            }
            
            
            if(!empty($request['nameBook']) and $request['nameBook'] !== $book->Name_book)
            {
                $book->Name_book = $request['nameBook'];
                $book->save();
            }

            if(!empty($request['annotationBook']) and $request['annotationBook'] !== $book->Annotation_book)
            {
                $book->Annotation_book = $request['annotationBook'];
                $book->save();
            }

            if(!empty($request['genreBook']) and $request['genreBook'] !== $book->Genre_id)
            {
                $book->Genre_id = $request['genreBook'];
                $book->save();
            }

            if(!empty($request['priceBook']) and $request['priceBook'] !== $book->Price_book)
            {
                $book->Price_book = $request['priceBook'];
                $book->save();
            }

            if(!empty($request['discountBook']) and $request['discountBook'] !== $book->Discount_book)
            {
                $book->Discount_book = $request['discountBook'];
                $book->save();
            }

             if(!empty($request['authorBook']) and $request['authorBook'] !== $book->Author_book)
            {
                $book->Author_book = $request['authorBook'];
                $book->save();
            }

             if(!empty($request['editionBook']) and $request['editionBook'] !== $book->Edition_book)
            {
                $book->Edition_book = $request['editionBook'];
                $book->save();
            }

             if(!empty($request['pageNumbersBook']) and $request['pageNumbersBook'] !== $book->PageNumbers_book)
            {
                $book->PageNumbers_book = $request['pageNumbersBook'];
                $book->save();
            }

             if(!empty($request['sizeBook']) and $request['sizeBook'] !== $book->Size_book)
            {
                $book->Size_book = $request['sizeBook'];
                $book->save();
            }

             if(!empty($request['publicationYearBook']) and $request['publicationYearBook'] !== $book->PublicationYear_book)
            {
                $book->PublicationYear_book = $request['publicationYearBook'];
                $book->save();
            }

             if(!empty($request['ISBNBook']) and $request['ISBNBook'] !== $book->ISBN_book)
            {
                $book->ISBN_book = $request['ISBNBook'];
                $book->save();
            }

             if(!empty($request['massBook']) and $request['massBook'] !== $book->Mass_book)
            {
                $book->Mass_book = $request['massBook'];
                $book->save();
            }

            if(!empty($request['image']))
            {

                //загрузка изображения на сервер + путь
                $fileNameWthExt = $request['image']->getClientOriginalName();
                //without extension
                $fileName = pathinfo($fileNameWthExt, PATHINFO_FILENAME);
                //extension
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;
                //Upload Image
                $path = $request->file('image')->storeAs('public/image_covers/', $fileNameToStore);
                //удаляем старый файл
                Storage::delete('public/image_covers/'.$book->Image_cover);

                $book->Image_cover = $fileNameToStore;


                $book->save();
            }

            session()->put('successEditBook','Изменения внесены успешно!!');
            return redirect()->back();   
              
        }
        else
        {
            return redirect()->back()->withErrors(['errors' => 'Ошибка! У Вас нет прав для данного действия']);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
    Перенаправление на форму создания книги
    */
    public function createBook(ErrorRequestController $request)
    {
        if(Auth::user() and Auth::user()->id == 25)
        {
           return view('pages.createBookView'); 
        }
        else
        {
            return redirect()->back()->withErrors(['errors' => 'Ошибка! У Вас нет прав для данного действия']);
        }
        
        
    }

    /*
    Перенаправление на форму редактирования книги
    */
    public function editBook(ErrorRequestController $request)
    {
        if(Auth::user() and Auth::user()->id == 25)
        {
            //Проверка существования книги
            $countBook = book_main::count();
            //получаем массив существующих ID для валидации
            foreach (book_main::all() as  $object) {
                $array_id [] = $object->ID_book;
            }

            //Валидация книги
            $rulesShow = $request->rulesShow($array_id);
           
            $messages = $request->messages();
            
            $validate = Validator::make($request->all(), $rulesShow, $messages);
            
            if ($validate->fails()){
                return redirect('/')->withErrors($validate);
            }


            //Получение данных для вывода на странице
            $book = book_main::where('ID_book', $request['BookID'])->first();
           

            return view('pages.editBookView')->with('book', $book);
        }else
        {
            return redirect()->back()->withErrors(['errors' => 'Ошибка! У Вас нет прав для данного действия']);
        }
    }
    /*
        Метод для страницы корзины
    */
    public function shopCart()
    {
        if(!empty($_COOKIE['cartBooksArray']))

        {   $idsInCart = json_decode($_COOKIE['cartBooksArray']);

            

            //получаем массив существующих ID для валидации
            foreach (book_main::all() as  $object) {
                $array_id [] = $object->ID_book;
            }
            
           /* //проверка данных куки(число, книга в БД)
            foreach ($idsInCart as $elem)
            {
                if(!is_int($elem) or !in_array($elem, $array_id))
                {
                    setcookie("cartBooksArray", time()-3600);
                    return redirect()->back()->withErrors(['errors' => 'Ошибка данных корзины!']);
                }
            }*/

            if(is_array($idsInCart))//если массив в куки
            {
               $booksShop = book_main::whereIn('ID_book', $idsInCart)->get(); 
               $sumToPay = 0;
                foreach($booksShop as $book)
                {
                    $sumToPay+= $book->Price_book*(1-$book->Discount_book/100);
                }

            }else
            {
                $booksShop = book_main::where('ID_book', $idsInCart)->first();
                $sumToPay = $booksShop->Price_book*(1-$booksShop->Discount_book/100);
                
            }
            
            
            
        }
        else
        {
            return redirect()->back()->withErrors(['errors' => 'В корзине отсутствуют нкиги. ']);
        }

        $sumToPay = number_format($sumToPay, 2, ".", "");
        return view('pages.shopCart')
                ->with('booksShop', $booksShop)
                ->with('sumToPay', $sumToPay)
                ->with('idsInCart',$idsInCart);
    }

    /*
        Метод для страницы поиска
    */
    public function search(ErrorRequestController $request)
    {   
        $rules = $request->rulesSearch();
        $messages = $request->messages();
        $validate = Validator::make($request->all(), $rules, $messages);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }

        $books = book_main::search($request['search_bar'])->paginate(5);

        //Получаем массив id книг в корзине
            if(!empty($_COOKIE['cartBooksArray']))
            {
              $idsInCart = json_decode($_COOKIE['cartBooksArray']);  
              
            }else
            {
                $idsInCart = null;
            }  

        return view('pages.searchPage')
                ->with('books', $books)
                ->with('idsInCart', $idsInCart);
    }
}

