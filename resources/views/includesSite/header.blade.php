<header>
    <div class="main-header">
      <div id = "logo-header">
        <a href="/"><img src="storage/includes_images/logo.png"></a>
      </div><!--Логотип -->

      <div>
        <form id = "search_form" action="/search" method="POST">
          <input type="hidden" name="_token"  value="{{ csrf_token() }}">
          <input id = "search_bar" type="text" name="search_bar">
          <input id = "search_button" type="submit" value="Поиск">
        </form>
      </div><!--Поисковая строка -->
      
      <div class = "shop_cart_block">

        <div style="display: inline-block;">
          <img src="storage/includes_images/cart_icon.png">
          <h3>В Вашем заказе: </h3>
          <h4 id = "itemInCart">0 книг</h4>
        </div>
        <div class="cart_button_buy_div">
          <a href="/shopCart" class = "cart_button_buy">Заказать</a>
        </div>
       
        
      </div><!--Тележка -->

    </div>
</header> <!--Шапка -->

@include('includesSite.outputMessages')