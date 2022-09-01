@extends('backend.master')

@section('content')




    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FAQ view</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">FAQ view</li>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">View Faq</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-info" href="{{ route('faq.create') }}">Create New</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <div class="alert alert-danger alert-dismissible d-none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-info"></i> Error!</h5>
                                <small class="alert-message">Something went wrong. Please try again...</small>
                            </div>

                            <div class="alert alert-success alert-dismissible d-none">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <small class="alert-message"><i class="fa fa-spinner fa-spin"></i> Redirecting to listing page...</small>
                            </div>



                            <table  id="esDatatable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($faqs)
                                        @foreach ($faqs as $key => $faq)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $faq->question }}</td>
                                                <td>
                                                    {!! $faq->answer !!}
                                                </td>

                                                <td>
                                                    @if ($faq->status == 0)
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @elseif($faq->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    <a class="btn btn-info"
                                                        href="{{ route('faq.edit', $faq->id) }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>

                                                    <form style="display: inline-block" class="deleteFaqForm"  method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <input type="hidden" class="deleteId" name="id" value="{{ $faq->id }}">
                                                        <input type="hidden" class="deleteUrl" name="url" value="{{route('faq.destroy', $faq->id)}}">
                                                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

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





@endsection

@section('script')

<script>
    $(document).on('submit', '.deleteFaqForm', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        let deleteUrl = $(this).find('.deleteUrl').val();
        let thisForm = $(".card-body");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: deleteUrl,
                    data: formData,
                    beforeSend: function() {
                        thisForm.find(".alert-success").removeClass('d-none');
                        thisForm.find(".alert-danger").removeClass('d-none');
                        thisForm.find(".alert-success").addClass('d-none');
                        thisForm.find(".alert-danger").addClass('d-none');
                    },
                    success: function(response) {
                        thisForm.find(".alert-success").removeClass('d-none');

                        toastr.success(response.message);

                        setTimeout(function() {
                            location.reload();
                        }, 3000)

                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".alert-danger").removeClass('d-none');
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                })


            }
        });


    });
</script>
@endsection
