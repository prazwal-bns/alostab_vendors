@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Brand </div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Brand</li>
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

                                <form id="myForm" action="{{ route('update.brand', $brand->id) }}" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="old_name" value="{{$brand->brand_image}}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h5 class="mb-0">Brand Name:</h5>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input id="brandTitle" type="text" name="brand_name" class="form-control" value="{{$brand->brand_name}}" />
                                            <span id="brand_error" class="text-danger"></span>
                                        </div>
                                    </div>
                            
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h5 class="mb-0">Photo:</h5>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="brand_image" type="file" class="form-control" id="image" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"></h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage"
                                                src="{{ asset($brand->brand_image) }}"
                                                alt="image" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-3" value="Update Brand" />
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

    <script>
        $(document).ready(function () {
            $('#myForm').submit(function (e) {
                e.preventDefault(); // Prevent the form from submitting by default
                
                // Get the value of the blog_category input
                var brandItem = $('#brandTitle').val().trim();
                
                // Check if the blog_category is empty
                if (brandItem === '') {
                    $('#brand_error').text('Brand Name cannot be empty.');
                } else {
                    // If not empty, remove any existing error message
                    $('#brand_error').text('');
                    
                    // Submit the form
                    this.submit();
                }
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
