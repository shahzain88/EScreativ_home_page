@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')


<section id="blog_list">
    <div class="container">
        <div class="row">
            <div class="col-md-9">

                    <div class="blog-post wow animated fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="blog-thumb"><img style="width: 100%; height:400px" src="{{asset('/')}}{{$blog->image}}" alt="Blog Thumb"></div>
                        <div class="blog-content">
                        <h3 class="blog-title"><a href="#">{{$blog->title}}</a></h3>
                            <ul class="post-meta">
                                <li><a href="#"><i class="fa fa-user"></i>Admin</a></li>
                            <li><a href="#"><i class="fa fa-calendar"></i>{{date('d-m-Y', strtotime($blog->updated_at))}}</a></li>
                            </ul>
                        <p>{{$blog->description}}</p>
                        </div>
                    </div>


            </div>
            <div class="col-md-3">


                <aside id="nav_menu-2" class="widget widget_nav_menu">
                    @include('frontend.layouts.asideCategory')
                </aside>

                @include('frontend.layouts.gallery')


            </div>
        </div>
    </div>
</section>

@include('frontend.layouts.banner')

@endsection
