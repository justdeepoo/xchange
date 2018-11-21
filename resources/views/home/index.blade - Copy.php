@extends('home.master')
@section('headerjs')
@endsection()
@section('content')
<section class="section4">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-6">
					<div class="viewsec4">
						<div class="box-main-sec4">
							<div class="toplabel">
								<label class="dark-color">BTC/USD</label>
								<span class="pink-color">-1.25%</span>
							</div>						
							<div class="bottomlabel">
								<div class="title">
									<span class="pink-color">$8120.87</span> 
									<span class="gray-color"></span>
								</div>
								<div class="discrip">
									<label class="gray-color">Volume:</label>
									<span class="gray-color">5,765.64 BTC</span>
								</div>
							</div>
						</div>
						<div class="sec4-view1"></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="viewsec4">
						<div class="box-main-sec4">
							<div class="toplabel">
								<label class="dark-color">BTC/USD</label>
								<span class="pink-color">-1.25%</span>
							</div>						
							<div class="bottomlabel">
								<div class="title">
									<span class="pink-color">$8120.87</span> 
									<span class="gray-color">$750.87</span>
								</div>
								<div class="discrip">
									<label class="gray-color">Volume:</label>
									<span class="gray-color">5,765.64 BTC</span>
								</div>
							</div>
						</div>
						<div class="sec4-view3"></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="viewsec4">
						<div class="box-main-sec4">
							<div class="toplabel">
								<label class="dark-color">BTC/USD</label>
								<span class="pink-color">-1.25%</span>
							</div>						
							<div class="bottomlabel">
								<div class="title">
									<span class="pink-color">$8120.87</span> 
									<span class="gray-color">$750.87</span>
								</div>
								<div class="discrip">
									<label class="gray-color">Volume:</label>
									<span class="gray-color">5,765.64 BTC</span>
								</div>
							</div>
						</div>
						<div class="sec4-view3"></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="viewsec4">
						<div class="box-main-sec4">
							<div class="toplabel">
								<label class="dark-color">BTC/USD</label>
								<span class="green-color">-1.25%</span>
							</div>						
							<div class="bottomlabel">
								<div class="title">
									<span class="drak-color">$8120.87</span> 
									<span class="gray-color">$750.87</span>
								</div>
								<div class="discrip">
									<label class="gray-color">Volume:</label>
									<span class="gray-color">5,765.64 BTC</span>
								</div>
							</div>
						</div>
						<div class="sec4-view4"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section5">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Nav tabs -->
					<div class="card">					
						<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
							<li class="active"><a href="#favorites" data-toggle="tab" class="active show">Favorites</a></li>
							<li><a href="#btcmarkets"  data-toggle="tab">BTC Markets</a></li>
							<li><a href="#ethmarkets" data-toggle="tab">ETH Markets</a></li>
							<li><a href="#usdmarkets" data-toggle="tab">USDT Markets</a></li>
							<!--<li><a href="#markets1" data-toggle="tab">Markets 1</a></li>
							<li><a href="#markets2" data-toggle="tab">Markets 2</a></li>
							<li><a href="#markets3" data-toggle="tab">Markets 3</a></li>-->
						</ul>
						<div id="my-tab-content" class="tab-content">
							<div class="tab-pane active" id="favorites">
								<div class="tradingview-widget-container">
								  <div class="tradingview-widget-container__widget"></div>
								  <div class="tradingview-widget-copyright"><a href="https://in.tradingview.com/markets/cryptocurrencies/prices-all/" rel="noopener" target="_blank"><span class="blue-text">Cryptocurrency Markets</span> by TradingView</a></div>
								  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
								  {
								  "width": "100%",
								  "height": "600",
								  "defaultColumn": "overview",
								  "screener_type": "crypto_mkt",
								  "displayCurrency": "USD",
								  "locale": "in"
								}
								  </script>
								</div>
							</div>
							<div class="tab-pane" id="btcmarkets">
								<table class="table table-striped">
									<thead>
									  <tr>
										<th></th>
										<th>Pair</th>
										<th>Last Price</th>
										<th>24h Change</th>
										<th>24h High</th>
										<th>24h Low</th>
										<th>24h Volume</th>
									  </tr>
									</thead>
									<tbody>
									 									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									</tbody>
								  </table>
							</div>
							<div class="tab-pane" id="ethmarkets">
								<table class="table table-striped">
									<thead>
									  <tr>
										<th></th>
										<th>Pair</th>
										<th>Last Price</th>
										<th>24h Change</th>
										<th>24h High</th>
										<th>24h Low</th>
										<th>24h Volume</th>
									  </tr>
									</thead>
									<tbody>
									 									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									</tbody>
								  </table>
							</div>
							<div class="tab-pane" id="usdmarkets">
								<table class="table table-striped">
									<thead>
									  <tr>
										<th></th>
										<th>Pair</th>
										<th>Last Price</th>
										<th>24h Change</th>
										<th>24h High</th>
										<th>24h Low</th>
										<th>24h Volume</th>
									  </tr>
									</thead>
									<tbody>
									 									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star active"></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="red-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="red-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									  <tr>
										<td><i class="far fa-star "></i></td>
										<td class="first">TRX/BTC </td>
										<td><span class="green-color">0.00000618</span> / <span>$0.05</span></td>
										<td class="green-color">8.04% </td>
										<td>0.00000633</td>
										<td>0.00000553 </td>
										<td>13,102.00341589</td>
									  </tr>
									</tbody>
								  </table>
							</div>
						
						</div>
						
					</div>					
                </div>
			</div>
		</div>
	</section>
    <!-- Page Content -->
    <section class="bestbit-2">
      <div class="container">
			<!--<div class="title">The Best</div>-->
			<h3 class="sec-title">GILTX TOKEN</h3>
				<!--<div class="lunch">Launching Soon</div>-->
				<div class="row">
				<div class="col-md-8 col-sm-6">
					<div class="discrip">
						<p>Giltx token (GIX) is available with a single purpose i.e everlasting success of a staging or a
						belvedere as it is devoted towards its users in terms of its service or driving action. </p>
						<ul class="point-list">
							<li>Bring home GIX tokens for trading on Giltxchange</li>
							<li>Utilize GIX Token to pay for trading</li>
							<li>Giltxchange Offers you 50% off on your trading fee.</li>
							<li>Indeed Trade GIX on exchange.</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 col-sm-6">
					<!--<div class="gxlo-img">
						<img src="{{asset('/public/gilt/img/GXLOGOCOIN2.png')}}"/>
					</div>-->
					<div class="gxlo-img">
						<img src="{{asset('/public/gilt/img/GILTXCOIN.png')}}"/>
					</div>
				</div>
			</div>
			
      </div>
    </section>
    <div class="header-margin">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12	 header-center">
					<div class="headerform-main">
						<div class="header-content">
							<h2 class="blk-title">The Future of <br/>Financing Technology<br/> is Here.</h2>
							<div class="discription">
								Giltxchange makes it safe and easy to Buy, Sell and Trade in Digital Currencies like Bitcoin and Ethereum 
							</div>
							<!--<div class="discover-btn">
								<button type="button" class="btn btn-global-dark">discover ICO <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
							</div>-->
						</div>
						<div class="header-form">
							<section class="login-form">
								<div class="form-wrap">
									<h1>Login into your account</h1>
									<form role="form" name="login-form" id="login-form" autocomplete="off">
										<div class="form-group">											
											<input type="text" class="form-control" name="email" id="email" placeholder="Email address">
										</div>
										<div class="form-group">											
											<input type="password" class="form-control" name="password" id="password" placeholder="Password">
										</div>
										<div class="rebember-group">
											<div class="form-check">
												<input type="checkbox" class="filled-in form-check-input" id="checkbox101" checked="checked">
												<label class="form-check-label" name="remember_me" for="checkbox101">Remember me</label>
											</div>
											<div class="forgot-pass">
												<a href="#" data-toggle="modal" data-target="#myModal">Forgot password?</a>
											</div>
										</div>
										<div class="login-btn">
											<button type="submit" class="btn btn-global login-submit">LOG IN<span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
										</div>
										<div class="login-msg-ara">
											
										</div>
																			
									</form>
								</div>
								<div class="login-footers">
									Want a new account?<a href="#" data-toggle="modal" data-target="#signup">Sign up now!</a>
								</div>
								
								<!-- Enable to 2 fA form -->

								
								<div id="2fa-form" class="modal fade" role="dialog">
								
									<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Enter Google 2FA Code</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
												
													<fieldset>
														<div class="form-group">
														<div class="input-group">
															<span class="input-group-addon"><i class="far fa-user"></i></span>			  
															<input id="2fa-code" placeholder="2FA" name="2fa-code" class="form-control" type="text">
														</div>
														</div>
														<div class="form-group">
														<button class="btn btn-global btn-block submit-2fa">Submit <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
														</div>
													</fieldset>
												
										</div>
										<div class="modal-footers"></div>
									</div>
									</div>
									
								</div>

								<!--- End of form -->
								
								
									<!-- Forgot Model Popup Box start-->											
									<div id="myModal" class="modal fade" role="dialog">
									<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Forgot Password</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="forgot-messgage">
											
										</div>

										<div class="modal-body">
												<form class="form" id="forgot-form" name="forgot-form">
												<fieldset>
													<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon"><i class="far fa-envelope"></i></span>			  
														<input  placeholder="Email address" name="email" id="email" class="form-control" type="text">
													</div>
													</div>
													<div class="form-group">
													<button class="btn btn-global btn-block forgot-sub">Submit <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
													</div>
												</fieldset>
												</form>
										</div>
										<div class="modal-footers"></div>
									</div>
									</div>
								</div>
								<!-- Forgot Model Popup Box end-->
											


								<!-- Sign Up Model Popup Box start-->											
								<div id="signup" class="modal fade" role="dialog">
									<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Create New Account</h4>
											<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>
										<div class="modal-body">
											<form class="login-form signup-form" name="reg-form" id="reg-form" >
												<div class="form-group">					 													  
													<input type="text" class="form-control" name="first_name"  id="first_name" placeholder="Firstname">
												</div>
												<div class="form-group">					 													  
													<input type="text" name="last_name"  id="last_name" class="form-control" placeholder="Lastname">
												</div>			
												<div class="form-group">					 													  
													<input type="email" name="email"  id="email" class="form-control" placeholder="Email Address">
												</div>
												<div class="form-group">					 													  
													<input type="text" name="mobile"  id="mobile" class="form-control" placeholder="Mobile Number">
												</div>
												<div class="form-group">					 													  
													<input type="password" name="password"  id="password" class="form-control" placeholder="Password">
												</div>
												<div class="form-group">					 													  
													<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password">
												</div>												
												<label><input type="checkbox" id="terms" value="1" name="terms"> I agree with the <a href="#">Terms and Conditions</a>.</label>													
											  <br/><br/>
											  <div class="form-group">
												<button class="btn btn-global btn-block reg-submit">SIGN UP <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
											  </div>												
											</form>
											<div class="signup-msg-ara">
											</div>
										</div>
										
										<div class="modal-footers"></div>
										
									</div>
									
									</div>
								</div>
								<!-- Sign-up Model Popup Box end-->
							</section>
						</div>						
					</div>        
				</div>
			</div>
		</div>
	 
  
    </div>
	
	  
@endsection()
@section('footerjs')
    
@endsection()
