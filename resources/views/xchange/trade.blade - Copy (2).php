@extends('xchange.master')


@section('headerjs')

@endsection()

@section('content')



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
						"width": 920,
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
							<div role="tabpanel" class="tab-pane {{strtolower($from_currency)=='btc'?'active':''}}" id="btc">
								<div class="dash-table-markets no-padding table-responsive">
									<table id="data-tables-market" class="table table-cryptic <!--dataTable--> no-footer"> <!--data-page-length="10"-->
									<thead>
										 <tr>
											<th>Pair <i class="fa fa-sort"></i></th>
											<th>Price <i class="fa fa-sort"></i></th>
											<th>Changes <i class="fa fa-sort"></i></th>
										 </tr>
									  </thead>
									<tbody>
										<?php
											foreach($pair_list['btc'] as $coin)
											{?>
												<tr>
													<td><p class="text-muted no-margin"><a href="{{url('/trade/btc-'.$coin->pair_coin)}}">{{strtoupper($coin->pair_coin)}}/BTC</a></p></td>
													<td><p class="no-margin"><span></span> {{number_format($coin->rate,4)}}</p></td>
													<td class="no-wrap"><span class="change-down color-red label label-light-danger"><i class="fa fa-chevron-down"></i> -15.20%</span></td>
												</tr>
										<?php	
											}
										?>
									</tbody>
								  </table>
								</div>							
							</div>
							<div role="tabpanel" class="tab-pane {{strtolower($from_currency)=='eth'?'active':''}}" id="eth">
								<div class="dash-table-markets">
									<table id="data-tables-market" class="table table-cryptic <!--dataTable--> no-footer"> <!--data-page-length="10"-->
									<thead>
										 <tr>
											<th>Pair <i class="fa fa-sort"></i></th>
											<th>Price <i class="fa fa-sort"></i></th>
											<th>Changes <i class="fa fa-sort"></i></th>
										 </tr>
									  </thead>
									<tbody>
										<?php
											foreach($pair_list['eth'] as $coin)
											{?>
												<tr>
													<td><p class="text-muted no-margin"><a href="{{url('/trade/eth-'.$coin->pair_coin)}}">{{strtoupper($coin->pair_coin)}}/ETH</a></p></td>
													<td><p class="no-margin"><span></span> {{number_format($coin->rate,4)}}</p></td>
													<td class="no-wrap"><span class="change-down color-red label label-light-danger"><i class="fa fa-chevron-down"></i> -15.20%</span></td>
												</tr>
										<?php	
											}
										?>
									</tbody>
								  </table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane {{strtolower($from_currency)=='inr'?'active':''}}" id="inr">
								<div class="dash-table-markets">
								<table id="data-tables-market" class="table table-cryptic <!--dataTable--> no-footer"> <!--data-page-length="10"-->
									<thead>
										 <tr>
											<th>Pair <i class="fa fa-sort"></i></th>
											<th>Price <i class="fa fa-sort"></i></th>
											<th>Changes <i class="fa fa-sort"></i></th>
										 </tr>
									  </thead>
									<tbody>
										<?php
											foreach($pair_list['inr'] as $coin)
											{?>
												<tr>
													<td><p class="text-muted no-margin"><a href="{{url('/trade/inr-'.$coin->pair_coin)}}">{{strtoupper($coin->pair_coin)}}/INR</a></p></td>
													<td><p class="no-margin"><span></span> {{number_format($coin->rate,4)}}</p></td>
													<td class="no-wrap"><span class="change-down color-red label label-light-danger"><i class="fa fa-chevron-down"></i> -15.20%</span></td>
												</tr>
										<?php	
											}
										?>
									</tbody>
								  </table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="btctab2">
								<div class="dash-table-markets">
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
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
							 <li role="presentation">
								<a disabled aria-controls="market" class="btn" role="tab">Market</a>
							</li>
							<!--<li role="presentation">
								<a href="#stoplimit" aria-controls="stoplimit" role="tab" class="btn" data-toggle="tab">Stop Limit <i class="fas fa-question-circle"></i></a>
							</li> -->
						</ul>
						<!-- Tab panes -->
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="limit">
								<div class="buysell-product"> 
									<div class="view-buy">
										<h3>Buy {{strtoupper($to_currency)}}</h3>
											<form action="#" name="buy-form" id="buy-form" autocomplete="off">
												<ul class="clearfix">
													<li>
														<label>Volume</label>
														<span class="btc-span">
															<input type="text" name="vol" value=""  class="form-control cust-inp only-int buy-input" id="vol"/>	
															<span class="btc-right">{{strtoupper($to_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Price per {{strtoupper($to_currency)}}</label>
														<span class="btc-span">
															<input type="text" name="at" value="" class="form-control cust-inp only-int buy-input" id="at"/>	
															<span class="btc-right">{{strtoupper($from_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Total</label>
														<span class="btc-span buy-dark-bg">
															<input id="buy-total-price" type="text" readonly class="form-control"/>	
															<span class="btc-right">{{strtoupper($from_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Commission</label>
														<span class="btc-span buy-dark-bg">
															<input type="text" id="buy-commission" readonly id="commission-buy-{{strtoupper($to_currency)}}" class="form-control"/>	
															<span class="btc-right">{{strtoupper($from_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Available Balance</label>
														<span class="btc-span buy-dark-bg">
															<input type="text" readonly id="selected-{{strtolower($from_currency)}}" class="form-control"/>	
															<span class="btc-right">{{strtoupper($from_currency)}}</span>	
														</span>
													</li>											
												</ul>
												<input type="hidden" name="from_coin" id="from_coin" value="{{strtoupper($from_currency)}}">
                                           	 	<input type="hidden" name="to_coin" id="to_coin" value="{{strtoupper($to_currency)}}">
												<div class="discover-btn no-shadow-s clearfix">
													<button type="submit" class="btn btn-global-dark buy buy-btn">Buy {{strtoupper($from_currency)}} <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
												</div>
												<div class="buy-response-msg"></div>
											</form>
									</div>
									<div class="view-buy">
										<h3>Sell  {{strtoupper($to_currency)}}</h3>
											<form action="#" name="sell-form" id="sell-form" autocomplete="off" > 
												<ul class="clearfix">
													<li>
														<label>Amount</label>
														<span class="btc-span">
															<input type="text" name="vol"  class="form-control cust-inp only-int sell-input" id="vol"/>	
															<span class="btc-right">{{strtoupper($to_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Price per {{strtoupper($to_currency)}}</label>
														<span class="btc-span">
															<input type="text" name="at" class="form-control cust-inp only-int sell-input" id="at"/>	
															<span class="btc-right">{{strtoupper($from_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Total</label>
														<span class="btc-span buy-dark-bg">
															<input id="sell-total-price" type="text" readonly class="form-control"/>	
															<span class="btc-right">{{strtoupper($from_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Commission</label>
														<span class="btc-span buy-dark-bg">
															<input type="text" id="sell-commission" readonly class="form-control"/>	
															<span class="btc-right">{{strtoupper($from_currency)}}</span>	
														</span>
													</li>
													<li>
														<label>Available Balance</label>
														<span class="btc-span buy-dark-bg">
															<input type="text" readonly id="selected-{{strtolower($to_currency)}}" class="form-control"/>	
															<span class="btc-right">{{strtoupper($to_currency)}}</span>	
														</span>
													</li>											
												</ul>
												<input type="hidden" name="from_coin"  value="{{strtoupper($to_currency)}}">
                                            	<input type="hidden" name="to_coin"  value="{{strtoupper($from_currency)}}">
												<div class="discover-btn no-shadow-s clearfix">
													<button type="submit" class="btn btn-global-dark sell sell-btn">Sell {{strtoupper($to_currency)}} <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
												</div>
												<div class="sell-response-msg"></div>
												
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
								<th>Amount({{strtoupper($to_currency)}})</th>
								<th>Price({{strtoupper($from_currency)}})</th>
								<th>Total({{strtoupper($from_currency)}})</th>
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
							 	<th>Amount({{strtoupper($to_currency)}})</th>
							 	<th>Price({{strtoupper($from_currency)}})</th>
								<th>Total({{strtoupper($from_currency)}})</th>
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
														<button class="btn btn-global">NEXT <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
													 
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
								<th>Operation</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Amount</th>
							 </tr>
						  </thead>
						  <tbody class="trade-history">
					  			<tr><td colspan="5" align="center">Loading...</td></tr>
						  </tbody>
					  </table>
					</div>
				</div>			
			</div>
		</div>	
	</div>
</section>

<div class="coin-deposit">
        
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <div class="modal-title action-heading"><span class="coin-request">NEW BUY ORDER</span></div>
                        
                    </div>
                        <div class="modal-body" style="">
                            <div>
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>COIN</strong> </div>
                                    <div class="col-md-6 selected-coin">---</div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>VOLUME</strong> </div>
                                    <div class="col-md-6 selected-vol">0</div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>RATE</strong> </div>
                                    <div class="col-md-6 selected-rate">0</div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>FEE</strong> </div>
                                    <div class="col-md-6 total-fee">0</div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>TOTAL AMOUNT</strong> </div>
                                    <div class="col-md-6 total-amt">00</div>
                                </div>   
                            </div>
                            <!-- -->
                            <div class="clearfix"></div>
                            <br/><br/>
                            <!-- <small><strong>TRADE FEES</strong></small>
                            <small> Trade Fee charged for this order is 0.00% (inclusive of all taxes)</small> -->
                        </div>
                        <div class="modal-footer">
                            <button class="ladda-button ladda-button-demo btn btn-default back-popup" data-style="zoom-in">Back</button>
                            <button class="ladda-button ladda-button-demo btn btn-primary confirm-action" data-style="zoom-in">Confirm</button>
                        </div>
                    </div>
                </div>
    </div>

@endsection()
@section('footerjs')

    <script>
        node_server_point = '{{env('node_server_point')}}';
    </script>
    <script src="{{env('node_server_point')}}/socket.io/socket.io.js"></script>
    <script src="{{asset('/public/gilt/js/trade.js')}}"></script>
    <script>

        
        node_server_point = '{{env('node_server_point')}}';

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

        c = Array('{{$from_currency}}', '{{$to_currency}}');
		b_com = '{{$buy_commission}}';
		s_com = '{{$sell_commission}}';


        $(function(){
			//Get Current Balance 
            getBalance(c);
            operOrders(c);
            buySell(c);
            myTrades(c);
            
        });

    </script>
@endsection()
