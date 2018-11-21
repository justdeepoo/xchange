<?php $__env->startSection('headerjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="container animatedParent">
		<div class="row">
			<div class="col-xl-12 animated growIn">
				<!--===================== Custom Form ========================-->
				<form class="custom-form" name="login-form" id="login-form">
					<h4>Login</h4>
					<div class="form-group">
						<label for="exampleInputEmail1">Email Address</label>
						<input type="email" class="form-control" id="email" name="email" autocomplete="off">
					</div>
					<div class="form-group last">
						<label for="exampleInputEmail2">Password</label>
						<input type="password" class="form-control" id="password" name="password" autocomplete="off">
					</div>
					<div class="text-center">
						<button type="submit" class="see-brd-btn login-submit"></button>
					</div>
					<span>Dont have account? <a href="<?php echo e(url('/secure/register')); ?>">Sign Up</a></span>
				</form>
				<!--===================== End of Custom Form ========================-->
			</div>
		</div>
	</div>


         
    <!--  Modal for REset Password-->

   <div class="2fa-enable-form">
        <div class="modal inmodal" id="2fa-form" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                
                <div class="modal-content" style="margin-top: 300px;">

                    <form action="#" name="login-2fa-form" id="login-2fa-form">
                        <!-- <button type="button" class="close close-reset" data-dismiss="modal">×</button> -->
                        <div class="modal-header d-details" style="
    padding:  10px 10px;
    float:  left;
">
                            
                            <h3 class="h3"><span class="coin-name"></span>Enter Google 2FA</h3>
                        </div>
                        <div class="modal-body scrol-p">
                            
                            <div class="row address-sec" style="display: block;">
                                <div class="col-md-12 mt-20 text-center">
                                    <div class="col-md-9">
                                        <div class="form-group name-group">
                                            <input type="text" class="form-control" placeholder="ENTER 2FA OTP" id="2fa-code" name="2fa-code"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button name="btnCopy"  id="btnCopy" class="ladda-button ladda-button-demo btn btn-primary submit-2fa" data-style="zoom-in" type="button"> SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                                        
                        </div>
                    </form>
                
                </div>
        </div>
    </div>
        

    <!--  END of Modal REset Password-->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
    <script>
       

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('secure.master-new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>