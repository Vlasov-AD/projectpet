
<div id = "pop_window_enter" class = "pop_window_class">
	<div>
		<h1>Вход</h1>

		<form action="{{route('login')}}" method="POST" class=registration_enter_recovery_form>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<h3>Введите почту:</h3>	
			<input type="email" name="email_enter" id="email_enter_form" value="{{old('email_enter')}}" placeholder="Введите почту">
			<h3>Введите пароль:</h3>
			<input type="password" name="password_enter" value="{{old('password_enter')}}" id="password_enter_form" minlength="8" maxlength="16" size="16" placeholder="Введите пароль">

			@if($errors->has('FailToEnter'))
				<h4 class = "pop_errors">Неверная пара логин/пароль!</h4>
			@endif
			
			<input type="submit" id="submit_enter_form">

		</form>
		
		<h2 onclick="" id="form_enter_to_recovery">Забыли пароль?</h2>
		<h2 onclick="" id="form_enter_to_registration">Зарегистрироваться</h2>

		<p class ="x-button" onclick="">X</p>
		<span onclick="" class = "eye_icon"> <span></span> </span>
	</div>

</div><!--Всплывающее окно входа -->