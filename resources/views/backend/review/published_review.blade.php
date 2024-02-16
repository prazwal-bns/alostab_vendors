@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product Published Reviews</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Reviews</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example2" class="table table-striped table-hover table-bordered">
                    <thead style="background-color: #004c36; color: #fff;">
                        <tr>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Product</th>
                            <th>User</th>
                            <th>Comment</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($review as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><img src="{{ asset($item['product']['product_thumbnail']) }}" width="60" alt="product_img"></td>
                            <td>{{ Str::limit($item['product']['product_name'],25) }}</td>
                            <td>{{$item['user']['name']}}</td>
                            <td>{{ Str::limit($item->comment,25) }}</td>

                            <td>
                            @if($item->rating == NULL)
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            </td>

                            @elseif($item->rating == 1)
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>

                            @elseif($item->rating == 2)
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>

                            @elseif($item->rating == 3)
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-secondary"></i>
                            <i class="bx bxs-star text-secondary"></i>

                            @elseif($item->rating == 4)
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-secondary"></i>

                            @elseif($item->rating == 5)
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>

                            @endif
                            <td style="font-size: 18px">
                                @if($item->status==0)
                                    <span class="badge bg-danger">Pending</span>
                                @elseif($item->status ==1)                             
                                    <span class="badge bg-success">Published</span>
                                @endif
                            </td>
                            
                            <td>
                                <a href="{{ route('delete.review',$item->id) }}" id="delete" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
