<?php $__env->startSection('headerjs'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!--===================== End of Header ========================-->
	<!--===================== First Section ========================-->
    <!-- Page Content -->
	<section class="section6 m-t-50">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">Add Token</div></div>
			</div>	
		</div>		
	</section>			
	<section class="section9 text-left">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">						
					<div class="staric-data addtoken-at">
						<div class="data-details">	
							<h5>Application for adding cryptocurrency/tokens to Giltxchange</h5>
							<p class="details-disc">If you are the owner, developer or officially representative of the coin/token, you can introduce your coin to Giltxchange.</p>
							<p class="details-disc">In case of adding a coin:
							The coin's developer is obliged to report all technical issues in terms of coin, node, block explorer, and all the forks beforehand. </p>
							<p class="details-disc">
							Developers are responsible for all the losses caused by technical problems related to the node or forks. Also, in case of failure to comply with the rules, the exchange administration has the right to remove the coin from the platform.
							</p>
						</div>
					</div>	
				</div>
			</div>
			
<div class="row justify-content-center">
    <div class="col-md-7 col-sm-12">
        <div class="card">
            <header class="card-header token-ad text-center">
                <h4 class="card-title mt-2">Application for adding cryptocurrency/tokens to Giltxchange</h4>
            </header>
			<div id="add_tkn_dis_msg" align='center'></div>
            <article class="card-body token-ads">
                <form name="frm_submit_addtocken" id="frm_submit_addtocken" action='#' method="POST">
				<?php echo e(csrf_field()); ?>

                    <div class="form-row">
                        <div class="col form-group">
                            <label>Email address <span class="error">*</span></label>
                            <input type="email" class="form-control" name='email_address' id='email_address' placeholder="Your email">
                        </div>
                        <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Name Coin <span class="error">*</span></label>
                            <input type="text" name="coin_name" id="coin_name" class="form-control" placeholder="Your Answer">
                        </div>
					</div>
					<div class="form-row">
						<div class="col form-group">
                            <label>Short name of the coin <span class="error">*</span></label>
                            <input type="text" name="coin_short_name" id="coin_short_name" class="form-control" placeholder="Your Answer">
                        </div>
						<div class="col form-group">
                            <label>Website <span class="error">*</span></label>
                            <input type="text" name="website_name" id="website_name" class="form-control" placeholder="Your Answer">
                        </div>
					</div>
					<div class="form-row">
						<div class="col form-group">
                            <label>Github source <span class="error">*</span></label>
                            <input type="text" name="github_source" id="github_source" class="form-control" placeholder="Your Answer">
                        </div>	
						<div class="col form-group">
                            <label>Block Explorer <span class="error">*</span></label>
                            <input type="text" name="block_explorer" id="block_explorer" class="form-control" placeholder="Your Answer">
                        </div>
					</div>
					<div class="form-row">
						<div class="col form-group">
                            <label>Bitcointalk <span class="error">*</span></label>
                            <input type="text" name="bitcoin_talk" id="bitcoin_talk" class="form-control" placeholder="Your Answer">
                        </div>
                    </div>
					<div class="form-row">
						<div class="form-group">
							 <label>A Type <span class="error">*</span></label>
							 <br/>
							<div class="type-tk">
								<label class="form-check form-check">
									<input class="form-check-input" type="radio" name="cryptocurrency_based" value="cbtc">
									<span class="form-check-label"> Cryptocurrency based on Bitcoin </span>
								</label>
								<label class="form-check form-check">
									<input class="form-check-input" type="radio" name="cryptocurrency_based" value="ceth">
									<span class="form-check-label"> Cryptocurrency based on Ethereum</span>
								</label>
								<label class="form-check form-check">
									<input class="form-check-input" type="radio" name="cryptocurrency_based" value="ccpn">
									<span class="form-check-label"> Cryptocurrency based on CryptoNote</span>
								</label>
								<label class="form-check form-check">
									<input class="form-check-input" type="radio" name="cryptocurrency_based" value="cnxt">
									<span class="form-check-label"> Cryptocurrency based on NXT</span>
								</label>
								<label class="form-check form-check">
									<input class="form-check-input" type="radio" name="cryptocurrency_based" value="cerc">
									<span class="form-check-label"> Token based on ERC20</span>
								</label>
								<label class="form-check form-check">
									<input class="form-check-input" type="radio" name="cryptocurrency_based" value="other">
									<span class="form-check-label"> Other</span>
								</label>
							</div>
						</div>
					</div>
                    <!-- form-group end.// -->
					<div class="form-row">
						<div class="col form-group">
                            <label>Contract address (For ETC tokens) <span class="error">*</span></label>
                            <input type="text" name="contract_address" id="contract_address" class="form-control" placeholder="Your Answer">
                        </div>							
                        <div class="col form-group">
                            <label>Price at time of filling in BTC <span class="error">*</span></label>
                            <input type="text" name="price_filling" id="price_filling" class="form-control" placeholder="Your Answer">
                        </div>
                    </div>
					<div class="form-row">
						<div class="col form-group">
                            <label>Coinmarketcap.com</label>
                            <input type="text" name="coinmarketcap" id="coinmarketcap" class="form-control" placeholder="Your Answer">
                        </div>							
                        <div class="col form-group">
                            <label>Icons png 128x128 <span class="error">*</span></label>
                            <input type="text" name="icon" id="icon" class="form-control" placeholder="Your Answer">
                        </div>
                    </div>					
                    <div class="form-row">
						<div class="col form-group">
                            <label>Trading pairs</label>
                            <div class="checkbox checkbox-primary">
								<input id="trading_pairs_btc_coin" name="trading_pairs_btc_coin" value="btccoin" type="checkbox">
								<label for="checkbox2" class="pairck-tk">
									BTC/*your coin <span class="error">*</span>
								</label>
							</div>
							<div class="checkbox checkbox-primary">
								<input id="trading_pairs_coin_usd" name="trading_pairs_coin_usd" value="coinusd" type="checkbox">
								<label for="checkbox3" class="pairck-tk">
									*your coin*/USD
								</label>
							</div>
							<div class="checkbox checkbox-primary">
								<input id="trading_pairs_other" name="trading_pairs_other" value="other" type="checkbox">
								<label for="checkbox4" class="pairck-tk">
									Other
								</label>
							</div>
                        </div>
						<div class="col form-group">
                        <label>Telegram </label>
                        <input class="form-control" type="text" name="telegram" id="telegram" placeholder="Your Answer">
                    </div>	
                    </div>
                    <!-- form-row.// -->
          			<div class="text-center btnsub-tk">	
						<!-- form-group end.// -->
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-full btn_addtkn_crypto" > SUBMIT </button>
						</div>
					</div>
                </form>
            </article>
            <!-- card-body end .// -->
            <div class="border-top card-body text-center">Never submit passwords through Google Forms.</div>
        </div>
        <!-- card.// -->
    </div>
    <!-- col.//-->

</div>
<!-- row.//-->
			
		</div>
	</section>
</div>
      <?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
    
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('home.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>