@extends('layouts/app')

@section('title')
<title>
	@if(Auth::user())
		{{Auth::user()->name}}
	@else
		Ошибка!
	@endif
</title>
@endsection

@section('content')


	<div class="container container-border">
	
		@if(Auth::user())
			<div class = "action_form">
				<form action="/account/edit/{{Auth::user()->id}}" method = "POST" enctype = "multipart/form-data">
					<input type="hidden" name="_token"  value="{{ csrf_token() }}">
					<h1 style="text-align: center; font-size: 24px; ">Моя учетная запись.</h1>
					<span class = "account_span">Ваша почта:</span>
					<span class="text_form_email">{{Auth::user()->email}}</span>
					
					<span class = "account_span">Ваш ник:</span>
					<input type="text" class="text_form text_account" name="name" 
						@if(Auth::user()->name == null)
							value = "{{'User_'.Auth::user()->id}}"
						@else
							value = "{{Auth::user()->name}}" 
						@endif
					>
					<span class = "account_span">Старый пароль:</span>
					<input type="password" class="text_form text_account" name="old_password" value="{{old('old_password')}}" id="old_password_account_form">
					<span class = "account_span">Новый пароль:</span>
					<input type="password" class="text_form text_account" name="password" value="{{old('password')}}" id="new_password_account_form">
					<span class = "account_span">Повторите новый пароль:</span>
					<input type="password" class="text_form text_account" name="password_confirmation" value="{{old('password_confirmation')}}" id="new_password_confirmation_account_form">
					<div class="file_div">
						<label>Выберите изображение:</label>
						<input type="file" name="image" class="button_file">
					</div>
					<input id = "button_account" type="submit" class="button_form" value="Сохранить изменения!">
				</form>
			</div>
			<span onclick="" class = "eye_icon_account" id = "eye_icon_account"> <span></span> </span>
		@else
			<script >
				window.location.href = '{{url("/")}}';
			</script>
		@endif
	</div>
	<script type="text/javascript" src="{{URL::asset('js/eyeIconAccount.js')}}"></script>
@endsection
