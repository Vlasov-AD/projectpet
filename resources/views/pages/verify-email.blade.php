@extends('layouts/app')

@section('title')
<title>Подтверждение почты</title>
@endsection

@section('content')
	
		<div class="container container-border">
			<a href="/"><p style="text-align: center; font-size: 24px; font-weight: bold; color: black;">На указанную вами почту было направлено письмо для подтверждения! Пожалуйста, откройте письмо и следуйте инструкции! Для возвращения на главную страницу нажимте на эту надпись.</p></a>

			<a href="/email/verificationResent"><p style="text-align: center; font-size: 20px; font-weight: bold; color: black;">Для повторной отправки письма нажмите на эту ссылку!</p></a>
		</div><!--Контактная информация -->
	
@endsection
