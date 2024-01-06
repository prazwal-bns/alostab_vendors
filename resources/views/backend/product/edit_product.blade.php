@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add New Product</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add New Product</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Product</h5>
                <hr />

                <form id="myForm" method="post" action="{{ route('update.product', $products->id) }}">
                    @csrf

                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="border border-3 p-4 rounded">
                                    <div class="form-group mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Name</label>
                                        <input type="text" name="product_name" class="form-control"
                                            id="inputProductTitle" value="{{ $products->product_name }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Tags</label>
                                        <input type="text" name="product_tags" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_tags }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Size</label>
                                        <input type="text" name="product_size" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_size }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Product Color</label>
                                        <input type="text" name="product_color" class="form-control visually-hidden"
                                            data-role="tagsinput" value="{{ $products->product_color }}">
                                    </div>



                                    <div class="form-group mb-3">
                                        <label for="inputProductDescription" class="form-label">Short Description</label>
                                        <textarea name="short_desc" class="form-control" id="inputProductDescription" rows="5" style="height: 170px;">{{ $products->short_desc }}</textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Long Description</label>
                                        <textarea id="mytextarea" name="long_desc">{!! $products->long_desc !!}</textarea>
                                    </div>







                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="border border-3 p-4 rounded">
                                    <div class="row g-3">

                                        <div class="form-group col-md-6">
                                            <label for="inputPrice" class="form-label">Product Price</label>
                                            <input type="text" name="selling_price" class="form-control" id="inputPrice"
                                                value="{{ $products->selling_price }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputCompareatprice" class="form-label">Discount Price </label>
                                            <input type="text" name="discount_price" class="form-control"
                                                id="inputCompareatprice" value="{{ $products->discount_price }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputCostPerPrice" class="form-label">Product Code</label>
                                            <input type="text" name="product_code" class="form-control"
                                                id="inputCostPerPrice" value="{{ $products->product_code }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputStarPoints" class="form-label">Product Quantity</label>
                                            <input type="text" name="product_quantity" class="form-control"
                                                id="inputStarPoints" value="{{ $products->product_quantity }}">
                                        </div>


                                        <div class="form-group col-12">
                                            <label for="inputProductType" class="form-label">Product Brand</label>
                                            <select name="brand_id" class="form-select" id="inputProductType">
                                                <option></option>
                                                @foreach ($brands as $brand)
                                                    <option
                                                        value="{{ $brand->id }}"{{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputVendor" class="form-label">Product Category</label>
                                            <select name="category_id" class="form-select" id="inputVendor">
                                                <option></option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ $cat->id == $products->category_id ? 'selected' : '' }}>
                                                        {{ $cat->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label for="inputCollection" class="form-label">Product SubCategory</label>
                                            <select name="subcategory_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($subcategory as $subcat)
                                                    <option value="{{ $subcat->id }}"
                                                        {{ $subcat->id == $products->subcategory_id ? 'selected' : '' }}>
                                                        {{ $subcat->subcategory_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-12">
                                            <label for="inputCollection" class="form-label">Select Vendor</label>
                                            <select name="vendor_id" class="form-select" id="inputCollection">
                                                <option></option>
                                                @foreach ($activeVendor as $vendor)
                                                    <option value="{{ $vendor->id }}"
                                                        {{ $vendor->id == $products->vendor_id ? 'selected' : '' }}>
                                                        {{ $vendor->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-12">

                                            <div class="row g-3">

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="hot_deals" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->hot_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault"> Hot
                                                            Deals</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="featured" type="checkbox"
                                                            value="1" id="flexCheckDefault"
                                                            {{ $products->featured == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexCheckDefault">Featured</label>
                                                    </div>
                                                </div>




                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_offer"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ $products->special_offer == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Offer</label>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="special_deals"
                                                            type="checkbox" value="1" id="flexCheckDefault"
                                                            {{ $products->special_deals == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexCheckDefault">Special
                                                            Deals</label>
                                                    </div>
                                                </div>



                                            </div> <!-- // end row  -->

                                        </div>

                                        <hr>


                                        <div class="col-12">
                                            <div class="d-grid">
                                                <input type="submit" class="btn btn-success px-4"
                                                    value="Save Changes" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end row-->
                    </div>
            </div>

            </form>

        </div>

    </div>

    {{-- For Product Main Thumbnail Image --}}
    <div class="page-content">
        <h5 class="mb-0 text-uppercase">Update Thumbnail Iamge</h5>
        <hr>
        <div class="card">
            <form id="myForm" method="post" action="{{ route('update.product.thumbnail', $products->id) }}"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $products->id }}">
                <input type="hidden" name="old_img" value="{{ $products->product_thumbnail }}">
                <div class="card-body">
                    <div class="mb-3">
                        <label name="product_thumbnail" for="formFile" class="form-label">Select Product Thumbnail
                            Image:</label>
                        <input class="form-control" type="file" id="formFile" onChange="mainThamUrl(this)">
                    </div>
                    <div class="mb-3">
                        <img src="{{ asset($products->product_thumbnail) }}" id="mainThmb" width="100"
                            height="100" alt="">
                    </div>
                    <input type="submit" class="btn btn-success px-4" value="Save Changes" />
                </div>
            </form>
        </div>
    </div>
    {{-- End product Main Thumbnail --}}


    <!-- For Product Multi Image -->
    <div class="page-content">
        <h6 class="mb-0 text-uppercase">Update Multi Image </h6>
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table mb-0 table-striped">
                    <thead>
                        <tr>
                            <th scope="col">SN</th>
                            <th scope="col">Image</th>
                            <th scope="col">Select Image</th>
                            <th scope="col">Change Image </th>
                            <th scope="col">Delete </th>
                        </tr>
                    </thead>
                    <tbody>

                        <form method="post" action="{{ route('update.product.multiimage', ['id' => $products->id]) }}"
                            enctype="multipart/form-data">
                            @csrf

                            @foreach ($multiImgs as $key => $img)
                                <tr>
                                    {{-- <th scope="row">{{ $key + 1 }}</th>
                                    <td> <img src="{{ asset($img->photo_image) }}" style="width:70; height: 40px;"> </td>
                                    <td> <input type="file" class="form-control" name="multi_img[{{ $img->id }}]"></td>
                                    <td><input type="submit" class="btn btn-success px-4" value="Update Image " /></td> --}}


                                    <th scope="row">{{$key+1}}</th>
                                    <td><img id="displayImage{{$key}}" src="{{ asset($img->photo_image) }}" width="70" alt=""></td>
                                    <td><input class="form-control" type="file" name="multi_img[{{$img->id}}]" onchange="multiImgUrl(this, 'displayImage{{$key}}')"></td>
                                    <td><input type="submit" class="btn btn-success px-4" value="Update Image" /></td>

                                    <td><a href="{{ route('delete.multimg.product',$img->id) }}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a></td>
                                    </td>
                                </tr>
                            @endforeach

                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- End product Multi Image --}}


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    product_name: {
                        required: true,
                    },
                    short_desc: {
                        required: true,
                    },
                    product_thumbnail: {
                        required: true,
                    },
                    multi_img: {
                        required: true,
                    },
                    selling_price: {
                        required: true,
                    },
                    product_code: {
                        required: true,
                    },
                    product_qty: {
                        required: true,
                    },
                    brand_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    subcategory_id: {
                        required: true,
                    },
                },
                messages: {
                    product_name: {
                        required: 'Please Enter Product Name',
                    },
                    short_desc: {
                        required: 'Please Enter Short Description',
                    },
                    product_thumbnail: {
                        required: 'Please Select Product Thumbnail Image',
                    },
                    multi_img: {
                        required: 'Please Select Product Multi Image',
                    },
                    selling_price: {
                        required: 'Please Enter Selling Price',
                    },
                    product_code: {
                        required: 'Please Enter Product Code',
                    },
                    product_qty: {
                        required: 'Please Enter Product Quantity',
                    },
                    brand_id: {
                        required: 'Brand ID is Required',
                    },
                    category_id: {
                        required: 'Category ID is Required',
                    },
                    subcategory_id: {
                        required: 'Subcategory ID is Required',
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
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    {{-- For Multi Image 2nd code --}}
    <script type="text/javascript">
        function multiImgUrl(input, imgId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + imgId).attr('src', e.target.result).width(70).height(70);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>



    <script type="text/javascript">
        // Wait for the document to be fully loaded before executing the script
        $(document).ready(function() {
            // Attach a change event listener to the select element with the name "category_id"
            $('select[name="category_id"]').on('change', function() {
                // Get the selected value of the "category_id" select element
                var category_id = $(this).val();

                // Check if a category_id is selected (not null or empty)
                if (category_id) {
                    // If a category_id is selected, make an AJAX request to the server
                    $.ajax({
                        // Specify the URL for the AJAX request, including the selected category_id as part of the URL
                        url: "{{ url('/subcategory/ajax') }}/" + category_id,
                        // Specify the HTTP method for the AJAX request (GET in this case)
                        type: "GET",
                        // Specify the expected data type of the server response (JSON in this case)
                        dataType: "json",
                        // If the AJAX request is successful, execute the following code
                        success: function(data) {
                            // Clear the options of the "subcategory_id" select element
                            $('select[name="subcategory_id"]').html('');
                            var d = $('select[name="subcategory_id"]').empty();

                            // Iterate through each element in the received data
                            $.each(data, function(key, value) {
                                // Append an option element to the "subcategory_id" select element for each element in the data
                                $('select[name="subcategory_id"]').append(
                                    '<option value="' + value.id + '">' + value
                                    .subcategory_name + '</option>');
                            })
                        }
                    })
                } else {
                    // If no category_id is selected, show an alert with the message 'danger'
                    alert('danger');
                }
            })
        });
    </script>
@endsection
