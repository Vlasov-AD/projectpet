///Чтение из куки
function readCookie(name) {
  var cookiename = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++)
  {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(cookiename) == 0) return c.substring(cookiename.length,c.length);
  }
  return null;
}

//запись количества книг в шапку
function changesInHeadersNumberOfBooks(numberOfBook){

	const itemInCart = document.getElementById('itemInCart');
	if(readCookie('cartBooksArray'))
	{
		
		if(numberOfBook == 1)
		{
			itemInCart.innerHTML = '1 книга';
		}else if (numberOfBook>=2 && numberOfBook<=4) {
			itemInCart.innerHTML = numberOfBook+' книги';
		}else if(numberOfBook>=5)
		{	
			itemInCart.innerHTML = numberOfBook+' книг';
		}else
		{
			itemInCart.innerHTML = '0 книг';
		}
		
	}else
	{
		itemInCart.innerHTML = '0 книг';
	}
}

const buttons = document.getElementsByClassName('add_to_cart_universal');
let currentBookIDWithPrefix = 0;
let currentBookID = 0;
let booksArray = [];
let currentArrayInCookie = 0;



if(readCookie('cartBooksArray'))
{
	currentArrayInCookie = JSON.parse(readCookie('cartBooksArray'));

changesInHeadersNumberOfBooks(currentArrayInCookie.length);
}else
{
	changesInHeadersNumberOfBooks(0);
}





