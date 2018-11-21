<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Giltxchange - Home Page</title>
	  <link rel="shortcut icon" type="image/png" href="{{asset('/public/gilt/img/favicon.png')}}"/>
	
	<!-- Appple Touch Icons -->
	<link rel="apple-touch-icon" sizes="57x57" href="{{asset('/public/gilt/img/apple-touch-icon-57x57.png')}}"/>
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('/public/gilt/img/apple-touch-icon-72x72.png')}}"/>
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('/public/gilt/img/apple-touch-icon-114x114.png')}}"/>
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('/public/gilt/img/apple-touch-icon-144x144.png')}}"/>


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
    @yield('headerjs')
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-darkblue fixed-top header-menu">
      <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/trade/eth-xrp')}}"><img src="{{asset('/public/gilt/img/logo.png')}}"/></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav ml-auto logo-menu">
            <li class="nav-item first">
              <a class="nav-link" href="{{url('/trade/eth-xrp')}}">Exchange</a>
            </li>
                       
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
			
			<li class="nav-item">
              <a class="nav-link" href="{{url('/wallet')}}">Wallet</a>
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
                <a class="dropdown-item" href="{{url('/balance')}}">Balance</a>
				<a class="dropdown-item" href="{{url('/history')}}">History</a>
				<a class="dropdown-item" href="{{url('/secure/logout')}}">Logout</a>
              </div>
			  
            </li>
            
          </ul>
		  
        </div>
      </div>
    </nav>

   	@yield('content')

		<footer class="dark-footer">
      <div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-3">
				<div class="abloutftr">
						<a href="#"><img src="{{asset('/public/gilt/img/footerlogo.png')}}"/></a>
					<!--<p>
						Etiam nec odio vestibulum est mattis effic iturut magna. Pellent esque sit amet tellus blandit. Etiam nec odio vestibul.
					</p>-->
				</div>
			</div>
			<div class="col-sm-12 col-md-3">
				<div class="footer-title">COMPANY</div>
				<div class="spl-link">
					<ul>
						<li><a href="{{url('/about')}}">About Us</a></li>
						<li><a href="{{url('/faq')}}" class="">FAQ</a></li>
						<li><a href="#" >Careers</a></li>
						<li><a href="{{url('/contact')}}" >Customer Support</a></li>
						<li><a href="#">Menu ideas</a></li>
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
							<li><a href="#">Disclaimer</a></li>
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
						<span class="right">419-A, Wave Silver Tower, Sector-18, Noida - 201301</span>
					</div>
					<div class="view-cont">
						<span class="left">
							<i class="fa fa-phone-volume"></i>
						</span>
						<span class="right">0120 - 4265782</span>
					</div>
					<div class="view-cont">
						<span class="left">
							<i class="far fa-envelope-open"></i> 
						</span>
						<span class="right"><a href="mailto:support@giltxchange.com">support@giltxchange.com</a></span>
					</div>
				</div>
			</div>
		</div>       
      </div>
      <!-- /.container -->
	  <input type="hidden" id="parent_coin" value="@if(isset($parent_coin)){{$parent_coin}}@endif" >
    </footer>

    <div class="darkes-footer">
      <div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<p>Copyright &copy; <span class="logo-yellow">Giltxchange</span> 2018 All Right Reserved.</p>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="footer-social">
					<ul>
						<li><a href="https://www.facebook.com/Giltxchangeofficial" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="https://t.me/giltxchange" target="_blank"><i class="fab fa-telegram-plane"></i></a></li>
						<li><a href="https://twitter.com/giltxchange" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li><a href="https://www.linkedin.com/company/giltxchange/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
						<li><a href="https://medium.com/@giltxchange" target="_blank"><i class="fab fa-medium-m"></i></a></li>						
					</ul>
				</div>
			</div>
		</div>
	</div>
	</div>
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('/public/gilt/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('/public/gilt/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/public/gilt/js/common.js')}}"></script>
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

