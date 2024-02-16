@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Blog Post </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Blog Post</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="card">
                            <div class="card-body">

                                <form id="myForm" action="{{ route('update.blog.post') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $blogPost->id }}">
                                    <input type="hidden" name="old_image" value="{{ $blogPost->post_image }}">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Category Name:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                             <select name="category_id" class="form-select" id="inputVendor">
                                                <option></option>
                                                @foreach ($blogCategories as $cat)
                                                    <option value="{{ $cat->id }}" {{ $cat->id == $blogPost->category_id? 'selected' : '' }}>{{ $cat->blog_category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Post Title:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input id="categoryTitle" type="text" value="{{ $blogPost->post_title }}" name="post_title" class="form-control" />
                                        </div>
                                    </div>

                                    <div class=" row form-group mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Post Short Description:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                           <textarea name="post_short_description" class="form-control" id="inputProductDescription" rows="3">{{ $blogPost->post_short_description }}</textarea>
                                        </div>
                                        
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Post Long Description:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                           <textarea id="mytextarea" name="post_long_description">{!! $blogPost->post_long_description !!}</textarea>
                                        </div>
                                        
                                    </div>


                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Blog Post Image:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary form-group">
                                            <input name="post_image" type="file" class="form-control" id="image" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ asset($blogPost->post_image) }}" alt="image" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-3" value="Save Changes" />
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    category_id: {
                        required: true,
                    },
                    post_title: {
                        required: true,
                    },
                    post_short_description: {
                        required: true,
                    },
                    post_long_description: {
                        required: true,
                    },
                },
                messages: {
                    category_id: {
                        required: 'Please Select Blog Category Name',
                    },
                    post_title: {
                        required: 'Please Enter Blog Post Title.',
                    },
                    post_short_description: {
                        required: 'Please Enter Short Description.',
                    },
                    post_long_description: {
                        required: 'Please Enter Long Description.',
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        })
    </script>
@endsection
