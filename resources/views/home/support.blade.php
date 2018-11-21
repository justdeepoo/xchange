@extends('home.master')
@section('headerjs')
@endsection()

@section('content')
<!--===================== End of Header ========================-->
	<!--===================== First Section ========================-->
	<div class="first-section not-images">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="text">
						<h1>Contact Us</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="cloud">&nbsp;</div>
		<div class="cloud-two">&nbsp;</div>
		<div class="mini-cloud"></div>
		<div class="mini-cloud two"></div>
	</div>
	<!--===================== End of First Section ========================-->
	<!--===================== Contact Block ========================-->
	<div class="contact-block">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 col-lg-8 col-12 pr-lg-0">
					<div class="bg">
						<h4>Send us a Message</h4>
						<form class="custom-form">
							<div class="form-group">
								<label for="exampleInputEmail1">Your Name</label>
								<input type="text" class="form-control" id="exampleInputEmail1">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail2">Email Address</label>
								<input type="text" class="form-control" id="exampleInputEmail2">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail3">Phone</label>
								<input type="text" class="form-control" id="exampleInputEmail3">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail4">Company</label>
								<input type="text" class="form-control" id="exampleInputEmail4">
							</div>
							<div class="form-group last">
								<label for="exampleInputEmail1">Message</label>
								<textarea name="massage"></textarea>
							</div>
							<div class="text-right">
								<button type="submit" class="see-brd-btn">Send</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-xl-4 col-lg-4 col-12 pl-lg-0">
					<div class="contact-info">
						<h4>Contact Information</h4>
						<ul class="list-unstyled">
							<li class="d-flex align-items-center">
								<img src="{{asset('/public/wp-content/themes/cryptocurrency-html/assets/img/map-marker.svg')}}" alt="map-marker">
								<div>
									<span>Wave Silver Tower, 604, Captain Vijyant Thapar Marg, D Block, Pocket D, Sector 18, Noida, Uttar Pradesh 201301</span>
								</div>
							</li>
							<li class="d-flex align-items-center">
								<img src="{{asset('/public/wp-content/themes/cryptocurrency-html/assets/img/phone.svg')}}" alt="phone">
								<span>+91 120 4265782</span>
							</li>
							<li class="d-flex align-items-center">
								<img src="{{asset('/public/wp-content/themes/cryptocurrency-html/assets/img/email.svg')}}" alt="email">
								<span><a href="index.html#">info@giltxchange.com</a></span>
							</li>
						</ul>
						<!-- <div class="footer-social-wrapper">
							<a href="index.html#">
								<svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 16 30">
									<path id="f2" class="cls-1" d="M2246.4,13660h-3.84c-4.31,0-7.1,2.9-7.1,7.4v3.4h-3.86a0.622,0.622,0,0,0-.6.6v4.9a0.561,0.561,0,0,0,.6.6h3.86v12.5a0.624,0.624,0,0,0,.61.6h5.03a0.622,0.622,0,0,0,.6-0.6v-12.5h4.51a0.564,0.564,0,0,0,.61-0.6v-4.9a0.453,0.453,0,0,0-.18-0.4,0.666,0.666,0,0,0-.42-0.2h-4.52v-2.9c0-1.4.33-2.1,2.11-2.1h2.59a0.622,0.622,0,0,0,.6-0.6v-4.6A0.622,0.622,0,0,0,2246.4,13660Z" transform="translate(-2231 -13660)"/>
								</svg>
							</a>
							<a href="index.html#">
								<svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 32 31">
									<path id="in2" class="cls-1" d="M2329,13679v12h-6.86v-11.2c0-2.8-.99-4.7-3.47-4.7a3.781,3.781,0,0,0-3.52,2.5,5.146,5.146,0,0,0-.23,1.7v11.7h-6.86s0.09-19,0-20.9h6.86v2.9c-0.01.1-.03,0.1-0.05,0.1h0.05v-0.1a6.812,6.812,0,0,1,6.18-3.4C2325.62,13669.6,2329,13672.6,2329,13679Zm-28.12-19a3.622,3.622,0,0,0-3.88,3.6,3.567,3.567,0,0,0,3.79,3.6h0.05A3.609,3.609,0,1,0,2300.88,13660Zm-3.47,31h6.86v-20.9h-6.86v20.9Z" transform="translate(-2297 -13660)"/>
								</svg>
							</a>
							<a href="index.html#">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 39.18 30.4">
									<path id="g2" class="cls-1" d="M2396.48,13673.8h-14.04v4.7h8.57a10.039,10.039,0,1,1-9.57-13.1,9.772,9.772,0,0,1,7.13,3l3.4-3.7a14.923,14.923,0,0,0-10.53-4.4,15.2,15.2,0,0,0,0,30.4,15.382,15.382,0,0,0,15.04-12.2v-4.7h0Zm9.12,0h-2.87v-2.9h-2.46v2.9h-2.87v2.5h2.87v2.9h2.46v-2.9h2.87v-2.5Z" transform="translate(-2366.41 -13660.3)"/>
								</svg>
							</a>
							<a href="index.html#">
								<svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" viewBox="0 0 37 31">
									<path id="t2" class="cls-1" d="M2477.16,13663.6a11.4,11.4,0,0,1-1.79.6,7.626,7.626,0,0,0,1.61-2.9,0.513,0.513,0,0,0-.19-0.6,0.583,0.583,0,0,0-.68-0.1,12.96,12.96,0,0,1-4.16,1.7,7.79,7.79,0,0,0-5.56-2.3,8.016,8.016,0,0,0-7.95,8.1,10.152,10.152,0,0,0,.07,1.1,20.1,20.1,0,0,1-13.96-7.6,0.5,0.5,0,0,0-.51-0.2,0.518,0.518,0,0,0-.47.3,8.22,8.22,0,0,0,.82,9.3,4.52,4.52,0,0,1-1.07-.5,0.445,0.445,0,0,0-.58.1,0.589,0.589,0,0,0-.3.5v0.1a8.331,8.331,0,0,0,3.89,7,1.329,1.329,0,0,0-.61-0.1,0.442,0.442,0,0,0-.56.2,0.616,0.616,0,0,0-.12.6,8.051,8.051,0,0,0,5.82,5.4,13.329,13.329,0,0,1-7.51,2.2,9.421,9.421,0,0,1-1.68-.1,0.608,0.608,0,0,0-.64.4,0.563,0.563,0,0,0,.24.7,20.894,20.894,0,0,0,11.59,3.5,20.343,20.343,0,0,0,15.96-7.2,23.09,23.09,0,0,0,5.54-14.8c0-.2-0.01-0.4-0.01-0.7a14.182,14.182,0,0,0,3.55-3.8,0.729,0.729,0,0,0-.04-0.8A0.6,0.6,0,0,0,2477.16,13663.6Z" transform="translate(-2441 -13660)"/>
								</svg>
							</a>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--===================== End of Contact Block ========================-->
@endsection()
@section('footerjs')
    
    
@endsection()
