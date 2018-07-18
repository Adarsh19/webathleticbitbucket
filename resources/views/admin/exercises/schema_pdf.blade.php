@extends('layouts.admin_layout')
@section('title','Products')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('exercises/print.css') }}" media="print">

    <style>
        .tab-det td{   border: 1px solid #d9dee4}
        .cu-top-margin{margin-top: 10px;}
        .tile-bg{background: #ECEDF0;cursor: move}
        .attachment-img{
            width: 214px;
            height: 150px;
            object-fit: cover !important;}
        .tablewidth{width: 100%;
            margin: 0 auto;}
        .company-logo{width:150px;}
        .cus-pad{width: 100%;}
        .cus-pad td{padding: 5px;}


        .grid {
            position: relative;
        }
        .item {
            display: block;
            position: absolute;
            width: 100%;
            /*height: 100px;*/
            margin: 5px;
            z-index: 1;
            /*background: #fff;*/
            /*color: #fff;*/
        }
        .item.muuri-item-dragging {
            z-index: 3;
        }
        .item.muuri-item-releasing {
            z-index: 2;
        }
        .item.muuri-item-hidden {
            z-index: 0;
        }
        .item-content {
            position: relative;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection
@section('content')



    <section service="main" class="content-body">

        <header class="page-header">
            <h2>Schedule pdf</h2>
            @include('admin.includes.header')
        </header>




        <section class="content-header">
            <ol class="breadcrumb" style="padding: 40px 0 10px 0;font-size: 17px;">
                <li><a href="#" style="text-decoration: none;color: #5c5757;"><i class="fa fa-grav active"></i>&nbsp; Schema schedule</a></li>
            </ol>
        </section>



        <div id="DivIdToPrint">


        {{--inside row tag content here--}}
        <div class="row">
            <div class="col-lg-12  col-sm-12 col-xs-12">



                @foreach($schemas as $key=>$schema)


                    @if($key==0)
                    <div class="col-lg-12">
                        <div class="box box-solid">

                            <div class="box-body">

                                <div class="row">

                                    <table class="cus-pad">
                                        <tr>
                                            <td>
                                                <img  class="company-logo" src="{{ asset('public/sites_images/'.$schema['company_logo'])}}" alt="image" onerror=this.src="{{ asset('images/vplogo.png')}}" />
                                                <h5 class="profile-username text-center">{{ $schema['company_name'] }}</h5>
                                            </td>
                                            <td>
                                                <h5>
                                                Name:
                                                    @foreach($users as $user)
                                                        <span class="badge badge-primary">{{ $user->name }}</span>

                                                    @endforeach
                                                    <br></h5>
                                                {{--<h5>Duration: <a >8 weeks</a></h5>--}}

                                            </td>
                                            <td>
                                                {{--<h5>Goal:  Thy</h5>--}}
                                                {{--<h5>Equipment: press</h5>--}}

                                            </td>
                                            <td>
                                                <h5>Starts on:  {{ $schema['startdate']  }}</h5>
                                                {{--<h5>Coach: press</h5>--}}
                                            </td>
                                        </tr>
                                    </table>

                                </div>

                            </div>
                        </div>
                    </div>








                    <div class="grid row show-grid grid{{$schema['company_name']}}"  >
                        @endif



                        <div class="cu-top-margin tile-bg item" style="page-break-after:always !important;">
                            <div class="item-content">
                                <div class="box-header with-border" style="background-color: #f39c12 !important;padding: 1px 6px 1px 10px;
    color: white;">


                                    <h3 class="box-title">{{ $schema['ex_name'] }}</h3>
                                </div>
                                <!-- /.box-header -->
                                <table class="tablewidth">
                                    <tr>
                                    <td>
                                        <div class="box box-solid">

                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <img class="attachment-img" src="{{ asset('admin/images/groups/exercises/'.$schema['imagepath'])}}" alt="image" onerror=this.src="{{ asset('images/vplogo.png')}}" />




                                            </div>
                                            <div>barcode here</div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </td>
                                    <td>
                                        <div class="box box-solid">

                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <table class="table table-responsive-md mb-0 tab-det" style="width: 100%; ">

                                                    <tbody>

                                                    <?php

                                                    $length=count(json_decode($schema['ex_meta'], true));
                                                    $metaArr=json_decode($schema['ex_meta'], true);


                                                    ?>

                                                    @if( $length)
                                                        @foreach($metaArr as $ko=>$meta)

                                                            @if($ko==$length-1)
                                                                <?php continue ?>
                                                            @endif
                                                            <tr @if($ko == $length-1) id ="addRow" @endif>
                                                                @foreach($meta as $key=>$cell)
                                                                    @if($key==0)
                                                                        <td>{{ $cell }}</td>
                                                                    @else
                                                                        <td><input type="text" class="form-control"  value="{{ $cell }}"> </td>
                                                                    @endif
                                                                @endforeach

                                                            </tr>


                                                        @endforeach
                                                        <tr>
                                                            <td>Note</td>
                                                            <?php
                                                            $note=$metaArr[$length-1][1];
                                                            ?>
                                                            <td colspan="{{$schema['reps']}}" ><input  value="{{ $note }}" type="text" name="note" class="form-control"> </td>
                                                        </tr>
                                                    @endif

                                                </table>

                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                        <!-- /.box -->
                                    </td>
                                    </tr>
                                </table>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>


                        @if($key==0)
                    </div>
                    @endif
                @endforeach









                <!-- /.row -->
            </div>
            <div class="row col-lg-12">
                <div> <button  onclick="window.print()" id="btnPrint" type="button"  class="btn btn-success pull-right"> <i class="fa fa-print"></i> Print</button></div>

            </div>

        </div>
        </div>

    </section>



@endsection
@section('site_scripts')
    <script type="text/javascript" src="{{asset('admin_files/vendor/jquery-ui/jquery-ui.min.js')}}"></script>

    <script src="{{asset('exercises/hammer-2.0.8.min.js')}}"></script>
    <script src="{{asset('exercises/muuri.js')}}"></script>
<script>
    function printDiv()
    {

        var divToPrint=document.getElementById('DivIdToPrint');

        var newWin=window.open('','Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

        newWin.document.close();

        setTimeout(function(){newWin.close();},10);

    }



    initGrid();
    function initGrid() {
        var grid = new Muuri('.grid', {
            dragEnabled: true,
            layoutOnInit: false
        }).on('move', function () {
            saveLayout(grid);
        });

        var layout = window.localStorage.getItem('layout');
        if (layout) {
            loadLayout(grid, layout);
        } else {
            grid.layout(true);
        }
    }

    function serializeLayout(grid) {
        var itemIds = grid.getItems().map(function (item) {
            return item.getElement().getAttribute('data-id');
        });
        return JSON.stringify(itemIds);
    }

    function saveLayout(grid) {
        var layout = serializeLayout(grid);
        window.localStorage.setItem('layout', layout);
    }

    function loadLayout(grid, serializedLayout) {
        var layout = JSON.parse(serializedLayout);
        var currentItems = grid.getItems();
        var currentItemIds = currentItems.map(function (item) {
            return item.getElement().getAttribute('data-id')
        });
        var newItems = [];
        var itemId;
        var itemIndex;

        for (var i = 0; i < layout.length; i++) {
            itemId = layout[i];
            itemIndex = currentItemIds.indexOf(itemId);
            if (itemIndex > -1) {
                newItems.push(currentItems[itemIndex])
            }
        }

        grid.sort(newItems, {layout: 'instant'});
    }


</script>





@endsection
@section('scripts')
@endsection
