<div id="suggestions_book" class="view_books">
    <p>Вам также может понравиться:</p>
    @if(count($suggestions)>0)  
	    @foreach($suggestions as $suggestion)      
		    <div onclick="location.href='/showBook?BookID={{$suggestion->ID_book}}'" 
		    	id="book_suggestion" class="book_body">
		    	@if($suggestion->Discount_book!=0)
		        	<span>-{{$suggestion->Discount_book}}%</span>
		        @endif
		        <div class = "inside_book_body">           
		            <img src="{{ asset('storage/image_covers/'.$suggestion->Image_cover) }}">           
		            <h3>{{$suggestion->Name_book}}</h3>
		            <h2>{{$suggestion->Price_book*(1-$suggestion->Discount_book*0.01)}}</h2>
		        </div> <!--Блок без скидки -->
		    </div><!--Блок книги -->  
	    @endforeach
    @endif
</div><!--Предложения -->