@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')

<div class="container p-3">
    <div class="row">
        <div class="col">
            <aside class="widget widget_archive">
              
                <div class="gallery">
                    @foreach ($galleries1 as $gallery)
                   
                        <a href="{{asset('/')}}{{$gallery->image}}"><img class="ml-4 p-5" style="height: 300px; width:300px" src="{{asset('/')}}{{$gallery->image}}" alt=""></a>
                   
            
                    @endforeach
                
                </div>
            </aside>
        </div>

    </div>

</div>

    
@endsection