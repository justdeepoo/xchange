@extends('home.master')
@section('headerjs')
@endsection()

@section('content')

	<section class="section6 m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">Fees & Limits</div></div>
			</div>	
		</div>		
	</section>			
	<section class="section9 text-left">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<h4 class="static-title"><i class="fas fa-hand-point-right"></i> Fees</h4>
					<div class="staric-data">
						<div class="data-details">
							<h5>Trading Fee</h5>
							<ul>
								<li>
									<label>Bid fee</label>
									<span> 0.10%*</span>
								</li>
								<li>
									<label>Ask fee</label>
									<span> 0.10%*</span>
								</li>
							</ul>
							<p class="disclimer"><span class="color-red">*</span> This fee is charged at the moment of the trade. There is no fee for placing an order. </p>
						</div>
					</div>				
					<div class="staric-data">
						<div class="data-details">
							<h5>Cryptocurrency Deposits</h5>
							<p class="details-disc">No fee..</p>
						</div>
					</div>		
					<div class="staric-data">
						<div class="data-details">
							<h5>Cryptocurrency Withdrawals <span class="color-red">(Miner fee.**)</span></h5>
							<p class="details-disc">Exchange will set mining fees for withdrawals. These mining fees are subject to change without notice due to network volatility. These fees will be held in a miner fee reserve pool. Exchange will group user withdrawals and send withdrawals to the blockchain together in the next available block. This is so Exchange can keep fees as low as possible while having fast withdrawals. In rare cases, the blockchain explorer will show a fee lower or higher than what was set by Exchange. In these cases, the remainder will return to the miner fee reserve pool, or the miner fee reserve pool will cover the higher fee. </p>
						</div>
					</div>						
				</div>
			</div>
			<div class="fee-table">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<h5>Limits</h5>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
								  <tr>
									<th>Limits</th>
									<th>Per Transaction</th>
									<th>Per Day</th>
								  </tr>
								</thead>
								<tbody>								
								  <tr>
									<td>BTC, ETH, XRP, LTC and BCH withdrawals </td>
									<td>Min. 0.002 BTC, 0.004 ETH, 0.03 XRP, 0.02 LTC, 0.02 DASH and 0.002 BCH Max. 10 BTC, 150 ETH, 1,00,000 XRP, 1,000 LTC, 1,000 DASH and 10 BCH </td>
									<td>1500 ETH, 50 BTC, 5000 LTC, 10,00,000 XRP, 50 BCH, 5,000 DASH </td>
								  </tr>
								  <tr>
									<td>BTC, ETH, XRP, LTC, DASH and BCH Deposits </td>
									<td>Min. 0.01 ETH, 0.001 BTC, 0.01 LTC, 0.1 XRP, 0.01 DASH and 0.001 BCH</td>
									<td>No Limit </td>
								  </tr>
								</tbody>
							  </table>
							 </div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
	
@endsection()
@section('footerjs')
    
    
@endsection()
