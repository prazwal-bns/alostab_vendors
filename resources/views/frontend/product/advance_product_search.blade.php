<style type="text/css">
    body {}

    .card {
        background-color: #fff;
        padding: 15px;
        border: none;
    }

    .input-box {
        position: relative;
    }

    .input-box i {
        position: absolute;
        right: 13px;
        top: 15px;
        color: #ced4da;
    }

    .form-control {
        height: 50px;
        background-color: #eeeeee69;
    }

    .form-control:focus {
        background-color: #eeeeee69;
        box-shadow: none;
        border-color: #eee;
    }

    .list {
        padding-top: 20px;
        padding-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .border-bottom {
        border-bottom: 2px solid #eee;
    }

    .list i {
        font-size: 19px;
        color: red;
    }

    .list small {
        color: #dedddd;
    }
</style>

@if ($products->isEmpty())
    <h6 class="text-center mt-2" style="text-align: left; color:red;">0 items found for "{{ $item }}"</h6>
@endif


<div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @foreach ($products as $product)
                    <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                        <div class="list border-bottom">
                            <img src="{{ asset($product->product_thumbnail) }}" width="60" alt="product_img">

                            <div class="d-flex flex-column ml-5" style="margin-left:10px; font-size:16px; font-weight: bolder;">
                                <span>{{ $product->product_name }}</span> <small style="color: rgb(142, 142, 142);">Rs. {{ $product->selling_price }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
