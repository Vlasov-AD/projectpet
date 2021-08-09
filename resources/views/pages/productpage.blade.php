@extends('layouts.app')

@section('title')
<title>{{$book->Name_book}}</title>
@endsection

@section('content')

 <div class="container">
	<div id="content_ref">
	      <a href="/">Главная</a>
	      <span> >> </span>
	      <a href="/?GenreID={{$book->genre->ID_genre}}"> {{$book->genre->Genre_name}}</a>
	      <span> >> </span>
	      <span id="current_book">{{$book->Name_book}}</span>
	      @if(Auth::user() and Auth::user()->id == 25)
	      	<span> >> </span>
	      <a href="/EditForm?BookID={{$book->ID_book}}"> Редактировать книгу</a>
	      @endif
	 </div><!--Строка с информацие о книге -->
    
	 @include('includesSite.bookAnnotation')<!-- Аннотация кники + кнопка покупки-->

	 <div id="info_suggestions_comments">
	 	<div id="info_comments">
	 		@include('includesSite.infoBook')<!-- Информация о книге-->
	 		@include('includesSite.commentSection')<!--Комментарии -->
	 	</div>
	 	@include('includesSite.suggestionsSide')
	 </div><!-- Информация о книге + предложения + комментария-->
 </div> <!--Блок продукта -->   


<script type="text/javascript" src = "{{URL::asset('js/getSetWindowPosition.js') }}"></script>

@endsection

