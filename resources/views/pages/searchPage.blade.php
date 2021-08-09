@extends('layouts/app')

@section('title')
<title>Помощь</title>
@endsection

@section('content')
	<div class="container container-border" style="border:none;">
		
		<div class="view_books" id="view_books_best" style="border: 1px solid #dedede; border-radius: 5px;">
			<h2 style="text-align: center;">Результаты поиска:</h2>
	        
	    	@foreach($books as $book)
	            
			    <div style="display: inline-block; height: 400px; margin: 0; width: 230px;">
					@php
					{{echo output_book_body($book);}}
					@endphp

					<!--Отрисовка кнопки  -->
					@if(empty($idsInCart))<!--Если в корзине пусто -->
	                  <div>
	                    <span class="add_to_cart_universal" id="search_{{$book->ID_book}}">Добавить в корзину</span>
	                  </div>
	                @elseif(is_array($idsInCart))<!--Если книг несколько -->
	                  @if(in_array($book->ID_book, $idsInCart))<!--Если книга в корзине - меняем стиль -->
	                    <div>
	                      <span class="add_to_cart_universal" id="search_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
	                    </div>
	                  @else
	                    <div>
	                      <span class="add_to_cart_universal" id="search_{{$book->ID_book}}">Добавить в корзину</span>
	                    </div>
	                  @endif
	                @else
	                  @if($book->ID_book == $idsInCart)<!--Если книга в корзине - меняем стиль -->
	                    <div>
	                      <span class="add_to_cart_universal" id="search_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
	                    </div>
	                  @else
	                    <div>
	                      <span class="add_to_cart_universal" id="search_{{$book->ID_book}}">Добавить в корзину</span>
	                    </div>
	                  @endif
	                @endif
              
		        </div>
	    	@endforeach
	        
		    <div class="pagination_div">
	            {{$books->links()}}
	        </div>
    	</div><!--Отображение книг -->

    	
	</div>
@endsection