@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')

  
<section id="blog_list">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @foreach ($news as $new)
                    <div class="blog-post wow animated fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="blog-thumb"><img style="width: 100%; height:400px;" src="{{asset('/')}}{{$new->image}}" alt="Blog Thumb"></div>
                        <div class="blog-content">
                        <h3 class="blog-title"><a href="#">{{$new->title}}</a></h3>
                            <ul class="post-meta">
                                <li><a href="#"><i class="fa fa-user"></i>Admin</a></li>
                                <li><a href="#"><i class="fa fa-calendar"></i>{{date('d-m-Y', strtotime($new->updated_at))}}</a></li>
                            </ul>
                        <p>{{substr($new->description,0,150)}}...</p>
                        <a href="{{route('news.show', $new->id)}}" class="dt-btn">Read More</a>
                        </div>
                    </div>
                @endforeach
              
            </div>
            <div class="col-md-3">


                <aside id="nav_menu-2" class="widget widget_nav_menu">
                    <h3 class="widget-title">Categories</h3>
                    <ul class="dt_custom_menu">
                        <li><a href="#"><i class="icon dti-message-text"></i>Category One</a></li>
                        <li><a href="#"><i class="icon dti-todolist-pencil"></i>Category Two</a></li>
                    </ul>
                </aside>





                {{-- Recent Post --}}
                <aside class="widget widget_recent_entries">
                    <h3 class="widget-title">Recent Posts</h3>
                    @foreach ($news as $new)
                    <div class="resent-post">
                    <div class="post-thumbs"><a href="#"><img class="media-object" src="{{asset('/')}}{{$new->image}}"
                                    alt="01"></a></div>
                        <div class="post-content">
                        <h5><a href="#">{{substr($new->title,0,10)}}</a></h5><a href="#">{{date('d-m-Y', strtotime($new->updated_at))}}</a>
                        <p>{{substr($new->description, 0, 20)}}...</p>
                        </div>
                    </div>
                  
                    @endforeach
                
                </aside>
               
               
            </div>
        </div>
    </div>
</section>

@include('frontend.layouts.banner')
    
@endsection