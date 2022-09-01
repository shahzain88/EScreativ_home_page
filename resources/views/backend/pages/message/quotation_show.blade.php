@extends('backend.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quotation Message</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Quotation Message</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">Read Message</h3>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                        <div class="mailbox-read-info">
                          <h5>Subject: {{$quotation->subject}}</h5>
                          <h6>From: {{$quotation->email}}
                            <span class="mailbox-read-time float-right">{{date('F d, Y h:i:s a', strtotime($quotation->created_at))}}</span></h6>
                            @if ($quotation->service)
                                <a href="{{route('serviceDetails',['slug'=>$quotation->service->slug,'id'=>$quotation->service->id])}}"><h4>Service: {{$quotation->service ? $quotation->service->title : ''}}</h4></a>
                            @endif
                        </div>
                        <!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border text-center">
                          <div class="btn-group">
                            <a href="{{route('quotation.index')}}" class="btn btn-primary btn-block mb-3">Back to Quotation List</a>
                          </div>
                        </div>
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            <h5>Message:</h5>
                            {{$quotation->message}}
                        </div>
                        <!-- /.mailbox-read-message -->
                      </div>
                      <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                  </div>

            </div>
        </div>
    </section>


@endsection

