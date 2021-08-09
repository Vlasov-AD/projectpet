
<div id = "pop_window_recovery" class = "pop_window_class">
	<div>
		<h1>Восстановление пароля</h1>

		<form action="/forgot-password" method="POST" class=registration_enter_recovery_form>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h3>Введите почту:</h3>	
			<input type="email" name="email" id="email_recovery_form" placeholder="Введите почту" value="{{old('email')}}">
			<input type="submit" id="submit_recovery_form">

			@if($errors->has('email'))
				@if($errors->get('email')[0] == 'errorRecoveryEmailRequired' )
					<h4 class = "pop_errors">Введите почту!</h4>
				@elseif($errors->get('email')[0] == 'errorRecoveryEmailEmail')
					<h4 class = "pop_errors">Некорректный ввод почты!</h4>
				@elseif($errors->get('email')[0] == 'errorRecoveryEmailExists')
					<h4 class = "pop_errors">Учетной записи не существует!</h4>
				@endif
			@endif
			
		</form>

		
		<h2 id="from_recovery_to_enter" onclick="">Вспомнили пароль?</h2>
		<h2 onclick="" id="from_recovery_to_registration">Зарегистрироваться</h2>
		<p class="x-button" onclick="">X</p>

	</div>
</div><!--Всплывающее окно регистрации -->