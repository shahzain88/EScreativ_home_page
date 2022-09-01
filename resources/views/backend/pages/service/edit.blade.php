@extends('backend.master')
@section('style')
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Service</li>
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
                                    <h3 class="card-title">Edit Service</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-info" href="{{route('service.index')}}">View List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="serviceEditForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" required name="title" value="{{$service->title}}" class="form-control" id="title" placeholder="Enter title">
                                </div>

                                <div class="form-group">
                                    <label for="info">Short Information</label>
                                    <input type="text" required name="info" value="{{$service->info}}" class="form-control" id="info" placeholder="Enter info">
                                </div>

                                <div class="form-group">
                                    <label for="unit_price">Unit Price</label>
                                    <input type="text" required name="unit_price" value="{{$service->unit_price}}" class="form-control" id="unit_price" placeholder="Enter unit price">
                                </div>

                                <div class="form-group">
                                    <label for="category_id"> Category <small class="category_id-error text-danger error"></small></label>
                                    <div class="mb-3">
                                        <select class="form-control" name="category_id">
                                            <option value="0">Select Category</option>
                                            @if ($categories)
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" @if ($service->category_id == $category->id) selected @endif >{{$category->name}}</option>
                                                        @if (!empty($category->children))
                                                            @foreach ($category->children as $children)
                                                                <option value="{{$children->id}}" @if ($service->category_id == $children->id) selected @endif > - {{$children->name}}</option>
                                                            @endforeach
                                                        @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description">Short Descripton</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="description" required name="description" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->description !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="details_content">Details Content</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="details_content" required name="details_content" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->details_content !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="sales_point">Sales Point</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="sales_point" required name="sales_point" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->sales_point !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price_list">Price List</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="price_list" required name="price_list" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->price_list !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="work_content">Work Content</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="work_content" required name="work_content" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->work_content !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="flow_to_work">Flow to Work</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="flow_to_work" required name="flow_to_work" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->flow_to_work !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="before_booking">Before Booking</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="before_booking" required name="before_booking" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->before_booking !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cancellation_policy">Cancellation Policy</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="cancellation_policy" required name="cancellation_policy" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->cancellation_policy !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="about_the_store">About the store</label>
                                    <div class="mb-3">
                                        <textarea class="form-control summernote" id="about_the_store" required name="about_the_store" placeholder="Place some text here" rows="5"
                                            cols="30">{!! $service->about_the_store !!}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" @if ($service->status) checked @endif  name="status" class="" id="status" value="1">
                                    <label for="status">Active <small class="status-error text-danger error"></small></label>
                                </div>



                                <div class="form-group">
                                    <label for="inputImg">Feature Image <small class="feature_image-error text-danger error"></small></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="inputImg" accept=".jpg, .jpeg, .png" name="feature_image">
                                        </div>
                                    </div>
                                    <img style="height: 100px; width:100px" src="{{ asset('/') }}{{ $service->feature_image }}"
                                        id="previewImg" alt="Preview">
                                </div>

                                <div class="form-group">
                                    <label>More Images <small class="image-error text-danger error"></small></label>

                                    <div class="table-responsive">
                                        <table class="table">
                                                <tr>
                                                    <th>Upload</th>
                                                    <th>Preview</th>
                                                    <th class="text-center"><button title="Add Image" type="button" class="btn btn-success btn-sm add_new_image"><i class="fa fa-plus-circle"></i></button></th>
                                                </tr>

                                                @if ($service->images)
                                                    @foreach ($service->images as $serviceImg)
                                                        <tr class="service-img-{{$serviceImg->id}}">
                                                            <td><input type="file" disabled></td>
                                                            <td><img height="50" width="50"  src="{{asset("/"). $serviceImg->image}}" alt=""></td>
                                                            <td class="text-center"><button title="Remove Image" class="btn btn-sm btn-danger" onclick="removeServiceImg({{$serviceImg->id}})" type="button"><i class="fa fa-minus-circle"></i></button></td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                        </table>
                                    </div>

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
            $("#serviceEditForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('service.update', $service->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        thisForm.find(".esc-loading-button").removeClass('d-none');
                        thisForm.find(".slider-submit-btn").html('Updateing...');
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                        thisForm.find(".alert-success").removeClass('d-none');
                        thisForm.find(".alert-danger").removeClass('d-none');
                        thisForm.find(".alert-success").addClass('d-none');
                        thisForm.find(".alert-danger").addClass('d-none');
                        thisForm.find('.error').text('');
                    },
                    success: function (response) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find(".slider-submit-btn").html('Updated');
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        thisForm.find(".alert-success").removeClass('d-none');
                        toastr.success(response.message);

                        setTimeout(function() {
                            location.href = "{{route('service.index')}}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find(".esc-loading-button").addClass('d-none');
                        thisForm.find(".slider-submit-btn").html('Update');
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

        function removeServiceImg(id) {
            $.ajax({
                type: "GET",
                url: "{{ url('remove-service-image') }}/"+id,
                success: function(response) {
                    $('.service-img-'+id).remove();
                    toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                }
            })
        }

        $(document).on('click', '.add_new_image', function(e) {
            let table = $(this).parents('table');
            let next_item = table.find('tr').length + 1;
            let html = '';
            html += '<tr>';
                html += '<td ><input type="file" class="newInputImg" name="images[]"></td>';
                html += '<td ><img height="50" width="50" class="preview-'+next_item+'" src="{{asset("public/no_image_found.jpg")}}" alt=""></td>';
                html += '<td class="text-center"><button class="btn btn-sm btn-danger remove_table_row" type="button"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';
            table.append(html);
        })

        $(document).on('click', '.remove_table_row', function(e) {
            $(this).parents('tr').remove();
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

        $(document).on('change', '.newInputImg', function(e) {
            var findTr =  $(this).parents('tr').find('img');
          readNewURL(this, findTr)
        })


        function readNewURL(input, findTr) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    findTr.attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
