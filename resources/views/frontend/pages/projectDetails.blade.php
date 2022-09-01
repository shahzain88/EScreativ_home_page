@extends('frontend.master')

@section('content')
@include('frontend.layouts.pageBanner')



<section id="project_single" data-carousel="swiper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <aside class="service-widgets">
                    @include('frontend.layouts.asideCategory')
                </aside>

               @include('frontend.layouts.gallery')
            </div>
            <div class="col-md-9">
                <div class="projece-single">
                <img style="width: 100%; height:400px" src="{{asset('/')}}{{$project->image}}" alt="Thumbnail">
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="project-details">
                            <h3 class="project-title">Project Driscription</h3>
                        <p>{{$project->description}}</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="project-details">
                            <h3 class="project-title">Client Feedback</h3>
                        <p>{{$project->client_feedback}}</p>
                            <table class="details">
                                <tr>
                                    <td>Client name :</td>
                                <td>{{$project->client_name}}</td>
                                </tr>
                                <tr>
                                    <td>Start Date :</td>
                                <td>{{$project->start_date}}</td>
                                </tr>
                                <tr>
                                    <td>End Date :</td>
                                    <td>{{$project->end_date}}</td>
                                </tr>
                                <tr>
                                    <td>Budget :</td>
                                <td> &#165; {{$project->budget}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection
