<?php $__env->startSection('headerjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

 
 <section class="section6 m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">Giltxchange Wallets</div></div>
			</div>	
		</div>		
	</section>			
	<section class="section9 text-left">
		<div class="container">
			<!-- <div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="estmit-block">
						<div class="view-row">
							<label>Estimated Value:</label>
							<span>0.00017761 BTC/$1.72</span>
						</div>						
					</div>
				</div>	
			</div> -->
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<!--<h4 class="wallet-title">Deposit</h4>-->
					 <div class="table-responsive datatable-s">
					  <table class="table table-bordered" id="datatable">
						<tr>
							<th>CRYPTOCURRENCY </th>
							<th>TOTAL</th>
							<th>IN ORDERS</th>
							<th>AVAILABLE </th>
							<th class="actions">TRANSACT</th>
                        </tr>
                        
                        <?php
                            foreach($coin_list as $k=>$c){

                                $address = $c['address'];
                                $dt='';
                                if(strtolower($c['coin']=='xrp'))
                                {
                                    $a = explode('?dt=', $c['address']);
                                    $address = @$a[0];
                                    $dt = @$a[1];
                                }
        
                                ?>
                                <tr>
                                <td><i class="cc mmt-icon BTC" title="<?php echo e(strtoupper($c['coin'])); ?>"></i> <?php echo e(strtoupper($c['coin'])); ?></td>
                                    <td><?php echo e($c['balance']+$c['in_order']); ?></td>
                                    <td class="text-navy"><span><?php echo e($c['in_order']); ?></span></td>
                                    <td class="text-navy"><span><?php echo e($c['balance']); ?></span></td>
                                    <td>
                                        <div class="actions">
                                            <a href="#" class="deposit-details" data-coin-name="<?php echo e($c['coin']); ?>"  data-coin-qrc="<?php echo e($c['qr_code_url']); ?>"  data-coin-address="<?php echo e($address); ?>" data-dt="<?php echo e($dt); ?>" data-toggle="modal" data-target="#deposit">DEPOSIT</a>
                                            <a href="#" data-toggle="modal" class="withdraw-request" data-coin-name="<?php echo e($c['coin']); ?>" data-coin-bal="<?php echo e($c['balance']); ?>" data-target="#withdraw">WITHDRAW</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                            }?>
						
					  </table>
					</div> 
				</div>
			</div>		
		</div>
    </section>
    


    <!-- Deposit Model Popup Box start-->											
    <div id="withdraw" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <span class="coin-name"></span> Withdrawal</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <form class="form" name="withdraw-form-request" id="withdraw-form-request">
                    <fieldset>
                        <div class="form-group destination-t" style="display:none">
                            <div class="input-group">														  			  
                                <input  class="form-control" name="dt" id="dt" placeholder="Destination Tag" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">														  			  
                                <input placeholder="Volume" name="amount" id="amount" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">														  			  
                                <input placeholder="Destination wallet address"  name="destination" id="destination"  class="form-control" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">														  			  
                                <input  placeholder="Remark" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="withdraw-form">
                        <h3>WITHDRAWAL FEES</h3>
                        <p>0.000 <span class="coin-name"></span></p>
                        </div>
                        <div class="note-s">
                        <h3>NOTE:</h3>
                        <div class="discrip">
                            Withdrawal to Smart Contract Addresses will not be processed
                            <div class="dis-s"></div>
                            
                            
                            <div class="dis-s"></div>
                            <p>Please verify the destination wallet address. Once submitted. the 
                            withdrawal request cannot be reverted back.</p>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-global confirm-withdraw">Submit <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
                        
                    </fieldset>
                    </form>
            </div>
            <div class="modal-footers"></div>
        </div>
        </div>
    </div>
    <!-- deposit Model Popup Box end-->
    
    <!-- WITHDRAW Model Popup Box start-->											
    <div id="deposit" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <span class="coin-name"></span> Deposit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <form class="form">
                    <fieldset>


                        <div class="withdraw-form">
                            <div class="des-tag-section" style="display: none;">
                                <div class="destination-tag">Destination Tag</div>
                                <div class="tag-value"></div>
                            </div>
                            <div class="col-md-12 mt-20 text-center">
                                <h4 class="text-center" style="margin-top: 8px;">Scan QR Code</h4>
                                <img class="qr-img" id="qr-img" src="">
                                <h3 class="text-center pb-10">OR</h3>
                                <p class="text-center" id="c_address">Address</p>
                                <div class="col-md-12 mt-20 text-center">
                                <div class="col-md-12">
                                        <div class="form-group name-group">
                                            <div id="coin_address" class="coin_address text-center"></div>
                                            <!-- <input type="text" class="form-control" id="coin_address" name="coin_address" readonly=""> -->
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-2">
                                        <button name="btnCopy" title="Click To Copy" id="btnCopy" type="button">
                                            <i class="fa fa-clipboard" aria-hidden="true"></i></button>
                                    </div> -->
                                </div>
                            </div>

                            <h3>MINIMUM DEPOSIT LIMIT</h3>
                            <p>0.000 <span class="coin-name"></span></p>
                            </div>
                            <div class="note-s">
                            <h3>NOTE:</h3>
                            <div class="discrip">
                                Deposit from Smart Contract Address will not be processed
                                
                                <div class="dis-s"></div>
                                <!-- <p>Please only transfer <b>Giltxchange</b> tokens to this wallet address. Sending any
                                others token may result into a loss and no wallet credit.</p> -->
                            </div>
                        </div>
                        
                    </fieldset>
                    </form>
            </div>
            <div class="modal-footers"></div>
        </div>
        </div>
    </div>
    <!-- deposit Model Popup Box end-->									
    
    
									

        

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
    <script src="<?php echo e(asset('/public/gilt/js/account.js')); ?>"></script>
    <script>
        $(document).on('click', '.deposit-details', function(){
            
            $(document).find('.des-tag-section').css('display','none');
            $(document).find('#qr-img').attr('src', $(this).attr('data-coin-qrc'));
            $(document).find('#coin_address').html($(this).attr('data-coin-address'));

            coin = $(this).attr('data-coin-name');

            $(document).find('#deposit').find('.coin-name').html($(this).attr('data-coin-name').toUpperCase());
            if(coin=='xrp')
            {
                $(document).find('.des-tag-section').css('display','block');
                $(document).find('.tag-value').html($(this).attr('data-dt'));
                
            }
        });
        
        $(document).on('click', '.withdraw-request', function(){
            $(document).find('.input-error').remove();
            $(document).find('.destination-t').css('display','none');
            
            coin = $(this).attr('data-coin-name');
            
            $(document).find('#withdrawal-address').attr('placeholder', 'Enter '+coin.toUpperCase()+' Address')

            $(document).find('#withdraw').find('.coin-name').html($(this).attr('data-coin-name').toUpperCase());
            
            if(coin=='xrp')
            {
                $(document).find('.destination-t').css('display','block');
            }
            bal = $(this).attr('data-coin-bal');
            $(document).find('.current-val').html(parseFloat(bal).toFixed(4)+' '+coin.toUpperCase());
            requested_coin = coin.toUpperCase();
            //console.log(requested_coin);
        });

        //getTransfer();
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('xchange.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>