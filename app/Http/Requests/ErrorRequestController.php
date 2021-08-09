<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ErrorRequestController extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return ['Getting error without this return and this method'=>'nullable'];
    }
   


    
    //Правила для вывода книги по ID
    public function rulesShow(array $array_id)
    {
       
        return ['BookID' => ['numeric', Rule::in($array_id)]
        ];
        
    }


    //Правила для вывода книг на главной
    public function rulesIndex($countBook , $countDiscount )
    {
        $BestAndNewPageNumber = ceil($countBook/5);
        $SpecialPageNumber = ceil($countDiscount/5);
        return ['GenreID'=>'numeric|min:1|max:9',
                'PageBest'=>'numeric|min:1|max:'.$BestAndNewPageNumber,
                'PageNew'=>'numeric|min:1|max:'.$BestAndNewPageNumber,
                'PageSpecial'=>'numeric|min:1|max:'.$SpecialPageNumber
        ];

    }
    //Правило для редактирования имени пользователя
    public function rulesAccountName(){

        return ['name' => 'string|max:255|unique:users'];
    }

    //Правило для редактирования пароля пользователся
    public function rulesAccountPassword(){

        return ['password' => 'string|confirmed|max:16|min:8',
                'old_password' => 'required'];
    }
    //Правило для сохранения аватара пользователся
    public function rulesAccountImage(){

        return ['image' => 'image|max:1999|nullable'];
    }

    //Правила для создания/редактирования книги
    public function rulesCreateEditBook(){
        return ['nameBook' => 'required|string|max:255',
                'annotationBook' => 'required|string|max:65536',
                'image' => 'image|max:1999|nullable',
                'genreBook' => 'required|integer|min:1|max:9',
                'priceBook' => 'required|integer|min:1|max:99999999999',
                'discountBook' => 'nullable|integer|min:0|max:99',
                'authorBook' => 'required|string|max:255',
                'editionBook' => 'required|string|max:255',
                'pageNumbersBook' => 'required|integer|min:1|max:99999999999',
                'sizeBook' => 'required|string|max:255',
                'publicationYearBook' => 'required|integer|min:1|max:'.date('Y'),
                'ISBNBook' => 'required|string|max:255',
                'massBook' => 'required|integer|min:1|max:99999999999'];
    }

    //Правило для отправки письмя для восстановления пароля
    public function rulesSendEmailToReset()
    {
        return [ 'email' => 'required|email|exists:users'];
    }

    public function resetPasswordRules()
    {
        return ['email' => 'required|email|exists:users',
                'token' => 'required',
                'password' => 'required|min:8|max:16|confirmed',
                ];
    }

    public function rulesSearch()
    {
        return ['search_bar' => 'nullable|string|max:255',
                ];
    }

     public function messages()
    {

        return [/*Сообщения для GET запроса с жанрами*/
                'GenreID.numeric' =>'Ошибка выбора категории книг! Повторите попытку!',
                'GenreID.min' =>'Ошибка выбора категории книг! Повторите попытку!',
                'GenreID.max' =>'Ошибка выбора категории книг! Повторите попытку!',
                /*Сообщения для GET запроса с ID книги*/
                'BookID.in' =>'Такой книги не существует! Повторите попытку!',
                'BookID.numeric' =>'Такой книги не существует! Повторите попытку!',
                /*Сообщения при пагинации*/
                'PageBest.numeric'=>'Такой вкладки не существует! Повторите попытку!',
                'PageBest.min'=>'Такой вкладки не существует! Повторите попытку!',
                'PageBest.max'=>'Такой вкладки не существует! Повторите попытку!',
                'PageNew.numeric'=>'Такой вкладки не существует! Повторите попытку!',
                'PageNew.min'=>'Такой вкладки не существует! Повторите попытку!',
                'PageNew.max'=>'Такой вкладки не существует! Повторите попытку!',
                'PageSpecial.numeric'=>'Такой вкладки не существует! Повторите попытку!',
                'PageSpecial.min'=>'Такой вкладки не существует! Повторите попытку!',
                'PageSpecial.max'=>'Такой вкладки не существует! Повторите попытку!',
                /*Сообщения при редактировании учетной записи пользователя*/
                'name.max' => 'Слишком длинное имя!',
                'name.unique' => 'Пользователь с данным именем уже существует!',
                'password.string' => 'Некорректный пароль!',
                'password.confirmed' => 'Введенные пароли не совпадают!',
                'password.max' => 'Пароль слишком длинный!',
                'password.min' => 'Пароль слишком корроткий!',
                'image.max' => 'Размер файла слишком большой!',
                'image.image' => 'Файл не является изображением!',
                /*Сообщения при создании/редактировании книги*/
                'nameBook.required' => 'Вы не указали название книги!',
                'nameBook.string' => 'Некорректное название!',
                'nameBook.max' => 'Название книги слишком длинное!',
                'annotationBook.required' => 'Не указана аннотация к книге!',
                'annotationBook.string' => 'Некорректные данные!',
                'annotationBook.max' => 'Слишком большое описание книги!',
                'genreBook.required' => 'Некорректные данные жанра книги!',
                'genreBook.integer' => 'Некорректные данные жанра книги!',
                'genreBook.min' => 'Некорректные данные жанра книги!',
                'genreBook.max' => 'Некорректные данные жанра книги!',
                'priceBook.required' => 'Вы не указали цену книги!',
                'priceBook.integer' => 'Некорректные данные цены книги!',
                'priceBook.min' => 'Цена не может быть меньше 1!',
                'priceBook.max' => 'Слишком высокая цена!',
                'discountBook.integer' => 'Некорректные данные для скидки!',
                'discountBook.min' => 'Скидка не может быть меньше 1!',
                'discountBook.max' => 'Скидка не может быть больше 99%!',
                'authorBook.required' => 'Вы не указали автора книги!',
                'authorBook.string' => 'Некорректные данные автора книги!',
                'authorBook.max' => 'Слишком длинный автор!',
                'editionBook.required' => 'Вы не указали издательство!',
                'editionBook.string' => 'Некорректные данные издательства!',
                'editionBook.max' => 'Слишком длинное издательство!',
                'pageNumbersBook.required' => 'Вы не указали количество страниц!',
                'pageNumbersBook.integer' => 'Некорректные данные для количества страниц!',
                'pageNumbersBook.min' => 'Количество страниц не может быть меньше 1!',
                'pageNumbersBook.max' => 'Количество страниц слишком велико!',
                'sizeBook.required' => 'Вы не указали размеры книги!',
                'sizeBook.string' => 'Некорректные данные для размера книги!',
                'sizeBook.max' => 'Значение размера книги слишком длинно!',
                'publicationYearBook.required' => 'Вы не указали год издания!',
                'publicationYearBook.integer' => 'Некорректные данные для года издания!',
                'publicationYearBook.min' => 'Год издания не может быть меньше 1!',
                'publicationYearBook.max' => 'Год издания не может быть больше текущего!',
                'ISBNBook.required' => 'Вы не указали ISBN книги!',
                'ISBNBook.string' => 'Некорректные данные для ISBN!',
                'ISBNBook.max' => 'Значение ISBN слишком длинно!',
                'massBook.required' => 'Вы не указали массу книги!',
                'massBook.integer' => 'Некорректные данные для массы! Данные должны быть числом',
                'massBook.min' => 'Масса не может быть меньше 1!',
                'massBook.max' => 'Масса слишком велика!',
                'email.required' => 'errorRecoveryEmailRequired',
                'email.email' => 'errorRecoveryEmailEmail',
                'email.exists' => 'errorRecoveryEmailExists',
                //при восстановлении пароля
                'token.required' => 'Ошибка в токене!',
                'old_password.required' => 'Вы не ввели старый пароль!',
                'search_bar.string' => 'Некорректные данные! Повторитек запрос!',
                'search_bar.max' => 'Поисковый запрос слишком длинный!',

        ];
    }
}
