<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ErrorRequestController;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\CanResetPassword;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.account');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     * Изменение данных пользователя
     */
    public function edit(ErrorRequestController $request, $id)
    {  
        if(Auth::user() and Auth::user()->id == $id)
        {
            //если меняется имя
            if(!empty($request['name']) and $request['name'] !=Auth::user()->name){
                $rules = $request->rulesAccountName();
                $messages = $request->messages();
                $validate = Validator::make($request->all(), $rules, $messages);
                if($validate->fails()){
                return redirect()->back()->withErrors($validate->errors());
                }else{
                    $user = User::find(Auth::user()->id);
            
                    $user->name = $request['name'];
                    $user->save();
                }

            }
            //если меняется пароль
            if(!empty($request['password']) 
                and !empty($request['old_password']))
            {


                $rules = $request->rulesAccountPassword();
                $messages = $request->messages();
                $validate = Validator::make($request->all(), $rules, $messages);

                if($validate->fails()){

                return redirect()->back()->withErrors($validate->errors(), 'passwordEdit');
                }else{//если текущий и новый не совпадают
                    if(!Hash::check($request['password'], Auth::user()->password))
                    {   //Если старый пароль совпадает с текущим
                        if(Hash::check($request['old_password'], Auth::user()->password))
                        {
                            $user = User::find(Auth::user()->id);
                            $user->password = Hash::make($request['password']);
                            $user->save();
                        }else
                        {
                            return redirect()->back()->withInput()->withErrors(['errors' => 'Указан не верный старый пароль!']);
                        }    
                    }else
                    {
                        return redirect()->back()->withInput()->withErrors(['errors' => 'Новый пароль не должен совпадать со старым!']);
                    }
                    
                }
            }

            //Добавляем аватарку
            if( $request->hasFile('image')
                and $request['image']->getClientOriginalName() != Auth::user()->imagePath){

                $rules = $request->rulesAccountImage();
                $messages = $request->messages();
                $validate = Validator::make($request->all(), $rules, $messages);

                if($validate->fails()){

                return redirect()->back()->withErrors($validate->errors());
                }else{
                    $user = User::find(Auth::user()->id);
                    //full filename
                    $fileNameWthExt = $request['image']->getClientOriginalName();
                    //without extension
                    $fileName = pathinfo($fileNameWthExt, PATHINFO_FILENAME);
                    //extension
                    $extension = $request->file('image')->getClientOriginalExtension();

                    $fileNameToStore = $fileName.'_'.time().'.'.$extension;

                    //Upload Image
                    $path = $request->file('image')->storeAs('public/includes_images/avatars/', $fileNameToStore);

                    $user->imagePath = $fileNameToStore;

                    $user->save();
                }
            }


            return redirect()->back()->with(['messageAccountEditSuccess' => 'Данные успешно изменены!']);
        }else{
            return redirect()->back()->withInput()->withErrors(['errors' => 'Ошибка при изменении данных. Повторите попытку!']);
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
    public function destroy()
    {  
        if(Auth::user())
        {
            Auth::logout();
            //Если выход пользователя из формы подтвеждения почты
            if(redirect()->back()->getTargetUrl() == 'http://mysite.test/email/verify')
            {
                return redirect('/');
            }
            else
            {
                return redirect()->back();    
            }
           
        }
        else
        {
            return redirect()->back()->withErrors(['errors' => 'Вы не авторизованы!']);
        }
    }

    
}
