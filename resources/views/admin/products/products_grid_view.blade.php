<style>
    .cellmarginright{margin-right:50px}
    .variationbox{    height: 245px;
        padding: 18px;}
    .card-cus{
        width: 220px;
        height: 245px;
        float:left;
        margin-right: 5px;
    }
    .card-img{
        object-fit: cover !important;
        width: 100%; display: block;
    }
    .plusicon{
        cursor: pointer;
        font-size: 44px;
        color: #fff !important;
    }
    .multipleproduct{
        position: absolute;top:0;
        z-index: 100000;;
        background: white;
        display: none;
    }
</style>
@if(!strlen(Request::segment(3)))

<div class="">

                        {{--<div class="modal-header">--}}
                            {{--<h4>Create Groups</h4>--}}
                        {{--</div>--}}
                        <ul id="products1">



                            {{--@auth--}}
                            {{--<li>--}}
                                {{--<a class="item thumbnail " href="#" data-toggle="modal" data-target="#groupModal">--}}
                                    {{--<h4>Add Group</h4>--}}
                                {{--</a>--}}
                            {{--</li>--}}

                            {{--<li>--}}
                                {{--<a class="item thumbnail " href="#" data-toggle="modal" data-target="#productModal">--}}
                                    {{--<h4>Add Product</h4>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--@endauth--}}
                            @if(sizeof($productgroups) > 0 )
                                @foreach($productgroups as $productgroup)
                                   
                                        <div class="card card-cus">
                                        <div class="itempro thumbnail " id="{{ $productgroup->name }}">
                                            <div class="image view view-first">
                                                <img  class="card-img" src="{{ asset('admin/images/groups/products/'.$productgroup->imagepath)}}" alt="image" />
                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        {{--<a href="#"><i class="fa fa-link"></i></a>--}}
                                                        <a href="#" data-toggle="modal" data-target="#edit-modal{{$productgroup->id}}"><i class="fa fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal{{$productgroup->id}}"><i class="fa fa-times"></i></a>
                                                        <a href="{{ route('admin.showSubGroupRqst',$productgroup->slug) }}"><i class="fa fa-eye"></i></a>
                                                    </div>
                                                    <p>{{ $productgroup->name }}</p>
                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><strong>Group:</strong>  {{ $productgroup->name }}</p>
                                            </div>
                                        </div>
                                        </div>
                                   


                                    <div class="modal fade" id="edit-modal{{$productgroup->id}}" tabindex="-2" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.editGroupRqst',$productgroup->id) }}">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Sub Group</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="groupname">Group name</label>
                                                            <input type="hidden" name="parent_id" value="{{ $productgroup->id }}"/>
                                                            <input type="text" name="groupname" class="form-control" id="groupname" aria-describedby="grpnameHelp"
                                                                   placeholder="Enter group name" value="{{ $productgroup->name }}" required>
                                                            <small id="grpnameHelp" class="form-text text-muted"></small>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="delete-modal{{$productgroup->id}}" class="modal modal-danger fade" >
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                        @lang('common.delete_modal_text')
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteProductSubGrpRqst',$productgroup->id) }}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                @endforeach


                            @endif


                            @if(sizeof($products) > 0 )
                                @foreach($products as $product)
                                    <div class="card card-cus">
                                        <div @if($product->total>1)  onclick="openmulipopup()"  @endif class="itempro thumbnail " id="p_{{ $product->id }}" @if($product->total==1) draggable="true" @else style="cursor: pointer"@endif>

                                            <div class="image view view-first">
                                                <img class="card-img" src="{{ asset('public/admin/images/groups/products/'.$product->path)}}" alt="image" onerror=this.src="{{ asset('admin/images/groups/products/noimage.jpeg')}}" />
                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        @if($product->total==1)
                                                        {{--<a href="#"><i class="fa fa-link"></i></a>--}}
                                                        <a href="#" data-toggle="modal" data-target="#productModal{{$product->id }}"><i class="fa fa-edit"></i></a>

                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-p{{$product->id }}"><i class="fa fa-times"></i></a>
                                                        @endif

                                                    </div>
                                                    <p>{{ $product->name }}</p>

                                                    @if($product->total>1)
                                                        <a  class="plusicon" onclick="openmulipopup()"><i class="fa fa-window-restore"></i></a>
                                                        @else
                                                        <a  class="plusicon" onclick="createOrder('p_{{$product->id }}')"><i class="fa fa-plus"></i></a>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><span>{{ $product->name }}</span> </p>
                                                <p><strong>Price</strong>: <span>$ {{ $product->price }}</span> <strong>Qty</strong>: <span>{{ $product->stock }}  @if(isset($orders[$product->id]))<strong>Sold </strong>: <span>{{ $orders[$product->id] }}</span>@endif</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    @if($product->total==1)
                                        <div class="modal fade" id="productModal{{$product->id }}" tabindex="-2" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('admin.editProductRqst',$product->id) }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Products </h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="vary">
                                                            <div class="box thumbnail variationbox">
                                                                <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="videoname">Product name</label>
                                                                    <input type="hidden" name="group_id" value="{{ $product->id }}"/>
                                                                    <input type="text" name="productname" class="form-control" value="{{ $product->name }}"  aria-describedby="grpnameHelp"
                                                                           placeholder="Enter product name" required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="imagefile">Product Image file</label>
                                                                    <input type="file" name="imagefile" class="form-control">






                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="price">Product Price</label>
                                                                    <input type="price" name="price" class="form-control" value="{{ $product->price }}"  required>
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="tax">Product Tax</label>
                                                                    <input type="tax" name="tax" class="form-control" value="{{ $product->tax }}" required>
                                                                </div>
                                                                </div>
                                                                <div class="row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="stocktype">Stock Type</label>
                                                                    <select onchange="channgestock(this)" name="stocktype" value="{{ $product->unlimited_stock }}" class="stocktype form-control" required>

                                                                        <option value="1">Unlimited</option>
                                                                        <option value="0">Limited</option>
                                                                    </select>

                                                                </div>
                                                                <div class="form-group col-md-6 stockbox" @if($product->unlimited_stock) style="display: none";  @else style="display: block";  @endif>
                                                                    <label for="stock">Product Stock</label>
                                                                    <input type="number" name="stock"  value="{{$product->stock}}" class="form-control">
                                                                </div>
                                                                </div>



                                                            </div>
                                                            </div>





                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-warning">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif


                                    @if($product->total>1)
                                        <div id="multipleProductsModal{{$product->id }}" class="multipleproduct">
                                            <div class="modal-dialog1" role="document">


                                                <div class="modal-header">
                                                    <h4>Variation products for <strong> {{$product->name }}</strong></h4>
                                                    <button type="button" onclick="closemulipopup()" class="btn btn-outline " style="float: right;" data-dismiss="modal"><i class="fa fa-times"></i></button>

                                                </div>
                                                @foreach($variations[$product['category']] as $variation)
                                                    <div class="col-md-6">
                                                        <div class="itempro thumbnail " id="{{ $variation['id'] }}" draggable="true">
                                                            <div class="image view view-first">
                                                                <img class="card-img" src="{{ asset('public/admin/images/groups/products/'.$variation['path'])}}" alt="image"  onerror=this.src="{{ asset('admin/images/groups/products/noimage.jpeg')}}"/>

                                                                <div class="mask">

                                                                    <div class="tools tools-bottom">
                                                                        <a href="#" data-toggle="modal" data-target="#productModalv{{$variation['id'] }}"><i class="fa fa-edit"></i></a>
                                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-pv{{$variation['id'] }}"><i class="fa fa-times"></i></a>

                                                                    </div>

                                                                    <p>{{ $variation['name'] }}</p>
                                                                    <a  class="plusicon" onclick="createOrder('p_{{$variation['id'] }}')"><i class="fa fa-plus"></i></a>

                                                                </div>
                                                            </div>
                                                            <div class="caption">

                                                                <p><span>{{ $variation['name'] }}</span> </p>
                                                                <p><strong>Price</strong>: <span>$ {{ $variation['price'] }}</span> <strong>Qty</strong>: <span>{{ $variation['stock'] }}  @if(isset($orders[$variation['id']]))<strong>Sold </strong>: <span>{{ $orders[$variation['id']] }}</span>@endif</span></p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="delete-modal-pv{{$variation['id'] }}" class="modal modal-danger fade">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">

                                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                                        @lang('common.delete_modal_text')
                                                                    </h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span></button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                                    <form method="post" role="form" id="delete_form" action=" {{ route('admin.deleteProductRqst',$variation['id'] ) }}">
                                                                        {{csrf_field()}}
                                                                        {{method_field('DELETE')}}
                                                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>



                                                    <div style="z-index: 2000 !important;" class="modal fade" id="productModalv{{$variation['id'] }}"  class="modal modal-danger fade">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{ route('admin.editProductRqst',$variation['id']) }}" enctype="multipart/form-data">
                                                                    {{ csrf_field() }}
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Products to </h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="vary">
                                                                            <div class="box thumbnail variationbox">
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="videoname">Product name</label>
                                                                                        <input type="hidden" name="group_id" value="{{ $product['id'] }}"/>
                                                                                        <input type="text" name="productname" class="form-control" value="{{ $product['name'] }}"  aria-describedby="grpnameHelp"
                                                                                               placeholder="Enter product name" required>
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="imagefile">Product Image file</label>
                                                                                        <input type="file" name="imagefile" class="form-control" >
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="price">Product Price</label>
                                                                                        <input type="price" name="price" class="form-control" value="{{ $product['price'] }}"  required>
                                                                                    </div>
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="tax">Product Tax</label>
                                                                                        <input type="tax" name="tax" class="form-control" value="{{ $product['tax'] }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-6">
                                                                                        <label for="stocktype">Stock Type</label>
                                                                                        <select onchange="channgestock(this)" name="stocktype" value="{{ $product['unlimited_stock'] }}" class="stocktype form-control" required>

                                                                                            <option value="1">Unlimited</option>
                                                                                            <option value="0">Limited</option>
                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="form-group col-md-6 stockbox" @if($product['unlimited_stock']) style="display: none";  @elsestyle="display: block";  @endif>
                                                                                        <label for="stock">Product Stock</label>
                                                                                        <input type="number" name="stock" value="{{$product['stock']}}" class="form-control">
                                                                                    </div>
                                                                                </div>



                                                                            </div>
                                                                        </div>





                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-warning">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>



                                                @endforeach


                                            </div>
                                        </div>
                                    @endif

                                    <div id="delete-modal-p{{$product->id }}" class="modal modal-danger fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                        @lang('common.delete_modal_text')
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <form method="post" role="form" id="delete_form" action=" {{ route('admin.deleteProductRqst',$product->id ) }}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                @endforeach
                            @endif



                        </ul>
                    </div>



