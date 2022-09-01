
<section id="popular-service">
    <div class="container">
       <a href="{{route('services')}}"> <h2 class="section-title text-center wow animated fadeInUp" data-wow-delay="0ms">Services</h2></a>
        <p class="sub-title wow animated fadeInUp" data-wow-delay="200ms">Find your desire service from the below service list. Select any categories to get your expected services.</p>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($services as $service)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{asset('/') . $service->feature_image}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <a href="{{route('serviceDetails',['slug'=>$service->slug,'id'=>$service->id])}}"><h5 class="card-title">{{$service->title}}</h5> </a>
                        <p class="card-text">{{$service->info}}</p>
                        <strong> ¥ {{$service->unit_price}}</strong>
                        <p class="card-text"><small class="text-muted">{{$service->category->name}}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
