
<div id = "pop_window_registration" class = "pop_window_class">
	<div >
		
		<h1>Регистрация</h1>
		<form action="{{route('register')}}" method="POST" class=registration_enter_recovery_form>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h3>Введите почту:</h3>	
			<input type="email" name="email" value="{{old('email')}}" id="email_register_form" placeholder="Введите почту">
				<!--Вывод ошибок если есть -->
				@if($errors->has('email'))
				
					@if($errors->get('email')[0] == 'errorRegisterEmailUnique' )
						<h4 class = "pop_errors">Почта уже зарегистрирована!</h4>
					@elseif($errors->get('email')[0] == 'errorRegisterEmailString')
						<h4 class = "pop_errors">Некорректный ввод почты!</h4>
					@elseif($errors->get('email')[0] == 'errorRegisterEmailMax')
						<h4 class = "pop_errors">Почта слишком длинная!</h4>
					@elseif($errors->get('email')[0] == 'errorRegisterEmailRequired')
						<h4 class = "pop_errors">Введите почту!</h4>
					@endif

					<script >
						document.getElementsByClassName('eye_icon')[0].style.top = '384px'
					</script>
				@endif
			<h3>Введите пароль:</h3>
			<input type="password" name="password" value="{{old('password')}}" id="password_register_form" minlength="8" maxlength="16" size="16" placeholder="Введите пароль">
			<input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" id="password_register_form_confirm" minlength="8" maxlength="16" size="16" placeholder="Повторите пароль">
				@if($errors->has('password'))

					@if($errors->get('password')[0] == 'errorRegisterPasswordRequired' )
						<h4 class = "pop_errors">Введите пароль!</h4>
					@elseif($errors->get('password')[0] == 'errorRegisterPasswordString')
						<h4 class = "pop_errors">Неккоректный ввод пароля!</h4>
					@elseif($errors->get('password')[0] == 'errorRegisterPasswordConfirmed')
						<h4 class = "pop_errors">Пароли не совпадают!</h4>
					@endif

				@endif
			<input type="submit" id="submit_register_form">
		</form>
		
		<h2 onclick="" id="form_registration_to_enter">Уже зарегистрированы?</h2>
		<p class="x-button" onclick="">X</p>
		<span onclick="" class = "eye_icon" > <span></span> </span>

	</div>
</div><!--Всплывающее окно регистрации -->