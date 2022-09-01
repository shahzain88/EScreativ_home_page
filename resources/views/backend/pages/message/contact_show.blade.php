@extends('backend.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact Message</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact Message</li>
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
                          <h5>Subject: {{$contact->subject}}</h5>
                          <h6>From: {{$contact->email}}
                            <span class="mailbox-read-time float-right">{{date('F d, Y h:i:s a', strtotime($contact->created_at))}}</span></h6>
                        </div>
                        <!-- /.mailbox-read-info -->
                        <div class="mailbox-controls with-border text-center">
                          <div class="btn-group">
                            <a href="{{route('contact.index')}}" class="btn btn-primary btn-block mb-3">Back to Contact List</a>
                          </div>
                        </div>
                        <!-- /.mailbox-controls -->
                        <div class="mailbox-read-message">
                            {{$contact->message}}
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

