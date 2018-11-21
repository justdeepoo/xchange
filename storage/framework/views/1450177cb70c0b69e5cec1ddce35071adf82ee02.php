<?php $__env->startSection('headerjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<section class="section6 m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">Contact Us</div></div>
			</div>	
		</div>		
	</section>			
	<section class="section7">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="stay-here">
						<div class="titles">Newsletter here</div>
						<div class="sub-title">Stay updated</div>
						<div id='subsc-msg-ara'></div>
						
					</div>	
					<div class="stayform-s">
					<form name="frm_submit_newsletter" id="frm_submit_newsletter" method="POST" action="#">
					<input type="hidden" name="subscfrmsubmite" id="subscfrmsubmite" value="subscfrmsubmite">
					<?php echo e(csrf_field()); ?>

						<div class="newsletter-box">
						  <input required="" placeholder="Your E-mail" type="text" id="email_address" name="email_address" class="news-input">
						  <button class="btn btn-global subs-btn btn_global_subsb">SUBSCRIBE <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
						</div>
						<p>*Etiam nec odio vestibulum est mattis effic iturut magna. Pellentesque sit am et tellus blandit. Etiam nec odio vestibul.</p>
					</form>
					</div>
					<div class="cont-social">
						<h3>Social media presence</h3>
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
				<div class="col-sm-12 col-md-6">
				<form name="frm_submit_contactus" id="frm_submit_contactus" action="#">
				
				<?php echo e(csrf_field()); ?>

					<div class="stay-here">
						<div class="titles">Contact form</div>
						<div class="sub-title">Get in touch..</div>	
						<div id='concat-msg-ara'></div>
					</div>	
					<div class="stayform-s">
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
							<div class="col-sm-12 col-md-12">
								<div class="form-group">											
									<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<div class="form-group">											
									<textarea class="form-control textareas" name="messages" id="messages" placeholder="Message"></textarea>
								</div>
							</div>
						</div>
						<div class="discover-btn">
							<button type="submit" class="btn btn-global-dark">SEND MESSAGE <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<section class="section8">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="mapplace">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2946.4488581611145!2d77.32231009053902!3d28.571626046995952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce44ec304087b%3A0xfbeb0000d3bfe388!2sWave+Silver+Tower%2C+604%2C+Captain+Vijyant+Thapar+Marg%2C+D+Block%2C+Pocket+D%2C+Sector+18%2C+Noida%2C+Uttar+Pradesh+201301!5e0!3m2!1sen!2sin!4v1524225895696" width="1110" height="585" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="section9">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<div class="contact-views">
						<div class="view-details icon-image">
							<img src="<?php echo e(asset('/public/gilt/img/icon01.png')); ?>"/>
						</div>
						<div class="view-details title">XXXXX</div>
						<div class="view-details discrip">
							<h4>Xchange Global XX.XX</h4>
							00-000, XXXXX S/6, XXXXXX, XXXXX- XXXXX
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="contact-views">
						<div class="view-details icon-image">
							<img src="<?php echo e(asset('/public/gilt/img/icon02.png')); ?>"/>
						</div>
						<div class="view-details title">XXXXX</div>
						<div class="view-details discrip">
							<h4>Xchange Global XX.XX</h4>
							00-000, XXXXX S/6, XXXXXX, XXXXX- XXXXX
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="contact-views">
						<div class="view-details icon-image">
							<img src="<?php echo e(asset('/public/gilt/img/icon03.png')); ?>"/>
						</div>
						<div class="view-details title">XXXXX</div>
						<div class="view-details discrip">
							<h4>Xchange Global XX.XX</h4>
							00-000, XXXXX S/6, XXXXXX, XXXXX- XXXXX
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
    
    
<?php $__env->stopSection(); ?>

<script>
$('form[name="frmcontact"]').submit(function (e) {
		alert('in......');
		
	  });
</script>

<?php echo $__env->make('home.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>