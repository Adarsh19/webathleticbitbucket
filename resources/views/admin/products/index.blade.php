@extends('layouts.admin_layout')
@section('title','Products')
@section('style')
    <link rel="stylesheet" href="{{ asset('products/custom.css') }}">

    <style>
        .tooltipicons{
            position: absolute;
            right: 0;
            top: 0;
            color: red;
            font-size: 20px;
        }
        .imagesize_logo{
            height: 40px;
            width: 40px;
        }
        .color-cus-black{color:#000}
        .margintop{margin-top: 10px;}
        .setdefult{
            float: left;
            line-height: 35px;
            margin-right: 10px;
        }


    </style>
    <style>


        /*  bhoechie tab */
        div.bhoechie-tab-container{
            z-index: 10;
            background-color: #ffffff;
            padding: 0 !important;
            border-radius: 4px;
            -moz-border-radius: 4px;
            border:1px solid #ddd;
            /*margin-top: 20px;*/
            /*margin-left: 50px;*/
            -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
            box-shadow: 0 6px 12px rgba(0,0,0,.175);
            -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
            background-clip: padding-box;
            /*opacity: 0.97;*/
            filter: alpha(opacity=97);
        }
        div.bhoechie-tab-menu{
            padding-right: 0;
            padding-left: 0;
            padding-bottom: 0;
        }
        div.bhoechie-tab-menu div.list-group{
            margin-bottom: 0;
        }
        div.bhoechie-tab-menu div.list-group>a{
            margin-bottom: 0;
        }
        div.bhoechie-tab-menu div.list-group>a .glyphicon,
        div.bhoechie-tab-menu div.list-group>a .fa {
            color: #00c0ef;
        }
        div.bhoechie-tab-menu div.list-group>a:first-child{
            border-top-right-radius: 0;
            -moz-border-top-right-radius: 0;
        }
        div.bhoechie-tab-menu div.list-group>a:last-child{
            border-bottom-right-radius: 0;
            -moz-border-bottom-right-radius: 0;
        }
        div.bhoechie-tab-menu div.list-group>a.active,
        div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
        div.bhoechie-tab-menu div.list-group>a.active .fa{
            background-color: #00c0ef;
            background-image: #00c0ef;
            color: #ffffff;
        }
        div.bhoechie-tab-menu div.list-group>a.active:after{
            content: '';
            position: absolute;
            right: 100%;
            top: 50%;
            margin-top: -13px;
            border-left: 0;
            border-bottom: 13px solid transparent;
            border-top: 13px solid transparent;
            border-right: 10px solid #00c0ef;
        }

        div.bhoechie-tab-content{
            background-color: #ffffff;
            /* border: 1px solid #eeeeee; */
            padding-left: 20px;
            padding-top: 10px;
        }

        div.bhoechie-tab div.bhoechie-tab-content:not(.active){
            display: none;
        }
        .list-group-item.active, .list-group-item.active:focus, .list-group-item.active:hover{
            border-color: #00c0ef;
        }

        .modal-backdrop {
            z-index: 1040 !important;
        }
        .modal-dialog {
            margin: 2px auto;
            z-index: 1100 !important;
        }
        .modal-backdrop {
            z-index: -1;
        }
        #amountvalue{

            font-size: 40px !important;
        }
    </style>
