@extends('home.master')
@section('headerjs')
@endsection()

@section('content')
	<section class="section6 m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">SUPPORT TICKET <span class="sup-hrs">(Support Hours: 10AM to 8PM)</span></div></div>
			</div>	
		</div>		
	</section>
	<section class="support-section animatedParent">
		<div class="container">
		<div class="form-support">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="sepport-left">
						<p>Got a query or facing an issue? Our support team is happy to assist you. Here’s what you can do for quick resolution while raising a ticket:</p>
						<div class="menu-suport">
							<ul>
								<li>For authenticator issues kindly go through this link: https://goo.gl/W6gPzH</li>
								<li>For <strong>INR deposit/withdrawal</strong> issues kindly share relevant details: Updated bank statement, screenshot of the transaction, transaction reference number along with date & time of the transaction </li>
								<li>or <strong>cryptocurrency deposit/withdrawal issues</strong> kindly share relevant details: Transaction hash, coin type, quantity and date & time of the transaction </li>
							</ul>
						</div>
						<p>Kindly avoid raising multiple support tickets for the same issue. Additionally, we request you to be polite and avoid using profanity towards our customer support team as they are working diligently to resolve your queries.</p>
					</div>				
				</div>
				<div class="col-sm-12 col-md-6 graysup-bg">
					<form name="frm_submit_support" id="frm_submit_support" action="#" method="POST">
					<div class="sepport-right">
					<div class="stayform-s">
						<div id="support-msg-ara"></div>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="form-group">											
									<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Name">
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="form-group">											
									<input type="email" name="email" id="email" class="form-control" placeholder="E-mail">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="form-group">											
									<input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" maxlength="10">
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div class="form-group">
									<div class="styled-select">
									   <select name="category" id="category">
											<option value="">Category</option>
											<option value="Sell order issues">Sell order issues</option>
											<option value="Buy order issues">Buy order issues</option>
											<option value="Crypto Deposit">Crypto Deposit</option>
											<option value="Crypto Withdrawal">Crypto Withdrawal</option>
											<option value="INR Deposit">INR Deposit</option>
											<option value="INR Withdrawal">INR Withdrawal</option>
											<option value="Bank Details Change">Bank Details Change</option>
											<option value="KYC">KYC</option>
											<option value="Email Change">Email Change</option>
											<option value="Mobile Number Change">Mobile Number Change</option>
											<option value="Recovery Password">Recovery Password</option>
											<option value="Google Authenticator">Google Authenticator</option>
											<option value="Account being Monitored">Account being Monitored</option>
											<option value="Name Change">Name Change</option>
											<option value="Mobile App Issues">Mobile App Issues</option>
											<option value="Suggestions">Suggestions</option>
									   </select>
									  <i class="fa fa-angle-down" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="form-group">											
									<textarea name="messages" id="messages" class="form-control textareas" placeholder="Message"></textarea>
								</div>
							</div>
						</div>
						<div class="discover-btn">
							<button type="submit" class="btn btn-global-dark">SUBMIT <span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
						</div>
					</div>
					</div>
					</form>
				</div>
			</div>
		<div>
		</div>
	</section>
@endsection()
@section('footerjs')
    
    
@endsection()
