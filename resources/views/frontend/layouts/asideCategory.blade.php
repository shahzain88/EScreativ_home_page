<div class="accordion" id="categoryAccordian">
    <h3 class="widget-title">Categories</h3>
    @if ($categories)
        @foreach ($categories as $key => $category)
            <div class="card">
                <div class="card-header" id="heading-{{ $category->id }}">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapse-{{ $category->id }}" aria-expanded="true"
                            aria-controls="collapse-{{ $category->id }}">
                            <img src="{{ asset('/') . $category->image }}" height="30" width="30" alt="">
                            {{ $category->name }} <i class="fa fa-angle-down"></i>
                        </button>
                    </h2>
                </div>

                <div id="collapse-{{ $category->id }}" class="collapse @if ($key == 0) show @endif"
                    aria-labelledby="heading-{{ $category->id }}" data-parent="#categoryAccordian">
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($category->children as $children)
                                <li class="list-group-item"><a class="card-link"
                                     href="{{ route('categoryServices', ['slug' => $children->slug, 'id' => $children->id]) }}">{{ $children->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        <a class="btn btn-outline-success btn-block mt-1 mb-4" href="{{route('categories')}}">See All Categories</a>
    @endif
</div>
