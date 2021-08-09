@extends('layouts/app')

@section('title')
<title>Корзина</title>
@endsection


@section('content')
	


	<div class="container container-border" style="border:none;">
		
		<div class="view_books" id="view_books_best" style="border: 1px solid #dedede; border-radius: 5px;">
			<h2 style="text-align: center;">В Вашем заказе:</h2>
	        @if(isset($booksShop) and is_a($booksShop, 'Illuminate\Database\Eloquent\Collection'))<!--Если несколько книг -->
	            @foreach($booksShop as $book)
	            
	            	<div style="display: inline-block; height: 400px; margin: 0; width: 230px;">
		                @php
		                  {{echo output_book_body($book);}}
		                @endphp
		                <!--Отрисовка кнопки корзины -->

			            <div>
			            	<span class="add_to_cart_universal book_inside_shop_page" 
			            		id="shop_{{$book->ID_book}}" 
			            		value = "{{$book->Price_book*(1- $book->Discount_book/100)}}" 
			            		style="background-color: #fff; color: #79b260;">В корзине</span>
			            </div>
              		</div>
	            @endforeach
	        @else<!--Если книга одна -->
	        	<div style="display: inline-block; height: 400px; margin: 0; width: 230px;">
		            @php
		              {{echo output_book_body($booksShop);}}
		            @endphp
		            <div>
			        	<span class="add_to_cart_universal" 
			        		id="shop_{{$book->ID_book}}" 
			        		value = "{{$book->Price_book*(1- $book->Discount_book/100)}}" 
			        		style="background-color: #fff; color: #79b260;">В корзине</span>
			        </div>
            	</div>            
	        @endif
	        <div class="container shopBottom">
	        	<div style="width: 50%; display: inline-block;">
	        		<h1 class="sumToPay">Сумма к покупке: {{$sumToPay}}&#8381</h1>
	        	</div>
	        	<div style="width: 50%; display: inline-block; float: right;">
	        		<h2 id="buyShopButton" onclick="">Приобрести</h2>
	        	</div>
	        </div>

    	</div><!--Отображение книг -->
	</div>
	

@endsection