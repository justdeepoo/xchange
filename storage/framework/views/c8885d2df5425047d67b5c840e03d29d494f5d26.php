<?php $__env->startSection('headerjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<section class="section6 m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">Disclaimer</div></div>
			</div>	
		</div>		
	</section>
		<!--===================== End of First Section ========================-->
<section class="disclimer-section animatedParent text-center">		
	<div class="container">
		<div class="row">
			<div class="col-xl-12 text-about">
				<h2 class="h2-main">Financial Statement Disclaimer</h2>
				<p>Xchange does not provide any form of financial advice. No content, services, or
products available on our Website or via any form of communication may be taken as
financial advice or a financial recommendation. Please speak with your financial advisor
for all matters related to purchases, trade or sale of Cryptocurrencies or volatile goods
and/or commodities. We do not recommend anything available on the Website as an
investment. It is possible that you can lose some or all of the money you spend on any
product available at Xchange due to price and/or value fluctuations.</p>
			</div>
		</div>		
	</div>
</section>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>