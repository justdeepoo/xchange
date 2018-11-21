@extends('xchange.master')
@section('headerjs')
    <link href="{{asset('/public/css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">
@endsection()

@section('content')
        <?php
            $color ='red';
            if($user_data['user']->is_profile==1 && $user_data['user']->is_kyc==1 && $user_data['user']->is_bank==1 && $user_data['user']->kyc==0)
            {
                $status ='Under Review';
                $color ='blue';
            }
            else
            if($user_data['user']->kyc==1)
            {
                $status ='Completed';
                $color ='green';
            }
            else
                $status ='Pending';

        ?>
 
        <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-md-3"><h3>Know Your Customer (KYC)</h3></div><div class="col-md-8"><strong>KYC Status </strong> :  <span style="color:{{$color}}">{{$status}}</span></div>
                    <div class="clearfix"></div>
                    <div class="col-md-12">NOTE: Please review your KYC information and make sure everything is correct to the best of your knowledge. Once Submitted,no further changes will be allowed. 
                        Only JPG or PNG files are allowed. Maximum size of the file is 5MB.</div>
                    
                 <br/><br/>
                    <div class="col-md-6">
                        
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Personal Information</h5>
                            </div>
                            <div class="ibox-content">
                                <?php 
                                    
                                    if($user_data['user']->is_profile==1)
                                    {?>
                                        <div class="form-group"><label class="col-lg-3 control-label">Email Address</label>

                                            <div class="col-lg-9"><p class="form-control-static">{{$user_data['user']->email}}</p></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">First Name</label>
                                            <div class="col-lg-9"><p class="form-control-static">{{$user_data['user']->first_name}}</p></div>
                                        </div>

                                        <div class="form-group"><label class="col-lg-3 control-label">Last Name</label>
                                            <div class="col-lg-9"><p class="form-control-static">{{$user_data['user']->last_name}}</p></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">DOB</label>
                                            <div class="col-lg-9"><p class="form-control-static">{{$user_data['user']->dob}}</p></div>
                                        </div>
                                        <div class="clearfix"></div>
                                    <?php }
                                    else{?>
                                            <form method="post" name="profile-form" id="profile-form" class="form-horizontal">
                                
                                                <div class="form-group"><label class="col-lg-3 control-label">Email Address</label>

                                                    <div class="col-lg-9"><p class="form-control-static">{{$user_data['user']->email}}</p></div>
                                                </div>
                                                <div class="form-group"><label class="col-lg-3 control-label">Mobile</label>
                                                    <div class="col-lg-9"><p class="form-control-static">{{$user_data['user']->mobile}}</p></div>
                                                </div>

                                                <div class="form-group"><label class="col-sm-3 control-label">First Name</label>

                                                    <div class="col-sm-9"><input type="text" value="{{$user_data['user']->first_name}}" id="first_name" name="first_name" class="form-control"></div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Last Name</label>
                                                    <div class="col-sm-9"><input type="text" value="{{$user_data['user']->last_name}}" id="last_name" name="last_name" class="form-control"></div>
                                                </div>
                                                <div class="form-group" id="data_1">
                                                    <label class="col-sm-3 control-label">DOB</label>
                                                    <div class="col-sm-9"><input type="text" value="{{$user_data['user']->dob}}" id="dob" name="dob" class="form-control" placeholder="yyyy-mm-dd"></div>
                                                    <!-- <div class="col-sm-8 input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                        <input type="text" name="dob" value="{{$user_data['user']->dob}}" id="dob" class="form-control" value="">
                                                    </div> -->
                                                </div>
                                                <!-- <div class="form-group"><label class="col-sm-3 control-label">DOB</label>
                                                    <div class="col-sm-9"><input type="text" value="{{$user_data['user']->dob}}" id="dob" name="dob" class="form-control"></div>
                                                </div> -->
                                                <div class="hr-line-dashed"></div>
                                                <div class="form-group">
                                                    <div class="col-sm-12"><button class="ladda-button ladda-button-demo btn btn-primary profile-submit-action pull-right" data-style="zoom-in">Submit</button></div>
                                                </div>
                                            </form>

                                   <?php }?>
                                
                            </div>
                        </div>

                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>KYC Information</h5>
                            </div>
                            <div class="ibox-content">
                                <?php
                                $aadhar_no = '';
                                $aadhar_front = '';
                                $aadhar_back = '';
                                $pan_no = '';
                                $pan_img = '';
                                
                                if($user_data['user']->is_kyc==1){
                                
                                    $aadhar_no = $user_data['kyc']->aadhar_no;
                                    $aadhar_front =  $user_data['kyc']->aadhar_front;
                                    $aadhar_back =  $user_data['kyc']->aadhar_back;
                                    $pan_no =  $user_data['kyc']->pan_no;
                                    $pan_img = $user_data['kyc']->pan_img;
                                }


                                if($user_data['user']->is_kyc==1)
                                {  ?>
                                    <div class="form-group"><label class="col-lg-3 control-label">Aadhar No </label>
                                            <div class="col-lg-9"><p class="form-control-static">{{$aadhar_no}}</p></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">Aadhar Front Image</label>
                                            <div class="col-lg-9"><p class="form-control-static"><img class="img-sec" src="{{url('/uploads/kyc/'.$aadhar_front)}}"></p></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">Aadhar Back Image</label>
                                            <div class="col-lg-9"><p class="form-control-static"><img class="img-sec" src="{{url('/uploads/kyc/'.$aadhar_back)}}"></p></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">PAN Number</label>
                                            <div class="col-lg-9"><p class="form-control-static">{{$pan_no}}</p></div>
                                        </div>
                                        <div class="form-group"><label class="col-lg-3 control-label">PAN Image</label>
                                            <div class="col-lg-9"><p class="form-control-static"><img class="img-sec" src="{{url('/uploads/kyc/'.$pan_img)}}"></p></div>
                                        </div>
                                        
                                        <div class="clearfix"></div>


                                <?php }
                                else{?>
                                <form method="post" enctype="multipart/form-data" name="kyc-form" id="kyc-form" class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-3 control-label">Aadhar Number</label>
                                        <div class="col-sm-9"><input type="text" name="aadhar_no" value="{{$aadhar_no}}" id="aadhar_no" class="form-control"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Upload Front Aadhar Card</label>
                                        <div class="col-sm-9"><input type="file" name="aadhar_front"  id="aadhar_front" class="form-control"> 
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Upload Back Aadhar Card</label>
                                        <div class="col-sm-9"><input type="file" name="aadhar_back" id="aadhar_back" class="form-control"></div>
                                    </div>
                                    
                                    <div class="form-group"><label class="col-sm-3 control-label">PAN Card Number</label>
                                        <div class="col-sm-9"><input type="text" name="pan_no" value="{{$pan_no}}" id="pan_no" class="form-control" ></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-3 control-label">Upload PAN Card</label>
                                        
                                        <div class="col-sm-9"><input type="file" name="pan_img" id="pan_img" class="form-control"> 
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-12"><button class="ladda-button ladda-button-demo btn btn-primary kyc-submit-action pull-right" data-style="zoom-in">Submit</button></div>
                                    </div>
                                </form>
                                <?php }?>
                            
                            </div>
                        </div>


                            
                        <div class="clearfix"></div>  
                    </div>
                    
                    <div class="col-md-6">
                            <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>Bank Information</h5>
                                    </div>
                                    <div class="ibox-content">

                                        <?php
                                            $ifsc = '';
                                            $bank = '';
                                            $linked_mobile = '';
                                            $account_no = '';
                                            $holder_name = '';
                                            $branch = '';
                                            $is_submit = '';
                                            $account_type ='';
                                            
                                            if(!empty($user_data['bank_account'])){
                                                $ifsc = $user_data['bank_account']->ifsc;
                                                $bank =  $user_data['bank_account']->bank;
                                                $linked_mobile =  $user_data['bank_account']->linked_mobile;
                                                $account_no =  $user_data['bank_account']->account_no;
                                                $holder_name = $user_data['bank_account']->holder_name;
                                                $account_type = $user_data['bank_account']->account_type;
                                                $branch = $user_data['bank_account']->branch;
                                                $is_submit = $user_data['bank_account']->is_submit;
                                            }
                                        

                                        if($user_data['user']->is_bank==1)
                                        {  ?>
                                                <div class="form-group"><label class="col-lg-3 control-label">Bank Name </label>
                                                    <div class="col-lg-9"><p class="form-control-static">{{$bank}}</p></div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Account Number</label>
                                                    <div class="col-lg-9">
                                                        <p class="form-control-static">{{$account_no}}</p>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label"> Account Holder Name</label>
                                                    <div class="col-lg-9"><p class="form-control-static">{{$holder_name}}</p></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Account Type</label>
                                                    <div class="col-lg-9"><p class="form-control-static">{{$account_type}}</p></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group"><label class="col-lg-3 control-label">Linked Mobile</label>
                                                <div class="col-lg-9"><p class="form-control-static">{{$linked_mobile}}</p></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group"><label class="col-lg-3 control-label">Branch</label>
                                                <div class="col-lg-9"><p class="form-control-static">{{$branch}}</p></div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                        <label class="col-lg-3 control-label">IFSC</label>
                                                    <div class="col-lg-9"><p class="form-control-static">{{$ifsc}}</p></div>
                                                </div>
                                                
                                                


                                        <?php }
                                        else{?>

                                        <form method="post" name="bank-form" id="bank-form" class="form-horizontal">
                                            <div class="form-group"><label class="col-sm-3 control-label">Bank Name</label>
                                                <div class="col-sm-9"><input type="text" name="bank"  id="bank" value="{{$bank}}" class="form-control"> 
                                                </div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">Account Number</label>
                                                <div class="col-sm-9"><input type="text" name="account_no"  id="account_no" value="{{$account_no}}" class="form-control"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">Repeat Account Number</label>
                                                <div class="col-sm-9"><input type="text" name="account_no_confirmation"  id="account_no_confirmation" value="" class="form-control"></div>
                                            </div>
                                            
                                            <div class="form-group"><label class="col-sm-3 control-label">Account Holder Name</label>
                                                <div class="col-sm-9"><input type="text" name="holder_name"  id="holder_name" value="{{$holder_name}}" class="form-control"></div>
                                            </div>

                                            <div class="form-group"><label class="col-sm-3 control-label">Mobile Number (Linked with bank account)</label>
                                                <div class="col-sm-9"><input type="text" name="linked_mobile"  id="linked_mobile" value="{{$linked_mobile}}" class="form-control"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">Branch Name</label>
                                                <div class="col-sm-9"><input type="text" name="branch"  id="branch" value="{{$branch}}" class="form-control"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">Account Type</label>
                                                <div class="col-sm-9"><input type="text" name="account_type"  id="account_type" value="{{$account_type}}" class="form-control"></div>
                                            </div>
                                            <div class="form-group"><label class="col-sm-3 control-label">IFSC Code</label>

                                                <div class="col-sm-9"><input type="text" name="ifsc" id="ifsc" value="{{$ifsc}}" class="form-control"></div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="hr-line-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12"><button class="ladda-button ladda-button-demo btn btn-primary bank-submit-action pull-right" data-style="zoom-in">Submit</button></div>
                                            </div>
                                            
                                        </form>
                                        <?php }?>
                                    </div>
                                </div>
                                <!-- jkl-->

                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Security</h5>
                                </div>
                                <div class="ibox-content">
                                
                                <?php
                                    if($user_data['user']->auth_enabled)
                                    {
                                        ?>
                                        <div><button  data-toggle="modal"  data-target="#2fa-popup"  class="btn btn-primary btn-block m-t"> Disabled 2FA </button></div>
                                        
                                    <?php
                                    }
                                    else{ ?>
                                        
                                        <div><button  data-toggle="modal"  data-target="#2fa-popup" class="btn btn-primary btn-block m-t"> Enable 2FA </button></div>
                                    
                                    <?php }?>
                                        <div> <button  data-toggle="modal"  data-target="#reset-password" class="btn btn-primary btn-block m-t"> Change Password </button></div>
                                    
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                     </div>


                        

                    
                    </div>
                </div>

          

                    
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
         
        
    </div> 




    <!--  Modal for REset Password-->

    <div class="2fa-enable">
        <div class="modal inmodal" id="reset-password" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                
                <div class="modal-content">

                    <form action="#" name="reset-password-form" id="reset-password-form">

                        <div class="modal-header d-details">
                            <button type="button" class="close close-reset" data-dismiss="modal">×</button>
                            <h3 class="h3"><span class="coin-name"></span> Reset Password</h3>
                        </div>
                        <div class="modal-body scrol-p">
                            
                            <div class="row address-sec" style="display: block;">
                                
                                <div class="col-md-12 mt-20">
                                    <div class="col-md-12">
                                        <div class="form-group name-group">
                                            <input type="password" class="form-control" placeholder="Current Password" id="old_password" name="old_password"> 
                                        </div>
                                        <div class="form-group name-group">
                                            <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password"> 
                                        </div>
                                        <div class="form-group name-group">
                                            <input type="password" class="form-control" placeholder="Enter Confirm Password" id="password_confirmation" name="password_confirmation"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button name="btnCopy"  id="btnCopy" class="btn btn-primary submit-reset" type="submit">Change</button>
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



     <!--  Modal for Enable 2FA-->

    <div class="2fa-enable">
        <div class="modal inmodal" id="2fa-popup" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                
                <div class="modal-content">

                    <form action="#" name="2fa-form" id="2fa-form">

                        <div class="modal-header d-details">
                            <h3 class="h3"><span class="coin-name"></span> {{($user_data['user']->auth_enabled==0)?'Enable 2FA':'Disabled 2FA'}}</h3>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body scrol-p">
                            
                            <div class="row address-sec" style="display: block;">
                            <?php
                                if($user_data['user']->auth_enabled==0)
                                {?>
                                <input type="hidden"  name="atcion" value="0">
                                <div class="col-md-12 mt-20 text-center">
                                    <h4 class="text-center" style="margin-top: 8px;">2FA QR Code</h4>
                                    <img class="qr-img" id="qr-img" src="{{$user_data['user']->auth_code_url}}">
                                    <h3 class="text-center pb-10">&nbsp;</h3>
                                    <!-- <p class="text-center" id="c_address">ENTER 2FA OTP</p> -->
                                </div>
                                <div class="col-md-12 mt-20 text-center">
                                    <div class="col-md-9">
                                        <div class="form-group name-group">
                                            <input type="text" class="form-control" placeholder="ENTER 2FA OTP" id="g2fa" name="g2fa"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button name="btnCopy"  id="btnCopy" class="btn btn-primary submit-2fa" type="submit"> SUBMIT</button>
                                    </div>
                                </div>
                                <?php 
                                }else{?>
                                    <input type="hidden"  name="atcion" value="1">
                                    <div class="col-md-12 mt-20 text-center">
                                        <div class="col-md-9">
                                            <div class="form-group name-group">
                                                <input type="text" class="form-control" placeholder="ENTER 2FA OTP" id="g2fa" name="g2fa"> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button name="btnCopy"  id="btnCopy" class="ladda-button ladda-button-demo btn btn-primary submit-2fa" data-style="zoom-in" type="submit"> SUBMIT</button>
                                        </div>
                                    </div>
                                <?php }?>
                                
                            </div>
                        </div>
                                        
                        </div>
                    </form>
                
                </div>
        </div>
    </div>
        

    <!--  END of Modal Enable 2FA-->
  

        

@endsection()
@section('footerjs')
    <script src="{{asset('/public/js/account.js')}}"></script>
    <!-- Data picker -->
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
