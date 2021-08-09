<nav>
    

    <div class="nav-header">
      <ul>

        <li><span onclick="" id="enter_in_nav">Войти</span></li>
        @if(Auth::user())
          <script>
            document.getElementById('enter_in_nav').style.display = "none";
          </script>
        @endif
       
       @if(Auth::user())
        <li>
          <div class="dropdown">
            <button class=" dropbtn">
              @if(Auth::user()->name == null)
                {{'User_'.Auth::user()->id}}
              @else
                {{Auth::user()->name}}
              @endif
            </button>

            <div class="dropdown-content">
              <a href="/account">Моя учетная запись</a>
              @if(Auth::user()->id == 25)
                <a href="/CreateForm">Добавить новую книгу</a>
              @endif
              <a href="/logout">Выйти</a>
            </div>
            <a href="/account">
                
                  
               
            </a>
          </div>
        </li>
        @endif
        
        
        <li><a href="/help">Помощь</a></li>
        <li><a href="/contact">Контакты</a></li>
      </ul>
    </div>
</nav><!--Шапка с активными ссылками -->


@include('includesSite.PopUp.pop_window_registration')
@include('includesSite.PopUp.pop_window_enter')
@include('includesSite.PopUp.pop_window_recovery')




<script type="text/javascript" src = "{{URL::asset('js/PopUpAndEyeIcon.js') }}"></script>

<script >
      //Вызов окна входа из кнопки войти в nav_header
        const enterInNav = document.getElementById('enter_in_nav');
        enterInNav.onclick = () =>{
          enterForm.style.display = 'block';
        }

</script>
