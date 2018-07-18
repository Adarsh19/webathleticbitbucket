<div class="row">
    @if(!empty($products))
    @foreach($products as $product)
<div class="col-lg-6 col-xl-4">



    <tr onclick="createSchedule('p_{{ $product['id'] }}_{{$user->id}}')" id="p_{{ $product['id'] }}_{{$user->id}}" draggable="true" ondragstart="dragExerciseStart('p_{{ $product['id'] }}_{{$user->id}}',{{Request::segment(5)}})" ondragend="dragExerciseEnd()" onmouseover="showhideIcons(this);" onmouseout="showhideIcons(this);">
        <td style="width:5%; text-align: center;">


<i class="fa fa-plus"></i>

            {{--<input name="food" data-foodid="100519" data-eattime="1" food_id="100519" track_id="289862628" type="checkbox" onclick="show_options(this);if($('.1 input:checked').length){$('#1').prop('checked',true);}else{$('#1').prop('checked',false)}" id="">--}}
        </td>
        <td   style="cursor: pointer;width: 25%;">
            <img src="{{ asset('admin/images/groups/foodproducts/'.$product->path)}}" onerror="this.src={{ asset('admin/images/groups/foodproducts/noimage.jpeg')}}" style="width:45px; height:45px;" class="float_left">&nbsp;
            <div style="float: left; padding-top: 15px; margin-left: 15px; font-weight: bold; font-size: 13px; width: 210px;" class="nowrap">{{$product->name}}</div>
        </td>
        <td style="width: 10%;">
            <div class="widget-summary-col icons" style="display: none;">
            <a href="#" data-toggle="modal" data-target="#delete-food-products-modal{{$product->id }}"  class="pull-right btn-box-tool cus-mar-right" ><i class="fa fa-trash"></i></a>&nbsp;
            <a href="#" onclick="showeditModal({{Request::segment(3)}},{{$product->id}})" class="pull-right btn-box-tool cus-mar-right" ><i class="fa fa-edit"></i></a>&nbsp;
            </div>


        </td>
        <td style="color: #777777;width: 20%;" title="{{$product->foodunit}} {{$product->amount}} ({{$product->weight}})">
            <div  class="nowrapclass hands" >{{$product->foodunit}} {{$product->amount}} ({{$product->weight}})</div>
        </td>

        <td style="width: 10%; color: #777777;">{{$product->kal}}g.</td>
        <td style="width: 10%; color: #777777;">{{$product->kal}}g.</td>
        <td style="width: 10%; color: #777777;">{{$product->kal}} g.</td>
        <td style="width: 10%; color: #777777;">{{$product->kal}}  g.</td>
    </tr>






    <div id="delete-food-products-modal{{$product->id }}" class="modal modal-danger fade">
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
                    <form method="post" role="form" id="delete_form" action="{{ route('admin.deleteProductsViewRqst', $product->id)}}">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-outline">Delete</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->




    </div>

</div>



        <div class="modal fade" id="addProductToGroup{{ $product['id'] }}" tabindex="-2" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('admin.assignmealRqst',$product['id'])}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title">Add Details</h5>
                        </div>
                        <div class="modal-body">

                            <div class="col-lg-12">
                                <label for="groupname">Date</label>
                                <div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
                                    <input required name="date" type="text" data-date-format="yyyy-mm-dd" class="form-control dailydate"  value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                                </div>
                            </div>

                            <div class="col-lg-12">


                                <label class="">Eaten at</label>
                                <select required data-plugin-selectTwo class="form-control grouptop{{ $product['id'] }}" name="eatan_at">

                                    @foreach($drop_groups as $group)
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endforeach


                                </select>

                            </div>


                            <div class="col-lg-12">

                                <label class="col-lg-12">Quantity</label>
                                <span class="col-lg-3"><input required type="number" name="quantity" min="1"  value="1" class="form-control"> X </span>
                                <span class="col-lg-9">

                                            <select required data-plugin-selectTwo class="form-control populate" name="units">

                                                <?php
                                                    $pid=$product['id'];
                                                 $units=\App\FoodProductsUnits::where('food_product_id',$pid)->get();

                                                ?>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}">{{$unit->foodunit}} {{$unit->amount}} {{$unit->weight}}</option>
                                            @endforeach



                                        </select>
                                        </span>

                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    @endforeach
        @endif
</div>