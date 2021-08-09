<div id="info_book">
  <h3>Информация о книге</h3>
  <div>
    <p>Автор: {{$book->Author_book}} </p>
    <p>Жанр: {{$book->genre->Genre_name}} </p>
    <p>Издательство: {{$book->Edition_book}} </p>
    <p>Год издания: {{$book->PublicationYear_book}} г.</p>
    <p> Количество страниц: {{$book->PageNumbers_book}}</p>
    <p>ISBN: {{$book->ISBN_book}}</p>
    <p>Размеры: {{$book->Size_book}}  </p>
    <p>Масса: {{$book->Mass_book}} г</p>
  </div>
</div><!--Дополнительная информация о книге -->