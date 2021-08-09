@extends('layouts/app')

@section('title')
<title>Редактор Книг</title>
@endsection

@section('content')
	<div class="container container-border">
		<h1 style="text-align: center; font-size: 26px;">Редактор книг</h1>
		<div class="action_form">
			
			<form method="POST" action = "/CreateNewBook" enctype = "multipart/form-data">
				<input type="hidden" name="_token"  value="{{ csrf_token() }}">
				<h1 style="text-align: center; font-size: 24px; ">Новая книга.</h1>

				<span class = "account_span">Название книги:</span>
				<input type="text" class="text_form text_account" value="{{old('nameBook')}}" name="nameBook" >

				<span class = "account_span" style="height: 90px; ">Аннотация:</span>
				<textarea  class="text_form text_account" style="height: 90px; resize: none;" name="annotationBook" >{{old('annotationBook')}} </textarea>

				<span class = "account_span">Жанр:</span>


				<select name = "genreBook" size="1" id="selectGenreCreate" class = "text_select text_account" >
					<option value = '1'>Детская литература</option>
					<option value = '2'>Фантастика</option>
					<option value = '3'>Роман</option>
					<option value = '4'>Ужасы</option>
					<option value = '5'>Русская литература</option>
					<option value = '6'>Юмор</option>
					<option value = '7'>Кулинария</option>
					<option value = '8'>Компьютер</option>
					<option value = '9'>Бизнес</option>
				</select>
				
				@if(old('genreBook'))
					<script>//Сохранение жанра после возвращения на страницу 
						const selectPosition = {{old('genreBook')}}
						const selectOptions = document.getElementById('selectGenreCreate').options
						var i = 0
						while(selectOptions[i]){
							
							if(selectOptions[i].value == selectPosition){
								document.getElementById('selectGenreCreate').selectedIndex = i

							}
							i++
						}
					</script>
				@endif

				<span class = "account_span">Цена:</span>
				<input type="text" class="text_form text_account" value="{{old('priceBook')}}" name="priceBook" >

				<span class = "account_span">Скидка:</span>
				<input type="text" class="text_form text_account" value="{{old('discountBook')}}" name="discountBook" >

				<span class = "account_span">Автор:</span>
				<input type="text" class="text_form text_account" value="{{old('authorBook')}}" name="authorBook" >

				<span class = "account_span">Издательство:</span>
				<input type="text" class="text_form text_account" value="{{old('editionBook')}}" name="editionBook" >

				<span class = "account_span">Количество страниц:</span>
				<input type="text" class="text_form text_account" value="{{old('pageNumbersBook')}}" name="pageNumbersBook" >

				<span class = "account_span">Размеры книги:</span>
				<input type="text" class="text_form text_account" value="{{old('sizeBook')}}" name="sizeBook" >

				<span class = "account_span">Год издания:</span>
				<input type="text" class="text_form text_account" value="{{old('publicationYearBook')}}" name="publicationYearBook" >

				<span class = "account_span">ISBN:</span>
				<input type="text" class="text_form text_account" value="{{old('ISBNBook')}}" name="ISBNBook" >

				<span class = "account_span">Масса книги:</span>
				<input type="text" class="text_form text_account" value="{{old('massBook')}}" name="massBook" >

				<div class="file_div">
					<label style="display: block;">Выберите обложку:</label>
					<input type="file" accept="image/*"  name="image"  class="button_file">
				</div>
				<input id = "buttonCreateBook" type="submit" class="button_form" value="Сохранить изменения!">

			</form>

		</div>
		
		

	</div><!--Форма создания/редактирования книг -->
@endsection
