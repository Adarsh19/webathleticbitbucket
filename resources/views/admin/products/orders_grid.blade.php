
@if(count($orders))

  <div class="" >

      <h5 style="margin-left: 10px;" class="font-weight-semibold text-dark text-uppercase mb-3 mt-3">{{count($orders)}} Order Found</h5>
    @foreach($orders as $k=>$order)


        <div class="col-lg-4 col-xl-4 pull-left">

            <section class="card card-featured-left card-featured-primary mb-4">
                <input type="hidden" name="scheduleid" value="{{$order->id}}">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">{{$order->invoiceusername}} sd</h4>
                                <div class="info">
                                    <strong class="amount">{{ $order->invoiceamount }} $</strong>
                                    <span class="text-primary">Qty: {{ $order->quantity }}</span>
                                </div>
                                <div class="info">
                                    <span class="text-primary">Balance: {{ $order->balance }}</span>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase">{{$order->updated_at}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>



        {{--<div class="col-md-4 col-sm-4 col-xs-12">--}}
            {{--<div class="info-box schedulebox" style="height: 120px;"   id="scheduleid_{{$order->id}}">--}}
                {{--<span class="info-box-icon bg-aqua" style="height: 120px;"><i class="ion ion-ios-cart-outline"></i></span>--}}
                {{--<a href="#" class="pull-right btn-box-tool" data-toggle="modal" data-target="#editupdateschedule19"><i class="fa fa-edit"></i> Edit</a>--}}

                {{--<div class="info-box-content">--}}
                    {{--<input type="hidden" name="scheduleid" value="{{$order->id}}">--}}
                    {{--<span class="info-box-text">{{$order->invoiceusername}}</span>--}}
                    {{--<span class="info-box-text">Order Date <small class="--}}
                    {{--label pull-right bg-yellow">{{$order->updated_at}}</small></span>--}}

                        {{--<span class="info-box-text">Quantity--}}
                            {{--<small class=" pull-right">{{ $order->quantity }}</small>--}}
                       {{--</span>--}}
                      {{--<span class="info-box-text">Invoice Amount--}}
                            {{--<small class=" pull-right">{{ $order->invoiceamount }} $</small>--}}
                       {{--</span>--}}
                     {{--<span class="info-box-text">Balance--}}
                            {{--<small class=" pull-right">{{ $order->balance }} $</small>--}}
                       {{--</span>--}}





                {{--</div>--}}
                {{--<!-- /.info-box-content -->--}}
            {{--</div>--}}
            {{--<!-- /.info-box -->--}}

        {{--</div>--}}


@endforeach
</div>



<div class="modal fade" id="carosselModal" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog contenthere modal-lg" role="document" style="width: 80%">

    </div>
</div>
@else
    <h3>No Results Found</h3>
    @endif



