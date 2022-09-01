<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('public/frontend')}}/assets/img/favicon/esfavicon.png">

    <meta name="theme-color" content="#ffb100">
    <title>ES Creative — @if($title){{$title}}@endif </title>
    <link rel="stylesheet" href="{{asset('public/frontend')}}/assets/bootstrap/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/dt-icons/styles.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/wow/css/animate.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/jPushMenu/css/jPushMenu.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/lightgallery/css/lightgallery.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/swiper/css/swiper.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/revolution/css/settings-ver.5.3.1.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/revolution/css/layers.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/dependencies/revolution/css/navigation.css" type="text/css">

    <link rel="stylesheet" href="{{asset('public/frontend')}}/others/vendor/aos/aos.css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/others/vendor/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/others/vendor/boxicons/css/boxicons.min.css" >
    <link rel="stylesheet" href="{{asset('public/frontend')}}/others/vendor/glightbox/css/glightbox.min.css" >
     <!-- Template Main CSS File -->
  {{-- <link href="{{asset('public/frontend')}}/others/css/style.css" rel="stylesheet"> --}}


    <link rel="stylesheet" href="{{asset('public/frontend')}}/assets/css/app.css" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend')}}/assets/css/custom.css" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800" rel="stylesheet">
     <!-- Toastr -->
     <link rel="stylesheet" href="{{asset('public/backend/plugins')}}/toastr/toastr.min.css">
    @yield('style')
    {{-- #53af36 --}}
    <style>
        .dt-btn:before {
            background: #53af36;
        }

        .choice .dt-btn:after, .choice .dt-btn:before {
    background: #53af36;
}
    </style>
</head>

<body id="home-version-1" class="home" data-style="default">


    {{-- Page Loader --}}
    {{-- <div class="page-loader">
        <div class="loader">
            <div class="binding"></div>
            <div class="pad">
                <div class="line line1"></div>
                <div class="line line2"></div>
                <div class="line line3"></div>
            </div>
            <div class="text">Loading...</div>
        </div>
    </div> --}}


    <div id="site">

        {{-- Section Top Nav --}}
       @include('frontend.layouts.header')

        @yield('content')

        {{-- Footer --}}
        @include('frontend.layouts.footer')
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{asset('public/frontend')}}/dependencies/jquery/jquery.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/swiper/js/swiper.js"></script>
    {{-- <script src="{{asset('public/frontend')}}/assets/js/smooth-scroll.js"></script> --}}
    <script src="{{asset('public/frontend')}}/dependencies/mixitup/mixitup.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/jPushMenu/js/jPushMenu.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/twitter-fetcher/twitterFetcher_min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/wow/wow.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/lightgallery/lightgallery.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script src="{{asset('public/frontend')}}/dependencies/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script src="{{asset('public/frontend')}}/assets/js/app.js"></script>
    <script src="{{asset('public/frontend')}}/others/vendor/purecounter/purecounter.js"></script>
    <script src="{{asset('public/frontend')}}/others/vendor/aos/aos.js"></script>
    <script src="{{asset('public/frontend')}}/others/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{asset('public/frontend')}}/others/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <!-- Template Main JS File -->
  <script src="{{asset('public/frontend')}}/others/js/main.js"></script>




    <!-- Toastr -->
    <script src="{{asset('public/backend/plugins')}}/toastr/toastr.min.js"></script>



    @yield('script')



</body>

</html>
