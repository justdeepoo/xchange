@extends('xchange.master')
@section('headerjs')
@endsection()

@section('content')
<section class="balance-new">
	<div class="container-fluid">		
		<div class="balance-bn">
			<h5 class="bal-title"><i class="fa fa-address-book" aria-hidden="true"></i>  INR BALANCE</h5>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="table-responsive dash-table-markets no-heights">
						<table class="table">
							<thead>
							  <tr>
								<th>TOTAL</th>
								<th>IN ORDER</th>
								<th>AVAILABLE</th>
								<th>ACTION</th>
							  </tr>
							</thead>
							<tbody>
								<tr>
									<td>
									{{number_format($balance->balance+$balance->locked_bal,2)}} {{strtoupper($balance->coin)}}</td>
									<td>{{number_format($balance->locked_bal,2)}} {{strtoupper($balance->coin)}}</td>
									<td>
									{{number_format($balance->balance,2)}} {{strtoupper($balance->coin)}}</td>
									<td>
										<button class="btn btn-global no-sdo" data-toggle="modal"  data-target="#withdraw-inr-section">WITHDRAW</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="deposit-bn">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<h5 class="bal-title"><i class="fa fa-address-book" aria-hidden="true"></i> DEPOSIT</h5>
					<div class="ac-detail">Bank Account Details</div>
					<div class="table-responsive dash-table-markets no-heights">
						<table class="table">							
							<tbody>
								<tr>
									<td>Account Number</td>
									<td>2056020000560</td>
									<!--<td>
										<a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</a>
									</td>-->
								</tr>
								<tr>
									<td>IFSC Code</td>
									<td>IBQA00002056</td>
									<!--<td>
										<a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</a>
									</td>-->
								</tr>
								<tr>
									<td>Account Holder Name</td>
									<td>Svarogt Technology Pvt Ltd.</td>
									<!--<td>
										<a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</a>
									</td>-->
								</tr>
								<tr>
									<td>Account Type</td>
									<td>CURRENT</td>
									<!--<td>
										<a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</a>
									</td>-->
								</tr>
								<tr>
									<td>BANK NAME</td>
									<td>Andra Bank</td>
									<!--<td>
										<a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</a>
									</td>-->
								</tr>	
								<tr>
									<td>Remarks/Description</td>
									<td>9999769250</td>
									<!--<td>
										<a href="#"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</a>
									</td>-->
								</tr>									
							</tbody>
						</table>
						<button class="btn btn-global no-sdo" data-toggle="modal" data-target="#request-inr-section">SUBMIT NEW DEPOSIT REQUEST</button>
					</div>
				</div>
				<div class="col-md-5 col-sm-12">
					<div class="bancdis-bn">
						<h5 class="dep-bn">Deposit Instructions:</h5>
						<ul>
							<li>The minimum deposit amount is ₹50,000.</li>
							<li>Once the transaction is successful, submit a deposit request by entering the exact amount and the 12 digit Transaction ID  Reference ID .</li>
							<li>The minimum deposit amount is ₹50,000.</li>
							<li>Once the transaction is successful, submit a deposit request by entering the exact amount and the 12 digit Transaction ID  Reference ID .</li>
							<li>The minimum deposit amount is ₹50,000.</li>
							<li>You can use any of these UPI Apps to make deposits to your Xchanage INR Wallet. Click on the following videos to see the detailed instructions of the respective app.</li>						
						</ul>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- start -->
		<div class="deposit-bn">
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<h5 class="bal-title"><i class="fa fa-address-book" aria-hidden="true"></i> Deposit Request</h5>
					
					<div class="table-responsive dash-table-markets no-heights">
						<table class="table">							
							<thead>
								<tr>
									<th>AMOUNT</th>
									<th>DEPOSIT DATE</th>									
									<th>REFERENCE NUMBER</th>									
									<th>STATUS</th>								
								</tr>
							</thead>
							<tbody>
								<?php
									if(sizeof($deposit_request)>0)
									{
										foreach($deposit_request as $k=>$v)
										{
											$status = ($v->status==1)?'Completed':'Pending';
								?>
										
										<tr>
											<td>{{$v->amount}} INR</td>
											<td>{{date('M-d, Y', strtotime($v->deposit_date))}}</td>
											<td>{{$v->reference_number}}</td>
											<td>{{$status}}</td>									
										</tr>
								<?php 
										}
									}else{
										echo '<tr><td colspan="4">No deposit request!</td></tr>';
									}
								?>
							</tbody>
						</table>						
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<h5 class="bal-title"><i class="fa fa-address-book" aria-hidden="true"></i> Withdrawal Request</h5>
					
					<div class="table-responsive dash-table-markets no-heights">
						<table class="table">							
							<thead>
								<tr>
									<th>AMOUNT</th>
									<th>WITHDRAWAL DATE</th>
									<th>STATUS</th>								
								</tr>
							</thead>
							<tbody>
								<?php
									if(sizeof($deposit_request)>0)
									{
										foreach($deposit_request as $k=>$v)
										{
											$status = ($v->status==1)?'Completed':'Pending';
								?>
										
										<tr>
											<td>{{$v->amount}} INR</td>
											<td>{{date('M-d, Y', strtotime($v->deposit_date))}}</td>		<td>{{$status}}</td>									
										</tr>
								<?php 
										}
									}else{
										echo '<tr><td colspan="3">No deposit request!</td></tr>';
									}
								?>
							</tbody>
						</table>						
					</div>
				</div>
			</div>
		</div>
		<!-- end -->
		
