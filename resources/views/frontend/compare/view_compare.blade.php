@extends('frontend.master_dashboard')
@section('main')

@section('title')
    Compare | Product  
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Compare
        </div>
    </div>
</div>
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <h1 class="heading-2 mb-10">Products Compare</h1>
            <h6 class="text-body mb-40">There are <span class="text-brand" id="compareAmt"></span> products to compare</h6>
            <div class="table-responsive">
                <table class="table text-center table-compare" style="border: 1px solid rgb(108, 108, 108);">
                    <tbody id="compare" style="border: 1px solid black;">
                        
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>
</div>
@endsection
   