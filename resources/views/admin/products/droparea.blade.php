<div class="col-md-3 col-sm-12 col-xs-12" style="background-color:#545454;height:800px;color:white;">



    <input type="hidden" id="orderid">



    <div class="col-md-12 margintop">
    <div class="userbar_products">




    </div>
    </div>





    <div class="col-md-12 margintop">

        <div class="input-group input-group-sm" style="z-index: 0;">
            <input type="text" class="form-control searchbaruder" placeholder="Search User">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-primary btn-flat"  onclick="loadCart()"><i class="fa fa-edit"></i>Cart</button>
                      </span>
        </div>

    </div>






    <div class="col-md-12">
    <div class="searchresultsbox_results " style="overflow: auto;max-height: 400px;">


    </div>
    </div>
    <div id="shopcart" class="col-md-12 cart" style="margin-top:10px;" >
        <h4>Sleep de oefeningen die u wilt toevoegen naar dit vak.</h4>
    </div>

    <div class="col-md-12 drooopable doprul" style="margin-top: 12px;">

        {{--<ul class="doprul" style="padding: 0px;">--}}

        {{--</ul>--}}
    </div>

    <div class="col-md-12 " id="totalprice">
    @include('admin.products.updatecart_orderamount')
    </div>

</div>


<div class="modal fade" id="showPayPopupModal" tabindex="-2" role="dialog" aria-hidden="true">

</div>





