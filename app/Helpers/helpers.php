<?php function output_book_body($book){?>

        <div 
          onclick="location.href='/showBook?BookID=<?php echo $book->ID_book?>'" 
          class="book_body">
            
            <?php if($book->Discount_book!= 0) {?>
            <span>-<?php echo $book->Discount_book ?>%</span>
            <?php } ?>

            <div class = "inside_book_body">
              
              <img src="storage/image_covers/<?php echo $book->Image_cover ?>">
              
              <h3><?php //Ограничиваем кол-во букв в названии
                if (mb_strlen($book->Name_book) < 30) {
                  echo $book->Name_book;
                 } else{
                  echo mb_substr($book->Name_book, 0, 30)."...";
                 }
              ?></h3>

              <h2><?php echo $book->Price_book*(1- $book->Discount_book/100)."&#8381"; ?></h2>

            </div> <!--Блок без скидки -->

        </div><!--Блок книги --> 

<?php }

