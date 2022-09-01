@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')

<section id="project_list">
    <div class="container">

        <ul class="portfolioFilter text-center wow animated fadeInUp" data-wow-delay="0ms"
            data-wow-duration="1500ms">
            <li><a href="#0" class="filter current" data-filter=".mix">All</a></li>
            @foreach ($categories as $key=>$category)
                <li><a href="#0" class="filter" data-filter=".category{{++$key}}">{{$category->name}}</a></li>
            @endforeach

        </ul>
        <div class="portfolio_container row animated fadeInUp" data-wow-delay="300ms"
            data-wow-duration="1500ms">
            @foreach ($projects as $index=>$project)
    <div class="col-md-4 col-xs-6 mix full-width category{{$project->category->parent_id ? $project->category->parent_id : $project->category->id  }}">
                <div class="portfolio-item">
                    <div class="blog-grid">
                    <div class="blog-thumb"><a href="{{route('projectDetails', $project->id)}}"><img style="height: 350px; width:350px" src="{{asset('/')}}{{$project->image}}" alt="blog thumb"></a>
                        </div>
                        <div class="blog-content">
                        <h3 class="blog-title">{{$project->title}}</h3>
                        <p>{{ substr($project->description,0,100)}}...</p><a href="{{route('projectDetails', $project->id)}}" class="dt-btn">More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- <div class="col-sm-12">
            <ul class="portfolio-nav text-center wow animated fadeInUp" data-wow-delay="0ms"
                data-wow-duration="1500ms">
                <li><a href="{{route('project.show',$project->id)}}"><i class="fa fa-angle-left"></i></a></li>
                <li class="page-active"><a href="{{route('project.show',$project->id)}}">1</a></li>
                <li><a href="{{route('project.show',$project->id)}}">2</a></li>
                <li><a href="{{route('project.show',$project->id)}}">3</a></li>
                <li><a href="{{route('project.show',$project->id)}}"><i class="fa fa-angle-right"></i></a></li>
            </ul>
        </div> --}}
    </div>
</section>


@include('frontend.layouts.banner')
@endsection
