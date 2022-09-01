<section class="">

    @if (count($sliders) > 0)

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($sliders as $key => $slider)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner">

            @foreach ($sliders as $key=>$slider)
                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                    <img class="d-block w-100" src="{{ asset('/') }}{{ $slider->image }}" alt="Second slide">
                </div>
            @endforeach


        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    @endif

</section>
