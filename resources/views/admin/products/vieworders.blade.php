@extends('layouts.admin_layout')
@section('title','Products Orders')
@section('style')

    <style>
        .breadcrumextra{
            margin-top: 20px !important;;
            padding-left: 0px !important;}
        .customheight{height: 78px;}
    </style>
@endsection
@section('content')



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Orders</h2>
            @include('admin.includes.header')
        </header>






        <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="{{route('admin.productsRqst',Request::segment(4))}}" style="text-decoration: none;color: #5c5757;"><i
                                class="fa fa-superpowers "></i>&nbsp; Products</a></li>
                <li><a href="{{route('admin.viewOrdersRequest',Request::segment(4))}}" style="text-decoration: none;color: #5c5757;">   <i
                                class="fa fa-cart-arrow-down active"></i>&nbsp; Orders</a></li>
            </ol>
        </section>



        <!-- default / right -->
        <div class="row">

            <section class="card mb-12" style="width: 100%">
                <div class="card-body customheight">

                    <form method="post" action=""  class="searchform">
                    {{--<form method="post" action="{{route('admin.searchOrderRqst')}}"  class="searchform">--}}
                        {{ csrf_field() }}
                        <div class="form-group col-md-6 pull-left">

                            <label class="col-lg-3 control-label text-lg-left pt-2">Date range</label>
                            <div class="col-lg-9 pull-right">
                                <div class="input-daterange input-group daterange" data-plugin-datepicker data-date-format="yyyy-mm-dd">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
                                    <input required type="text" class="form-control" name="startdate" value="@if(strlen(Request::segment(5))>0) {{Request::segment(5)}} @else {{ \Carbon\Carbon::now()->format('Y-m-d') }} @endif">
                                    <span class="input-group-addon">to</span>
                                    <input required type="text" class="form-control" name="enddate"  value="@if(strlen(Request::segment(5))>0) {{Request::segment(6)}} @else {{ \Carbon\Carbon::now()->format('Y-m-d') }} @endif">
                                </div>
                            </div>
                        </div>



                        <div class="form-group col-md-6 pull-right">
                            <div class="input-group">
                                <input type="text" class="form-control" value="{{Request::segment(7)}}" placeholder="e,g, username,invoice status " name="keyword" >
										<span class="input-group-btn">
											<button class="btn btn-primary p-2" type="button" onclick="searchOrders({{Request::segment(4)}})">Search</button>
										</span>
                            </div>
                        </div>

                    </form>
                </div>
            </section>

            <div class="" >
                <div class="row">
                    @include('admin.products.orders_grid')

                </div>

                <div class="pagination mt-5">
                    {!! $orders->links('vendor.pagination.bootstrap-4')  !!}`
                </div>


                {{--<div class="pagination mt-5">--}}
                    {{--{!! $orders->appends(['oc' => '1'])->render() !!}`--}}
                {{--</div>--}}
            </div>



        </div>


    </section>

@endsection
@section('site_scripts')

    <script>

        function  searchOrders(companyid) {

            var start=$('input[name=startdate]').val();
            var end=$('input[name=enddate]').val();
            var keyword=$('input[name=keyword]').val();

            var url=BASE_URL+"/admin/products/view-orders/"+companyid+"/"+start+"/"+end+"/"+keyword;
            window.location = url;

        }
    </script>


@endsection
@section('scripts')
@endsection