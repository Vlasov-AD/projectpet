<div id="body_content">
      <div id="tab_buttons">
        <form action="#"> 
          <input id="tab1" class="radio_tabs" type="radio" name="tab_button" value="Лучшее предложение" checked>
          <label for="tab1">Хиты продаж</label>
          <input id="tab2" class="radio_tabs" type="radio" name="tab_button" value="Новинки">
          <label for="tab2">Новинки</label>
          <input id="tab3" class="radio_tabs" type="radio" name="tab_button" value="Специальное предложение">
          <label for="tab3">Спецпредложения</label>
        </form>
      </div><!-- Категории сортировки-->

    <div class="view_books" id="view_books_best">
        @if(count($books_best)>0)
            @foreach($books_best as $book)
              <div style="display: inline-block; height: 400px; margin: 0; width: 230px;">
                @php
                  {{echo output_book_body($book);}}//функция: App/Helpers
                @endphp
                
                <!--Отрисовка кнопки корзины -->
                @if(empty($idsInCart))<!--Если в корзине пусто -->
                  <div>
                    <span class="add_to_cart_universal" id="best_{{$book->ID_book}}">Добавить в корзину</span>
                  </div>
                @elseif(is_array($idsInCart))<!--Если книг несколько -->
                  @if(in_array($book->ID_book, $idsInCart))<!--Если книга в корзине - меняем стиль -->
                    <div>
                      <span class="add_to_cart_universal" id="best_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
                    </div>
                  @else
                    <div>
                      <span class="add_to_cart_universal" id="best_{{$book->ID_book}}">Добавить в корзину</span>
                    </div>
                  @endif
                @else
                  @if($book->ID_book == $idsInCart)<!--Если книга в корзине - меняем стиль -->
                    <div>
                      <span class="add_to_cart_universal" id="best_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
                    </div>
                  @else
                    <div>
                      <span class="add_to_cart_universal" id="best_{{$book->ID_book}}">Добавить в корзину</span>
                    </div>
                  @endif
                @endif
              </div>

            @endforeach
            <div class="pagination_div">
              {{$books_best->links()}}
            </div>
            
        @endif

    </div><!--Отображение книг на вкладке бестселлеры -->

    <div class="view_books" id="view_books_new">
        @if(count($books_new)>0)
            @foreach($books_new as $book)
              <div style="display: inline-block; height: 400px; margin: 0; width: 230px;">
                @php
                  {{echo output_book_body($book);}}
                @endphp
                <!--Отрисовка кнопки корзины -->
                @if(empty($idsInCart))<!--Если в корзине пусто -->
                  <div>
                    <span class="add_to_cart_universal" id="new_{{$book->ID_book}}">Добавить в корзину</span>
                  </div>
                @elseif(is_array($idsInCart))<!--Если книг несколько -->
                  @if(in_array($book->ID_book, $idsInCart))<!--Если книга в корзине - меняем стиль -->
                    <div>
                      <span class="add_to_cart_universal" id="new_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
                    </div>
                  @else
                    <div>
                      <span class="add_to_cart_universal" id="new_{{$book->ID_book}}">Добавить в корзину</span>
                    </div>
                  @endif
                @else
                  @if($book->ID_book == $idsInCart)<!--Если книга в корзине - меняем стиль -->
                    <div>
                      <span class="add_to_cart_universal" id="new_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
                    </div>
                  @else
                    <div>
                      <span class="add_to_cart_universal" id="new_{{$book->ID_book}}">Добавить в корзину</span>
                    </div>
                  @endif
                @endif
              </div>
            @endforeach
            <div class="pagination_div">
              {{$books_new->links()}}
            </div>
        @endif

    </div><!--Отображение книг на вкладке новинки -->

    <div class="view_books" id="view_books_special">
        @if(count($books_special)>0)
            @foreach($books_special as $book)
              <div style="display: inline-block; height: 400px; margin: 0; width: 230px;">
                @php
                  {{echo output_book_body($book);}}
                @endphp
                <!--Отрисовка кнопки корзины -->
                @if(empty($idsInCart))<!--Если в корзине пусто -->
                  <div >
                    <span class="add_to_cart_universal" id="special_{{$book->ID_book}}">Добавить в корзину</span>
                  </div>
                @elseif(is_array($idsInCart))<!--Если книг несколько -->
                  @if(in_array($book->ID_book, $idsInCart))<!--Если книга в корзине - меняем стиль -->
                    <div>
                      <span class="add_to_cart_universal" id="special_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
                    </div>
                  @else
                    <div>
                      <span class="add_to_cart_universal" id="special_{{$book->ID_book}}">Добавить в корзину</span>
                    </div>
                  @endif
                @else
                  @if($book->ID_book == $idsInCart)<!--Если книга в корзине - меняем стиль -->
                    <div>
                      <span class="add_to_cart_universal" id="special_{{$book->ID_book}}" style="background-color: #fff; color: #79b260;">В корзине</span>
                    </div>
                  @else
                    <div>
                      <span class="add_to_cart_universal" id="special_{{$book->ID_book}}">Добавить в корзину</span>
                    </div>
                  @endif
                @endif
              </div>
            @endforeach
            <div class="pagination_div">
              {{$books_special->links()}}
            </div>
        @endif

    </div><!--Отображение книг на вкладке спецпредложения -->


</div>