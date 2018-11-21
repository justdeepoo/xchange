<?php $__env->startSection('headerjs'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<input type="text" id="from_coin_decimals" value="<?php echo e($from_coin_decimals); ?>" >
<input type="text" id="to_coin_decimals" value="<?php echo e($to_coin_decimals); ?>" >

   <section class="marketmain">
	<div class="market-block">
		<div class="container-fluid">
			<div class="row">
				<!-- Graph page start  -->
				<div class="col-sm-12 col-md-8 m-b-10 p-r-15">
					<div class="trading-display">
						<!-- TradingView Widget BEGIN -->
						<div class="tradingview-widget-container margin-top-10">
						<div id="tradingview_48310"></div>
						<div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/symbols/COINBASE-BTCUSD/" rel="noopener" target="_blank"><span class="blue-text">BTCUSD</span> <span class="blue-text">chart</span> by TradingView</a></div>
						<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
						<script type="text/javascript">
						new TradingView.widget(
						{
						"width": 820,
						"height": 500,
						"symbol": "COINBASE:BTCUSD",
						"interval": "D",
						"timezone": "Etc/UTC",
						"theme": "Light",
						"style": "1",
						"locale": "in",
						"toolbar_bg": "#f1f3f6",
						"enable_publishing": false,
						"allow_symbol_change": true,
						"container_id": "tradingview_48310"
						}
						);
						</script>
						
						</div>
					<!-- TradingView Widget END -->		
					</div>
				</div>
			<!-- Graph page end  -->	
				<div class="col-sm-12 col-md-4 m-b-10 p-l-10">
					<div class="btc-tabs margin-top-10">
						<ul class="nav nav-tabs" role="tablist">
						<?php
							foreach($coins_support as $k=>$coin)
							{
								$class= '';
								if(strtolower($from_currency)==$k)
									$class= 'active';
								echo '<li role="presentation" class="'.$class.'"><a href="#'.$k.'" aria-controls="profile" role="tab" data-toggle="tab" class="'.$class.' show">'.$coin.'</a></li>';
							}
						?>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane <?php echo e(strtolower($from_currency)=='btc'?'active':''); ?>" id="btc">
								<div class="dash-table-markets no-padding table-responsive">
									<table id="data-tables-market" class="table table-cryptic <!--dataTable--> no-footer"> <!--data-page-length="10"-->
									<thead align="left">
										 <tr>
											<th align="left" width="50%">Pair <i class="fa fa-sort"></i></th>
											<th align="left" width="50%">Price <i class="fa fa-sort"></i></th>
											<!-- <th>Changes <i class="fa fa-sort"></i></th> -->
										 </tr>
									  </thead>
									<tbody class="btc-pair" align="left">
										<?php
											foreach($pair_list['btc'] as $coin)
											{
												if((strtolower($coin->pair_coin) == strtolower($to_currency)) && (strtolower($from_currency))=='eth')
												{
													
													$fontclorS = '<b>';
													$fontclorE = '</b>';
												}
												else
												{
													$fontclorS ='';
													$fontclorE =''; 
												}
												?>
												<tr>
													<td align="left"><p class="text-muted no-margin"><a href="<?php echo e(url('/trade/btc-'.$coin->pair_coin)); ?>">
													<?php echo $fontclorS; ?>
													<?php echo e(strtoupper($coin->pair_coin)); ?>/BTC
													<?php echo $fontclorE;  ?>
													</a></p></td>
													<td align="left"><p class="no-margin"><span></span> <?php echo e(number_format($coin->rate,4)); ?></p></td>
													
												</tr>
										<?php	
											}
										?>
									</tbody>
								  </table>
								</div>							
							</div>
							<div role="tabpanel" class="tab-pane <?php echo e(strtolower($from_currency)=='eth'?'active':''); ?>" id="eth">
								<div class="dash-table-markets">
									<table id="data-tables-market" class="table table-cryptic <!--dataTable--> no-footer"> <!--data-page-length="10"-->
									<thead align="left">
										 <tr>
											<th align="left" width="50%">Pair <i class="fa fa-sort"></i></th>
											<th align="left" width="50%">Price <i class="fa fa-sort"></i></th>
											<!-- <th>Changes <i class="fa fa-sort"></i></th> -->
										 </tr>
									  </thead>
									<tbody class="eth-pair" align="left">
										<?php
											foreach($pair_list['eth'] as $coin)
											{
												if((strtolower($coin->pair_coin) == strtolower($to_currency)) && (strtolower($from_currency))=='eth')
												{
													
													$fontclorS = '<b>';
													$fontclorE = '</b>';
												}
												else
												{
													$fontclorS ='';
													$fontclorE =''; 
												}
												?>
												<tr>
													<td align="left"><p class="text-muted no-margin"><a href="<?php echo e(url('/trade/eth-'.$coin->pair_coin)); ?>">
													<?php echo $fontclorS; ?>
													<?php echo e(strtoupper($coin->pair_coin)); ?>/ETH
													<?php echo $fontclorE;  ?>
													</a></p></td>
													<td align="left"><p class="no-margin"><span></span> <?php echo e(number_format($coin->rate,4)); ?>

													
													</p></td>
													<!-- <td class="no-wrap"><span class="change-down color-red label label-light-danger"><i class="fa fa-chevron-down"></i> -15.20%</span></td> -->
												</tr>
										<?php	
											}
										?>
									</tbody>
								  </table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane <?php echo e(strtolower($from_currency)=='inr'?'active':''); ?>" id="inr">
								<div class="dash-table-markets">
								<table id="data-tables-market" class="table table-cryptic <!--dataTable--> no-footer"> <!--data-page-length="10"-->
									<thead align="left">
										 <tr>
											<th align="left" width="50%">Pair <i class="fa fa-sort"></i></th>
											<th align="left" width="50%">Price <i class="fa fa-sort"></i></th>
											<!-- <th>Changes <i class="fa fa-sort"></i></th> -->
										 </tr>
									  </thead>
									<tbody class="inr-pair" align="left">
										<?php
											foreach($pair_list['inr'] as $coin)
											{
												
												
												if((strtolower($coin->pair_coin) == strtolower($to_currency)) && (strtolower($from_currency))=='inr')
												{
													
													$fontclorS = '<b>';
													$fontclorE = '</b>';
												}
												else
												{
													$fontclorS ='';
													$fontclorE =''; 
												}
												?>
												<tr>
													<td align="left"><p class="text-muted no-margin"><a href="<?php echo e(url('/trade/inr-'.$coin->pair_coin)); ?>">
													<?php echo $fontclorS; ?><?php echo e(strtoupper($coin->pair_coin)); ?>/INR 
													<?php echo $fontclorE;  ?></a></p></td>
													<td align="left"><p class="no-margin"><span></span> <?php echo e(number_format($coin->rate,4)); ?></p></td>
													<!-- <td class="no-wrap"><span class="change-down color-red label label-light-danger"><i class="fa fa-chevron-down"></i> -15.20%</span></td> -->
												</tr>
										<?php	
											}
										?>
									</tbody>
								  </table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane <?php echo e(strtolower($from_currency)=='gix'?'active':''); ?>" id="gix">
								<div class="dash-table-markets">
								<table id="data-tables-market" class="table table-cryptic <!--dataTable--> no-footer"> <!--data-page-length="10"-->
									<thead align="left">
										 <tr>
											<th align="left" width="50%">Pair <i class="fa fa-sort"></i></th>
											<th align="left" width="50%">Price <i class="fa fa-sort"></i></th>
											<!-- <th>Changes <i class="fa fa-sort"></i></th> -->
										 </tr>
									  </thead>
									<tbody class="gix-pair"  align="left">
										<?php
											foreach($pair_list['gix'] as $coin)
											{
												if((strtolower($coin->pair_coin) == strtolower($to_currency)) && (strtolower($from_currency))=='gix')
												{
													
													$fontclorS = '<b>';
													$fontclorE = '</b>';
												}
												else
												{
													$fontclorS ='';
													$fontclorE =''; 
												}												
												
												?>
												<tr>
													<td align="left"><p class="text-muted no-margin"><a href="<?php echo e(url('/trade/gix-'.$coin->pair_coin)); ?>">
													<?php echo $fontclorS; ?>
													<?php echo e(strtoupper($coin->pair_coin)); ?>/GIX
													<?php echo $fontclorE;  ?>
													</a></p></td>
													<td align="left"><p class="no-margin"><span></span> <?php echo e(number_format($coin->rate,4)); ?></p></td>
													<!-- <td class="no-wrap"><span class="change-down color-red label label-light-danger"><i class="fa fa-chevron-down"></i> -15.20%</span></td> -->
												</tr>
										<?php	
											}
										?>
									</tbody>
								  </table>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 p-r-15">
					<div class="buy-sell-trade margin-top-10">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#limit" aria-controls="limit" role="tab" data-toggle="tab" class="btn  active show">Limit Order</a>
							</li>
							 <!-- <li role="presentation">
								<a disabled aria-controls="market" class="btn" role="tab">Market</a>
							</li> -->
							<!--<li role="presentation">
								<a href="#stoplimit" aria-controls="stoplimit" role="tab" class="btn" data-toggle="tab">Stop Limit <i class="fas fa-question-circle"></i></a>
							</li> -->
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="limit">
								<div class="buysell-product"> 
									<div class="view-buy">
										<h3>Buy <?php echo e(strtoupper($to_currency)); ?></h3>
											<form action="#" name="buy-form" id="buy-form" autocomplete="off">
												<ul class="clearfix">
													<li>
														<label>Volume</label>
														<span class="btc-span" id="buyVolSpan">
															<input type="text" name="vol" value=""  class="form-control cust-inp only-int buy-input buyVol" id="vol" onkeypress="return isNumberKeyWithDot(event,'vol','buy-form');" />	
															<span class="btc-right"><?php echo e(strtoupper($to_currency)); ?></span>	
														</span>
													</li>
													<li>
														<label>Price per <?php echo e(strtoupper($to_currency)); ?></label>
														<span class="btc-span" id="buyAtSpan" >
															<input type="text" name="at" value="" class="form-control cust-inp only-int buy-input buyAt" id="at" onkeypress="return isNumberKeyWithDot(event,'at','buy-form');" />	
															<span class="btc-right"><?php echo e(strtoupper($from_currency)); ?></span>	
														</span>
													</li>
													<li>
														<label>Total</label>
														<span class="btc-span buy-dark-bg">
															<input id="buy-total-price" type="text" readonly class="form-control"/>	
															<span class="btc-right"><?php echo e(strtoupper($from_currency)); ?></span>	
														</span>
													</li>
													<li>
														<label>Commission</label>
														<span class="btc-span buy-dark-bg">
															<input type="text" id="buy-commission" readonly id="commission-buy-<?php echo e(strtoupper($to_currency)); ?>" class="form-control"/>	
															<span class="btc-right"><?php echo e(strtoupper($from_currency)); ?></span>	
														</span>
													</li>
													<li class="resp-msg-li">
														<label>Available Balance</label>
														<span class="btc-span buy-dark-bg" id="buyAvailBalSpan">
															<input type="text" readonly id="selected-<?php echo e(strtolower($from_currency)); ?>" class="form-control"/>	
															<span class="btc-right"><?php echo e(strtoupper($from_currency)); ?></span>	
														</span>
														
														<div class="buy-response-msg"></div>
													</li>											
												</ul>
												<input type="hidden" name="from_coin" id="from_coin" value="<?php echo e(strtoupper($from_currency)); ?>">
                                           	 	<input type="hidden" name="to_coin" id="to_coin" value="<?php echo e(strtoupper($to_currency)); ?>">
												
												
												<div class="discover-btn no-shadow-s clearfix">
													<button type="submit" class="btn btn-global-dark buy buy-btn">Buy <?php echo e(strtoupper($to_currency)); ?> <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
												</div>
												
											</form>
									</div>
									<div class="view-buy">
										<h3>Sell  <?php echo e(strtoupper($to_currency)); ?></h3>
											<form action="#" name="sell-form" id="sell-form" autocomplete="off" > 
												<ul class="clearfix">
													<li>
														<label>Amount</label>
														<span class="btc-span" id="sellVolSpan" >
															<input type="text" name="vol"  class="form-control cust-inp only-int sell-input sellVol" id="vol" onkeypress="return isNumberKeyWithDot(event,'vol','sell-form');" />	
															<span class="btc-right"><?php echo e(strtoupper($to_currency)); ?></span>	
														</span>
													</li>
													<li>
														<label>Price per <?php echo e(strtoupper($to_currency)); ?></label>
														<span class="btc-span" id="sellAtSpan" >
															<input type="text" name="at" class="form-control cust-inp only-int sell-input sellAt" id="at" onkeypress="return isNumberKeyWithDot(event,'at','sell-form');" />	
															<span class="btc-right"><?php echo e(strtoupper($from_currency)); ?></span>	
														</span>
													</li>
													<li>
														<label>Total</label>
														<span class="btc-span buy-dark-bg">
															<input id="sell-total-price" type="text" readonly class="form-control"/>	
															<span class="btc-right"><?php echo e(strtoupper($from_currency)); ?></span>	
														</span>
													</li>
													<li>
														<label>Commission</label>
														<span class="btc-span buy-dark-bg">
															<input type="text" id="sell-commission" readonly class="form-control"/>	
															<span class="btc-right"><?php echo e(strtoupper($from_currency)); ?></span>	
														</span>
													</li>
													<li class="resp-msg-li2">
														<label>Available Balance</label>
														<span class="btc-span buy-dark-bg" id="sellAvailBalSpan" >
															<input type="text" readonly id="selected-<?php echo e(strtolower($to_currency)); ?>" class="form-control"/>	
															<span class="btc-right"><?php echo e(strtoupper($to_currency)); ?></span>	
														</span>
														<div class="sell-response-msg"></div>
													</li>											
												</ul>
												<input type="hidden" name="from_coin"  value="<?php echo e(strtoupper($to_currency)); ?>">
                                            	<input type="hidden" name="to_coin"  value="<?php echo e(strtoupper($from_currency)); ?>">
												<div class="discover-btn no-shadow-s clearfix">
													<button type="submit" class="btn btn-global-dark sell sell-btn">Sell <?php echo e(strtoupper($to_currency)); ?> <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
												</div>										
												
											</form>
									</div>
								</div>		
							</div>
							                                     
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-3 p-l-10 p-r-15">
					<h4 class="buyorder-title margin-top-10">Buy Orders</h4>
					<div class="dash-table-markets no-padding table-responsive data-spacing-td">				
						<table id="data-tables-markets1" class="table table-cryptic  no-footer">
						  <thead>
							 <tr>
								<th>Amount(<?php echo e(strtoupper($to_currency)); ?>)</th>
								<th>Price(<?php echo e(strtoupper($from_currency)); ?>)</th>
								<th>Total(<?php echo e(strtoupper($from_currency)); ?>)</th>
							 </tr>
						  </thead>
						<tbody class="buy-orders">
							<tr><td colspan="3" align="center">Loading...</td></tr>
						</tbody>
					  </table>
					</div>
				</div>				
				<div class="col-sm-12 col-md-3 p-l-10">
					<h4 class="buyorder-title margin-top-10">Sell Orders</h4>
					<div class="dash-table-markets no-padding table-responsive data-spacing-td">				
						<table id="data-tables-markets1" class="table table-cryptic  no-footer">
						  <thead>
							 <tr>
							 	<th>Amount(<?php echo e(strtoupper($to_currency)); ?>)</th>
							 	<th>Price(<?php echo e(strtoupper($from_currency)); ?>)</th>
								<th>Total(<?php echo e(strtoupper($from_currency)); ?>)</th>
							 </tr>
						  </thead>
						<tbody class="sell-orders">
							<tr><td colspan="3" align="center">Loading...</td></tr>								
						</tbody>
					  </table>
					</div>
				
				</div>
				<div class="col-sm-12 col-md-6 margin-top-30 p-r-15">
					<div class="mytrading-history">
						<!--<div class="canceloreder">
							<a href="#" class="btn cancelorder">Cancel Order</a>
						</div>-->
						<div class="buy-sell-trade margin-top-10">
							<ul class="nav nav-tabs" role="tablist">
								<li role="presentation">
									<a href="#myactiveorder" aria-controls="myactiveorder" role="tab" data-toggle="tab" class="btn active show">My Active Order</a>
								</li>
								<li role="presentation">
									<a href="#mytradinghistory" aria-controls="mytradinghistory" role="tab" data-toggle="tab" class="btn">My Trading History</a>
								</li>
								<!-- <li role="presentation">
									<a href="#myvolite" aria-controls="myvolite" role="tab" data-toggle="tab" class="btn">My Wallet</a></li>								 -->
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="myactiveorder">
								  <div class="dash-table-markets no-padding table-responsive data-spacing-td">	
										<table id="data-tables-markets1" class="table table-cryptic table-fixed1 no-footer">
										  <thead>
											 <tr>
												<th>Operation</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Amount</th>
												<th class="last text-center">Cancel Order</th>
											 </tr>
										  </thead>
										<tbody>
											<!-- <tr>
												<td>26.04 12:12</td>
												<td class="color-red">Sell</td>
												<td class="no-wrap">0.00000059</td>
												<td>711.773015</td>
												<td>0.00041994</td>
												<td class="color-red last text-center"><i class="far fa-times-circle"></i></td>
											</tr> -->
											<tbody class="my-open-trade">
												<tr>
													<td class="" colspan="5" align="center">Loading ...</td>
													
												</tr>
											</tbody>							
										</tbody>
									  </table>
								  </div>
								</div>




								<div role="tabpanel" class="tab-pane" id="mytradinghistory">	
									<div class="dash-table-markets no-padding table-responsive data-spacing-td">	
										<table id="data-tables-markets1" class="table table-cryptic table-fixed1 no-footer">
										  <thead>
											 <tr>
												<th>Date/time</th>
												<th>Operation</th>
												<th>Price</th>
												<th>Quantity</th>
												<th>Amount</th>
											</tr>
										  </thead>
										<tbody class="my-trade">
											<tr>
												<td class="" colspan="5" align="center">Loading ...</td>
												
											</tr>
																		
										</tbody>
									  </table>
									  </div>
								</div>
								
								
								
								
								
									  <div role="tabpanel" class="tab-pane" id="myvolite">
						<div class="dash-table-markets no-padding table-responsive data-spacing-td newwallet">			
						<table id="data-tables-markets1" class="table table-cryptic table-fixed2 no-footer">
						  <thead>
							 <tr>
								<th>Cryptocurrency</th>
								<th class="total-orders text-center">Total</th>
								<th class="total-orders text-center">In Orders</th>
								<th class="text-center total-orders-abl">Available</th>
								<th class="transit">Transact</th>
							 </tr>
						  </thead>
						<tbody>
							<tr>
							<td><i class="cc mmt-icon BTC" title="BTC"></i>BITCOIN( BTC )</td>
							<td class="total-orders">0.00000000 </td>
							<td class="total-orders text-center">0.00000000 </td>
							<td class="text-center total-orders-abl">0.00000000<br/> <span class="small-gray">≈ 0.00 INR</span> </td>
							<td class="transit">
								<div class="actions">
									<a href="#" data-toggle="modal"  class="btn btn-primary"
									data-toggle="tooltip" data-placement="bottom" title="Trade"
									>
									<i class="fas fa-arrow-alt-circle-down"></i></a>
									<a href="#" data-toggle="modal" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Trade">
									
									<i class="fas fa-arrow-alt-circle-up"></i></a>
									<a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Trade"><i class="fas fa-exchange-alt"></i></a>	
									<!-- Deposit Model Popup Box start-->
									</div>
									
									<div id="deposit" class="modal fade" role="dialog">
										<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">GILTXCHANGE DEPOSIT</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
												 <form class="form">
													<fieldset>
													<div class="form-group">
														<div class="input-group">														  			  
														  <input placeholder="Volume" class="form-control" type="text">
														</div>
													  </div>
													  <div class="form-group">
														<div class="input-group">														  			  
														  <input  placeholder="email address" class="form-control" type="email">
														</div>
													  </div>
													  <div class="form-group">
														<div class="input-group">														  			  
														  <input  placeholder="Remark" class="form-control" type="text">
														</div>
													  </div>
													 <div class="withdraw-form">
														<h3>WITHDRAWAL FEES</h3>
														<p>0.003 ETH</p>
													 </div>
													 <div class="note-s">
														<h3>NOTE:</h3>
														<div class="discrip">
															Withdrawal to Smart Contract Addresses will not be processed
															<div class="dis-s"></div>
															Do not use Koinex wallets for Participating in ICOs. We Will not be
															responsible for the loss of tokens as Koinex Wallets will not support
															the tokens from the ICOs
															
															<div class="dis-s"></div>
															<p>Please verify the destination wallet address. Once submitted. the 
															withdrawal request cannot be reverted back.</p>
														</div>
													 </div>
														<button class="btn btn-global">NEXT <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
													 
													</fieldset>
												  </form>
											</div>
											<div class="modal-footers"></div>
										</div>
										</div>
									</div>
									<!-- deposit Model Popup Box end-->
									
									<!-- WITHDRAW Model Popup Box start-->											
									<div id="withdraw" class="modal fade" role="dialog">
										<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">GILTXCHANGE WITHDRAW</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<div class="modal-body">
												 <form class="form">
													<fieldset>
													  <div class="withdraw-form">
														<h3>MINIMUM DEPOSIT LIMIT</h3>
														<p>0.003 ETH</p>
													 </div>
													 <div class="note-s">
														<h3>NOTE:</h3>
														<div class="discrip">
															Deposit from Smart Contract Address will not be processed
															
															<div class="dis-s"></div>
															<p>Please only transfer <b>Giltxchange</b> tokens to this wallet address. Sending any
															others token may result into a loss and no wallet credit.</p>
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
									
									
									
									
								</div>
							</td>
						</tr>
						<tr>
							<td><i class="cc mmt-icon LTC" title="LTC"> </i>LITECOIN( LTC )</td>
							<td class="total-orders">0.00000000 </td>
							<td class="total-orders text-center">0.00000000 </td>
							<td class="text-center total-orders-abl"> 0.00000000<br/><span class="small-gray"> ≈ 0.00 INR <span></td>
							<td class="transit">
								<div class="actions">
									<a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Deposit"><i class="fas fa-arrow-alt-circle-down"></i></a>
									<a href="#" class="btn btn-success" data-toggle="tooltip" 
									data-placement="bottom" title="Withdrawal"><i class="fas fa-arrow-alt-circle-up"></i></a>
									<a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Trade"><i class="fas fa-exchange-alt"></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td><i class="cc XRP" title="XRP"></i>RIPPLE( XRP )</td>
							<td class="total-orders">0.00000000 </td>
							<td class="total-orders text-center">0.00000000 </td>
							<td class="text-center total-orders-abl"> 0.00000000<br/><span class="small-gray"> ≈ 0.00 INR </span></td>
							<td class="transit">
								<div class="actions">
									<a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Deposit"><i class="fas fa-arrow-alt-circle-down"></i></a>
									<a href="#" class="btn btn-success" data-toggle="tooltip" 
									data-placement="bottom" title="Withdrawal"><i class="fas fa-arrow-alt-circle-up"></i></a>
									<a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Trade"><i class="fas fa-exchange-alt"></i></a>
								</div>
							</td>
						</tr>
						<tr>
							<td><i class="fab fa-bitcoin"></i>BITCOIN CASH( BCH )</td>
							<td class="total-orders">0.00000000 </td>
							<td class="total-orders text-center">0.00000000 </td>
							<td class="text-center total-orders-abl"> 0.00000000<br/><span class="small-gray"> ≈ 0.00 INR </span></td>
							<td class="transit">
								<div class="actions">
									<a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Deposit"><i class="fas fa-arrow-alt-circle-down"></i></a>
									<a href="#" class="btn btn-success" data-toggle="tooltip" 
									data-placement="bottom" title="Withdrawal"><i class="fas fa-arrow-alt-circle-up"></i></a>
									<a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Trade"><i class="fas fa-exchange-alt"></i></a>
								</div>

							</td>
						</tr>
						
						<tr>
							<td><i class="cc mmt-icon ETH" title="ETH"></i>ETHEREUM( ETH )</td>
							<td class="total-orders">0.00000000 </td>
							<td class="total-orders text-center ">0.00000000 </td>
							<td class="text-center total-orders-abl"> 0.00000000<br/><span class="small-gray"> ≈ 0.00 INR </span></td>
							<td class="transit">
								<div class="actions">
									<a href="#" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Deposit"><i class="fas fa-arrow-alt-circle-down"></i></a>
									<a href="#" class="btn btn-success" data-toggle="tooltip" 
									data-placement="bottom" title="Withdrawal"><i class="fas fa-arrow-alt-circle-up"></i></a>
									<a href="#" class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="Trade"><i class="fas fa-exchange-alt"></i></a>
								</div>

							</td>
						</tr>						
						</tbody>
					  </table>
					</div>

								
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-6 margin-top-40 p-l-10">
					<h4 class="buyorder-title">Trade History </h4>
					<div class="dash-table-markets no-padding table-responsive data-spacing-td">				
						<table id="data-tables-markets1" class="table table-cryptic table-fixed no-footer">
						  <thead>
							 <tr>
								<th>Date/time</th>								
								<th>Price</th>
								<th>Quantity</th>
								<th>Amount</th>
							 </tr>
						  </thead>
						  <tbody class="trade-history">
					  			<tr><td colspan="4" align="center">Loading...</td></tr>
						  </tbody>
					  </table>
					</div>
				</div>			
			</div>
		</div>	
	</div>
</section>

<!-- Buy Order Modal (start) -->
<div id="myModal" class="modal fade buy-sell-modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title coin-request"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<div class="table-responsive dash-table-markets no-heights">
						<table class="table table-bordered">
							<tr>
								<th>COIN</th>
								<th>VOLUME</th>
								<th>RATE</th>
								<th>FEE</th>
								<th>TOTAL AMOUNT</th>
							</tr>
							<tr>
								<td class="selected-coin" ></td>
								<td class="selected-vol" ></td>
								<td class="selected-rate" ></td>
								<td class="total-fee" ></td>
								<td class="total-amt" ></td>
							</tr>
						</table>
					</div>
				</div>
				
				<div class="form-group text-right">					
					<button class="btn btn-global confirm-action" data-style="zoom-in">Confirm</button>
				</div>
			</div>
			<div class="modal-footers"></div>
		</div>
	</div>
</div>
<!-- Buy Order Modal (End) -->


<!-- Buy Sell Cancel Order Modal (start) -->
<div id="buySellCancelModal" class="modal fade buy-sell-modal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title cancel-coin-request"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="#" name="buy-sell-cancel-form" id="buy-sell-cancel-form" >				
				<input type="hidden" name="row_id" id="cancel_row_id" value="" >
				<input type="hidden" name="trade_type" id="cancel_trade_type" value="" >
				<div class="modal-body">				
					<div class="form-group">
						<div class="table-responsive dash-table-markets no-heights">
							<table class="table table-bordered">
								<tr>								
									<th>VOLUME</th>
									<th>RATE</th>
									<th>FEE</th>
									<th>TOTAL AMOUNT</th>
								</tr>
								<tr>								
									<td class="cancel-trade-volume" ></td>
									<td class="cancel-trade-rate" ></td>
									<td class="cancel-trade-fee" ></td>
									<td class="cancel-trade-amount" ></td>
								</tr>
							</table>
						</div>
					</div>
					
					<div class="form-group text-left cancelTradeAjaxResp" >
					</div>
					
					<div class="form-group text-right buySellSubmitBtns" >
						<!--<button type="button" class="btn btn-global buysell-close-btn" data-style="zoom-in">Close</button>-->
						<button type="submit"  class="btn btn-global buysell-cancel-btn" data-style="zoom-in">Confirm</button>
					</div>
				</div>
			</form>
			
			<div class="modal-footers"></div>
		</div>
	</div>
</div>
<!-- Buy Sell Cancel Order Modal (start) -->       
    

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>

    <script>
        node_server_point = '<?php echo e($node_server_point); ?>';
    </script>
    <script src="<?php echo e($node_server_point); ?>/socket.io/socket.io.js"></script>
    <script src="<?php echo e(asset('/public/gilt/js/trade.js')); ?>"></script>
	<script src="<?php echo e(asset('/public/gilt/js/otherform.js')); ?>"></script>
    <script>

        

        var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [

                {
                    label: "XRP",
                    backgroundColor: 'rgba(151, 151, 186, 1)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
                // ,{
                //     label: "Data 2",
                //     backgroundColor: 'rgba(220, 220, 220, 0.5)',
                //     pointBorderColor: "#fff",
                //     data: [65, 59, 80, 81, 56, 55, 40]
                // }
            ]
        };

        var lineOptions = {
            responsive: true
        };

        c = Array('<?php echo e($from_currency); ?>', '<?php echo e($to_currency); ?>');
		b_com = '<?php echo e($buy_commission); ?>';
		s_com = '<?php echo e($sell_commission); ?>';


        $(function(){
			//Get Current Balance 
            getBalance(c);
            operOrders(c);
            buySell(c);
            myTrades(c);
            
        });
		
		var barGraph = $('#tradingview_48310').children();	
		barGraph[0].className = barGraph[0].className + ' highlight-gp';
		
		var barGraph2 = $('.highlight-gp').children();
		barGraph2[0].className = barGraph2[0].className + ' highlight2-gp';		

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('xchange.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>