<aside class="widget widget_archive">
    <h3 class="widget-title">Gallery</h3>
    <div class="gallery">
        @foreach ($galleries as $gallery)
    <a href="{{asset('/')}}{{$gallery->image}}">
            <img style="height:100px; width:100px" src="{{asset('/')}}{{$gallery->image}}"alt="">
            </a>
        @endforeach
      

    </div>
</aside>