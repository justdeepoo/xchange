<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Giltxchange.com | Cryptocurrency Exchange. Buy and Sell BTC, ETH, XRP, LTC</title>
    <link rel="shortcut icon" href="{{asset('/public/favicon.ico')}}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/less/dropdowns.less">
    
    <link href="{{asset('/public/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('/public/css/plugins/morris/morris-0.4.3.min.css')}}" rel="stylesheet">
    <link href="{{asset('/public/css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">

    <link href="{{asset('/public/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/public/css/style.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('/public/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('/public/css/xchange.css')}}" rel="stylesheet">
    <style type="text/css">
        .col-md-2.pl {
            padding-left: 10%;
        }
    </style>
<!--     <script src="{{asset('/public/js/jquery-3.1.1.min.js')}}"></script> -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        
        bu = '{{url('/')}}';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        node_server_point = "{{env('node_server_point')}}"
        


    </script>
    @yield('headerjs')
</head>

<body>
    <div id="wrapper">  
        
        <div id="page-wrapper" class="gray-bg" style="margin-left:0px;">
            <div class="row border-bottom">
            <nav class="navbar navbar-static-top navbar-fixed-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header w-100">
                    <div class="row">
                        
                        <div class="col-md-12">
                            
                            <div class="col-md-6 col-xs-12">
                                <a class="minimalize-styl-2" href="{{url('/')}}"><img src="{{asset('/public/wp-content/themes/cryptocurrency-html/assets/img/GXLL.png1.png')}}" class="logo" alt="images" style="height: 34px; margin-top: -5px;"></a>
                                <a class="minimalize-styl-2 {{$active_coin_pair['inr-xrp']==1?'sct-cryto':''}}" href="{{url('/trade/inr-xrp/')}}"><span class="m-r-sm text-muted welcome-message tab-option">XRP</span></a>
                                <a class="minimalize-styl-2 {{$active_coin_pair['inr-ltc']==1?'sct-cryto':''}}" href="{{url('/trade/inr-ltc/')}}"><span class="m-r-sm text-muted welcome-message tab-option">LTC</span></a>
                                <a class="minimalize-styl-2 {{$active_coin_pair['inr-eth']==1?'sct-cryto':''}}" href="{{url('/trade/inr-eth/')}}"><span class="m-r-sm text-muted welcome-message tab-option">ETH</span></a>
                                <a class="minimalize-styl-2 {{$active_coin_pair['inr-btc']==1?'sct-cryto':''}}" href="{{url('/trade/inr-btc/')}}"><span class="m-r-sm text-muted welcome-message tab-option">BTC</span></a>
                                <a class="minimalize-styl-2 {{$active_coin_pair['inr-bch']==1?'sct-cryto':''}}" href="{{url('/trade/inr-bch/')}}"><span class="m-r-sm text-muted welcome-message tab-option">BCH</span></a>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>                        
                                  </button>
                                  
                                </div>
                                <div class="collapse navbar-collapse" id="myNavbar">
                                  
                                <ul class="nav navbar-top-links navbar-nav navbar-right">
                                    <li class="tab-b">
                                       
                                        <a href="{{url('/trade/inr-xrp')}}"><span class="m-r-sm text-muted welcome-message tab-option">BUY/SELL</span></a>
                                    </li>
                                    <li class="tab-b">
                                        <a href="#"><span class="m-r-sm text-muted welcome-message tab-option">EXCHANGE</span></a>
                                        <!-- <a href="{{url('/trade/inr-xrp')}}"><span class="m-r-sm text-muted welcome-message tab-option">TRADE</span></a> -->
                                    </li>
                                    <li class="tab-b dropdown">
                                        <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                            <span class="m-r-sm text-muted welcome-message tab-option">WALLET</span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-alerts wallet-types" role="menu">
                                            <li>
                                                <a href="{{url('/wallet')}}" tabindex="-1">
                                                   
                                                    <i class="fa fa-bitcoin fa-fw"></i>  Crypto Wallet
                                                    
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                <a href="{{url('/balance')}}" tabindex="-1">
                                                    
                                                    <i class="fa fa-inr fa-fw"></i>  INR Wallet
                                                   
                                                </a>
                                            </li>
                                            
                                            
                                        </ul>

                                    </li>
                                    <li class="tab-b dropdown">
                                        <a href="{{url('/profile')}}"><span class="m-r-sm text-muted welcome-message tab-option">PROFILE</span></a>
                                    </li>
                                    <!-- <li class="tab-b">
                                        <a href="#"><span class="m-r-sm text-muted welcome-message tab-option">DAILY INTEREST</span></a>
                                    </li>  -->

                                   

                                    <li>
                                        <a href="{{url('/secure/logout')}}">
                                            <i class="fa fa-sign-out"></i>
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a class="right-sidebar-toggle">
                                            <i class="fa fa-tasks"></i>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                

            </nav>
        </div>


        <div class="row ticker">
            <div class="col-md-12 ticker">
            </div>
        </div>


    @yield('content')

    <!-- <div class="footer">
                <div class="pull-right">
                    
                </div>
                <div>
                    <strong>Copyright</strong> Xchange &copy; 2014-2018
                </div>
            </div>

        </div>
        
    </div> -->
    
    <!-- Mainly scripts -->

    <!--===================== Footer ========================-->
