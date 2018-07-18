<button type="button" class="btn btn-primary " <?php if(!empty($orderamount)): ?>style="width: 78%"<?php endif; ?>>
    <div id="total">Total <span>  $ <?php if(empty($orderamount)): ?> 0 <?php else: ?><?php echo e($orderamount->invoiceamount); ?><?php endif; ?></span></div>
</button>
<?php if(!empty($orderamount)): ?>
<button type="button" class="btn btn-info" onclick="showPayyPopup('<?php echo e($userid); ?>')">
    <i class="fa fa-dollar-sign"></i> Pay
</button>
<?php endif; ?>