<div class="modal fade" id="productModal" tabindex="-2" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.addProductRqst') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title">Add Products</h5>
                </div>
                <div class="modal-body">
                    <div class="vary">
                    <div class="box thumbnail variationbox">
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="videoname">Product name</label>
                            <input type="hidden" name="group_id" value=""/>
                            <input type="text" name="productname[]" class="form-control"  aria-describedby="grpnameHelp"
                                   placeholder="Enter product name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="imagefile">Product Image file</label>
                            <input type="file" name="imagefile[]" class="form-control" >
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="price">Product Price</label>
                            <input type="price" name="price[]" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tax">Product Tax</label>
                            <input type="tax" name="tax[]" class="form-control"  required>
                        </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="stocktype">Stock Type</label>
                            <select onchange="channgestock(this)" name="stocktype[]" class="stocktype form-control" required>

                                <option value="1">Unlimited</option>
                                <option value="0">Limited</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6 stockbox" style="display: none">
                            <label for="stock">Product Stock</label>
                            <input type="number" name="stock[]" class="form-control">
                        </div>
                        </div>


                    </div>
                    </div>





                </div>
                <div class="modal-footer">
                    <button type="button"  id="variation" class="btn btn-info">Has Variation Product</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>







    <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.addProductGroupRqst') }}">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Add Product Group</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="groupname">Group name</label>
                            <input type="text" name="groupname" class="form-control" id="groupname"
                                   aria-describedby="grpnameHelp"
                                   placeholder="Enter group name" required>
                            <small id="grpnameHelp" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@elseif(Request::segment(3)=="product-group")
    {{--Sub groups view--}}
    <div class="col-md-12">
        {{--<div class="modal-header">--}}
            {{--<h4>You are in Group: {{$group->name}}</h4>--}}
        {{--</div>--}}
        <ul id="products1">


            {{--<li>--}}
                {{--<a class="item thumbnail" href="{{ route('admin.productsRqst') }}">--}}

                    {{--<i class=" fassbtn fa fa-arrow-circle-left"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--@auth--}}
            {{--<li>--}}
                {{--<a class="item thumbnail " href="#" data-toggle="modal" data-target="#groupModal">--}}
                    {{--<h4>Add Sub Group</h4>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a class="item thumbnail " href="#" data-toggle="modal" data-target="#productModal">--}}
                    {{--<h4>Add Product</h4>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--@endauth--}}
            @if(sizeof($productgroups) > 0 )
                @foreach($productgroups as $productgroup)
                    <?php
                    ?>
                    <div class="card card-cus">
                        <div class="itempro thumbnail " id="{{ $productgroup->name }}" >
                            <div class="image view view-first">
                                <img class="card-img" src="{{ asset('public/admin/images/groups/products/'.$productgroup->imagepath)}}" alt="image" onerror=this.src="{{ asset('admin/images/groups/products/noimage.jpeg')}}" />
                                <div class="mask">

                                    <div class="tools tools-bottom">
                                        {{--<a href="#"><i class="fa fa-link"></i></a>--}}
                                        <a href="#" data-toggle="modal" data-target="#edit-modal{{$productgroup->id}}"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#delete-modal{{$productgroup->id}}"><i class="fa fa-times"></i></a>
                                        <a href="{{ route('admin.showSubSubGroupsRqst',$productgroup->slug) }}"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <p>{{ $productgroup->name }}</p>
                                </div>
                            </div>
                            <div class="caption">
                                <p><strong> SG: </strong>{{ $productgroup->name }}</p>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="edit-modal{{$productgroup->id}}" tabindex="-2" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('admin.editGroupRqst',$productgroup->id) }}">
                                    {{ csrf_field() }}
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Sub Group</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="groupname">Group name</label>
                                            <input type="hidden" name="parent_id" value="{{ $productgroup->id }}"/>
                                            <input type="text" name="groupname" class="form-control" id="groupname" aria-describedby="grpnameHelp"
                                                   placeholder="Enter group name" value="{{ $productgroup->name }}" required>
                                            <small id="grpnameHelp" class="form-text text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div id="delete-modal{{$productgroup->id}}" class="modal modal-danger fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                        @lang('common.delete_modal_text')
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteProductSubGrpRqst',$productgroup->id) }} ">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                @endforeach
            @endif
            @if(sizeof($products) > 0 )
                @foreach($products as $product)
                    <div class="card card-cus">
                        <div @if($product->total>1)  onclick="openmulipopup()"  @endif class="itempro thumbnail " id="p_{{ $product->id }}" @if($product->total==1) draggable="true" @else style="cursor: pointer"@endif>

                            <div class="image view view-first">
                                <img class="card-img" src="{{ asset('public/admin/images/groups/products/'.$product->path)}}" alt="image" onerror=this.src="{{ asset('admin/images/groups/products/noimage.jpeg')}}" />
                                <div class="mask">


                                    <div class="tools tools-bottom">
                                        @if($product->total==1)
                                            {{--<a href="#"><i class="fa fa-link"></i></a>--}}
                                            <a href="#" data-toggle="modal" data-target="#productModal{{$product->id }}"><i class="fa fa-edit"></i></a>

                                            <a href="#" data-toggle="modal" data-target="#delete-modal-p{{$product->id }}"><i class="fa fa-times"></i></a>
                                        @endif

                                    </div>
                                    <p>{{ $product->name }}</p>

                                    @if($product->total>1)
                                        <a  class="plusicon" onclick="openmulipopup()"><i class="fa fa-window-restore"></i></a>
                                    @else
                                        <a  class="plusicon" onclick="createOrder('p_{{$product->id }}')"><i class="fa fa-plus"></i></a>
                                    @endif

                                </div>
                            </div>
                            <div class="caption">
                                <p><span>{{ $product->name }}</span> </p>
                                <p><strong>Price</strong>: <span>$ {{ $product->price }}</span> <strong>Qty</strong>: <span>{{ $product->stock }}  @if(isset($orders[$product->id]))<strong>Sold</strong>: <span>{{ $orders[$product->id] }}</span>@endif</span></p>

                            </div>
                        </div>
                    </div>

                    @if($product->total==1)
                        <div class="modal fade" id="productModal{{$product->id }}" tabindex="-2" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('admin.editProductRqst',$product->id) }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Products </h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="vary">
                                            <div class="box thumbnail variationbox">
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="videoname">Product name</label>
                                                    <input type="hidden" name="group_id" value="{{ $product->id }}"/>
                                                    <input type="text" name="productname" class="form-control" value="{{ $product->name }}"  aria-describedby="grpnameHelp"
                                                           placeholder="Enter product name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="imagefile">Product Image file</label>
                                                    <input type="file" name="imagefile" class="form-control">
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="price">Product Price</label>
                                                    <input type="price" name="price" class="form-control" value="{{ $product->price }}"  required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tax">Product Tax</label>
                                                    <input type="tax" name="tax" class="form-control" value="{{ $product->tax }}" required>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="stocktype">Stock Type</label>
                                                    <select onchange="channgestock(this)" name="stocktype" value="{{ $product->unlimited_stock }}" class="stocktype form-control" required>

                                                        <option value="1">Unlimited</option>
                                                        <option value="0">Limited</option>
                                                    </select>

                                                </div>
                                                <div class="form-group col-md-6 stockbox" @if($product->unlimited_stock) style="display: none";  @elsestyle="display: block";  @endif>
                                                    <label for="stock">Product Stock</label>
                                                    <input type="number" name="stock" value="{{$product->stock}}" class="form-control">
                                                </div>
                                                </div>



                                            </div>
                                            </div>





                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if($product->total>1)
                        <div id="multipleProductsModal{{$product->id }}" class="multipleproduct">
                            <div class="modal-dialog1" role="document">

                                <div class="modal-header">
                                    <button type="button" onclick="closemulipopup()" class="btn btn-outline pull-right" style="float: right;" data-dismiss="modal"><i class="fa fa-times"></i></button>

                                </div>
                                @foreach($variations[$product['category']] as $variation)
                                    <div class="col-md-6">
                                        <div class="itempro thumbnail " id="{{ $variation['id'] }}" draggable="true">
                                            <div class="image view view-first">
                                                <img class="card-img" src="{{ asset('public/admin/images/groups/products/'.$variation['path'])}}" alt="image"  onerror=this.src="{{ asset('public/web/images/groups/products/noimage.jpeg')}}"/>

                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        <a href="#" data-toggle="modal" data-target="#productModalv{{$variation['id'] }}"><i class="fa fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-pv{{$variation['id'] }}"><i class="fa fa-times"></i></a>

                                                    </div>

                                                    <p>{{ $variation['name'] }}</p>
                                                    <a  class="plusicon" onclick="createOrder('p_{{$variation['id'] }}')"><i class="fa fa-plus"></i></a>

                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><span>{{ $variation['name'] }}</span> </p>
                                                <p><strong>Price</strong>: <span>$ {{ $variation['price'] }}</span> <strong>Qty</strong>: <span>{{ $variation['stock'] }}  @if(isset($orders[$variation['id']]))<strong>Sold </strong>: <span>{{ $orders[$variation['id']] }}</span>@endif</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="delete-modal-pv{{$variation['id'] }}" class="modal modal-danger fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                        @lang('common.delete_modal_text')
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <form method="post" role="form" id="delete_form" action=" {{ route('admin.deleteProductRqst',$variation['id'] ) }}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>


                                    <div style="z-index: 2000 !important;" class="modal fade" id="productModalv{{$variation['id'] }}"  class="modal modal-danger fade">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.editProductRqst',$variation['id']) }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Products to </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="vary">
                                                            <div class="box thumbnail variationbox">
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="videoname">Product name</label>
                                                                        <input type="hidden" name="group_id" value="{{ $product['id'] }}"/>
                                                                        <input type="text" name="productname" class="form-control" value="{{ $product['name'] }}"  aria-describedby="grpnameHelp"
                                                                               placeholder="Enter product name" required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="imagefile">Product Image file</label>
                                                                        <input type="file" name="imagefile" class="form-control" >
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="price">Product Price</label>
                                                                        <input type="price" name="price" class="form-control" value="{{ $product['price'] }}"  required>
                                                                    </div>
                                                                    <div class="form-group col-md-6">
                                                                        <label for="tax">Product Tax</label>
                                                                        <input type="tax" name="tax" class="form-control" value="{{ $product['tax'] }}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-6">
                                                                        <label for="stocktype">Stock Type</label>
                                                                        <select onchange="channgestock(this)" name="stocktype" value="{{ $product['unlimited_stock'] }}" class="stocktype form-control" required>

                                                                            <option value="1">Unlimited</option>
                                                                            <option value="0">Limited</option>
                                                                        </select>

                                                                    </div>
                                                                    <div class="form-group col-md-6 stockbox" @if($product['unlimited_stock']) style="display: none";  @elsestyle="display: block";  @endif>
                                                                        <label for="stock">Product Stock</label>
                                                                        <input type="number" name="stock" value="{{$product['stock']}}" class="form-control">
                                                                    </div>
                                                                </div>



                                                            </div>
                                                        </div>





                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                @endforeach


                            </div>
                        </div>
                    @endif

                    <div id="delete-modal-p{{$product->id }}" class="modal modal-danger fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                        @lang('common.delete_modal_text')
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <form method="post" role="form" id="delete_form" action=" {{ route('admin.deleteProductRqst',$product->id ) }}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                @endforeach
            @endif




        </ul>
    </div>


    <div class="modal fade" id="groupModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.addProductGroupRqst') }}">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Add Sub Group</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="groupname">Group name</label>
                            <input type="hidden" name="parent_id" value="{{ $group->id }}"/>
                            <input type="text" name="groupname" class="form-control" id="groupname" aria-describedby="grpnameHelp"
                                   placeholder="Enter group name" required>
                            <small id="grpnameHelp" class="form-text text-muted"></small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.addProductRqst') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Add Products to {{ $group->name }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="vary">
                        <div class="box thumbnail variationbox">
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="videoname">Product name</label>
                                <input type="hidden" name="group_id" value="{{ $group->id }}"/>
                                <input type="text" name="productname[]" class="form-control"  aria-describedby="grpnameHelp"
                                       placeholder="Enter product name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="imagefile">Product Image file</label>
                                <input type="file" name="imagefile[]" class="form-control">
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price">Product Price</label>
                                <input type="price" name="price[]" class="form-control"  required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tax">Product Tax</label>
                                <input type="tax" name="tax[]" class="form-control"  required>
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="stocktype">Stock Type</label>
                                <select onchange="channgestock(this)" name="stocktype[]" class="stocktype form-control" required>

                                    <option value="1">Unlimited</option>
                                    <option value="0">Limited</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6 stockbox" style="display: none">
                                <label for="stock">Product Stock</label>
                                <input type="number" name="stock[]" class="form-control">
                            </div>
                            </div>

                        </div>

                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button"  id="variation" class="btn btn-info">Has Variation Product</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@elseif(Request::segment(3)=="product-sub-group")
    <div class="col-md-9">
        {{--<div class="modal-header">--}}
            {{--<h4>You are in Sub Group: {{$subgroup->name}}</h4>--}}
        {{--</div>--}}
        <ul id="products1">


            {{--<li>--}}
                {{--<a class="item thumbnail" href="{{ route('admin.showSubGroupRqst',$group->slug) }}">--}}
                    {{--<i class=" fassbtn fa fa-arrow-circle-left"></i>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--@auth--}}

            {{--<li>--}}
                {{--<a class="item thumbnail " href="#" data-toggle="modal" data-target="#productModal">--}}
                    {{--<h4>Add Product</h4>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--@endauth--}}


            @if(sizeof($products) > 0 )
                @foreach($products as $product)
                    <div class="card card-cus">
                        <div @if($product->total>1)  onclick="openmulipopup()" @endif class="itempro thumbnail " id="p_{{ $product->id }}" @if($product->total==1) draggable="true" @else style="cursor: pointer"@endif>
                            <div class="image view view-first">
                                <img class="card-img" src="{{ asset('public/admin/images/groups/products/'.$product->path)}}" alt="image" onerror=this.src="{{ asset('admin/images/groups/products/noimage.jpeg')}}" />

                                <div class="mask">

                                    <div class="tools tools-bottom">
                                        @if($product->total==1)
                                            {{--<a href="#"><i class="fa fa-link"></i></a>--}}
                                            <a href="#" data-toggle="modal" data-target="#productModal{{$product->id }}"><i class="fa fa-edit"></i></a>

                                            <a href="#" data-toggle="modal" data-target="#delete-modal-p{{$product->id }}"><i class="fa fa-times"></i></a>
                                        @endif

                                    </div>
                                    <p>{{ $product->name }}</p>

                                    @if($product->total>1)
                                        <a  class="plusicon" onclick="openmulipopup()"><i class="fa fa-window-restore"></i></a>
                                    @else
                                        <a  class="plusicon" onclick="createOrder('p_{{$product->id }}')"><i class="fa fa-plus"></i></a>
                                    @endif

                                </div>
                            </div>
                            <div class="caption">
                                {{--<p>{{ $product->name }}</p>--}}
                                <p><span>{{ $product->name }}</span> </p>
                                <p><strong>Price</strong>: <span>$ {{ $product->price }}</span> <strong>Qty</strong>: <span>{{ $product->stock }}  @if(isset($orders[$product->id]))<strong>Sold</strong>: <span>{{ $orders[$product->id] }}</span>@endif</span></p>
                            </div>
                        </div>
                    </div>


                    @if($product->total==1)
                        <div class="modal fade" id="productModal{{$product->id }}" tabindex="-2" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('admin.editProductRqst',$product->id) }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="modal-header">
                                            <h5 class="modal-title">Add Products to {{ $subgroup->name }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="vary">
                                            <div class="box thumbnail variationbox">
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="videoname">Product name</label>
                                                    <input type="hidden" name="group_id" value="{{ $product->id }}"/>
                                                    <input type="text" name="productname" class="form-control" value="{{ $product->name }}"  aria-describedby="grpnameHelp"
                                                           placeholder="Enter product name" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="imagefile">Product Image file</label>
                                                    <input type="file" name="imagefile" class="form-control" >
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="price">Product Price</label>
                                                    <input type="price" name="price" class="form-control" value="{{ $product->price }}"  required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tax">Product Tax</label>
                                                    <input type="tax" name="tax" class="form-control" value="{{ $product->tax }}" required>
                                                </div>
                                                </div>
                                                <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="stocktype">Stock Type</label>
                                                    <select onchange="channgestock(this)" name="stocktype" value="{{ $product->unlimited_stock }}" class="stocktype form-control" required>

                                                        <option value="1">Unlimited</option>
                                                        <option value="0">Limited</option>
                                                    </select>

                                                </div>
                                                <div class="form-group col-md-6 stockbox" @if($product->unlimited_stock) style="display: none";  @elsestyle="display: none";  @endif>
                                                    <label for="stock">Product Stock</label>
                                                    <input type="number" name="stock" value="{{$product->stock}}" class="form-control">
                                                </div>
                                                </div>



                                            </div>
                                            </div>




                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif




                    @if($product->total>1)
                        <div id="multipleProductsModal{{$product->id }}" class="multipleproduct">
                            <div class="modal-dialog1" role="document">

                                <div class="modal-header">
                                    <button type="button" onclick="closemulipopup()" class="btn btn-outline pull-right" style="float: right;" data-dismiss="modal"><i class="fa fa-times"></i></button>

                                </div>
                                @foreach($variations[$product['category']] as $variation)
                                    <div class="col-md-6">
                                        <div class="itempro thumbnail " id="{{ $variation['id'] }}" draggable="true">
                                            <div class="image view view-first">
                                                <img class="card-img" src="{{ asset('public/admin/images/groups/products/'.$variation['path'])}}" alt="image" onerror=this.src="{{ asset('admin/images/groups/products/noimage.jpeg')}}" />

                                                <div class="mask">

                                                    <div class="tools tools-bottom">
                                                        <a href="#" data-toggle="modal" data-target="#productModalv{{$variation['id'] }}"><i class="fa fa-edit"></i></a>
                                                        <a href="#" data-toggle="modal" data-target="#delete-modal-pv{{$variation['id'] }}"><i class="fa fa-times"></i></a>

                                                    </div>

                                                    <p>{{ $variation['name'] }}</p>
                                                    <a  class="plusicon" onclick="createOrder('p_{{$variation['id'] }}')"><i class="fa fa-plus"></i></a>

                                                </div>
                                            </div>
                                            <div class="caption">
                                                <p><span>{{ $variation['name'] }}</span> </p>
                                                <p><strong>Price</strong>: <span>$ {{ $variation['price'] }}</span> <strong>Qty</strong>: <span>{{ $variation['stock'] }}  @if(isset($orders[$variation['id']]))<strong>Sold </strong>: <span>{{ $orders[$variation['id']] }}</span>@endif</span></p>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="delete-modalv{{$variation['id']}}" class="modal modal-danger fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                                        Are you sure want to delete this aa?
                                                    </h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                                    <form method="post" role="form" class="delete_form" action="{{ route('admin.deleteProductRqst',$variation['id'] ) }}">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>


                                    <div style="z-index: 2000 !important;" class="modal fade" id="productModalv{{$variation['id'] }}"  class="modal modal-danger fade">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('admin.editProductRqst',$variation['id']) }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Products to {{ $subgroup->name }}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="vary">
                                                        <div class="box thumbnail variationbox">
                                                            <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="videoname">Product name</label>
                                                                <input type="hidden" name="group_id" value="{{ $product['id'] }}"/>
                                                                <input type="text" name="productname" class="form-control" value="{{ $product['name'] }}"  aria-describedby="grpnameHelp"
                                                                       placeholder="Enter product name" required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="imagefile">Product Image file</label>
                                                                <input type="file" name="imagefile" class="form-control" >
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="price">Product Price</label>
                                                                <input type="price" name="price" class="form-control" value="{{ $product['price'] }}"  required>
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="tax">Product Tax</label>
                                                                <input type="tax" name="tax" class="form-control" value="{{ $product['tax'] }}" required>
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="stocktype">Stock Type</label>
                                                                <select onchange="channgestock(this)" name="stocktype" value="{{ $product['unlimited_stock'] }}" class="stocktype form-control" required>

                                                                    <option value="1">Unlimited</option>
                                                                    <option value="0">Limited</option>
                                                                </select>

                                                            </div>
                                                            <div class="form-group col-md-6 stockbox" @if($product['unlimited_stock']) style="display: none";  @elsestyle="display: block";  @endif>
                                                                <label for="stock">Product Stock</label>
                                                                <input type="number" name="stock" value="{{$product['stock']}}" class="form-control">
                                                            </div>
                                                            </div>



                                                        </div>
                                                        </div>





                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach


                            </div>
                        </div>
                    @endif




                    <div id="delete-modal{{$product->id }}" class="modal modal-danger fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <h4 class="modal-title">
                            <span class="fa-stack fa-sm">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-trash fa-stack-1x"></i>
                            </span>
                                        Are you sure want to delete this aa?
                                    </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                    <form method="post" role="form" class="delete_form" action="{{ route('admin.deleteProductRqst',$product->id ) }}">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" class="btn btn-outline">@lang('common.delete')</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>

                @endforeach
            @endif




        </ul>
    </div>





    <div class="modal fade" id="productModal" tabindex="-2" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{route('admin.addProductRqst')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title">Add Products to {{ $subgroup->name }}</h5>
                    </div>
                    <div class="modal-body">
                        <div class="vary">
                        <div class="box thumbnail variationbox">
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="videoname">Product name</label>
                                <input type="hidden" name="group_id" value="{{ $subgroup->id }}"/>
                                <input type="text" name="productname[]" class="form-control"  aria-describedby="grpnameHelp"
                                       placeholder="Enter product name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="imagefile">Product Image file</label>
                                <input type="file" name="imagefile[]" class="form-control"  >
                            </div>
                            </div>
                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="price">Product Price</label>
                                <input type="price" name="price[]" class="form-control"  required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tax">Product Tax</label>
                                <input type="tax" name="tax[]" class="form-control"  required>
                            </div>
                            </div>

                            <div class="row">
                            <div class="form-group col-md-6">
                                <label for="stocktype">Stock Type</label>
                                <select onchange="channgestock(this)" name="stocktype[]" class="stocktype form-control" required>

                                    <option value="1">Unlimited</option>
                                    <option value="0">Limited</option>
                                </select>

                            </div>
                            <div class="form-group col-md-6 stockbox" style="display: none">
                                <label for="stock">Product Stock</label>
                                <input type="number" name="stock[]" class="form-control">
                            </div>
                            </div>


                        </div>
                        </div>





                    </div>
                    <div class="modal-footer">
                        <button type="button"  id="variation" class="btn btn-info">Has Variation Product</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <script>
        function hidebackdrop(){

            $('.modal-backdrop').css('display','none');
        }
    </script>
@endif






