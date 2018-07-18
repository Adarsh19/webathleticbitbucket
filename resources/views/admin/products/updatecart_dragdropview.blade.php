{{--<ul>--}}


    {{--@foreach($ordersdrop as $order)--}}
        {{--<li><span class="price">${{$order->price}} (+{{ $order->tax }})</span><span class="quantity">{{$order->quantity}}</span>{{$order->name}}</li>--}}
    {{--@endforeach--}}
    {{----}}
    {{----}}
    {{----}}
    {{----}}
{{--</ul>--}}




    @foreach($ordersdrop as $order)

        <section class="toggle">
            <label>

                <div>
                    <?php
                    $tax_amount=$order->price * ($order->tax/100);
                    ?>
                <span class="text price"><i class="fa fa-eur"></i> {{$order->price - $tax_amount}} ({{ round($order->tax, 0) }} %)</span>
                <small class="label label-danger quantity"> {{$order->quantity}} </small>  &nbsp;&nbsp;<span>  {{$order->name}}</span>
                </div>
                <div class="tools pull-right tooltipicons">
                    <i class="fa fa-edit" data-toggle="modal" data-target="#edit-cartitem-modal-{{$order->productid }}"></i>
                    <i class="fa fa-trash-o" data-toggle="modal" data-target="#delete-cartitem-modal-{{$order->productid}}"></i>
                </div>
            </label>



        </section>


    {{--<li>--}}
        {{--<!-- drag handle -->--}}
                      {{--<span class="handle ui-sortable-handle">--}}
                        {{--<i class="fa fa-ellipsis-v"></i>--}}
                        {{--<i class="fa fa-ellipsis-v"></i>--}}
                      {{--</span>--}}

        {{--<!-- todo text -->--}}
        {{--<span class="text price">${{$order->price}} (+{{ $order->tax }})</span>--}}
        {{--<!-- Emphasis label -->--}}
        {{--<small class="label label-danger quantity"><i class="fa fa-clock-o"></i> {{$order->quantity}} </small>  &nbsp;&nbsp;<span>  {{$order->name}}</span>--}}
        {{--<!-- General tools such as edit or delete-->--}}
        {{--<div class="tools">--}}
            {{--<i class="fa fa-edit" data-toggle="modal" data-target="#edit-cartitem-modal-{{$order->productid }}"></i>--}}
            {{--<i class="fa fa-trash-o" data-toggle="modal" data-target="#delete-cartitem-modal-{{$order->productid}}"></i>--}}
        {{--</div>--}}
    {{--</li>--}}

        <div id="delete-cartitem-modal-{{$order->productid}}" class="modal modal-danger fade" style="color: #000">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">
							<span class="fa-stack fa-sm">
								<i class="fa fa-square-o fa-stack-2x"></i>
								<i class="fa fa-trash fa-stack-1x"></i>
							</span>
                            Are you sure want to delete this ?
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <form method="post" role="form" id="delete_form" action=" {{ route('admin.deleteCartItemRqst',$order->productid ) }}">
                            {{csrf_field()}}
                            <input type="hidden" name="userid" value="{{$order->userid}}">
                            <input type="hidden" name="orderid" value="{{$order->orderid}}">
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-outline">Delete</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div id="edit-cartitem-modal-{{$order->productid}}" class="modal modal-info fade">
        <div class="modal-dialog" role="document">


            <div class="modal-content">
                <form method="POST" action="{{route('admin.editCartItemRqst',$order->productid)}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="userid" value="{{$order->userid}}">
                    <input type="hidden" name="orderid" value="{{$order->orderid}}">
                    <div class="modal-header">
                        <h5 class="modal-title" style="color: #464646">Update Cart item</h5>
                    </div>
                    <div class="modal-body">
                        <table class="tile_info">
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-group col-md-12 " style="color: black">
                                        <label for="videoname">Product name</label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group col-md-12" style="color: black">
                                        <label for="price">Product Price</label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group col-md-12" style="color: black">
                                        <label for="price">Quantity</label>

                                    </div>
                                </td>
                            </tr>
                                <tr>
                                    <td>
                                        <div class="form-group col-md-12">

                                            <input type="text" name="name" class="form-control"
                                                   aria-describedby="grpnameHelp"
                                                   placeholder="Enter product name" value="{{$order->name}}" required>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-md-12">
                                            <input type="price" name="price"  value="{{$order->price}}"class="form-control" required>
                                             </div>
                                    </td>
                                    <td>
                                        <div class="form-group col-md-12">
                                            <input type="price" name="quantity"  value="{{$order->quantity }}"class="form-control" required>


                                        </div>
                                    </td>
                                </tr>


                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>

            </div>
        </div>
        </div>









    @endforeach


