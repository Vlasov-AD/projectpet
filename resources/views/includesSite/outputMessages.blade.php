<!--Вывод успешного сообщения -->

<!-- повторная отправка письма для подтверждения почты-->
@if(session()->has('messageResentMail'))
    <div class=" alert alert-success">
        @php
            echo session()->get('messageResentMail');
            session()->forget('messageResentMail');
        @endphp
    </div>
@endif

<!-- успешно изменены данные пользователя-->
@if(session()->has('messageAccountEditSuccess'))
    <div class=" alert alert-success">
        @php
            echo session()->get('messageAccountEditSuccess');
            session()->forget('messageAccountEditSuccess');
        @endphp
    </div>
@endif

<!--отправлено письмо для восстановления пароля-->
@if(session()->has('recoveryEmailSent'))
    <div class=" alert alert-success">
        @php
            echo session()->get('recoveryEmailSent');
            session()->forget('recoveryEmailSent');
        @endphp
    </div>
@endif

<!--удачная регистрация или вход-->
@if(session()->has('successRegister') or session()->has('successEnter'))
    <div class="alert alert-success">
        @php
        if(Auth::user()->name == null){
               echo 'Добро пожаловать! User_'.Auth::user()->id;
        }
        else{
            echo 'Добро пожаловать! '.Auth::user()->name;
        }
          session()->forget('successRegister');
          session()->forget('successEnter');
        @endphp
    </div>
@endif

<!--успешно добавлена книга-->
@if(session()->has('successCreateBook'))
    <div class="alert alert-success">
        @php
        
        echo session()->get('successCreateBook');
        session()->forget('successCreateBook');
          
        @endphp
    </div>
@endif

<!--успешно отредактирована книга-->
@if(session()->has('successEditBook'))
    <div class="alert alert-success">
        @php
        
        echo session()->get('successEditBook');
        session()->forget('successEditBook');
          
        @endphp
    </div>
@endif

<!--Вывод ошибок -->
@if (count($errors)>0 or
    count($errors->passwordEdit)>0)
    <!--Если ошибка не связанная с комментарием
        (ошибка комментария выведется в блоке комментариев) -->
    @if(!$errors->has('text_comment'))   

        	<!--Если ошибка при регистрации/восстановлении пароля -->
        @if($errors->has('email') or $errors->has('password')) 
          
        	@if($errors->first()=='errorRegisterEmailUnique' ||
        		$errors->first()=='errorRegisterEmailString' ||
        		$errors->first()=='errorRegisterEmailMax' ||
        		$errors->first()=='errorRegisterEmailRequired' ||
        		$errors->first()=='errorRegisterPasswordRequired' ||
        		$errors->first()=='errorRegisterPasswordString' ||
        		$errors->first()=='errorRegisterPasswordConfirmed' )
    	    	<script>
    	 			 document.getElementById('pop_window_registration').style.display = 'block'
    			</script>
            @elseif($errors->first() == 'errorRecoveryEmailRequired' ||
                    $errors->first() == 'errorRecoveryEmailEmail' ||
                    $errors->first() == 'errorRecoveryEmailExists')
                <script>
                    document.getElementById('pop_window_recovery').style.display = 'block'
                </script> 
        	@endif

            <!--Ошибка при входе -->
        @elseif($errors->has('FailToEnter')) 
            <script>
                document.getElementById('pop_window_enter').style.display = 'block'
            </script>
            
           <!--Остальные ошибки по реквестам --> 
        @else

        	<div class="alert alert-danger">
    		    <!--дефолтные ошибки(без изменения ключа ошибок валидатора при передаче на view) -->
                <ul>
    		        @foreach ($errors->all() as $error)
    		            <li>{{ $error }}</li>
    		        @endforeach
    		    </ul>
                <!--с измененным ключом -->
                <ul>
                    @foreach ($errors->passwordEdit->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
    		</div>
        @endif
	@endif	    
@endif