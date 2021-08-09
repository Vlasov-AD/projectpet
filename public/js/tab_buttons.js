   
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

    //При выборе пользователя
    const best_tab = document.getElementById('tab1');
    const new_tab = document.getElementById('tab2');
    const special_tab = document.getElementById('tab3');

    document.addEventListener("click", (event) =>{
      if(event.target == best_tab) {
        document.getElementById('view_books_best').style.display = 'block';
        document.getElementById('view_books_new').style.display = 'none';
        document.getElementById('view_books_special').style.display = 'none';
        document.cookie = "TabChoice = 1";
      }

      if(event.target == new_tab) {
        document.getElementById('view_books_best').style.display = 'none';
        document.getElementById('view_books_new').style.display = 'block';
        document.getElementById('view_books_special').style.display = 'none';
        document.cookie = "TabChoice = 2";
      }


      if(event.target == special_tab) {
        document.getElementById('view_books_best').style.display = 'none';
        document.getElementById('view_books_new').style.display = 'none';
        document.getElementById('view_books_special').style.display = 'block';
        document.cookie = "TabChoice = 3";
      }
    })
    

    if( readCookie('TabChoice') == null){
      //Если куки не существует
      document.getElementById('tab1').checked=true;
      document.getElementById('view_books_best').style.display = 'block';
      document.getElementById('view_books_new').style.display = 'none';
      document.getElementById('view_books_special').style.display = 'none';  
    }
      else if(readCookie('TabChoice') == 1){
      document.getElementById('tab1').checked=true;
      document.getElementById('view_books_best').style.display = 'block';
      document.getElementById('view_books_new').style.display = 'none';
      document.getElementById('view_books_special').style.display = 'none';  
    } else if(readCookie('TabChoice') == 2){
      document.getElementById('tab2').checked=true;
      document.getElementById('view_books_best').style.display = 'none';
      document.getElementById('view_books_new').style.display = 'block';
      document.getElementById('view_books_special').style.display = 'none';
    } else if(readCookie('TabChoice') == 3){
      document.getElementById('tab3').checked=true;
      document.getElementById('view_books_best').style.display = 'none';
      document.getElementById('view_books_new').style.display = 'none';
      document.getElementById('view_books_special').style.display = 'block';
    }
     

    
    