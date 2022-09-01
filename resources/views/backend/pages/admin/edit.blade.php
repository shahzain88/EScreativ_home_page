@extends('backend.master')
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" id="userUpdateForm" method="POST" >
                @csrf
                {{-- @method('PUT') --}}
                <input type="hidden" id="userID" name="id" value="{{$user->id}}">
                <div class="card-body">
                  <div class="form-group">
                    <label>User name</label>
                    <input type="text" required name="name" class="form-control"  value={{$user->name}}>
                  </div>
                
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <div class="mb-3">
                        <input class="form-control" value={{$user->email}} type="email" required name ="email" placeholder="Enter Email">
                      </div>
                  
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <div class="mb-3">
                        <input class="form-control" id="pass" type="password" minlength="8"  name ="password" placeholder="*********">
                    </div>
                  
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <div class="mb-3">
                        <input class="form-control" id="cpass" type="password"  minlength="8"  name ="cpassword" placeholder="*********">
                    </div>
                </div>
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    {{-- Form section --}}


@endsection


@section('script')
    <script>
        $(document).ready(function(){
            console.log("Jquery Getting");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

         
            $("#userUpdateForm").on('submit', function(e){
                e.preventDefault();
                var userID = $("#userID").val();
                var pass = $("#pass").val();
                var cpass = $("#cpass").val();
                if(pass != cpass){
                    alert("password does not match");
                }else{
                        $.ajax({
                            type: "POST",
                            url: "{{url('/user-profile-update')}}/"+userID,
                            data:new FormData(this),
                            dataType: "json",
                            contentType:false,
                            cache:false,
                            processData:false,
                            success: function (response) {
                                if(response == 0){
                                    alert('Email already exit !!')
                                }else{     
                                    toastr.success('Successful');
                                    location.reload();
                                }


                            
                            },
                            
                        });


                    }

            })



        })
    </script>

@endsection