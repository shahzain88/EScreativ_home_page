@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')

  
<section id="blog_list">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
           
                    <div class="blog-post wow animated fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="blog-thumb"><img style="width: 100%; height:400px" src="{{asset('/')}}{{$news->image}}" alt="Blog Thumb"></div>
                        <div class="blog-content">
                        <h3 class="blog-title"><a href="#">{{$news->title}}</a></h3>
                            <ul class="post-meta">
                                <li><a href="#"><i class="fa fa-user"></i>Admin</a></li>
                            <li><a href="#"><i class="fa fa-calendar"></i>{{date('d-m-Y', strtotime($news->updated_at))}}</a></li>
                            </ul>
                        <p>{{$news->description}}</p>
                        </div>
                    </div>
              
              
            </div>
            <div class="col-md-3">


                <aside id="nav_menu-2" class="widget widget_nav_menu">
                    <h3 class="widget-title">Categories</h3>
                    <ul class="dt_custom_menu">
                        <li><a href="#"><i class="icon dti-message-text"></i>Category One</a></li>
                        <li><a href="#"><i class="icon dti-todolist-pencil"></i>Category Two</a></li>
                    </ul>
                </aside>

                @include('frontend.layouts.gallery')
               
               
            </div>
        </div>
    </div>
</section>

@include('frontend.layouts.banner')
    
@endsection