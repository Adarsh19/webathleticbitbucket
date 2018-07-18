<button type="button" class="btn btn-primary " @if(!empty($orderamount))style="width: 78%"@endif>
    <div id="total">Total <span>  <i class="fa fa-eur"></i> @if(empty($orderamount)) 0 @else{{ $orderamount->invoiceamount }}@endif</span></div>
</button>
@if(!empty($orderamount))
<button type="button" class="btn btn-info" onclick="showPayyPopup('{{ $userid }}')">
    <i class="fa fa-dollar-sign"></i> Pay
</button>
@endif


