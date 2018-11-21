<?php $__env->startSection('headerjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="balance-new">
	<div class="container-fluid">		
		
		<!-- start -->
		<div class="deposit-bn">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<h5 class="bal-title"><i class="fa fa-address-book" aria-hidden="true"></i> 
					Trade History</h5>
					
					<div class="table-responsive dash-table-markets " style="margin-top:25px;" >
						<table class="table">							
							<thead>
								<tr>
									<th>DATE</th>
									<th>COIN</th>									
									<th>TYPE</th>									
									<th>VOLUME</th>
									<th>PRICE PER UNIT</th>
									<th>PRICE</th>
									<th>FEES</th>
									<th>TOTAL AMOUNT</th>
								</tr>
							</thead>
							<tbody>
								<?php									
									if(sizeof($trade_data)>0)
									{
										foreach($trade_data as $k=>$v)
										{																		
											$volume = $v->volume;
											if($v->seller_id==$user_id){
												$type = 'Sell';
												$rate = $v->seller_rate;
												$fee = $v->sell_fee;
												
											}else if($v->buyer_id==$user_id){
												$type = 'Buy';
												$rate =	$v->buyer_rate;
												$fee = $v->buy_fee;												
											}
											if(empty($fee)){
												$fee = 0;	
											}
											
											$from_currency = $v->from_currency;
											$to_currency = $v->to_currency;
											
											$currency = strtoupper($from_currency);
											
											if(strtolower($from_currency) == 'inr'){
												$price = $volume * $rate;													
											}else{
												$price = $volume * $rate;
											}
											
											
											if($v->seller_id==$user_id){
												$total_price = $price - $fee;
											}else if($v->buyer_id==$user_id){
												$total_price = $price + $fee;
											}
											
											
											
												
								?>
										
										<tr>
											<td><?php echo e(date('M-d, Y', strtotime($v->trade_at))); ?></td>
											<td><?php echo e(strtoupper($v->to_currency)); ?></td>
											<td><?php echo e($type); ?></td>
											<td><?php echo e(number_format($volume,5)); ?></td>
											<td><?php echo e(number_format($rate,5)); ?> <?php echo e($currency); ?></td>
											<td><?php echo e(number_format($price,5)); ?> <?php echo e($currency); ?></td>
											<td><?php echo e(number_format($fee,5)); ?> <?php echo e($currency); ?></td>
											<td><?php echo e(number_format($total_price,5)); ?> <?php echo e($currency); ?></td>
										</tr>
								<?php 
										}
									}else{
										echo '<tr><td colspan="8">No records found!</td></tr>';
									}
								?>
							</tbody>
						</table>						
					</div>
				</div>
				
			</div>
		</div>
		<!-- end -->
		
</div>
</section>    

    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footerjs'); ?>
<script src="<?php echo e(asset('/public/gilt/js/account.js')); ?>"></script>
<script src="<?php echo e(asset('/public/gilt/js/common.js')); ?>"></script>
<script src="<?php echo e(asset('/public/gilt/js/otherform.js')); ?>"></script>
<script src="<?php echo e(asset('/public/js/plugins/datapicker/bootstrap-datepicker.js')); ?>"></script>
<script>
        $('#deposit_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('xchange.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>