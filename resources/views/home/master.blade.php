<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Koinone - Home Page</title>
	<link rel="shortcut icon" type="image/png" href="{{asset('/public/gilt/img/favicon.png')}}"/>
	
	<!-- Appple Touch Icons -->
	<link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png')}}"/>
	<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png')}}"/>
	<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png')}}"/>
	<link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png')}}"/>


    <!-- Bootstrap core CSS -->
    <link href="{{asset('/public/gilt/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/public/gilt/css/half-slider.css')}}" rel="stylesheet">
	<link href="{{asset('/public/gilt/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('/public/gilt/css/media-query.css')}}" rel="stylesheet">
	 <!-- Custom styles for font awsome this template -->
	 <link href="{{asset('/public/gilt/css/brands.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fa-brands.min.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fa-regular.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fa-regular.min.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fa-solid.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fa-solid.min.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fontawesome.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fontawesome.min.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fontawesome-all.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/fontawesome-all.min.css')}}" rel="stylesheet">
	 <link href="{{asset('/public/gilt/css/custom.css')}}" rel="stylesheet">
	 <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	 <script>
      bu = "{{url('/')}}";
   
   </script>


</head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-darkblue fixed-top header-menu">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><img width="100" src="{{asset('/public/gilt/img/logo.png')}}"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto logo-menu">
            @if(Session::get('sess_userfname')!='')
			<li class="nav-item first">
              <a class="nav-link" href="{{url('/trade/eth-xrp')}}">Exchange</a>
            </li>
			@endif			
                      
          </ul>
          <ul class="navbar-nav ml-auto">
            
            <li class="nav-item">
              <a class="nav-link" href="{{url('/news')}}">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/contact')}}">Contact</a>
            </li>
			<li class="nav-item">
              <a class="nav-link" href="{{url('/addtoken')}}">Add Token</a>
            </li>
            
			<!--<li class="nav-item dropdown last">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                English
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <a class="dropdown-item first" href="#">English 01</a>
                <a class="dropdown-item" href="$">English 02</a>
              </div>
            </li>-->
			
			@if(Session::get('sess_userfname')!='')
			  
			<li class="nav-item dropdown last">              
			  <a class="nav-link dropdown-toggle" href="#" id="navbarWallet" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Wallet
              </a>			 
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarWallet">
                <a class="dropdown-item first" href="{{url('/wallet')}}">Crypto Wallet</a>
                <a class="dropdown-item" href="{{url('/balance')}}">INR Wallet</a>				
              </div>			  
            </li>
		  
			<li class="nav-item dropdown last">
			  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-bell"></i> Notification
			  </a>
			  <div id="notifications" class="dropdown-menu dropdown-menu-right notif-s" aria-labelledby="navbarDropdownPortfolio"></div>
			</li>
			  
			<li class="nav-item dropdown last">              
			  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Session::get('sess_userfname') }}
              </a>
			 
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <a class="dropdown-item first" href="{{url('/profile')}}">Profile</a>                
				<a class="dropdown-item" href="{{url('/history')}}">History</a>
				<a class="dropdown-item" href="{{url('/secure/logout')}}">Logout</a>
              </div>
			  
            </li>
			  
			  
			@endif
			
			
          </ul>
        </div>
      </div>
    </nav>
		@yield('content')



    <!-- Footer -->
    <footer class="dark-footer">
      <div class="container">
		<div class="row">
		<div class="col-sm-12 col-md-3">
				<div class="abloutftr">
				<a href="{{url('/')}}"><img src="{{asset('/public/gilt/img/footerlogo.png')}}"/></a>
					
				</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="footer-title">COMPANY</div>
				<div class="spl-link">
					<ul>
					<li><a href="{{url('/about')}}">About Us</a></li>
									<li><a href="{{url('/faq')}}" class="">FAQ</a></li>
									<li><a href="#" >Careers</a></li>
									<li><a href="{{url('/customersupport')}}" >Customer Support</a></li>
									
					</ul>
				</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="footer-title">INFORMATION</div>
					<div class="spl-link">
						<ul>
						<li><a href="{{url('/fee')}}">Fees & Limits</a></li>
										<li><a href="{{url('/terms-condition')}}" class="">Terms & Conditions</a></li>
										<li><a href="{{url('/aml')}}">AML</a></li>
										<li><a href="{{url('/privacy')}}">Privacy Policy</a></li>
										<li><a href="{{url('disclaimer')}}">Disclaimer</a></li>
						</ul>
					</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="footer-title">CONTACT</div>
				<div class="contact-main">
					<div class="view-cont">
						<span class="left">
							<i class="fa fa-map-marker"></i> 
						</span>
						<span class="right">000-A, abcd Tower, Sector-XX, Xchange - 201301</span>
					</div>
					<div class="view-cont">
						<span class="left">
							<i class="fa fa-phone-volume"></i>
						</span>
						<span class="right">0XX0 - 0000XXXXX</span>
					</div>
					<div class="view-cont">
						<span class="left">
							<i class="far fa-envelope-open"></i> 
						</span>
						<span class="right"><a href="mailto:support@Xchange.com">support@Xchange.com</a></span>
					</div>
				</div>
			</div>
		</div>       
      </div>
      <!-- /.container -->
    </footer>
    <div class="darkes-footer">
      <div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<p>Copyright &copy; <span class="logo-yellow">Koinone</span> 2018 All Right Reserved.</p>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="footer-social">
					<ul>
						<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-telegram-plane"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
						<li><a href="#" target="_blank"><i class="fab fa-medium-m"></i></a></li>						
					</ul>
				</div>
			</div>
		</div>
	</div>
	</div>
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('/public/gilt/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/public/gilt/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('/public/gilt/js/secure.js')}}"></script>
		<script src="{{asset('/public/gilt/js/otherform.js')}}"></script>
		
		@yield('footerjs')
		<script>
				$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      	});
		</script>
  </body>

</html>
