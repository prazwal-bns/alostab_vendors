@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Vendor Profile</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Active Vendor Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <form action="{{ route('inactive.vendor.approve') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$activeVendorDetails->id}}">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">User Name</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" disabled
                                                value="{{ $activeVendorDetails->username }}" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Name:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input name="name" type="text" class="form-control" value="{{ $activeVendorDetails->name }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Email:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="email" class="form-control" value="{{ $activeVendorDetails->email }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Phone:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="phone" class="form-control" value="{{ $activeVendorDetails->phone }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Address:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="address" class="form-control"
                                                value="{{ $activeVendorDetails->address }}" />
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Join Date:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="vendor_join" class="form-control"
                                                value="{{ $activeVendorDetails->vendor_join }}" />
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Info:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea class="form-control" id="inputAddress" name="vendor_short_info" placeholder="Vendor Info" rows="3" style="height: 118px;">{{ $activeVendorDetails->vendor_short_info }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Vendor Photo</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ !empty($activeVendorDetails->photo) ? url('upload/vendor_images/' . $activeVendorDetails->photo) : url('upload/no_image.jpg') }}" alt="image" style="width: 100px; height: 100px;">
                                        </div>
                                    </div>

                                    

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-danger px-3" value="Deactivate This Vendor" />
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
