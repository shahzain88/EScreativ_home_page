@extends('frontend.master')
@section('content')
@include('frontend.layouts.pageBanner')

<section id="popular-category">
    <div class="container">
        <h2 class="section-title text-center wow animated fadeInUp" data-wow-delay="0ms">Category list</h2>
        <p class="sub-title wow animated fadeInUp" data-wow-delay="200ms">Find your desire category from the below category list. Select any categories to get your expected services.</p>
    </div>
</section>

<section id="popular-category-list">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                @foreach ($categories as $category)
                <div class="card">
                    <h2 class="card-header section-title ">
                       <img src="{{asset('/') . $category->image}}"  alt="{{$category->name}}"  height="60" width="60"> {{$category->name}}
                    </h2>
                    <div class="card-body">
                        <div class="row">
                            @if ($category->children)
                                @foreach ($category->children as $childCategory)
                                <div class="col-md-4">
                                    <a href="{{route('categoryServices', ['slug'=>$childCategory->slug,'id'=>$childCategory->id] )}}"><h5 class="card-title">{{$childCategory->name}}</h5> </a>
                                    <p class="card-text">{{$childCategory->description}}</p>
                                </div>
                                @endforeach
                            @endif

                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@include('frontend.layouts.banner')
@endsection