</div>
</section>


<!--  Modal for managing withdraw request of INR-->
    <div class="deposit-inr-request" >        
        <div class="modal inmodal" id="withdraw-inr-section" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">INR WITHDRAW REQUEST</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                        
                    </div>
                    <form name="withdraw-inr-form-request" id="withdraw-inr-form-request">
                        <div class="modal-body" style="">
                            <div>
                                <div class="form-group destination-t">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Withdraw Amount">
                                </div>
                                
                                
                            </div>
                            <div style="text-align:center;">
                                <!-- <small><strong>WITHDRAWAL FEES</strong></small> -->
                                <p></p>

                                <p>
                                    <small>NOTE: 
                                    It may take up to 1 Bank working day for a new withdraw to reflect from the wallet.</small>
                                </p>
                            </div>


                        </div>
                        <div class="modal-footer">
							<div id="withdrawFormReqResp" class="success-txt" style="display:none;" ></div>
                            <button type="submit" class="ladda-button ladda-button-demo btn btn-global submit-withdraw-btn"  data-style="zoom-in">SUBMIT</button>                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  END of Modal for managing withdraw request of INR-->
	
	<!--  Modal for managing diposit request of INR-->
    <div class="deposit-inr-request">        
        <div class="modal inmodal" id="request-inr-section" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">INR DEPOSIT REQUEST</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                        
                    </div>
                    <form name="depoisted-form-request" id="depoisted-form-request">
                        <div class="modal-body" style="">
                            <div>
                                <div class="form-group destination-t">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Deposited Amount">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="deposit_date" id="deposit_date" placeholder="Deposit Date" >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="Reference Number" >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="reference_number_confirmation" id="reference_number_confirmation" placeholder="Confirm Reference Number" >
                                </div>
                                
                            </div>
                            <div style="text-align:center;">
                                <!-- <small><strong>WITHDRAWAL FEES</strong></small> -->
                                <p></p>
                                <p>
                                    <small>NOTE: 
                                    It may take up to 1 Bank working day for a new deposit to reflect in the wallet.</small>
                                </p>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <div id="depositedFormReqResp" class="success-txt" style="display:none;" ></div>
							
							<button type="submit" class="ladda-button ladda-button-demo btn btn-global submit-deposit-btn"  data-style="zoom-in">SUBMIT</button>
							
                            <!--<button type="submit" class="btn btn-primary block full-width m-b">Next</button>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        

    <!--  END of Modal for managing diposit request of INR-->
@endsection()

@section('footerjs')
<script src="{{asset('/public/gilt/js/account.js')}}"></script>
<script src="{{asset('/public/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script>
        $('#deposit_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
</script>
@endsection()
