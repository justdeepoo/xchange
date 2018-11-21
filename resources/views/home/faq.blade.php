@extends('home.master')
@section('headerjs')
@endsection()

@section('content')
<!--===================== End of Header ========================-->
	<!--===================== First Section ========================-->
	<div class="faq-section animatedParent" style="padding:80px 0 50px 0; margin-bottom: 50px;" >
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="text text-center" style="max-width:100%" >
						<h1>FAQ</h1>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="panel-group acction-s" id="accordion">
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="panel-title expand">
						   <div class="right-arrow pull-right">+</div>
						  <a href="#">How to Start?</a>
						</h4>
					  </div>

					  
					  <div id="collapse1" class="panel-collapse collapse">
						<div class="panel-body">It's simple, quick and free to set up with Exchange. Click Signup, complete theform and activate your account. After verifying, you can fund your account with digital assets (Bitcoin, Litecoin, Ripple etc or INR Bank transfer) and start
						trading!</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Which documents are required for KYC?</a>
						</h4>
					  </div>
					  <div id="collapse2" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								<ul>
									<li>ID Proof (PAN Card).</li>
									<li>Address proof (Any one of Driver's license, Electricity bill, Telephone bill, Indian passport and Aadhar card).</li>
									<li>Bank Account Details.</li>
								</ul>
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Is PAN mandatory for registration?</a>
						</h4>
					  </div>
					  <div id="collapse3" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Yes. PAN is mandatory.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Is Aadhar mandatory for registration?</a>
						</h4>
					  </div>
					  <div id="collapse4" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Yes Aadhar in mandatory as The Government of India has made it mandatory to link
								Aadhaar number for any kind of transaction.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How much time it takes for KYC / Bank Account verification?</a>
						</h4>
					  </div>
					  <div id="collapse5" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Usually, it takes less than 24 hours for verification. However it depends on the No of applications received.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse6" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How safe are my documents with Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse6" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								All your given documents are extremely safe with Exchange. We do not share your personal information with anyone at any cost.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse7" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How safe are my documents with Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse7" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								No. An individual can hold only one account with Exchange.
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse8" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Can I have multiple bank accounts linked with my Exchange account?</a>
						</h4>
					  </div>
					  <div id="collapse8" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								No. One User can link only one bank account with his Exchange account.
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse9" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How to reset my password?</a>
						</h4>
					  </div>
					  <div id="collapse9" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Go to 'forget password' page and follow the steps to reset your password.
							</div>
						</div>
					  </div>
					</div>		
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse10" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">I want to change the bank details or mobile number associated with my account.</a>
						</h4>
					  </div>
					  <div id="collapse10" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Please contact Exchange Support with the details.
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse11" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How can I transfer INR to my Exchange wallet?</a>
						</h4>
					  </div>
					  <div id="collapse11" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								<div class="faq-app">
									<ul>
										<li>Transfer your INR via IMPS/NEFT/RTGS to the bank account shown in the Deposits page.</li>
										<li>Fill Up the deposit details in Deposit Submission page.</li>
										<li>Your amount will be reflected in your wallet.</li>
									</ul>
								</div>
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse12" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">What is the minimum INR I can deposit?</a>
						</h4>
					  </div>
					  <div id="collapse12" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Rs.2000 is the minimum deposit required to trade on Exchange.
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse13" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How to deposit cryptocurrencies on Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse13" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Click on the 'Deposit' button under the respective cryptocurrency and use the address to deposit your cryptocurrency.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse14" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Can I use my credit/debit card to transfer INR to Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse14" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								No. We do not accept credit/debit cards.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse15" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">What is the Fees for deposit and withdrawal on Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse15" class="panel-collapse collapse">
						<div class="panel-body">							
							<div class="faq-app">
								<ul>
									<li>
										<strong>Trading Fee</strong>
										<div class="dep-datas">
											<div class="viewfaq-s">
												<label>Bid fee:</label>
												<span>0.10%</span>
											</div>
											<div class="viewfaq-s">
												<label>Ask fee:</label>
												<span> 0.10%</span>
											</div>
											<div class="viewfaq-s">
												<p>This fee is charged at the moment of the trade. There is no fee for placing an order.</p>
											</div>
										</div>
									</li>
									<li>
										<strong>Fiat Deposits</strong>
										<div class="dep-datas">
											<div class="viewfaq-s no-fee">
												<p>No fee</p>
											</div>
										</div>
									</li>
									<li>	
									<strong>Fiat Withdrawals</strong>
										<div class="dep-datas">
											<div class="viewfaq-s no-fee">
												<p>Rs 10 to Indian bank accounts.</p>
											</div>
										</div>
									</li>
									<li>	
									<strong>Cryptocurrency Deposits</strong>
										<div class="dep-datas">
											<div class="viewfaq-s no-fee">
												<p>No fee.</p>
											</div>
										</div>
									</li>
									<li>	
									<strong>Cryptocurrency Withdrawals</strong>
										<div class="dep-datas">
											<div class="viewfaq-s no-fee">
												<p>Miner fee.*</p>
											</div>
										</div>
									</li>										
								</ul>
								<div class="dep-fter">
									**** Exchange will set mining fees for withdrawals. These mining fees are subject to change without notice due to network volatility. These fees will be held in a miner fee reserve pool. Exchange will group user withdrawals and send withdrawals to the blockchain together in the next available block. This is so Exchange can keep fees as low as possible while having fast withdrawals. In rare cases, the blockchain explorer will show a fee lower or higher than what was set by Exchange. In these cases, the remainder will return to the miner fee reserve pool, or the miner fee reserve pool will cover the higher fee.
								</div>
							</div>							
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse16" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">What is the Limits for deposit and withdrawal on Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse16" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								<table class="table table-striped">
									<tr>
										<th>Limits</th>
										<th>Per Transaction</th>
										<th>Per Day</th>
									</tr>
									<tr>
										<td>INR Deposit (NEFT/IMPS</td>
										<td>Minimum Rs 2000</td>
										<td>No Limit</td>
									</tr>
									<tr>
										<td>INR Withdrawal</td>
										<td>Min. Rs 1000 Max. Rs 5,00,000</td>
										<td>Rs 20,00,000</td>
									</tr>
									<tr>
										<td>BTC, ETH, XRP, LTC and BCH withdrawals</td>
										<td>Min. 0.002 BTC, 0.004 ETH, 0.03 XRP, 0.02 LTC, 0.02 DASH and 0.002 BCH Max. 10 BTC, 150 ETH, 1,00,000 XRP, 1,000 LTC, 1,000 DASH and 10 BCH</td>
										<td>1500 ETH, 50 BTC, 5000 LTC, 10,00,000 XRP, 50 BCH, 5,000 DASH</td>
									</tr>
									<tr>
										<td>BTC, ETH, XRP, LTC, DASH and BCH Deposits</td>
										<td>Min. 0.002 BTC, 0.004 ETH, 0.03 XRP, 0.02 LTC, 0.02 DASH and 0.002
											BCH Max. 10 BTC, 150 ETH,
											1,00,000 XRP, 1,000 LTC, 1,000
											DASH and 10 BCH
										</td>
										<td>1500 ETH, 50 BTC, 5000 LTC, 10,00,000 XRP, 50 BCH, 5,000 DASH</td>
									</tr>	
									<tr>
										<td>BTC, ETH, XRP, LTC, DASH and BCH Deposits</td>
										<td>Min. 0.01 ETH, 0.001 BTC, 0.01 LTC, 0.1 XRP, 0.01 DASH and 0.001 BCH</td>
										<td>No Limit</td>
									</tr>									
								</table>
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse17" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Can I store Cryptocurrencies on Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse17" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Yes, you can store your cryptocurrencies .
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse18" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How to Withdraw cryptocurrencies from Exchange?</a>
						</h4>
					  </div>
					  <div id="collapse18" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Click on the respective cryptocurrencies. Submit details such as Amount & address of wallet to withdrawal your cryptocurrenies.
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse19" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How to buy Cryptocurrencies?</a>
						</h4>
					  </div>
					  <div id="collapse19" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								After you deposit INR from your bank to your Exchange account, you can make an order to buy cryptocurrencies on the exchange. When your order is filled, you can withdraw your cryptocurrencies to your wallet.
							</div>
						</div>
					  </div>
					</div>	
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse20" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How to sell Cryptocurrencies?</a>
						</h4>
					  </div>
					  <div id="collapse20" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								After you send cryptocurrency from your wallet to your Exchange account, you can make an order to sell them for INR. When your order is filled, you can withdraw the INR to your bank.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse21" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">How much does Exchange charge in trading fees?</a>
						</h4>
					  </div>
					  <div id="collapse21" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								Please visit the Fee Section page for full details.
							</div>
						</div>
					  </div>
					</div>		
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse22" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Do you have any referral programs?</a>
						</h4>
					  </div>
					  <div id="collapse22" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								We will announce the referral program soon.
							</div>
						</div>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h4 data-toggle="collapse" data-parent="#accordion" href="#collapse23" class="panel-title expand">
							<div class="right-arrow pull-right">+</div>
						  <a href="#">Will I need to pay tax for gains on cryptocurrencies trading?</a>
						</h4>
					  </div>
					  <div id="collapse23" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="faq-app">
								We suggest you to consult a CA regarding this.
							</div>
						</div>
					  </div>
					</div>					
				</div>
			</div>
		</div>
	</div>

@endsection()
@section('footerjs')
<script>
$(function() {
  $(".expand").on( "click", function() {
    // $(this).next().slideToggle(200);
    $expand = $(this).find(">:first-child");
    
    if($expand.text() == "+") {
      $expand.text("-");
    } else {
      $expand.text("+");
    }
  });
});
</script>    
    
@endsection()
