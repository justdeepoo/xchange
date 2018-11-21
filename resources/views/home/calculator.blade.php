@extends('home.master')
@section('headerjs')
@endsection()

@section('content')
<!--===================== First Section ========================-->
<div class="first-section animatedParent" style="padding: 75px 0 50px 0; margin-bottom: 50px;" >
		<div class="container">
			
			<div class="row">
				<div class="col-xl-12">
					<div class="text text-center" style="max-width:100%" >
						<h1>Exchange</h1>
					</div>
				</div>
			</div>
			
		</div>
		<div class="cloud">&nbsp;</div>
		<div class="cloud-two">&nbsp;</div>
		<div class="mini-cloud"></div>
		<div class="mini-cloud two"></div>
		<div class="mini-cloud three"></div>
	</div>
	<!--===================== End of First Section ========================-->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<h3>Exchange</h3>
				<p>
				    <span class="pull-left">Select currency pair to exchange</span>
				    <span class="pull-right">1 RUB ≈ 0.01 USD</span>
				</p>
				<div class="clearfix"></div>
				<p style="margin-top: 1em">I GIVE</p>
				<div class="group_block">

                <input type="text" class="input_large" name="give" title="I give">
                <div class="po_right">
	                <div class="select-style">
					  <select>
					    <option value="1">test</option>
					    <option value="2">test</option>
					    <option value="3">test</option>
					    <option value="4">test</option>
					  </select>
					</div>
			    </div>
            </div>
            <p style="margin-top: 1em">I RECEIVE</p>
				<div class="group_block">

                <input type="text" class="input_large" name="give" title="I give">
                <div class="po_right">
	                <div class="select-style">
					  <select>
					    <option value="1">test</option>
					    <option value="2">test</option>
					    <option value="3">test</option>
					    <option value="4">test</option>
					  </select>
					</div>
			    </div>
            </div>
            <button class="btn btn-primary btn-new">Exchange</button>
			</div>
			<div class="col-md-2"></div>
		</div>	
	</div>

@endsection()
@section('footerjs')
    
    
@endsection()