<footer class="ft">
        <div class="container">
            <div class="row footer-menu-wrap">
                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                    <div class="logo">
                        <a href="index.html">
                            <img src="{{asset('/public/wp-content/themes/cryptocurrency-html/assets/img/GXLOGOBlue.png')}}" class="logo" alt="images" style="height: 34px">
                        </a>
                        <p>The India's first ZERO Trading Fees crypto currency exchange. </p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                    <div class="inside-column">
                        <h4 class="title">Company</h4>
                        <ul class="list-unstyled">
                            <li><a href="{{url('/about')}}">About Us</a></li>
                            <li><a href="{{url('/faq')}}">FAQ</a></li>
                            <li><a href="{{url('/contact')}}">Careers</a></li>
                            <li><a href="{{url('/support')}}">Customer Support</a></li>
                            
                            <!--<li><a href="../blog-grid-straight/index.html">Blog</a></li>
                            <li><a href="../calculator-straight/index.html">Currency Calculator</a></li>-->                         
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-2 col-md-6 col-12">
                    <div class="inside">
                        <h4 class="title">Information</h4>
                        <ul class="list-unstyled">
                            <li><a href="{{url('/fee')}}">Fees & Limits</a></li>
                            <li><a href="{{url('/terms-condition')}}">Terms & Conditions</a></li>
                            <li><a href="{{url('/aml')}}">AML</a></li>
                            <li><a href="{{url('/privacy')}}">Privacy Policy</a></li>
                            <li><a href="{{url('/disclaimer')}}">Disclaimer</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-6 col-12">
                    <h4 class="title">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="index.html#">info@giltxchange.com</a></li>
                        <li>+91 120 4265782</li>
                    </ul>
                </div>
            </div>
        </div>
        <!--===================== Copyright ========================-->
        <div class="copyright">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-6">
                        <p><img class="svg social-link" src="{{asset('/public/wp-content/themes/cryptocurrency-html/assets/img/copyright.svg')}}" alt="images">2017 All Rights Reserved</p>
                    </div>
                    <!-- <div class="col-md-6 col-6">
                        <div class="footer-social-wrapper">
                            <a href="index.html#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 16 30">
                                    <path id="f" class="cls-1" d="M2246.4,13660h-3.84c-4.31,0-7.1,2.9-7.1,7.4v3.4h-3.86a0.622,0.622,0,0,0-.6.6v4.9a0.561,0.561,0,0,0,.6.6h3.86v12.5a0.624,0.624,0,0,0,.61.6h5.03a0.622,0.622,0,0,0,.6-0.6v-12.5h4.51a0.564,0.564,0,0,0,.61-0.6v-4.9a0.453,0.453,0,0,0-.18-0.4,0.666,0.666,0,0,0-.42-0.2h-4.52v-2.9c0-1.4.33-2.1,2.11-2.1h2.59a0.622,0.622,0,0,0,.6-0.6v-4.6A0.622,0.622,0,0,0,2246.4,13660Z" transform="translate(-2231 -13660)"></path>
                                </svg>
                            </a>
                            <a href="index.html#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 32 31">
                                    <path id="in" class="cls-1" d="M2329,13679v12h-6.86v-11.2c0-2.8-.99-4.7-3.47-4.7a3.781,3.781,0,0,0-3.52,2.5,5.146,5.146,0,0,0-.23,1.7v11.7h-6.86s0.09-19,0-20.9h6.86v2.9c-0.01.1-.03,0.1-0.05,0.1h0.05v-0.1a6.812,6.812,0,0,1,6.18-3.4C2325.62,13669.6,2329,13672.6,2329,13679Zm-28.12-19a3.622,3.622,0,0,0-3.88,3.6,3.567,3.567,0,0,0,3.79,3.6h0.05A3.609,3.609,0,1,0,2300.88,13660Zm-3.47,31h6.86v-20.9h-6.86v20.9Z" transform="translate(-2297 -13660)"></path>
                                </svg>
                            </a>
                            <a href="index.html#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 39.18 30.4">
                                    <path id="g" class="cls-1" d="M2396.48,13673.8h-14.04v4.7h8.57a10.039,10.039,0,1,1-9.57-13.1,9.772,9.772,0,0,1,7.13,3l3.4-3.7a14.923,14.923,0,0,0-10.53-4.4,15.2,15.2,0,0,0,0,30.4,15.382,15.382,0,0,0,15.04-12.2v-4.7h0Zm9.12,0h-2.87v-2.9h-2.46v2.9h-2.87v2.5h2.87v2.9h2.46v-2.9h2.87v-2.5Z" transform="translate(-2366.41 -13660.3)"></path>
                                </svg>
                            </a>
                            <a href="index.html#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="16" viewBox="0 0 37 31">
                                    <path id="t" class="cls-1" d="M2477.16,13663.6a11.4,11.4,0,0,1-1.79.6,7.626,7.626,0,0,0,1.61-2.9,0.513,0.513,0,0,0-.19-0.6,0.583,0.583,0,0,0-.68-0.1,12.96,12.96,0,0,1-4.16,1.7,7.79,7.79,0,0,0-5.56-2.3,8.016,8.016,0,0,0-7.95,8.1,10.152,10.152,0,0,0,.07,1.1,20.1,20.1,0,0,1-13.96-7.6,0.5,0.5,0,0,0-.51-0.2,0.518,0.518,0,0,0-.47.3,8.22,8.22,0,0,0,.82,9.3,4.52,4.52,0,0,1-1.07-.5,0.445,0.445,0,0,0-.58.1,0.589,0.589,0,0,0-.3.5v0.1a8.331,8.331,0,0,0,3.89,7,1.329,1.329,0,0,0-.61-0.1,0.442,0.442,0,0,0-.56.2,0.616,0.616,0,0,0-.12.6,8.051,8.051,0,0,0,5.82,5.4,13.329,13.329,0,0,1-7.51,2.2,9.421,9.421,0,0,1-1.68-.1,0.608,0.608,0,0,0-.64.4,0.563,0.563,0,0,0,.24.7,20.894,20.894,0,0,0,11.59,3.5,20.343,20.343,0,0,0,15.96-7.2,23.09,23.09,0,0,0,5.54-14.8c0-.2-0.01-0.4-0.01-0.7a14.182,14.182,0,0,0,3.55-3.8,0.729,0.729,0,0,0-.04-0.8A0.6,0.6,0,0,0,2477.16,13663.6Z" transform="translate(-2441 -13660)"></path>
                                </svg>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <!--===================== End of Copyright ========================-->
    </footer>
    <!--===================== End of Footer ========================-->
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('/public/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('/public/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('/public/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('/public/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('/public/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('/public/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('/public/js/plugins/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('/public/js/plugins/flot/jquery.flot.symbol.js')}}"></script>
    <script src="{{asset('/public/js/plugins/flot/curvedLines.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('/public/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('/public/js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('/public/js/inspinia.js')}}"></script>
    <script src="{{asset('/public/js/plugins/pace/pace.min.js')}}"></script>


    <!-- Ladda -->
    <script src="{{asset('/public/js/plugins/ladda/spin.min.js')}}"></script>
    <script src="{{asset('/public/js/plugins/ladda/ladda.min.js')}}"></script>
    <script src="{{asset('/public/js/plugins/ladda/ladda.jquery.min.js')}}"></script>



    <!-- jQuery UI -->
    <script src="{{asset('/public/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- Jvectormap -->
    <script src="{{asset('/public/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('/public/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{asset('/public/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{asset('/public/js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{asset('/public/js/plugins/chartJs/Chart.min.js')}}"></script>
    <script src="{{asset('/public/js/demo/chartjs-demo.js')}}"></script>

    <!-- Toastr -->
    <script src="{{asset('/public/js/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('/public/js/common.js')}}"></script>
    
    
    <script>
       
    </script>
    @yield('footerjs')
</body>
</html>