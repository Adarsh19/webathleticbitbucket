<div class="modal-dialog" role="document" style="top:25%">
    <div class="modal-content">


        <script>
            $(document).ready(function() {
                $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
                    e.preventDefault();
                    $(this).siblings('a.active').removeClass("active");
                    $(this).addClass("active");
                    var index = $(this).index();
                    $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                    $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
                });
            });
        </script>


        <div class="container-popup">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu pull-right">
                        <div class="list-group">
                            <a href="#" class="list-group-item active text-center" onclick="paybycash(this)">
                                <h4 class="glyphicon glyphicon-plane"></h4><br/>Cash
                            </a>
                            <a href="#" class="list-group-item text-center" onclick="paybyaccount(this)">
                                <h4 class="glyphicon glyphicon-road"></h4><br/>Account
                            </a>
                            <a href="#" class="list-group-item text-center" onclick="cancelorder(this)">
                                <h4 class="glyphicon glyphicon-trash"></h4><br/><?php echo app('translator')->getFromJson('common.delete'); ?>
                            </a>

                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
                        <!-- Cash section -->
                        <div class="bhoechie-tab-content active">

                            <form action="<?php echo e(route('admin.saveTransactionRqst')); ?>" name="calculator" method="post">
                                <?php echo e(csrf_field()); ?>

                                <table class="calculator1" style="width:90%">


                                    <input type="hidden" value="<?php echo e($orderamount->id); ?>" name="orderid">
                                    <input type="hidden" name="amountaccount" value="<?php echo e($orderamount->invoiceamount); ?>">
                                    <input type="hidden" name="transaction_type" value="by_cash">
                                    <tr>
                                        <td   colspan="4"><input  id="amountvalue" class="form-control" type="text" name="answer" value="<?php echo e($orderamount->invoiceamount); ?>"  required/></td>
                                    </tr>
                                    <tr>
                                        <td><input class="calbutton  form-control" type="button" value=" 1 " onclick="calculator.answer.value += '1'" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 2 " onclick="calculator.answer.value += '2'" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 3 " onclick="calculator.answer.value += '3'" /></td>
                                        <td rowspan="4"><input id="okbutton" type="submit" class="btn btn-primary" value=" OK "  /></td>

                                    </tr>
                                    <tr>
                                        <td><input class="calbutton form-control" type="button" value=" 4 " onclick="calculator.answer.value += '4'" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 5 " onclick="calculator.answer.value += '5'" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 6 " onclick="calculator.answer.value += '6'" /></td>
                                    </tr>
                                    <tr>
                                        <td><input class="calbutton form-control" type="button" value=" 7 " onclick="calculator.answer.value += '7'" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 8 " onclick="calculator.answer.value += '8'" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 9 " onclick="calculator.answer.value += '9'" /></td>
                                    </tr>
                                    <tr>

                                        <td><input class="calbutton form-control" type="button" value=" c " onclick="calculator.answer.value = ''" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 0 " onclick="calculator.answer.value += '0'" /></td>
                                        <td><input class="calbutton form-control" type="button" value=" 00 " onclick="calculator.answer.value += '00'" /></td>
                                    </tr>

                                </table>
                            </form>

                        </div>
                        <!-- Account section -->
                        <div class="bhoechie-tab-content">
                            <div class="paybyaccount" style="display: none">
                                <form action="<?php echo e(route('admin.saveTransactionRqst')); ?>" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <h5>Are you sure to use Account payments ?</h5>
                                    <br>

                                    <button type="button" class="btn btn-danger" onclick="$('#showPayPopupModal').modal('hide')">
                                        <i class="fa fa-times"></i> No
                                    </button>
                                    <input type="hidden" name="orderid" value="<?php echo e($orderamount->id); ?>">
                                    <input type="hidden" name="amountaccount" value="<?php echo e($orderamount->invoiceamount); ?>">
                                    <input type="hidden" name="transaction_type" value="by_account">
                                    <button type="submit" class="btn btn-success" >
                                        <i class="fa fa-check"></i> Yes
                                    </button>
                                </form>

                            </div>
                        </div>

                        <!-- Cancel search -->
                        <div class="bhoechie-tab-content">
                            <div class="cancelorder" style="display: none">
                                <form action="<?php echo e(route('admin.cancelOrderRqst')); ?>" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <h5>Are you sure to Cancel order ?</h5>
                                    <br>
                                    <button type="button" class="btn btn-danger" onclick="$('#showPayPopupModal').modal('hide')">
                                        <i class="fa fa-times"></i> No
                                    </button>
                                    <input type="hidden" name="orderid" value="<?php echo e($orderamount->id); ?>">
                                    <button type="submit" class="btn btn-success paybtn">
                                        <i class="fa fa-check"></i> Yes
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    
        
            
                
            
            
                
            
            
                
            

        
        
        

            
                
                    
                    
                    

                    
                        
                    
                    
                    
                    
                    
                        
                    
                

            

            
                
                    
                    
                    
                    
                        
                    
                    
                    
                        
                    
                

            

            
                
                

                    
                    
                    
                    
                        
                    
                    
                        
                        
                        
                        

                    
                    
                        
                        
                        
                    
                    
                        
                        
                        
                    
                    

                        
                        
                        
                    

                
            
        
    



</div>
</div>