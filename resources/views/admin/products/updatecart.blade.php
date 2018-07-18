<div class="modal-dialog" role="document">
    <div class="modal-content">
        <form method="POST" action="{{route('admin.saveCartRqst')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-header">
                <h5 class="modal-title" style="color: #464646">Update Cart</h5>
            </div>
            <div class="modal-body">
                <img  style="display: none" id="cartloader" class="loader" src="{{ asset('public/assets/images/loader.svg') }}">
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
                    </tr>
                    @foreach($order as $ord)
                        <tr>
                            <td>
                                <div class="form-group col-md-12">

                                    <input name="productid[]" type="hidden" value="{{$ord->productid}}">
                                    <input name="userid[]" type="hidden" value="{{$ord->userid}}">
                                    <input type="text" name="orderproductname[]" class="form-control"
                                           aria-describedby="grpnameHelp"
                                           placeholder="Enter product name" value="{{$ord->name}}" required>
                                </div>
                            </td>
                            <td>
                                <div class="form-group col-md-12">

                                    <input type="price" name="price[]"  value="{{$ord->price}}"class="form-control" required>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    {{--<input type="hidden" value="{{$order->0->price}}">--}}

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeupdatecartup(this)" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>

    </div>
</div>






