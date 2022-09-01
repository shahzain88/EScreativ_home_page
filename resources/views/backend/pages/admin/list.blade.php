@extends('backend.master')

@section('content')




 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin List</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Admin List</li>
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
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Admin List</h3>
                  @if (Session::get('success'))
                <p class="text-success">{{Session::get('success')}}</p>
                  @endif
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th style="width: 10px">#</th>
                        {{-- <th>Image</th> --}}
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=>$user)
                            <tr>
                            <td>{{++$key}}</td>
                            {{-- <td><img src="" alt="Preview"></td> --}}
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->role ==0)
                                        <span class="text-danger">New</span>
                                    @elseif($user->role==1)
                                    <span class="text-success">Super Admin</span>
                                    @elseif($user->role==2)
                                    <span class="text-primary">Admin</span>
                                    @endif
                                </td>
                                <th>
                             
                                  @if ($user->role!=1)

                                  <a href="" class="btn btn-info admin-modal" data-toggle="modal" data-target="#modal-admin" data-id="{{$user->id}}" data-name="{{$user->name}}" data-role="{{$user->role}}" >Change Role</a>

                                    <form action="{{route('admin.destroy', $user->id)}}" method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button onclick="return confirm('Are you sure?')" class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                    
                                  @endif
                                  

                                </th>
                            </tr>
                        @endforeach
                       
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
    </section>

  








    <div class="modal fade" id="modal-admin">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Change Admin Role</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{route('changeRole')}}" method="POST">
            @csrf
          <div class="modal-body">
            <p id="modalName"></p>

         
              
                <input type="hidden" name="id" id="adminID" value="">
                <select class="form-control" name="role" id="selectRole">
                    <option value="">Select Role</option>
                    <option value="0">New</option>
                    <option value="1">Super Admin</option>
                    <option value="2">Admin</option>
                </select>
           

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Role</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


@endsection

@section('script')
<script>
$(document).ready(function(){
      console.log("Getting");
    $(".admin-modal").on("click",function(){

      var id = $(this).data('id');
      var name =$(this).data('name');
      var role =$(this).data('role');
      console.log(id+name+role);
      $("#modalName").html(name);
      $("#selectRole").val(role);
      $("#adminID").val(id);

    });
})
</script>

    
@endsection