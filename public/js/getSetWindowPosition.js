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


function setCookie(){
  //Запись в куки раз в 0,05 секунд
  //addListner запускаеся только при evtFired == False
  evtFired = true;

  setTimeout(function(){evtFired = false;}, 50);
 
  positionY = window.pageYOffset;
  document.cookie = 'productPageScroll='+positionY;
}

//Если переход с другой страницы
if(window.location.href !== document.referrer)
  {document.cookie = 'productPageScroll='+0;}

//Запись позиции на экране в куки
let evtFired = false;
let positionY = 0;

window.addEventListener("scroll", function(){
  if(evtFired === false){
    setCookie()
  }

});


  //Перевод на положение экрана из куки
  setTimeout(function(){
    if (readCookie('productPageScroll') !== null) {
   scrollTo({top: readCookie('productPageScroll'),
              behavior: "instant"});
}
}, 100)

