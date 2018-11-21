@extends('home.master')
@section('headerjs')
@endsection()

@section('content')
<header class="header-margin">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-10 header-center" style="text-align:center">
					<div class="headerform-main resetpass-s">
						
						<div class="header-form">
							<section class="login-form">
								<div class="form-wrap">
									<h1>Reset your account</h1>
									<form role="form" name="reset-form" id="reset-form" action="#" autocomplete="off">
										<div class="form-group">											
											<input  class="form-control" type="password" name="password" id="password" placeholder="New Password">
										</div>
										<div class="form-group">											
											<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password">
										</div>
										
										<div class="login-btn">
											<button type="submit" class="btn btn-global res-pwd">Reset<span><img src="{{asset('/public/gilt/img/btn-arrow.png')}}"/></span></button>
										</div>
										<div class="login-msg-ara">
											
										</div>
										<div class="discrip">
											
                                        </div>
                                        <input type="hidden" value="{{$token}}" name="token">										
									</form>
								</div>
								
                                <div class="login-footers">
									Back to login?<a href="{{url('/')}}">Login!</a>
								</div>
								
								
							</section>
						</div>						
					</div>        
				</div>
			</div>
		</div>
	 
   
    </header>
   
    
@endsection()
@section('footerjs')
    
    
@endsection()
