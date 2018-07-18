@extends('layouts.admin_layout')
@section('title','Products Orders')
@section('style')

    <style>
        .breadcrumextra{
            margin-top: 20px !important;;
            padding-left: 0px !important;}
    </style>
@endsection
@section('content')



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Orders</h2>
            @include('admin.includes.header')
        </header>




        <section class="content-header">
            <ol class="breadcrumb breadcrumextra">
                <li><a href="{{ route('admin.dashboardRoute') }}"><i class="fa fa-home"></i> Dashboard  </a></li>
                <li class="active"> &nbsp;> Products &nbsp;> &nbsp;</li>
                <li class="active">  orders </li>
            </ol>
        </section>



        <!-- default / right -->
        <div class="row">

            <section class="col-md-12 card mb-4">
                <div class="card-body">
                 <span><i class="fa fa-filter"></i> Choose Filter</span>
                    <form method="post" action="{{route('admin.searchOrderRqst')}}"  class="searchform">
                        {{ csrf_field() }}
                        <div class="form-group col-md-6 pull-left">

                            <label class="col-lg-3 control-label text-lg-left pt-2">Date range</label>
                            <div class="col-lg-9 pull-right">
                                <div class="input-daterange input-group" data-plugin-datepicker>
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
                                    <input type="text" class="form-control" name="startdate">
                                    <span class="input-group-addon">to</span>
                                    <input type="text" class="form-control" name="enddate">
                                </div>
                            </div>
                        </div>



                        <div class="form-group col-md-6 pull-right">
                            <div class="input-group">
                                <input type="text" class="form-control" value="" placeholder="e,g, username,invoice status " name="keyword">
										<span class="input-group-btn">
											<button class="btn btn-primary p-2" type="submit">Search</button>
										</span>
                            </div>
                        </div>

                    </form>
                </div>
            </section>

            <div class="col-md-12" >
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


@endsection
@section('scripts')
@endsection