@extends('home.master')
@section('headerjs')
@endsection()

@section('content')
<!--===================== End of Header ========================-->
	<!--===================== First Section ========================-->
	<!-- Page Content -->
	<section class="section6 m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">About Us</div></div>
			</div>	
		</div>		
	</section>			
	<section class="section9">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="stay-here text-center">
						<div class="titles">About us</div>
						<div class="sub-title">A user friendly Theme, <br/>
											   build with usability in mind</div>
					</div>	
					<div class="column-para">
						Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio ves tibul.  Nec odio vestibulum est mattis effic iturut. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio ves tibul. Pellentesque sit amet tellus blandit. Etiam nec odio ves tibul.  Nec odio vestibulum est mattis effic iturut. 

					</div>
					<div class="discover-btn nobox-shadow">
						<button type="button" class="btn btn-global-dark">DISCOVER DOOM<span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section10 lightblue-bg">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="stay-here text-center">
						<div class="titles">Our Client</div>
						<div class="sub-title">Team members</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="team-image">
								<img src="{{asset('/public/gilt/img/01.jpg')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="team-details">
								<h5>Mick Williams</h5>
								<p>Team Leader</p>
							</div>
						</div>						
					</div>				
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="team-image">
								<img src="{{asset('/public/gilt/img/02.jpg')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="team-details">
								<h5>Cristinne Smith</h5>
								<p>Manager</p>
							</div>
						</div>						
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="team-image">
								<img src="{{asset('/public/gilt/img/03.jpg')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="team-details">
								<h5>Jack M. Down</h5>
								<p>Designer</p>
							</div>
						</div>						
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="team-image">
								<img src="{{asset('/public/gilt/img/04.jpg')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="team-details">
								<h5>Maria Fernandez </h5>
								<p>Motion Graphic</p>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section11">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="teampoint-image">
								<img src="{{asset('/public/gilt/img/icon05.png')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="teampoint-details">
								<h5>14</h5>
								<p>Years of Experience</p>
							</div>
						</div>						
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="teampoint-image">
								<img src="{{asset('/public/gilt/img/icon06.png')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="teampoint-details">
								<h5>+1000</h5>
								<p>Happy clients</p>
							</div>
						</div>						
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="teampoint-image">
								<img src="{{asset('/public/gilt/img/icon07.png')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="teampoint-details">
								<h5>14K</h5>
								<p>Followers on FB</p>
							</div>
						</div>						
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="team-member">
						<div class="team-view">
							<div class="teampoint-image">
								<img src="{{asset('/public/gilt/img/icon08.png')}}"/>
							</div>
						</div>
						<div class="team-view">
							<div class="teampoint-details">
								<h5>732</h5>
								<p>Finished Projects</p>
							</div>
						</div>						
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="testimorial grident-bg">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="testmorial-main">
						<div class="testmor-header">
							<h5>our clients</h5>
							<p>Testimonials</p>
						</div>	
						<div id="carouseltestimorial" class="carousel slide my-4" data-ride="carousel">
							<ol class="carousel-indicators">
							  <li data-target="#carouseltestimorial" data-slide-to="0" class=""></li>
							  <li data-target="#carouseltestimorial" data-slide-to="1" class=""></li>
							  <li data-target="#carouseltestimorial" data-slide-to="2" class="active"></li>
							</ol>
							<div class="carousel-inner" role="listbox">
							  <div class="carousel-item">							
									<div class="testmor-image view-testi">
										<img src="{{asset('/public/gilt/img/05.jpg')}}"/>
									</div>
									<div class="testimg-discrip view-testi">
										<h4>Daiane Smith, <span>Customer</span></h4>
										<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>
									</div>			
							  </div>
							  <div class="carousel-item">							
									<div class="testmor-image view-testi">
										<img src="{{asset('/public/gilt/img/06.jpg')}}"/>
									</div>
									<div class="testimg-discrip view-testi">
										<h4>Daiane Smith, <span>Customer</span></h4>
										<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>
									</div>			
							  </div>
							  <div class="carousel-item active">							
									<div class="testmor-image view-testi">
										<img src="{{asset('/public/gilt/img/07.jpg')}}"/>
									</div>
									<div class="testimg-discrip view-testi">
										<h4>Daiane Smith, <span>Customer</span></h4>
										<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit amet tellus blandit. Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul. Etiam nec odio vestibulum est mat tis effic iturut magna.</p>
									</div>			
							  </div>
							</div>
							<!--<a class="carousel-control-prev" href="#carouseltestimorial" role="button" data-slide="prev">
							  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
							  <span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouseltestimorial" role="button" data-slide="next">
							  <span class="carousel-control-next-icon" aria-hidden="true"></span>
							  <span class="sr-only">Next</span>
							</a>-->
						</div>
					</div>
				</div>
			</div>	
		</div>
	</section>
	<section class="faqpage">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">
					<div class="stay-here text-center">
						<div class="titles">if you are wondering</div>
						<div class="sub-title">Faq and Stuff</div>
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="faq-main">
						<h4>How can I contact you?</h4>
						<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</p>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="faq-main">
						<h4>Do you offer free support for clients?</h4>
						<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</p>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="faq-main">
						<h4>Does It have all the plugins included?</h4>
						<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</p>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="faq-main">
						<h4>Are your templates responsive? </h4>
						<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</p>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="faq-main">
						<h4>Can I use your theme for a client?</h4>
						<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</p>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="faq-main">
						<h4>How do I install your theme?</h4>
						<p>Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</p>
					</div>
				</div>					
			</div>
			<div class="discover-btn nobox-shadow text-center">
				<button type="button" class="btn btn-global-dark">SEE ALL FAQ<span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
			</div>
		</div>
	</section>
@endsection()
@section('footerjs')
    
    
@endsection()
