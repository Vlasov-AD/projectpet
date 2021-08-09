<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ErrorRequestController;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected function redirectTo(){

            return url()->previous();

    }

    public function sendLinkToPassword(ErrorRequestController $request)
    {   
        $rules = $request->rulesSendEmailToReset();
        $messages = $request->messages();
        $validate = Validator::make($request->all(), $rules, $messages);
      
        if($validate->fails())
        {   
            return redirect()->back()->withInput()->withErrors($validate);
        }
        else
        {

            Password::sendResetLink(
                $request->only('email')
            );

            return redirect()->back()->with(['recoveryEmailSent' => 'Письмо для восстановления пароля отправлено Вам на почту!']);
        }
    }

    public function resetPassword(ErrorRequestController $request)
    {   
        $rules = $request->resetPasswordRules();
        $messages = $request->messages();
        $validate = Validator::make($request->all(), $rules, $messages);
        if($validate->fails())
        {   
            return redirect()->back()->withInput()->withErrors($validate->errors(), 'passwordEdit');
        }else
        {   
            $user = User::where('email',$request['email'])->first();
            //если новый и старый пароль совпадают
            if(Hash::check($request['password'], $user->password))
            {
                return redirect()->back()->withInput()->withErrors(['errors' => 'Новый и старый пароль совпадают!']);
            }else
            {
                Password::reset(
                    $request->only('email', 'password', 'password_confirmation', 'token'),
                    function($user, $password)
                    {
                        $user->forceFill([
                            'password' => Hash::make($password)
                            ])->setRememberToken(Str::random(60));
                        $user->save();
                    }
                );
            }
            return redirect('/')->with(['messageAccountEditSuccess' => 'Пароль успешно изменен!']);
        }
    }
}