@endsection
@section('content')



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Products</h2>
            @include('admin.includes.header')
        </header>






        <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="/admin/dashboard" style="text-decoration: none;color: #5c5757;"><i
                                class="fa fa-superpowers active"></i>&nbsp; Products</a></li>
            </ol>
        </section>




        {{--inside row tag content here--}}

        <div class="row">

                @include('admin.products.droparea')



            <div class="col-md-9">
            <div class="exerciseView">

                <div class="tabs">
                    <ul class="nav nav-tabs tabs-primary justify-content-end">


                        @if(!strlen(Request::segment(4)))
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="modal" data-target="#productModal" href="#productModal"
                                   data-toggle="tab">Add Product </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#groupModal" href="#groupModal"
                                   data-toggle="tab">Add Group </a>
                            </li>

                        @elseif(Request::segment(4)=="product-group")

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('admin.productsRqst',Request::segment(3))}}"
                                   ><i class="fa fa-arrow-circle-left"></i> Back </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="modal" data-target="#productModal" href="#productModal"
                                   data-toggle="tab">Add Product </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#groupModal" href="#groupModal"
                                   data-toggle="tab">Add Group </a>
                            </li>



                        @elseif(Request::segment(4)=="product-sub-group")


                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.showSubGroupRqst',[Request::segment(3),$group->slug]) }}"
                                   ><i class="fa fa-arrow-circle-left"></i> Back </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="modal" data-target="#productModal" href="#productModal"
                                   data-toggle="tab">Add Product </a>
                            </li>


                        @endif
                            <li class="nav-item ">
                                {{--<a  onclick="showpredefinedview('{{$user->id}}')" class="nav-link" href="#popular7" data-toggle="tab"> Opgeslagen schema’s </a>--}}
                                <a href="{{route('admin.viewOrdersRequest',$user->id)}}"
                                   class="nav-link"> Verkopen  </a>
                            </li>
                        @if(\Illuminate\Support\Facades\Auth::user()->role=="admin")
                            <li class="dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i
                                            class="fa fa-search"></i> Seach By Company <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($companies as $company)
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{route('admin.productsRqst',$company->user_id)}}">{{$company->company_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content" style="position: absolute;width: 98%;">
                        <div  class="tab-pane active">

                            <p>
                            @if(Request::segment(4)=="product-group")
                            <h2 class="card-title">You are in Group: {{$group->name}}</h2>
                            @elseif(Request::segment(4)=="product-sub-group")
                            <h2 class="card-title">You are in Sub Group: {{$subgroup->name}}</h2>
                            @else
                            <h2 class="card-title">Manage products</h2>
                            @endif
                                <div class="appendgrid">
                                @include('admin.products.products_grid_view')
                                </div>
                            </p>
                        </div>

                    </div>
                </div>






                {{--<header class="card-header">--}}
                    {{--<div class="card-actions">--}}

                        {{--<form action="#" method="post" class="setdefult" id="default-setting-form">--}}
                            {{--{{csrf_field()}}--}}
                            {{--<input type="hidden" name="group_path" value="{{Request::path()}}">--}}
                        {{--<div class="checkbox-custom checkbox-default  ">--}}
                            {{--<input type="checkbox" @if(Request::path()==$user->products_default_setting) checked @endif id="checkboxExample1" onchange="saveDefaultGroup(this)">--}}
                            {{--<label for="checkboxExample1">Set as Defult</label>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                        {{--@if(!strlen(Request::segment(4)))--}}
                            {{--<button class="btn btn-default" href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-plus"></i> Add Product</button>--}}
                            {{--<button class="btn btn-default" href="#" data-toggle="modal" data-target="#groupModal"><i class="fa fa-plus"></i> Add Group</button>--}}
                        {{--@elseif(Request::segment(4)=="product-group")--}}

                            {{--<button class="btn btn-default " onclick="location.href = '{{route('admin.productsRqst',Request::segment(3))}}';" ><i class="fa fa-arrow-circle-left"></i> Back</button>--}}
                            {{--<button class="btn btn-default"  href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-plus"></i> Add Product</button>--}}
                            {{--<button class="btn btn-default"  href="#" data-toggle="modal" data-target="#groupModal"><i class="fa fa-plus"></i> Add Sub Group</button>--}}


                        {{--@elseif(Request::segment(4)=="product-sub-group")--}}
                            {{--<button class="btn btn-default "  onclick="location.href = '{{ route('admin.showSubGroupRqst',[Request::segment(3),$group->slug]) }}';"><i class="fa fa-arrow-circle-left"></i> Back</button>--}}
                            {{--<button class="btn btn-default"  href="#" data-toggle="modal" data-target="#productModal"><i class="fa fa-plus"></i> Add Product</button>--}}


                        {{--@endif--}}
                        {{--<a  href="{{route('admin.viewOrdersRequest',$user->id)}}"><i class="fa fa-eye"></i>Verkopen</a>--}}

                        {{--@if($user->role=="admin")--}}
                            {{--<a  href="#"><i class="fa fa-eye"></i>Companies--}}
                            {{--<ul class="dropdown">--}}
                                {{--<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"><i--}}
                                            {{--class="fa fa-search"></i> Seach By Company <span--}}
                                            {{--class="caret"></span></a>--}}
                                {{--<ul class="dropdown-menu" role="menu">--}}
                                    {{--@foreach($companies as $company)--}}
                                        {{--<li>--}}
                                            {{--<a class="dropdown-item"--}}
                                               {{--href="{{route('admin.exercisesViewRqst',$company->user_id)}}">{{$company->name}}</a>--}}
                                        {{--</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</ul>--}}
                            {{--</a>--}}
                        {{--@endif--}}


                    {{--</div>--}}

                    {{--@if(Request::segment(4)=="product-group")--}}
                        {{--<h2 class="card-title">You are in Group: {{$group->name}}</h2>--}}
                    {{--@elseif(Request::segment(4)=="product-sub-group")--}}
                        {{--<h2 class="card-title">You are in Sub Group: {{$subgroup->name}}</h2>--}}
                        {{--@else--}}
                        {{--<h2 class="card-title">Manage products</h2>--}}
                    {{--@endif--}}
                     {{--</header>--}}
                {{--<div class="appendgrid">--}}
                    {{--@include('admin.products.products_grid_view')--}}
                {{--</div>--}}
            </div>
            </div>


            <div class="modal fade" id="updateorderboxModal2" tabindex="-2" role="dialog" aria-hidden="true">

            </div>

        </div>


    </section>




@endsection
@section('site_scripts')
    <script type="text/javascript" src="{{asset('products/shopcart.js')}}"></script>
    <script>

var companyid='{{Request::segment(3)}}';

        $(document).ready(function () {


            var data_transfer="";
            $('#shopcart')
                    .bind('dragover', function (evt) {
                        evt.preventDefault();


                        if($('.userbar').html()=="lease select User"){
                            alert("Please select user first");

                        }
                    })
                    .bind('dragenter', function (evt) {
                        evt.preventDefault();
                    })
                    .bind('drop', function (evt) {


                        //var userid=$('#user-id').val();


//                        console.log(data_transfer.product_id);
//                        var productid=evt.dataTransfer.getData('product_id');


//                        console.log(data_transfer);
                        var productid=data_transfer;

                        createOrder(productid)




                        evt.stopPropagation();
                        return false;
                    });


            $('.itempro')
                    .bind('dragstart', function (e) {
                        data_transfer=this.id;
                        console.log(this.id);
                        //evt.dataTransfer.setData('product_id', this.id);
//                        console.log(this.id);
//                        evt.dataTransfer.setData('price', $("#"+this.id).find('.pforprice').html());
//                        evt.dataTransfer.setData('tax', $("#"+this.id).find('.tax').html());
//                        console.log("drahsatt");
//                        //evt.dataTransfer.setData('productid', $("#"+this.id).find('.pforprice').html());
//                        //$('h2').fadeIn('fast');
                    })
                    .hover(
                    function () {
                        $('div', this).fadeIn();
                    },
                    function () {
                        //$('div', this).fadeOut();
                    }
            );


//            comment
            $(".searchbaruder").keyup(function () {
                if ($(".searchbaruder").val().trim().length == 0) {
                    return;
                }
                $('.searchresultsbox_results').show();

                var keyword = $(this).val();
                var url = "{{ route('admin.products.searchuser','keyword') }}";
                url = url.replace("keyword", keyword);
                console.log(url);
                $.ajax({
                    url: url,
                    method: "GET",
                    dataType: "html",
                    success: function (data) {
                        $('.searchresultsbox_results').html(data);

                    }
                });

            });

            loaduserbarproducts(companyid);


        });

        $(function(){


        });


        function createOrder(productid){

            var userid=$('.userbar_products .userids').val();
            var url=BASE_URL+"/admin/products/createorder/"+userid+"/"+productid;
            $.ajax({
                url: url,
                method: "GET",
                dataType: "json",
                success:function(data){

                    if( typeof data.orderid !== 'undefined') {
                        $('#orderid').val(data.orderid);
                        loadlistproducts(userid);
                        $('.updateOrder').show();

                    }else{

                        var notice = new PNotify({
                            title: "Warning",
                            text: data.message,
                            addclass: 'notification-dark stack-bar-bottom',
                            icon: 'fa fa-user',
                            type:"warning",
                            // stack: 'stack_bar_bottom',
                            'delay' : 1000,
                            hide: true,
                            width: "70%"
                        });


//                        $('.flash-message').show();
//                        $('.flash-message').html('<p class="alert alert-warning"> '+data.message+' <a href="#" class="close" onclick="clickclose()" data-dismiss="alert" aria-label="close">&times;</a></p>');
//                        function clickclose() {
//                            $('flash-message').hide();
//                        }
                    }
                }
            });

        }




//        window.onscroll = function () {
//            myFunction()
//        };
//
//
//
//
//        function myFunction() {
//            if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
//                $("#shopcart").addClass("markfixed");
//            } else {
//                $("#shopcart").removeClass("markfixed");
//            }
//        }


    </script>

@endsection
@section('scripts')
@endsection