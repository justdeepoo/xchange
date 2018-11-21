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
							@if(count($balance)>0)
							<tbody>
								<tr>
									<td>
									{{number_format($balance->balance+$balance->locked_bal,2)}} {{strtoupper($balance->coin)}}</td>
									<td>{{number_format($balance->locked_bal,2)}} {{strtoupper($balance->coin)}}</td>
									<td>
									{{number_format($balance->balance,2)}} {{strtoupper($balance->coin)}}</td>
									<td>
										<button class="btn btn-global no-sdo withdraw-inr-button" data-toggle="modal"  data-target="#withdraw-inr-section">WITHDRAW</button>
									</td>
								</tr>
							</tbody>
							@else
							<tbody>
								<tr><td colspan="4"><font color='red'>Record(s) not found.</font></td></tr>
							</tbody>
							@endif	
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
							<li>The minimum deposit amount is ₹1,000.</li>
							<li>Once the transaction is successful, submit a deposit request by entering the exact amount and the 12 digit Transaction ID  Reference ID .</li>
							
							<!-- <li>The minimum deposit amount is ₹50,000.</li>
							<li>You can use any of these UPI Apps to make deposits to your Xchanage INR Wallet. Click on the following videos to see the detailed instructions of the respective app.</li> -->						
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
									<!--<th>ACTION</th>-->
								</tr>
							</thead>
							<tbody>
								<?php
									if(sizeof($deposit_request)>0)
									{
										foreach($deposit_request as $k=>$v)
										{																		
											if($v->status == 0){
												$status = '<span style="color:black"><strong>Pending</strong></span>';
											}else if($v->status == 1){
												$status = '<span style="color:green" ><strong>Completed</strong></span>';
											}else if($v->status == 2){
												$status = '<strong style="color:red"><span>Rejected</strong></span>';
											}else{
												$status = '';
											}
								?>
										
										<tr>
											<td>{{$v->amount}} INR</td>
											<td>{{date('M-d, Y', strtotime($v->deposit_date))}}</td>
											<td>{{$v->reference_number}}</td>
											<td><?php echo $status; ?></td>
											<!--<td>
											<?php 
												//if($v->status == 0){ 
											?>
											<a href="javascript:void(0);" data-toggle="modal"  data-target="#del-deposit-req-modal" onclick="delDepositReq('{{$v->id}}');" >Delete</a>
											<?php 
												//}
											?>
											</td>-->
										</tr>
								<?php 
										}
									}else{
										echo '<tr><td colspan="5"><font color="red">Record(s) not found.</font></td></tr>';
									}
								?>
							</tbody>
						</table>						
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<h5 class="bal-title"><i class="fa fa-address-book" aria-hidden="true"></i> Withdraw Request</h5>
					
					<div class="table-responsive dash-table-markets no-heights">
						<table class="table">							
							<thead>
								<tr>
									<th>AMOUNT</th>
									<th>WITHDRAWAL DATE</th>
									<th>STATUS</th>
									<!-- <th>ACTION</th> -->
								</tr>
							</thead>
							<tbody>
								<?php
									if(sizeof($withdraw_request)>0)
									{
										foreach($withdraw_request as $k=>$v)
										{
											$status = ($v->status==1)?'Completed':'Pending';
											
											if($v->status == 0){
												$status = '<span style="color:black"><strong>Pending</strong></span>';
											}else if($v->status == 1){
												$status = '<span style="color:green" ><strong>Completed</strong></span>';
											}else if($v->status == 2){
												$status = '<strong style="color:red"><span>Rejected</strong></span>';
											}else{
												$status = '';
											}
								?>
										
										<tr>
											<td>{{$v->amount}} INR</td>
											<td>{{date('M-d, Y', strtotime($v->reqeusted_at))}}</td>		<td><?php echo $status; ?></td>	
											<!-- <td>
												<?php 
													//if($v->status == 0){ 
												?>
												<a href="javascript:void(0);" data-toggle="modal"  data-target="#del-withdraw-req-modal" onclick="delWithdrawReq('{{$v->id}}');" >Delete</a>
												<?php //} ?>
											</td> -->
										</tr>
								<?php 
										}
									}else{
										echo '<tr><td colspan="4"><font color="red">Record(s) not found.</font></td></tr>';
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
                        
						<div id="wdrl-amt-modal-body" class="modal-body" style="">
                            <div class="form-group destination-t">
                                <input type="text" class="form-control wdrl-amt" name="amount" id="amount" placeholder="Enter Withdraw Amount" onkeypress="return isNumberKey(event);" autocomplete="off">
                            </div>
                            <div style="text-align:center;">                                
                                <p>
                                    <small>NOTE: 
                                    It may take up to 1 Bank working day for a new withdraw to reflect from the wallet.</small>
                                </p>
                            </div>
                        </div>
						
						<div id="wdrl-2fa-modal-body" style="display:none;" class="modal-body">
							<div class="form-group destination-t">
                                <input placeholder="ENTER 2FA OTP" id="2fa-code" name="2fa-code" class="form-control" type="text" onkeypress="return isNumberKey(event);" onkeyup="return submit2FaWithdraw();" autocomplete="off" >
                            </div>
                            <div style="text-align:left;">                                
                                <p>
                                    <small>&nbsp;</small>
                                </p>
                            </div>
						</div>
						
						
                        <div class="modal-footer">
							
							<div id="withdrawFormReqResp" class="success-txt" style="display:none;" ></div>
                            
							<button type="button" class="ladda-button ladda-button-demo btn btn-global next-wdrl-amt-btn"  data-style="zoom-in">NEXT</button>
							
							<button style="display:none;" type="submit" class="ladda-button ladda-button-demo btn btn-global submit-wdrl-2fa-btn"  data-style="zoom-in">SUBMIT</button>
							
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
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Deposited Amount" autocomplete="off" >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="deposit_date" id="deposit_date" placeholder="Deposit Date" autocomplete="off" >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="reference_number" id="reference_number" placeholder="Reference Number" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="reference_number_confirmation" id="reference_number_confirmation" placeholder="Confirm Reference Number" autocomplete="off">
                                </div>								
								<div class="form-group">
                                    <input type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks (Phone Number)" onkeypress="return isNumberKey(event);" autocomplete="off">
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
							
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  END of Modal for managing diposit request of INR-->
		
	<!--  Modal Delete Deposit Request -->
    <div class="deposit-inr-request">        
        <div class="modal inmodal" id="del-deposit-req-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">CANCEL DEPOSIT REQUEST</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                        
                    </div>
                    <form name="del-deposit-form-request" id="del-deposit-form-request">
						<input type="hidden" id="deposit_id" name="deposit_id" value="" >
						<input type="hidden" id="deposit_request_action" name="request_action" value="del_deposit_request" >
                        <div class="modal-body" style="">
                            <div>
                                <div class="form-group destination-t">
                                    Are you really want to delete this request?
                                </div>                                
                            </div>
                            
							<div style="text-align:center;">                                
                            </div>

                        </div>
                        <div class="modal-footer">
                            
							<div class="success-txt ajaxResponse" style="display:none;" ></div>
							
							<button type="submit" class="ladda-button ladda-button-demo btn btn-global submit-del-deposit-btn"  data-style="zoom-in">SUBMIT</button>
							
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  END Delete Deposit Request -->
	
	
	<!--  Modal Delete Withdraw Request -->
    <div class="deposit-inr-request">        
        <div class="modal inmodal" id="del-withdraw-req-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">CANCEL WITHDRAW REQUEST</h4>
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                        
                    </div>
                    <form name="del-withdraw-form-request" id="del-withdraw-form-request">
                        <input type="hidden" id="withdraw_id" name="withdraw_id" value="" >
						<input type="hidden" id="withdraw_request_action" name="request_action" value="del_withdraw_request" >
						<div class="modal-body" style="">
                            <div>
                                <div class="form-group destination-t">
                                    Are you really want to delete this request?
                                </div>                              
                            </div>
                            
							<div style="text-align:center;">                                
                            </div>

                        </div>
						
						
						
                        <div class="modal-footer">                            
							
							<div class="success-txt ajaxResponse" style="display:none;" ></div>
							
							<button type="submit" class="ladda-button ladda-button-demo btn btn-global submit-del-withdraw-btn"  data-style="zoom-in">SUBMIT</button>
							
							<!-- <button type="button" class="ladda-button ladda-button-demo btn btn-global close-req-modal"  data-style="zoom-in">CANCEL</button>-->							
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--  END Delete Deposit Request -->
	
	
@endsection()
@section('footerjs')
<script src="{{asset('/public/gilt/js/account.js')}}"></script>
<script src="{{asset('/public/gilt/js/common.js')}}"></script>
<script src="{{asset('/public/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('/public/gilt/js/otherform.js')}}"></script>
<script>
		function delDepositReq(id){
			$('#deposit_id').val(id);
		}
		function delWithdrawReq(id){
			$('#withdraw_id').val(id);
		}
        $('#deposit_date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
		
		
		$('.close-req-modal').click(function(){
			$('#del-deposit-req-modal').modal('hide');
			$('#del-withdraw-req-modal').modal('hide');
		})
</script>
@endsection()
