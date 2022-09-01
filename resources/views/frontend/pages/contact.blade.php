@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')



<section id="contact">
    <div class="container">
        <div class="contact-area">
            <div class="row">
                <div class="col-md-8">
                    <div class="contact">
                        <h2 class="contact-title">Contact Us</h2>
                        <p>If you want to connect with me, please see our address or call our number or mail us
                            on our email, we will contact with you for our own business, so don’t worrie we are
                            beside you to help you.</p>
                            <form id="contactForm" method="POST">
                                @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-dismissible d-none ">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="fa fa-info"></i> Error!</h5>
                                        <small class="alert-message">Something went wrong. Please try again...</small>
                                    </div>

                                    <div class="alert alert-success alert-dismissible d-none ">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="fa fa-check"></i> Success!</h5>
                                        <small class="alert-message">Message Sent sucessfully.</small>
                                    </div>
                                </div>



                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" id="name-field">
                                        <input name="name" id="inputName" required maxlength="50" class="form-control" placeholder="Enter your name" type="text">
                                        <span id="err_name" class="text-danger">Name Invalid</span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group" id="email-field">
                                        <input required maxlength="50" id="inputEmail" name="email" class="form-control" placeholder="Enter you email" type="email">
                                        <span id="err_email" class="text-danger">Email Invalid</span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group" id="subject-field">
                                        <input required maxlength="50" name="subject"  class="form-control" placeholder="Enter your subject" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group form-text text-center" id="message-field">
                                        <textarea required name="message" id="message" placeholder="Enter your message" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="dt-btn">
                                        <span class="esc-loading-button d-none">
                                            <i class="fa fa-spinner fa-spin"></i>
                                        </span>
                                        <span class="submit-btn">
                                            Submit
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-address">
                        <div class="address">
                            <div class="con-icon"><i class="fa fa-home"></i></div>
                            <h5>【本社】〒343-0035</h5>
                            <p> 	&nbsp;	&nbsp;	&nbsp;	&nbsp;	 埼玉県越谷市大字510番地一階
                            </p>
                        </div>
                        <div class="address">
                            <div class="con-icon"><i class="fa fa-envelope-o"></i></div>
                            <h5>Email Address</h5>
                            <p> <a href="mailto:es_creative@yahoo.com">es_creative@yahoo.com</a></p>
                        </div>
                        <div class="address">
                            <div class="con-icon"><i class="fa fa-phone"></i></div>
                            <h5>Contact Number</h5>
                            <p><a href="tel:048-940-3935">048-940-3935</a></p>
                        </div>
                        <div class="open">
                            <h3 class="contact-title">Opening Hours</h3>
                            <p>Mon - Wed ... 9:30 AM - 6:00 PM</p>
                            <!--<p>Tue:	9:30 AM – 6:00 PM</p>-->
                            <!--<p>Wed:	9:30 AM – 6:00 PM</p>-->
                            <p>Thu - Sun ... 9:00 AM - 6:00 PM</p>
                            <!--<p>Fri:	9:00 AM – 6:00 PM</p>-->
                            <!--<p>Sat:	9:00 AM – 6:00 PM</p>-->
                            <!--<p>Sun:	9:00 AM – 6:00 PM</p>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="google-map">
        <div class="show-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3231.046536765266!2d139.75918581461264!3d35.92136092437353!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018bfc21260dcf1%3A0xafdc4a21b7025ded!2zRVMgQ3JlYXRpdmUg5bel5qWt5qCq5byP5Lya56S-!5e0!3m2!1sen!2sbd!4v1605359211401!5m2!1sen!2sbd" width="100%" height="600" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            <!--<div class="gmap3-area" data-lat="23.733248" data-lng="90.412040"-->
            <!--    data-mrkr="assets/img/map-marker.png"></div>-->
        </div>
    </div>
</section>

@include('frontend.layouts.banner')

@endsection

@section('script')
    <script>
        $(document).ready(function(){

            $("#err_name").hide();
            $("#err_email").hide();


            var err_name = false;
            var err_email = false;



            $("#inputName").focusout(function(){
                check_name();
            });

            $("#inputEmail").focusout(function() {
                check_email();
            });




            function check_name() {
                var pattern = /^[a-zA-Z ]*$/;
                var name = $("#inputName").val();
                if (pattern.test(name) && name !== '') {
                $("#err_name").hide();
                $("#inputName").css("border","1px solid #34F458");
                } else {
                $("#err_name").html("Contain Characters Only");
                $("#err_name").show();
                $("#inputName").css("border","1px solid #F90A0A");
                err_name = true;
                console.log("name assigning true");
                }
                console.log("getting name check");
            }


            function check_email() {
                var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                var email = $("#inputEmail").val();
                if (pattern.test(email) && email !== '') {
                $("#err_email").hide();
                $("#inputEmail").css("border","1px solid #34F458");
                } else {
                $("#err_email").html("Invalid Email");
                $("#err_email").show();
                $("#inputEmail").css("border","1px solid #F90A0A");
                err_email = true;
                }

            }


            $("#contactForm").on('submit', function(e){
                e.preventDefault();
                let thisForm = $(this);
                err_name = false;
                err_email = false;


                check_name();
                check_email();


                console.log(err_name);
                console.log(err_email);


                if (err_name === false && err_email === false) {
                $.ajax({
                    type: "POST",
                    url: "{{route('sendContactMessage')}}",
                    data:new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find(".esc-loading-button").removeClass('d-none');
                        thisForm.find('button[type="submit"]').html('Submitting');
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                            thisForm.find(".alert-success").removeClass('d-none');
                            thisForm.find(".alert-danger").removeClass('d-none');
                            thisForm.find(".alert-success").addClass('d-none');
                            thisForm.find(".alert-danger").addClass('d-none');
                    },
                    success: function (response) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').html('Submitted');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-success").removeClass('d-none');
                        toastr.success('Successful');
                        setTimeout(function() {
                                location.reload();
                            }, 3000)

                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').html('Submit');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-danger").removeClass('d-none');
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }

                });
                }else {
                    toastr.error('Invalid Form Submission');
                }


            })
        })
    </script>
@endsection
