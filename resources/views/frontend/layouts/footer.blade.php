<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="footer-ab">
                <div class="footer-logo"><a href="#">
                    @if ($about)
                        @if ($about->logo)
                            <img src="{{asset('/')}}{{$about->logo}}" alt="logo"></a>
                        @else
                            <img src="{{asset('public/no_image_found.jpg')}}" alt="logo"></a>
                        @endif

                    @endif

                </div>
                @if (isset($about->about))
                    <p>{{substr($about->about,0,150)}}...</p>
                @else
                    <p>...</p>
                @endif

                    <ul class="social-link">
                        <li><a href="facebook.com"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="twitter.com"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="instagram.com"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="linkedin.com"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="google.com"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="usefull-link">
                    <h5 class="footer-title">Usefull Link</h5>
                    <ul class="footer-link">
                    <li><a href="{{route('about')}}"><i class="fa fa-angle-right"></i>About US</a></li>
                    <li><a href="{{route('services')}}"><i class="fa fa-angle-right"></i>Services</a></li>
                    <li><a href="{{route('projects')}}"><i class="fa fa-angle-right"></i>Projects</a></li>
                    <li><a href="{{route('esFaq')}}"><i class="fa fa-angle-right"></i>FAQ</a></li>
                    <li><a href="{{route('esContact')}}"><i class="fa fa-angle-right"></i>Contact</a></li>
                    <li><a href="{{route('quotation.create')}}"><i class="fa fa-angle-right"></i>Quotation</a></li>

                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="footer-contact">
                    <h5 class="footer-title">Contact</h5>
                    <div class="contact-details clearfix"><span><i class="fa fa-paper-plane"></i></span>
                        <p>Email Us</p>
                        @if (isset($about->email))
                        <p class="con-text"><a href="mailto:{{$about->email}}">{{$about->email}}</a></p>
                        @else
                        <p class="con-text"><a href="mailto:noemailfound@email.com">noemailfound@email.com</a></p>

                        @endif
                    </div>
                    <div class="contact-details clearfix"><span><i class="fa fa-phone"></i></span>
                        <p>Call Now</p>
                        <p></p>
                        @if (isset($about->mobile))
                            <p class="con-text"><a href="tel:{{$about->mobile}}">{{$about->mobile}}</a></p>
                        @else
                            <p class="con-text"><a href="tel:+000000">+000000</a></p>
                        @endif
                    </div>
                    <div class="contact-details clearfix"><span><i class="fa fa-map-marker"></i></span>
                        <p>Find Us</p>
                        <p style="font-size: 12px">【本社】〒343-0035 <br> &nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	 埼玉県越谷市大字510番地一階
                        </p>                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <h5 class="footer-title">Gallery</h5>
                 @include('frontend.layouts.gallery')
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>Copyright 2020. All right reserved by ES Creative Industries Co. Ltd.</p>
    </div>
</footer>
