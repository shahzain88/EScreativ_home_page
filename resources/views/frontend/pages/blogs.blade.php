@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')


<section id="blog_list">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @foreach ($blogs as $blog)
                    <div class="blog-post wow animated fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <div class="blog-thumb"><img style="width: 100%; height:400px;" src="{{asset('/')}}{{$blog->image}}" alt="Blog Thumb"></div>
                        <div class="blog-content">
                        <h3 class="blog-title"><a href="{{route('blogDetails',['slug'=>$blog->slug,'id'=>$blog->id])}}">{{$blog->title}}</a></h3>
                            <ul class="post-meta">
                                <li><span ><i class="fa fa-user"></i> Admin</span></li>
                                <li><span ><i class="fa fa-calendar"></i> {{date('d-m-Y', strtotime($blog->updated_at))}}</span></li>
                            </ul>
                        <p>{{substr($blog->description,0,150)}}...</p>
                        <a href="{{route('blogDetails',['slug'=>$blog->slug,'id'=>$blog->id])}}" class="dt-btn">Read More</a>
                        </div>
                    </div>
                @endforeach

                {{$blogs->links("pagination::bootstrap-4")}}

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
