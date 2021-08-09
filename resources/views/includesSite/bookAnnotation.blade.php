<div id="book_annotation">

      <div>
        <img id="image_product" src="{{ asset('storage/image_covers/'.$book->Image_cover) }}">
      </div><!--Обложка -->

      <div id="annotation_buy">
        <h2>{{$book->Name_book}}</h2>
        <h3>{{$book->Annotation_book}}</h3>

        <div id="add_to_cart">

          <div id="price_button">

            <div> 
              <h1>Наша цена: 
                <span>
                  {{$book->Price_book*(1-$book->Discount_book*0.01)}}
                </span> 
              </h1> 
              @if($book->Discount_book!=0)
              <p>Цена была: {{$book->Price_book}} 
                Экономьте {{$book->Discount_book}}%</p>
              @endif
            </div>
            @if($bookInCart)
              <span class="add_to_cart_universal" id = "book_{{$book->ID_book}}" style="margin-top: 28px; background-color: #fff; color: #79b260;" >Добавить в корзину</span>
            @else
              <span class="add_to_cart_universal" id = "book_{{$book->ID_book}}" style="margin-top: 28px;">Добавить в корзину</span>
            @endif
            

          </div><!--Цена+кнопка -->

          <div id="block_payment">
            <p>&#128274; Безопасные платежи</p>
            <li><img src="{{ asset('storage/includes_images/visa.png') }}"></li>
            <li><img src="{{ asset('storage/includes_images/mastercard.png') }}"></li>
            <li><img src="{{ asset('storage/includes_images/mir.png') }}"></li>
            <li><img src="{{ asset('storage/includes_images/qiwi.png') }}"></li>
            <li><img src="{{ asset('storage/includes_images/webmoney.png') }}"></li>
          </div><!--Системы платежей -->

        </div><!-- Блок добавления в корзину-->

      </div><!--Аннотация + покупка -->

</div><!--Описание книги--> 