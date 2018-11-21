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
				<!--<div class="col-sm-12 col-md-12"><div class="contact-s">News</div></div>-->
			</div>	
		</div>		
	</section>			
	<section class="section9 text-left">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">						
					<div class="staric-data addtoken-at">
						<div class="col-md-7 col-sm-12">
							<!-- CryptoRival News Widget BEGIN -->
							<script type="text/javascript" src="https://static.cryptorival.com/js/newswidget.js"></script>
							<a id="cr-copyright" href="https://cryptorival.com/" target="_blank" rel="nofollow">Powered by CryptoRival</a>
							<script type="text/javascript">
							showNews('998', false, '0', '593ea2', '593ea2', '593ea2', '777', '495');
							</script>
							<!-- CryptoRival News Widget END -->
						</div>						
					</div>	
				</div>
			</div>		
		</div>
	</section>
</div>
@endsection()
@section('footerjs')
@endsection()
