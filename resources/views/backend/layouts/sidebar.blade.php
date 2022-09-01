  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      {{-- <img src="{{asset('public/backend/dist')}}/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">ES Creative 工業株式会社</span>
    </a>

    <!-- Sidebar -->


<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
          @if (Auth::user()->image)
          <img src="{{asset('/') . Auth::user()->image}}" class="img-circle elevation-2" alt="User Image">

          @else
          <img src="{{asset('public/backend/dist')}}/img/avatar5.png" class="img-circle elevation-2" alt="User Image">

          @endif
      </div>
      <div class="info">
        <a class="d-block"> {{ Auth::user()->name }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview @if($menu == 'Dashboard') menu-open @endif ">
          <a href="{{route('dashboard')}}" class="nav-link  @if($menu == 'Dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>



        {{-- Slider --}}
        {{-- <li class="nav-item has-treeview @if($menu=='Slider') menu-open @endif ">

          <a href="#" class="nav-link @if($menu=='Slider') active @endif">
            <i class="nav-icon fa fa-forward"></i>
            <p>
              Slider
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('slider.create')}}" class="nav-link @if($submenu=='Create-Slider') active @endif ">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('slider.index')}}" class="nav-link @if($submenu=='View-Slider') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
          </ul>

        </li> --}}


        {{-- About --}}
        <li class="nav-item has-treeview @if($menu=='About') menu-open @endif">

          <a href="#" class="nav-link @if($menu=='About') active @endif">
            <i class="nav-icon fas fa-address-card"></i>
            <p>
              About
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            {{-- <li class="nav-item">
            <a href="{{url('/about/create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li> --}}

            <li class="nav-item">
              <a href="{{route('about.index')}}" class="nav-link @if($submenu=='View-About') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View</p>
              </a>
            </li>

          </ul>

        </li>

         {{-- Categories --}}
         <li class="nav-item has-treeview @if($menu=='Category') menu-open @endif">

            <a href="#" class="nav-link @if($menu=='Category') active @endif">
              <i class="nav-icon fas fa-ethernet"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('category.create')}}" class="nav-link @if($submenu=='Create-Category') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link @if($submenu=='View-Category') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>

          </li>

        {{-- Services --}}
        <li class="nav-item has-treeview @if($menu=='Service') menu-open @endif">

          <a href="#" class="nav-link @if($menu=='Service') active @endif">
            <i class="nav-icon fas fa-peace"></i>
            <p>
              Services
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('service.create')}}" class="nav-link @if($submenu=='Create-Service') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('service.index')}}" class="nav-link @if($submenu=='View-Service') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View</p>
              </a>
            </li>
          </ul>

        </li>



        {{--Recent Project --}}
        <li class="nav-item has-treeview @if($menu=='Project') menu-open @endif">

            <a href="#" class="nav-link @if($menu=='Project') active @endif">
              <i class="nav-icon fas fa-building"></i>
              <p>
                 Projects
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('project.create')}}" class="nav-link @if($submenu=='Create-Project') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{route('project.index')}}" class="nav-link @if($submenu=='View-Project') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>

        </li>



          {{--Our Products --}}
          <li class="nav-item has-treeview @if($menu=='Product') menu-open @endif">

            <a href="#" class="nav-link @if($menu=='Product') active @endif">
              <i class="nav-icon fas fa-atom"></i>
              <p>
                 Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('product.create')}}" class="nav-link @if($submenu=='Create-Product') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{route('product.index')}}" class="nav-link @if($submenu=='View-Product') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>

        </li>




        {{--Latest Blog --}}
        <li class="nav-item has-treeview @if($menu=='Blog') menu-open @endif">

            <a href="#" class="nav-link @if($menu=='Blog') active @endif">
              <i class="nav-icon fas fa-rss"></i>
              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('blog.create')}}" class="nav-link @if($submenu=='Create-Blog') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{route('blog.index')}}" class="nav-link @if($submenu=='View-Blog') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>

        </li>

        {{--Gallery--}}
        <li class="nav-item has-treeview @if($menu=='Gallery') menu-open @endif">

            <a href="#" class="nav-link @if($menu=='Gallery') active @endif">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Gallery
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{route('gallery.create')}}" class="nav-link @if($submenu=='Create-Gallery') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{route('gallery.index')}}" class="nav-link @if($submenu=='View-Gallery') active @endif">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
            </ul>

        </li>

        {{--Testimonial --}}
        <li class="nav-item has-treeview @if($menu=='Testimonial') menu-open @endif">

          <a href="#" class="nav-link @if($menu=='Testimonial') active @endif">
            <i class="nav-icon fas fa-comments"></i>
            <p>
              Testimonial
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('testimonial.create')}}" class="nav-link @if($submenu=='Create-Testimonial') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>

            <li class="nav-item">
            <a href="{{route('testimonial.index')}}" class="nav-link @if($submenu=='View-Testimonial') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View</p>
              </a>
            </li>
          </ul>

        </li>

        {{--FAQ --}}
        <li class="nav-item has-treeview @if($menu=='Faq') menu-open @endif">

          <a href="#" class="nav-link @if($menu=='Faq') active @endif">
            <i class="nav-icon fas fa-question"></i>
            <p>
              FAQ
              <i class="fas fa-angle-left right"></i>
              {{-- <i class="fa-solid fa-person-circle-question"></i> --}}
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('faq.create')}}" class="nav-link @if($submenu=='Create-Faq') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Create</p>
              </a>
            </li>

            <li class="nav-item">
            <a href="{{route('faq.index')}}" class="nav-link @if($submenu=='View-Faq') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>View</p>
              </a>
            </li>
          </ul>

        </li>


        {{-- Order --}}
        <li class="nav-item has-treeview @if($menu=='Order') menu-open @endif">

            <a href="#" class="nav-link @if($menu=='Order') active @endif">
                <i class="nav-icon fas fa-wallet"></i>
                {{-- <i class="fa-solid fa-cart-shopping"></i> --}}
                <p>
                Order
                <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{route('order.index')}}" class="nav-link @if($submenu=='View-Order') active @endif">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View</p>
                </a>
                </li>

            </ul>

        </li>

        {{-- Message --}}
        <li class="nav-item has-treeview @if($menu=='Message') menu-open @endif">

          <a href="#" class="nav-link @if($menu=='Message') active @endif">
            <i class="nav-icon fas fa-comments-dollar"></i>
            {{-- <i class="fa-solid fa-comments-dollar"></i> --}}
            <p>
              Message
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('quotation.index')}}" class="nav-link @if($submenu=='Quotation') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Quotaion</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('contact.index')}}" class="nav-link @if($submenu=='Contact') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Contact</p>
              </a>
            </li>
          </ul>

        </li>

        {{-- User --}}
        <li class="nav-item has-treeview @if($menu=='Users') menu-open @endif">

          <a href="#" class="nav-link @if($menu=='Users') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Users
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>

          <ul class="nav nav-treeview">


            <li class="nav-item">
              <a href="{{route('user.create')}}" class="nav-link @if($submenu=='Create-User') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>Register</p>
              </a>

              <a href="{{route('user.index')}}" class="nav-link @if($submenu=='View-User') active @endif">
                <i class="far fa-circle nav-icon"></i>
                <p>List</p>
              </a>
            </li>
          </ul>

        </li>


        {{-- Login/Logout --}}
        <li class="nav-item">
          {{-- <a href="#" class="nav-link">
            <i class="nav-icon far fa-circle text-info"></i>
            <p>Login/Logout</p>
          </a> --}}


          <a  class="nav-link" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i class="nav-icon far fa-circle text-info"></i> {{ __('Logout') }}
          </a>
        </li>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>


    <!-- /.sidebar -->
</aside>
