@extends('backend.master')
@section('style')
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Project</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Project</li>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 text-left">
                                    <h3 class="card-title">Edit Project</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-info" href="{{route('project.index')}}">View List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="projectUpdateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="projectID" name="id" value="{{ $project->id }}">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="title">Title <small class="title-error text-danger error"></small></label>
                                    <input type="text" required name="title" value="{{ $project->title }}"
                                        class="form-control" id="title" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label for="category_id"> Category <small
                                            class="category_id-error text-danger error"></small></label>
                                    <div class="mb-3">
                                        <select class="form-control" name="category_id">
                                            <option value="0">Select Category</option>
                                            @if ($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        @if ($project->category_id == $category->id) selected @endif>
                                                        {{ $category->name }}</option>
                                                    @if (!empty($category->children))
                                                        @foreach ($category->children as $children)
                                                            <option value="{{ $children->id }}"
                                                                @if ($project->category_id == $children->id) selected @endif> -
                                                                {{ $children->name }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="client_name">Client Name <small class="client_name-error text-danger error"></small></label>
                                    <input type="text" required value="{{ $project->client_name }}" name="client_name"
                                        class="form-control" id="client_name">
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Start Date <small class="start_date-error text-danger error"></small></label>
                                    <input type="date" required name="start_date" value="{{ $project->start_date }}"
                                        class="form-control" id="start_date">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date <small class="end_date-error text-danger error"></small></label>
                                    <input type="date" required name="end_date" value="{{ $project->end_date }}"
                                        class="form-control" id="end_date">
                                </div>

                                <div class="form-group">
                                    <label for="budget">Budget <small class="budget-error text-danger error"></small></label>
                                    <input type="text" required name="budget" value="{{ $project->budget }}"
                                        class="form-control" id="budget" placeholder="Enter budget">
                                </div>

                                <div class="form-group">
                                    <label for="client_feedback">Client Feedback <small class="client_feedback-error text-danger error"></small></label>
                                    <textarea name="client_feedback" required class="form-control summernote" id="client_feedback" cols="30" rows="5"
                                        placeholder="Enter client feedback">{{ $project->client_feedback }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripton <small class="description-error text-danger error"></small></label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" required name="description" id="description" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $project->description !!}</textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">Image input <small class="image-error text-danger error"></small></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="inputImg" accept=".jpg, .jpeg, .png" name="image">
                                        </div>
                                    </div>
                                    <img style="height: 100px; width:100px" src="{{ asset('/') }}{{ $project->image }}"
                                        id="previewImg" alt="Preview">
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" @if ($project->status) checked @endif name="status"
                                        class="" id="status" value="1">
                                    <label for="status">Active <small class="status-error text-danger error"></small></label>
                                </div>

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



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <span class="esc-loading-button d-none">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </span>
                                    <span class="submit-btn">
                                        Update
                                    </span>
                                </button>
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
        $(document).ready(function() {

            $("#projectUpdateForm").on('submit', function(e) {
                e.preventDefault();
                var id = $("#projectID").val();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('project.update', $project->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find(".esc-loading-button").removeClass('d-none');
                        thisForm.find('button[type="submit"]').html('Updateing...');
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                        thisForm.find(".alert-success").removeClass('d-none');
                        thisForm.find(".alert-danger").removeClass('d-none');
                        thisForm.find(".alert-success").addClass('d-none');
                        thisForm.find(".alert-danger").addClass('d-none');
                        thisForm.find('.error').text('');
                    },
                    success: function (response) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').html('Updated');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-success").removeClass('d-none');
                        toastr.success(response.message);

                        setTimeout(function() {
                            location.href = "{{route('project.index')}}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find('button[type="submit"]').html('Update');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-danger").removeClass('d-none');

                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);

                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })
    </script>


    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#inputImg").change(function() {
            readURL(this);
        });
    </script>
@endsection
