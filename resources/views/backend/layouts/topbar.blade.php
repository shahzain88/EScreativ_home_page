<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('index')}}"  class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('products')}}"  class="nav-link">Shop</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      @php
        $message= DB::table('contacts')->where('status', 0)->limit(5)->get();
      @endphp
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
        <span class="badge badge-danger navbar-badge">{{count($message)}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @if (count($message) > 0)
            @foreach ($message as $item)
                <a href="{{ route('contact.show', $item->id) }}" class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                    <div class="media-body">
                    <h3 class="dropdown-item-title">
                        {{$item->name}}
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                    </h3>
                    <p class="text-sm">{{substr($item->message,0,20)}}...</p>
                    {{-- <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> --}}
                    </div>
                </div>
                <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>

            @endforeach
            <a href="{{route('contact.index')}}" class="dropdown-item dropdown-footer">See All Messages</a>
          @else
          <h3 class="dropdown-item dropdown-item-title" >No new messge found</h3>
          @endif

        </div>
      </li>

       <!-- Profile Dropdown Menu -->
       <li class="nav-item dropdown">
     
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">


          <div class="dropdown-divider"></div>

          <div class="dropdown-divider"></div>
           <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}<span class="caret"></span>
            </a>


            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.profile', Auth::user()->username) }}">
                    {{ __('Profile') }}
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </div>
        </li>
          <div class="dropdown-divider"></div>


        </div>
      </li>

    </ul>
  </nav>
