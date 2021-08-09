@extends('layouts/app')

@section('title')
<title>Ник</title>
@endsection

@section('content')


	<div class="container container-border">
	
		@if(isset($token) and !empty($token))
			<div class = "action_form">
				<form action="/reset-password" method = "POST" >
					<input type="hidden" name="_token"  value="{{ csrf_token() }}">
					<input type="hidden" name="token"  value="{{$token}}">
					<input type="hidden" name="email"  value="{{$email}}">
					<h1 style="text-align: center; font-size: 24px; ">Восстановление пароля для: {{$email}}.</h1>
					
					<span class = "account_span">Новый пароль:</span>
					<input type="password" class="text_form text_account" name="password" value="{{old('password')}}" id="new_password_reset_form">
					<span class = "account_span">Повторите новый пароль:</span>
					<input type="password" class="text_form text_account" name="password_confirmation" value="{{old('password_confirmation')}}" id="new_password_confirmation_reset_form">
					
					<input id = "button_account" type="submit" class="button_form" value="Сохранить изменения!">
				</form>
			</div>
			<span onclick="" class = "eye_icon_account eye_icon_reset" id = "eye_icon_reset"> <span></span> </span>
		@else
			<script >
				window.location.href = '{{url("/")}}';
			</script>
		@endif
	</div>
	<script type="text/javascript" src="{{URL::asset('js/eyeIconReset.js')}}"></script>
@endsection