//добавление/удаление элементов в куки при нажатии на кнопку на главной странице
for(let i = 0; i<buttons.length; i++)
{	
	buttons[i].addEventListener('click',(event) =>{

		currentBookIDWithPrefix = event.target.id;

		//у трех вкладок разные префиксы ID
		currentBookID = currentBookIDWithPrefix.split("_")[1];

		if(getComputedStyle(event.target).backgroundColor == "rgb(121, 178, 96)")
		{
			//Добавление в куки
			//Если книги в куки уже есть
			if(readCookie('cartBooksArray'))
			{	
				currentArrayInCookie = JSON.parse(readCookie('cartBooksArray'))

				if(!Array.isArray(currentArrayInCookie))//если в куки один элемент - то меняем его на массив
				{	
					if(currentArrayInCookie!= currentBookID)
					{	
						booksArray[0] = currentArrayInCookie;
						
						booksArray[1] = currentBookID; 
						
						document.cookie = 'cartBooksArray='+JSON.stringify(booksArray);
						changesInHeadersNumberOfBooks(booksArray.length);
					}

				}else
				{
					if(!currentArrayInCookie.includes(currentBookID))//отсутствие книги в массиве
					{
						
						booksArray = currentArrayInCookie;
						
						booksArray[booksArray.length] = currentBookID;
						
						
						document.cookie = 'cartBooksArray='+JSON.stringify(booksArray);

						changesInHeadersNumberOfBooks(booksArray.length);
					}
						
				}
			//если первая книга
			}else
			{
				
				document.cookie = 'cartBooksArray='+JSON.stringify(currentBookID);
				changesInHeadersNumberOfBooks(1);
			}
			
	
			//меняем стили у всех книг с данным id если они есть на странице
			if(document.getElementById('best_'+currentBookID))
			{
				document.getElementById('best_'+currentBookID).style.backgroundColor = '#fff';
				document.getElementById('best_'+currentBookID).style.color = '#79b260';
				document.getElementById('best_'+currentBookID).innerHTML = 'В корзине';

			}

			if(document.getElementById('new_'+currentBookID))
			{
				document.getElementById('new_'+currentBookID).style.backgroundColor = '#fff';
				document.getElementById('new_'+currentBookID).style.color = '#79b260';
				document.getElementById('new_'+currentBookID).innerHTML = 'В корзине';
			}

			if(document.getElementById('special_'+currentBookID))
			{
				document.getElementById('special_'+currentBookID).style.backgroundColor = '#fff';
				document.getElementById('special_'+currentBookID).style.color = '#79b260';
				document.getElementById('special_'+currentBookID).innerHTML = 'В корзине';
			}

			if(document.getElementById('shop_'+currentBookID))
			{
				document.getElementById('shop_'+currentBookID).style.backgroundColor = '#fff';
				document.getElementById('shop_'+currentBookID).style.color = '#79b260';
				document.getElementById('shop_'+currentBookID).innerHTML = 'В корзине';
			}

			if(document.getElementById('book_'+currentBookID))
			{
				document.getElementById('book_'+currentBookID).style.backgroundColor = '#fff';
				document.getElementById('book_'+currentBookID).style.color = '#79b260';
				document.getElementById('book_'+currentBookID).innerHTML = 'В корзине';
			}

			if(document.getElementById('search_'+currentBookID))
			{
				document.getElementById('search_'+currentBookID).style.backgroundColor = '#fff';
				document.getElementById('search_'+currentBookID).style.color = '#79b260';
				document.getElementById('search_'+currentBookID).innerHTML = 'В корзине';
			}

			//если страница корзины, при удалении или добавлении пересчитываем сумму
			if(window.location.pathname == '/shopCart')
			{
				let allBooks = document.getElementsByClassName('book_inside_shop_page');
				let sum = 0;

				for(let i=0; i<allBooks.length; i++)
				{	//сли элемент в корзине

				
					if(getComputedStyle(allBooks[i]).backgroundColor == "rgb(255, 255, 255)")
						{	
							sum+= parseInt(allBooks[i].getAttribute('value'));
							
						}
				}

				document.getElementsByClassName('sumToPay')[0].innerHTML = 'Сумма к покупке: '+sum+ '.00&#8381'
			}

		}else
		{
			//удаление из куки
			currentArrayInCookie = JSON.parse(readCookie('cartBooksArray'))
			if(currentArrayInCookie.includes(currentBookID))
			{	
				currentArrayInCookie.splice(currentArrayInCookie.indexOf(currentBookID), 1);
				document.cookie = 'cartBooksArray='+JSON.stringify(currentArrayInCookie);	
				changesInHeadersNumberOfBooks(currentArrayInCookie.length);			
			}

			//меняем стили у всех книг с данным id если они есть на странице
			if(document.getElementById('best_'+currentBookID))
			{
				document.getElementById('best_'+currentBookID).style.backgroundColor = '#79b260';
				document.getElementById('best_'+currentBookID).style.color = '#fff';
				document.getElementById('best_'+currentBookID).innerHTML = 'Добавить в корзину';

			}

			if(document.getElementById('new_'+currentBookID))
			{
				document.getElementById('new_'+currentBookID).style.backgroundColor = '#79b260';
				document.getElementById('new_'+currentBookID).style.color = '#fff';
				document.getElementById('new_'+currentBookID).innerHTML = 'Добавить в корзину';
			}

			if(document.getElementById('special_'+currentBookID))
			{
				document.getElementById('special_'+currentBookID).style.backgroundColor = '#79b260';
				document.getElementById('special_'+currentBookID).style.color = '#fff';
				document.getElementById('special_'+currentBookID).innerHTML = 'Добавить в корзину';
			}

			if(document.getElementById('shop_'+currentBookID))
			{
				document.getElementById('shop_'+currentBookID).style.backgroundColor = '#79b260';
				document.getElementById('shop_'+currentBookID).style.color = '#fff';
				document.getElementById('shop_'+currentBookID).innerHTML = 'Добавить в корзину';
			}

			if(document.getElementById('book_'+currentBookID))
			{
				document.getElementById('book_'+currentBookID).style.backgroundColor = '#79b260';
				document.getElementById('book_'+currentBookID).style.color = '#fff';
				document.getElementById('book_'+currentBookID).innerHTML = 'Добавить в корзину';
			}

			if(document.getElementById('search_'+currentBookID))
			{
				document.getElementById('search_'+currentBookID).style.backgroundColor = '#79b260';
				document.getElementById('search_'+currentBookID).style.color = '#fff';
				document.getElementById('search_'+currentBookID).innerHTML = 'Добавить в корзину';
			}

			//если страница корзины, при удалении или добавлении пересчитываем сумму
			if(window.location.pathname == '/shopCart')
			{
				let allBooks = document.getElementsByClassName('book_inside_shop_page');
				let sum = 0;

				for(let i=0; i<allBooks.length; i++)
				{	//сли элемент в корзине

				
					if(getComputedStyle(allBooks[i]).backgroundColor == "rgb(255, 255, 255)")
						{	
							sum+= parseInt(allBooks[i].getAttribute('value'));
							
						}
				}

				document.getElementsByClassName('sumToPay')[0].innerHTML = 'Сумма к покупке: '+sum+ '.00&#8381'
			}
		}
		
		
		
	});
}


