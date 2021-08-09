<div class="advert_section">

 
  <div class="advert_slide"  >
    @foreach ($slide_images as $image)
      <div class = "image_block" style="
        background: url({{url('/storage/includes_images/advertImages/'.$image->imageName)}}) 100% 0  no-repeat;
        background-size: 100% 100%;
        display: none;
        height: 100%;" >
      </div>
    @endforeach
    <a id="prev_slide" onclick="">&#10094;</a>
    <a id="next_slide" onclick="">&#10095;</a>
  </div><!--Слайд новинок/популярных -->

  <script type="text/javascript" src="{{URL::asset('js/slideLogic.js')}}"></script>
  

  <div class="advert_special">

    <form action="#" method="GET">
      <input id="get_special" type="submit" name="get_special" value="Купить">
    </form>
  </div><!--Блок со спецпредложениями --> 

</div><!--Секция с рекламой -->