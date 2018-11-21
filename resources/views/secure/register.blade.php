@extends('secure.master-new')
@section('headerjs')
<style type="text/css">
	.hide{
		display: none;
	}
</style>>
@endsection()

@section('content')

   
    <div class="container animatedParent">
		<div class="row">
			<div class="col-xl-12 animated growIn">
               
				<!--===================== Custom Form ========================-->
				<form class="custom-form" name="reg-form" id="reg-form" autocomplete="off">
                
                    <h4>Sign Up</h4>
                    
                    <p>
                        <div class="success-message hide">Thank you!  We have sent you email verification link to given email address. Kindly verify it to access your account. <br/><br/></div>
                    </p>
					<div class="form-group">
						<label for="exampleInputEmail1">First Name</label>
						<input type="text" class="form-control" name="first_name"  id="first_name" >
                    </div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Last Name</label>
						<input type="text" class="form-control" name="last_name"  id="last_name" >
                    </div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Email Address</label>
						<input type="text" class="form-control" name="email"  id="email" >
                    </div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Mobile</label>
						<input type="text" class="form-control" name="mobile" id="mobile" >
                    </div>
                    <div class="form-group">
						<label for="exampleInputEmail1">Password</label>
						<input type="password" class="form-control" name="password" id="password" >
					</div>
					<div class="form-group last">
						<label for="exampleInputEmail2">Confirm Password</label>
						<input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
                    <div class="form-group">
						<span><input name="terms" class="" id="terms" value="1" type="checkbox"></span>
						<span>Accept Terms & Conditions</span>
					</div>

					<div class="text-center">
						<button type="submit" class="see-brd-btn reg-submit">Register</button>
					</div>
					<span>Do you have an account? <a href="{{url('/secure/login')}}">Sign In</a></span>
				</form>
				<!--===================== End of Custom Form ========================-->
			</div>
		</div>
	</div>
           


@endsection()
@section('footerjs')
    <script>
        

    </script>
@endsection()
