<div id="comment_section">
    @if(count($book->comments)>0)
        <h2>Отзывы</h2>
        @foreach($book->comments as $comment)
            <div class="comment_elem">
                <div>
                   
                    @if($comment->user->imagePath!=null)
                        <img src="{{ asset('storage/includes_images/avatars/'.$comment->user->imagePath) }}">
                    @else
                        <img src="{{ asset('storage/includes_images/avatar_image.png') }}">
                    @endif  

                    @if($comment->user->name == null)
                        <h3>{{'User_'.$comment->user->id}}</h3>
                    @else
                        <h3>{{$comment->user->name}}</h3>
                    @endif 
                 
                </div>

                <p>{!!$comment->Comment!!}</p>
                <h4>{{$comment->Date_comment}}</h4>

            </div><!--Комментарий -->
        @endforeach
    @endif
    
<!--Сообщения об успехе/неудаче добавления комментария -->
    @if(session()->has('successAddComment'))
        <div class="alert alert-success">
            @php
            echo session()->get('successAddComment');
            session()->forget('successAddComment');
            @endphp
        </div>
    @endif

    @if(count($errors)>0)
        @if($errors->has('text_comment'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{$errors->first()}}</li>
                </ul>
                
            </div>
        @endif
    @endif


    <h2>Оставьте свой отзыв</h2>
    <div class="action_form">
        <form action="/storeCommentary" method="post">
            <input type="hidden" name="_token"  value="{{ csrf_token() }}">
            <input type="hidden" name="BookID" value = "{{$book->ID_book}}">
            <textarea class="text_form text_comment" id="summary-ckeditor" name="text_comment" placeholder="Добавьте Ваш комментарий"></textarea>
            <input id="button_comment" class="button_form" type="submit" >
        </form>
    </div>
</div><!--Отзывы -->

    <script src="//cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>

<!--Отправка комменария только авторизованным пользователям -->
@if(!Auth::user())

    <script>
        window.addEventListener("click", (event)=>{
        if(event.target == document.getElementById('button_comment')){
            event.preventDefault();
            document.getElementById('pop_window_enter').style.display = 'block';
        }
    })
    </script>

@endif
