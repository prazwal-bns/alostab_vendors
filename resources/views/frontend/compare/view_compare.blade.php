@extends('frontend.master_dashboard')
@section('main')
<style>
    .table-compare tr {
        border-bottom: 2px solid black; /* Add a border at the bottom of each table row */
    }

    .table-compare td {
    border: 2px solid black; /* Add a border at the bottom of each table row */
    }

    /* Optional: To remove border from the last row */
    .table-compare tr:last-child {
        border-bottom: none;
    }
</style>
<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
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
                <table class="table text-center table-compare" style="border: 3px solid black;">
                    <tbody id="compare" style="border: 2px solid black;">
                        
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </div>
</div>
@endsection
   