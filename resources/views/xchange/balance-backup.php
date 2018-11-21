@extends('xchange.master')
<!-- @extends('xchange.master1') -->
@section('headerjs')
@endsection()

@section('content')

 
        <div class="wrapper wrapper-content">
				
                <div class="row">

                    <div class="col-lg-12" style="display:none;" >
                            <div class="ibox float-e-margins" >
                                <div class="">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5><i class="fa fa-inr"></i> INR BALANCE</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <strong>TOTAL</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong> IN ORDERS</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong>AVAILABLE</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong>WITHDRAW</strong>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    {{number_format($balance->balance+$balance->locked_bal,2)}} {{strtoupper($balance->coin)}}
                                                </div>
                                                <div class="col-md-3">
                                                {{number_format($balance->locked_bal,2)}} {{strtoupper($balance->coin)}}
                                                </div>
                                                <div class="col-md-3">
                                                {{number_format($balance->balance,2)}} {{strtoupper($balance->coin)}}
                                                </div>
                                                <div class="col-md-3">
                                                    <button class="btn btn-primary" data-toggle="modal"  data-target="#withdraw-inr-section">WITHDRAW</button>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    
                                    
                                    </div>

                                </div>
                            
                            </div>
                        
                    </div>

                     <div class="col-lg-12" style="display:none;" >
                            <div class="ibox float-e-margins">
                                <div class="">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5> DEPOSIT INR</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="col-md-6">
                                               <h3> Bank Account Details:</h3>
                                               <div class="hr-line-dashed"></div>
                                                <div class="col-md-12 p-10">
                                                    <div class="col-md-6">Account Number</div>	
                                                    <div class="col-md-6">XXXXXXXXXXX</div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-6">IFSC</div>	
                                                    <div class="col-md-6">XXXXXXX</div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6">Account Holder Name</div>	
                                                    <div class="col-md-6"> Exhchange</div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6">Branch</div>	
                                                    <div class="col-md-6">New Delhi</div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="">  
                                                    <button class="btn btn-primary"  data-toggle="modal"  data-target="#request-inr-section">SUBMIT NEW DEPOSIT REQUEST</button>
                                                </div>  
                                            </div>
                                            
                                            <div class="col-md-6">
                                               <h3> Deposit Instructions:</h3>
                                               <div class="hr-line-dashed"></div>
                                               <ul>
                                                   <li class="li-pad">The minimum deposit amount is ₹50,000.</li>
                                                   <li class="li-pad">Once the transaction is successful, submit a deposit request by entering the exact amount and the 12 digit Transaction ID  Reference ID .</li>
                                                   <li class="li-pad">The minimum deposit amount is ₹50,000.</li>
                                                   <li class="li-pad">Once the transaction is successful, submit a deposit request by entering the exact amount and the 12 digit Transaction ID  Reference ID .</li>
                                                   <li class="li-pad">The minimum deposit amount is ₹50,000.</li>
                                                   <li class="li-pad">You can use any of these UPI Apps to make deposits to your Xchanage INR Wallet. Click on the following videos to see the detailed instructions of the respective app.</li>
                                               <ul>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    
                                    
                                    </div>

                                </div>
                            
                            </div>
                        
                    </div>

                    <div class="col-lg-12" style="display:none;" >
                            <div class="ibox float-e-margins">
                                <div class="">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5> Amount Deposit Request</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="col-md-12">
                                                <div class="col-md-3">
                                                    <strong>AMOUNT</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong> DEPOSIT DATE</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong>REFERENCE NUMBER</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong>STATUS</strong>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="col-md-12">
                                                <?php
                                                    foreach($deposit_request as $k=>$v)
                                                    {
                                                        $status = ($v->status==1)?'Completed':'Pending';
                                                        ?><div class="col-md-12">
                                                            <div class="col-md-3">
                                                                {{$v->amount}} INR
                                                            </div>
                                                            <div class="col-md-3">
                                                            {{date('M-d, Y', strtotime($v->deposit_date))}}
                                                            </div>
                                                            <div class="col-md-3">
                                                            {{$v->reference_number}}
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span class="label label-primary">{{$status}}</span>
                                                                <div class"clearfix"></div>
                                                            </div>
                                                            <div class="hr-line-dashed"></div>
                                                        </div>

                                                  <?php   }?>
                                                <!-- <div class="col-md-3">
                                                    <strong>AMOUNT</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong> DEPOSIT DATE</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong>REFERENCE NUMBER</strong>
                                                </div>
                                                <div class="col-md-3">
                                                <strong>STATUS</strong>
                                                </div> -->
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                    
                                    
                                    </div>

                                </div>
                            
                            </div>
                        
                    </div>
                    
                    

                </div>
                           



            </div>
            <div class="footer">
                
                <div>
                    <strong>Copyright</strong>  Company &copy; 2018
                </div>
            </div>
        </div>
        
    </div>



    <!--  Modal for managing withdraw request of INR-->

    <div class="deposit-inr-request" >
        
        <div class="modal inmodal" id="withdraw-inr-section" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">INR WITHDRAW REQUEST</h4>
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
                            <button type="submit" class="ladda-button ladda-button-demo btn btn-primary submit-withdraw-btn"  data-style="zoom-in">SUBMIT</button>
                            <!--<button type="submit" class="btn btn-primary block full-width m-b">Next</button>-->
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
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">INR DEPOSIT REQUEST</h4>
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
                            <button class="ladda-button ladda-button-demo btn btn-primary submit-deposit-btn"  data-style="zoom-in">SUBMIT</button>
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
<script src="{{asset('/public/js/account.js')}}"></script>
<script src="{{asset('/public/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>
<script>
        $('#data_1 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true
        });
</script>

@endsection()
