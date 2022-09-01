@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')
<section id="team" data-bg-image="{{asset('public/frontend')}}/media/rev-banner/officeloop_cover.jpg" >
    <div class="container">
        <h2 class="section-title text-center" >Get free quotaion</h2>
        <p class="sub-title text-dark">Send us about your estimate.</p>
        <div class="row ">
            <div class="col-md-12 col-lg-12 col-sm-12">
                <form id="quotationForm-1" method="POST">
                    @csrf
                        <div>
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
                            <table class="table text-dark  bg-light">
                                <tr>
                                    <td>Service Name:</td>
                                    <td>
                                        {{$service->title}}
                                        <input type="hidden" name="service_id" value="{{$service->id}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Choose your necessary option <br>
                                        <span class="text-danger">[必須]</span>
                                    </td>
                                    <td>
                                        <label for="quotation"><input name="quotation" id="quotation"  type="checkbox" value="1"> Quotation</label> &nbsp;
                                        <label for="visit"><input name="visit" id="visit"  type="checkbox" value="1"> Visit Reservation</label> &nbsp;
                                        <label for="diagnosis"><input name="diagnosis" id="diagnosis" type="checkbox" value="1"> Diagnosis</label>&nbsp;
                                        <label for="consultation"><input name="consultation" id="consultation" type="checkbox" value="1"> Consultation</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name <span class="text-danger">[必須]</span></td>
                                    <td>
                                        <input name="name" id="name" required maxlength="50" class="form-control" placeholder="Enter your name" type="text">
                                        <span id="err_name" class="name-error text-danger"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Email <span class="text-danger">[必須]</span></td>
                                    <td>
                                        <input required maxlength="50" id="email" name="email" class="form-control" placeholder="Enter you email" type="email">
                                        <span id="err_email" class="text-danger"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Mobile <span class="text-danger">[必須]</span></td>
                                    <td>
                                        <input required name="mobile" id="mobile" class="form-control" placeholder="Enter your mobile number" type="text">
                                        <span id="err_mobile" class="text-danger"></span>
                                    </td>

                                </tr>
                                <tr>
                                    <td>Subject <span class="text-danger">[必須]</span></td>
                                    <td><input required maxlength="50" id="subject" name="subject"  class="form-control" placeholder="Enter your subject" type="text"></td>
                                </tr>
                                <tr>
                                    <td>Message <span class="text-danger">[必須]</span></td>
                                    <td><textarea required name="message" id="message" class="form-control" cols="30" rows="5"></textarea></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary float-right">
                                            <span class="esc-loading-button d-none">
                                                <i class="fa fa-spinner fa-spin"></i>
                                            </span>
                                            <span class="submit-btn">
                                                Submit
                                            </span>
                                        </button>
                                    </td>
                                </tr>

                            </table>
                        </div>
                </form>

            </div>

        </div>
    </div>
</section>

@endsection



@section('script')

<script>
    $(document).ready(function(){
        $("#quotationForm-1").on('submit', function(e){
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('quotationStore')}}",
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
                    setTimeout( function() { location.reload();}, 5000)

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
        })
    })
</script>


@endsection
