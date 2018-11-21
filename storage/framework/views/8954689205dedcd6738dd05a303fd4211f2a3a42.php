<?php $__env->startSection('headerjs'); ?>
    <link href="<?php echo e(asset('/public/css/plugins/datapicker/datepicker3.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="section6 m-t-50">	
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12"><div class="contact-s">KYC Form</div></div>
			</div>	
		</div>		
	</section>			
	<section class="section9 text-left">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12">					
					<div class="d-flex flex-row mt-2 tabkyc-form">						
						<ul class="nav nav-tabs nav-tabs--vertical nav-tabs--left" role="navigation">							
							<li class="nav-item">
								<a href="#identy" class="nav-link active" data-toggle="tab" role="tab" aria-controls="lorem">Identity
									
									<?php
										//echo "email=".$user_data['user']->id;
										//echo "userid= ".$user_data['user']->email;
										
										if(isset($user_data['user']->is_profile) && ($user_data['user']->is_profile==1)){
											echo '<span class="yellow-color">Under Review</span>';
										}
										else if(isset($user_data['user']->is_profile) && ($user_data['user']->is_profile==0)){
											echo '<span class="red-color">Pending</span>';
										}
										else if(isset($user_data['user']->is_profile) && ($user_data['user']->is_profile==2)){
											echo '<span class="green-color">Verified</span>';
										}
										else if(isset($user_data['user']->is_profile) && ($user_data['user']->is_profile==3)){
											echo '<span class="red-color">Rejected</span>';
										}
									?>
									
								</a>
							</li>
							<li class="nav-item">
								<a href="#address" class="nav-link" data-toggle="tab" role="tab" aria-controls="ipsum">Address 
								<?php
									if(isset($user_data['user']->is_address) && ($user_data['user']->is_address==1))
									{
										echo '<span class="yellow-color">Under Review</span>';
									}
									else if(isset($user_data['user']->is_address) && ($user_data['user']->is_address==0)){
										echo '<span class="red-color">Pending</span>';
									}
									else if(isset($user_data['user']->is_address) && ($user_data['user']->is_address==2)){
										echo '<span class="green-color">Verified</span>';
									}
									else if(isset($user_data['user']->is_address) && ($user_data['user']->is_address==3)){
										echo '<span class="red-color">Rejected</span>';
									}
								?></a>
							</li>
							<li class="nav-item">
								<a href="#bankdetail" class="nav-link" data-toggle="tab" role="tab" aria-controls="sit-more">Bank Details
								<?php
									if(isset($user_data['user']->is_bank) && ($user_data['user']->is_bank==1))
									{
										echo '<span class="yellow-color">Under Review</span>';
									}
									else if(isset($user_data['user']->is_bank) && ($user_data['user']->is_bank==0)){
										echo '<span class="red-color">Pending</span>';
									}
									else
									if(isset($user_data['user']->is_bank) && ($user_data['user']->is_bank==2)){
										echo '<span class="green-color">Verified</span>';
									}
									else
									if(isset($user_data['user']->is_bank) && ($user_data['user']->is_bank==3)){
										echo '<span class="red-color">Rejected</span>';
									}
								?></a>
							</li>
							
							<li class="nav-item">
								<a href="#setting" class="nav-link" data-toggle="tab" role="tab" aria-controls="sit-amet">Change Password </a>
							</li>
							
							<li class="nav-item">
								<a href="#security" class="nav-link" data-toggle="tab" role="tab" aria-controls="sit-amet">Setting </a>
							</li>							
							
						</ul>
						<div class="tab-content">
							<div class="tab-pane fade show active" id="identy" role="tabpanel">														
								<form class="form-inline formindenty" action="#" method="post" name="profile-form" id="profile-form">
									<h4 class="passvary-s">Identity Verification</h4>
									<div class="form-group">
										<label>First Name</label>
										<input type="text" value="<?php if(isset($user_data['user']->first_name)): ?><?php echo e($user_data['user']->first_name); ?><?php endif; ?>" id="first_name" name="first_name" class="form-control">
									</div>
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" value="<?php if(isset($user_data['user']->last_name)): ?><?php echo e($user_data['user']->last_name); ?><?php endif; ?>" id="last_name" name="last_name" class="form-control">
                                    </div>
                                    <div class="form-group">
										<label>Mobile</label>
										<input type="text" value="<?php if(isset($user_data['user']->mobile)): ?><?php echo e($user_data['user']->mobile); ?><?php endif; ?>" id="mobile" name="mobile"  onkeypress="return isNumberKey(event);" class="form-control">
									</div>
									<div class="form-group">
										<label>Date of Birth</label>
										<div class="select-data">
											<select class="form-control minimal viewselet-form" name="day">
											<option value="">Day</option>
                                                <?php
                                                    for($i=1; $i<=31; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->dob) && ($i==(int)date('d', strtotime($user_data['user']->dob))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="month">
											<option value="">Month</option>
                                                <?php
                                                    for($i=1; $i<=12; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->dob) && ($i==(int)date('m', strtotime($user_data['user']->dob))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="year">
											<option value="">Year</option>
                                                <?php
                                                    for($i=1960; $i<=2000; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->dob) && ($i==(int)date('Y', strtotime($user_data['user']->dob))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>Document Series/Number</label>
										<input type="text" class="form-control" value="<?php if(isset($user_data['user']->document_number)): ?><?php echo e($user_data['user']->document_number); ?><?php endif; ?>" name="document_number" id="document_number">
									</div>
									<div class="form-group">
										<label>Document country of issue</label>
										<div class="select-data">
											<select class="form-control minimal viewselet-form"  name="country" id="country">
												
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>ID Document Issue Date</label>
										<div class="select-data">
											<select class="form-control minimal viewselet-form" name="doc_issue_day" id="doc_issue_day_id"
											<?php
											if(isset($user_data['user']->is_iddoc_issue_date))
											{
											if($user_data['user']->is_iddoc_issue_date=='Y')
												echo "disabled";
											else
												echo "";
											}
											?> >
											<option value="">Day</option>
                                                <?php
                                                    for($i=1; $i<=date('d'); $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->document_issue_date) && ($i==(int)date('d', strtotime($user_data['user']->document_issue_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                            
											<select class="form-control minimal viewselet-form" name="doc_issue_month"  id="doc_issue_month_id"
											<?php
											if(isset($user_data['user']->is_iddoc_issue_date))
											{
											if($user_data['user']->is_iddoc_issue_date=='Y')
												echo "disabled";
											else
												echo "";
											}
											?>
											>
											<option value="">Month</option>
                                                <?php
                                                    for($i=1; $i<=date('m'); $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->document_issue_date) && ($i==(int)date('m', strtotime($user_data['user']->document_issue_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="doc_issue_year"  id="doc_issue_year_id"
											<?php
											if(isset($user_data['user']->is_iddoc_issue_date))
											{
											if($user_data['user']->is_iddoc_issue_date=='Y')
												echo "disabled";
											else
												echo "";
											}
											?>
											>
											<option value="">Year</option>
                                                <?php
                                                    for($i=1990; $i<=2018; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->document_issue_date) && ($i==(int)date('Y', strtotime($user_data['user']->document_issue_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
										</div>
										<div class="not-app">
											<label></label>										
											<input type="checkbox" name="is_iddoc_issue_date" id="is_iddoc_issue_date" value='Y' 
											<?php
											if(isset($user_data['user']->is_iddoc_issue_date))
											{
											if($user_data['user']->is_iddoc_issue_date=='Y')
												echo "checked";
											else
												echo "";
											}
											?> onClick="enable_disable_date_idver_issue();">  Not Applicable
										</div>
									</div>
									<div class="form-group">
										<label>ID Document Expiration Date</label>
										<div class="select-data">
											<select class="form-control minimal viewselet-form" name="doc_exp_day" id="doc_exp_day_id"
											<?php
											if(isset($user_data['user']->is_iddoc_exp_date))
											{
											if($user_data['user']->is_iddoc_exp_date=='Y')
												echo "disabled";
											else
												echo "";
											}
										?>
											>
											<option value="">Day</option>
                                                <?php
                                                    for($i=1; $i<=31; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->document_exp_date) && ($i==(int)date('d', strtotime($user_data['user']->document_exp_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="doc_exp_month" id="doc_exp_month_id"
											<?php
											if(isset($user_data['user']->is_iddoc_exp_date))
											{
											if($user_data['user']->is_iddoc_exp_date=='Y')
												echo "disabled";
											else
												echo "";
											}
										?>
											>
											<option value="">Month</option>
                                                <?php
                                                    for($i=1; $i<=12; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->document_exp_date) && ($i==(int)date('m', strtotime($user_data['user']->document_exp_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="doc_exp_year" id="doc_exp_year_id"
											<?php
											if(isset($user_data['user']->is_iddoc_exp_date))
											{
											if($user_data['user']->is_iddoc_exp_date=='Y')
												echo "disabled";
											else
												echo "";
											}
										?>
											>
											<option value="">Year</option>
                                                <?php
                                                    for($i=2018; $i<=2040; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['user']->document_exp_date) && ($i==(int)date('Y', strtotime($user_data['user']->document_exp_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
										</div>
										<div class="not-app">
											<label></label>										
											<input type="checkbox"  value='Y' name="is_iddoc_exp_date" id="is_iddoc_exp_date" 
											
											<?php
											if(isset($user_data['user']->is_iddoc_exp_date))
											{
												if($user_data['user']->is_iddoc_exp_date=='Y')
													echo "checked";
												else
													echo "";
											}
											?> onClick="enable_disable_date_idver_expiration();">  Not Applicable
										</div>
									</div>	
									<div class="form-group">
										<label>Colour scan copy of the document</label>
										 <div class="input-group image-preview">
                                            <?php
											if(isset($user_data['user']->document_attached) && $user_data['user']->document_attached!='')
											{?>
												<img src="<?php echo e(url('/uploads/documents/'.$user_data['user']->document_attached)); ?>">
											<?php }
											else{
                                             ?>
											<input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
											<span class="input-group-btn">
												<!-- image-preview-clear button -->
												<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
													<span class="glyphicon glyphicon-remove"></span> Clear
												</button>
												<!-- image-preview-input -->
												<div class="btn btn-default image-preview-input">
													<span class="glyphicon glyphicon-folder-open"></span>
													<span class="image-preview-input-title">Browse</span>
													<input type="file" accept="image/png, image/jpeg, image/gif" name="document_attached" id="document_attached"/> <!-- rename it -->
												</div>
											</span>
											<?php 
											}?>
										</div>
									</div>
									<?php
									if(isset($user_data['user']->is_profile) && ($user_data['user']->is_profile==0 || $user_data['user']->is_profile==3))
									{?>
										<div class="discover-btn  marfin-top-tab nobox-shadow ">
											<button type="submit" class="btn btn-global-dark profile-submit-action">SEND FOR VERIFICATION <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
										</div>
									<?php 
										}?>

								</form>
							</div>
							<div class="tab-pane fade" id="address" role="tabpanel">
								<form class="form-inline formindenty" action="#"  name="address-form" id="address-form">
								<h4 class="passvary-s">Verification Address</h4>
									<div class="form-group">
										<label>Address</label>
										<textarea class="form-control"  name="addr" id="addr"><?php if(isset($user_data['address']->addr)): ?><?php echo e($user_data['address']->addr); ?><?php endif; ?></textarea>
									</div>
									<div class="form-group">
										<label>City</label>
										<input type="text" class="form-control" value="<?php if(isset($user_data['address']->city)): ?><?php echo e($user_data['address']->city); ?><?php endif; ?>" name="city" id="city">
									</div>
									<div class="form-group">
										<label>Postal Code</label>
										<input type="text" class="form-control" value="<?php if(isset($user_data['address']->zip_code)): ?><?php echo e($user_data['address']->zip_code); ?><?php endif; ?>" name="zip_code" id="zip_code" maxlength="8" onkeypress="return isNumberKey(event);" autocomplete="off"> 
									</div>	
									
									<div class="form-group">
										<label>Document Number/Series</label>
										<input type="text" class="form-control" name="document_number" value="<?php if(isset($user_data['address']->document_number)): ?><?php echo e($user_data['address']->document_number); ?><?php endif; ?>" value="" id="document_number"> 
									</div>	

									<div class="form-group">
										<label>Document country of issue</label>
										<div class="select-data">
											<select class="form-control minimal viewselet-form country" name="country" id="country">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>ID Document Issue Date</label>
										<div class="select-data">
											<select class="form-control minimal viewselet-form" name="doc_issue_day" id="doc_issue_day"
											<?php
												if(isset($user_data['address']->is_addoc_issue_date))
												{
													if($user_data['address']->is_addoc_issue_date=='Y')
														echo "disabled";
													else
														echo "";
												}
											?>
											>
											<option value="">Day</option>
                                                <?php
                                                    for($i=1; $i<=date('d'); $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['address']->document_issue_date) && ($i==(int)date('d', strtotime($user_data['address']->document_issue_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
                                            </select>
                                            
											<select class="form-control minimal viewselet-form" name="doc_issue_month" id="doc_issue_month"
											<?php
											if(isset($user_data['address']->is_addoc_issue_date))
											{
												if($user_data['address']->is_addoc_issue_date=='Y')
													echo "disabled";
												else
													echo "";
											}
												?>
											>
											<option value="">Month</option>
                                                <?php
                                                    for($i=1; $i<=date('m'); $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['address']->document_issue_date) && ($i==(int)date('m', strtotime($user_data['address']->document_issue_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="doc_issue_year" id='doc_issue_year'
											<?php
											if(isset($user_data['address']->is_addoc_issue_date))
											{
												if($user_data['address']->is_addoc_issue_date=='Y')
													echo "disabled";
												else
													echo "";
											}	
												?>
											>
											<option value="">Year</option>
                                                <?php
                                                    for($i=1990; $i<=2018; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['address']->document_issue_date) && ($i==(int)date('Y', strtotime($user_data['address']->document_issue_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
										</div>
										<div class="not-app">
											<label></label>										
											<input type="checkbox" name='is_addoc_issue_date' id='is_addoc_issue_date' value='Y' 
											<?php
											if(isset($user_data['address']->is_addoc_issue_date))
											{
											if($user_data['address']->is_addoc_issue_date=='Y')
												echo "checked";
											else
												echo "";
											}
											?> onClick="enable_disable_date_add_issue();");
											>  Not Applicable
										</div>
									</div>
									<div class="form-group">
										<label>ID Document Expiration Date</label>
										<div class="select-data">
											<select class="form-control minimal viewselet-form" name="doc_exp_day" id='doc_exp_day'
											<?php
											if(isset($user_data['address']->is_addoc_exp_date))
											{
												if($user_data['address']->is_addoc_exp_date=='Y')
													echo "disabled";
												else
													echo ""; 
											}
											?>
											>
											<option value="">Day</option>
                                                <?php
                                                    for($i=1; $i<=31; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['address']->document_exp_date) && ($i==(int)date('d', strtotime($user_data['address']->document_exp_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="doc_exp_month" id='doc_exp_month'
											<?php
											if(isset($user_data['address']->is_addoc_exp_date))
											{
												if($user_data['address']->is_addoc_exp_date=='Y')
													echo "disabled";
												else
													echo "";
											}
											?>
											>
											<option value="">Month</option>
                                                <?php
                                                    for($i=1; $i<=12; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['address']->document_exp_date) && ($i==(int)date('m', strtotime($user_data['address']->document_exp_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
											<select class="form-control minimal viewselet-form" name="doc_exp_year" id='doc_exp_year'
											<?php
											if(isset($user_data['address']->is_addoc_exp_date))
											{
												if($user_data['address']->is_addoc_exp_date=='Y')
													echo "disabled";
												else
													echo "";
											}
											?>
											>
											<option value="">Year</option>
                                                <?php
                                                    for($i=2018; $i<=2040; $i++)
                                                    {
                                                        $selected = '';
                                                        if(isset($user_data['address']->document_exp_date) && ($i==(int)date('Y', strtotime($user_data['address']->document_exp_date))))
                                                        {
                                                            $selected = 'selected';
                                                        }
                                                        echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
                                                    }
                                                ?>
											</select>
										</div>
										<div class="not-app">
											<label></label>										
											<input type="checkbox" name='is_addoc_exp_date' id="is_addoc_exp_date" value='Y' 
											<?php
											if(isset($user_data['address']->is_addoc_exp_date))
											{
											if($user_data['address']->is_addoc_exp_date=='Y')
												echo "checked";
											else
												echo "";
											}
								?>
										onClick="enable_disable_date_add_expiration();"> Not Applicable
										</div>
									</div>	
									<div class="form-group">
										<label>Colour scan copy of the document</label>
										<div class="input-group image-preview1">

											<?php
											if(isset($user_data['address']->document_attached_file) && ($user_data['address']->document_attached_file!=''))
											{?>
												<img src="<?php echo e(url('/uploads/documents/'.$user_data['address']->document_attached_file)); ?>">
											<?php }
											else{?>

											<input type="text" class="form-control image-preview-filename1" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
											<span class="input-group-btn">
												<!-- image-preview-clear button -->
												<button type="button" class="btn btn-default image-preview-clear1" style="display:none;">
													<span class="glyphicon glyphicon-remove"></span> Clear
												</button>
												<!-- image-preview-input -->
												<div class="btn btn-default image-preview-input1">
													<span class="glyphicon glyphicon-folder-open"></span>
													<span class="image-preview-input-title1">Browse</span>
													<input type="file" accept="image/png, image/jpeg, image/gif" name="document_attached_file" id="document_attached_file"/> <!-- rename it -->
												</div>
											</span>
											<?php }?>
										</div>
									</div>
									<?php
									if(isset($user_data['user']->is_address) && ($user_data['user']->is_address==0 || $user_data['user']->is_address==3))
									{?>
										<div class="discover-btn  marfin-top-tab nobox-shadow ">
											<button type="submit" class="btn btn-global-dark sub-address">SEND FOR VERIFICATION <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
										</div>
									<?php 
									}?>

								</form>
							</div>	
							<div class="tab-pane fade" id="bankdetail" role="tabpanel">
								<form class="form-inline formindenty" method="post" action="#"  name="bank-form" id="bank-form">
									
									<h4 class="passvary-s">Bank Details</h4>
									
									<div class="form-group">
										<label>Bank Name</label>
										<input type="text" name="bank" value="<?php if(isset($user_data['bank_account']->account_type)): ?> <?php echo e($user_data['bank_account']->bank); ?> <?php endif; ?>" id='bank' class="form-control">
									</div>
									<div class="form-group">
										<label>Branch Name</label>
										<input type="text" name="branch" value="<?php if(isset($user_data['bank_account']->branch)): ?><?php echo e($user_data['bank_account']->branch); ?><?php endif; ?>" id='branch' class="form-control">
									</div>									
									<div class="form-group">
										<label>Account Holder Name</label>
										<input type="text" name="holder_name" value="<?php if(isset($user_data['bank_account']->holder_name)): ?><?php echo e($user_data['bank_account']->holder_name); ?><?php endif; ?>" id='holder_name' class="form-control">
									</div>
									<div class="form-group">
										<label>Bank Account Number</label>
										<input type="text" name="account_no" value="<?php if(isset($user_data['bank_account']->holder_name)): ?><?php echo e($user_data['bank_account']->holder_name); ?><?php endif; ?>" id="account_no"  class="form-control">
									</div>
									<div class="form-group">
										<label>Re-Enter Bank Account Number</label>
										<input type="text" name="account_no_confirmation" value="<?php if(isset($user_data['bank_account']->holder_name)): ?><?php echo e($user_data['bank_account']->holder_name); ?><?php endif; ?>" id="account_no_confirmation"   class="form-control">
									</div>									
									<div class="form-group">
										<label>Pan Card Number</label>
										<input type="text" name="pan_card_number" value="<?php if(isset($user_data['bank_account']->pan_card_number)): ?><?php echo e($user_data['bank_account']->pan_card_number); ?><?php endif; ?>" id="pan_card_number"    class="form-control">
									</div>
									<div class="form-group">
										<label>Bank IFSC Code</label>
										<input type="text" name="ifsc" 	value="<?php if(isset($user_data['bank_account']->ifsc)): ?><?php echo e($user_data['bank_account']->ifsc); ?><?php endif; ?>" id="ifsc" class="form-control">
									</div>
									<div class="form-group">
										<label>Account Type</label>
										<input type="text" name="account_type" 	value="<?php if(isset($user_data['bank_account']->account_type)): ?><?php echo e($user_data['bank_account']->account_type); ?><?php endif; ?>" id="account_type" class="form-control">
									</div>		
									<div class="form-group">
										<label>Mobile Number</label>
										<input type="text" name="linked_mobile" value="<?php if(isset($user_data['bank_account']->linked_mobile)): ?><?php echo e($user_data['bank_account']->linked_mobile); ?><?php endif; ?>" id="linked_mobile"  onkeypress="return isNumberKey(event);"  class="form-control">
									</div>	
									<!--
									<div class="form-group">
										<label>Colour scan copy of the Cheque</label>
										 <div class="input-group image-preview1">
											<input type="text" name="color_scan_cheque" value=""  class="form-control image-preview-filename1" id="color_scan_cheque" disabled="disabled"> 
											
											<span class="input-group-btn">
												
												<button type="button" class="btn btn-default image-preview-clear1" style="display:none;">
													<span class="glyphicon glyphicon-remove"></span> Clear
												</button>
												
												<div class="btn btn-default image-preview-input1">
													<span class="glyphicon glyphicon-folder-open"></span>
													<span class="image-preview-input-title1">Browse</span>
													<input type="file" accept="image/png, image/jpeg, image/gif" name="color_scan_cheque" id="color_scan_cheque"/> 
													
												</div>
											</span>
										</div>
									</div>-->
									
									<!--document-->
									<div class="form-group">
										<label>Colour scan copy of the cheque</label>
										 <div class="input-group image-preview">
                                            <?php
											if(isset($user_data['bank_account']->color_scan_cheque) && ($user_data['bank_account']->color_scan_cheque!=''))
											{?>
												<img src="<?php echo e(url('/uploads/documents/'.$user_data['bank_account']->color_scan_cheque)); ?>">
											<?php }
											else{
                                             ?>
											<input type="text" class="form-control image-preview-filename" disabled="disabled"> 
											<span class="input-group-btn">
												
												<button type="button" class="btn btn-default image-preview-clear" style="display:none;">
													<span class="glyphicon glyphicon-remove"></span> Clear
												</button>
												
												<div class="btn btn-default image-preview-input">
													<span class="glyphicon glyphicon-folder-open"></span>
													<span class="image-preview-input-title">Browse</span>
													<input type="file"  name="color_scan_cheque" id="color_scan_cheque"/>
													<input type="hidden" >
												</div>
											</span>
											<?php 
											}?>
										</div>
									</div>
									<!--end-->
											
									<?php
									if(isset($user_data['user']->is_bank) && ($user_data['user']->is_bank==0 || $user_data['user']->is_bank==3))
									{?>
									<div class="discover-btn  marfin-top-tab nobox-shadow ">
											<button type="submit" class="btn btn-global-dark sub-bank">SEND FOR VERIFICATION <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
											<span id="showmsgbank" class="success-txt"></span>
										</div>
								
										<?php
									}
										?>
								</form>
							</div>														
							<div class="tab-pane fade" id="setting" role="tabpanel">
								<form class="form-inline formindenty" action="#" name="reset-password-form" id="reset-password-form">
									<h4 class="passvary-s">Password</h4>
									<div class="form-group">
										<label>Current Password</label>
										<input type="password" placeholder="Current Password" id="old_password" name="old_password" class="form-control">
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input type="password" placeholder="New Password" id="password" name="password" class="form-control">
									</div>
									<div class="form-group">
										<label>Repeat Password</label>
										<input type="password" placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" class="form-control">
									</div>
									<?php
									//if($user_data['user']->auth_enabled){?>
									<!--<div class="form-group">
										<label><b>Enter 2FA</b></label>
										<input type="password" placeholder="Enter 2FA" id="secret" name="secret" class="form-control">
									</div>-->
									<?php //}?>
									
									<input type="hidden" placeholder="Enter 2FA" id="secret" name="secret" value="" class="form-control">
									
		   									
									
									<div class="discover-btn  marfin-top-tab nobox-shadow ">
											<button type="submit" class="btn btn-global-dark submit-reset">CHANGE PASSWORD <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
											<span class="text-message"></span>
									</div>
									<div id="resetPswAjxResp" style="padding: 10px 10px;" ></div>
								</form>
								
							</div>
							
							<div class="tab-pane fade" id="security" role="tabpanel">
								<!-- 2fa Button start -->
								<?php
									if($user_data['user']->auth_enabled)
									{
										?>
										
										<div><button  data-toggle="modal"  data-target="#2fa-popup"  class="btn btn-global btn-block m-t"> Disabled 2FA </button></div>
										
										<!--<li class="nav-item">
											<a href="#google2FA" class="nav-link" data-toggle="modal"  data-target="#2fa-popup" role="tab" aria-controls="sit-amet"> Disabled 2FA </a>
										</li>-->
										
									<?php
									}
									else{ ?>
										
										<div><button  data-toggle="modal"  data-target="#2fa-popup" class="btn btn-global btn-block m-t"> Enable 2FA </button></div>
										
										<!-- <li class="nav-item">
											<a href="#google2FA" class="nav-link" data-toggle="modal"  data-target="#2fa-popup" role="tab" aria-controls="sit-amet"> Enable 2FA </a>
										</li> -->
									
									<?php }?>
									<!-- 2fa Button end -->
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>
	
	<!--  Modal for Enable 2FA QR Code-->
    <div class="2fa-enable">
        <div class="modal inmodal" id="2fa-popup" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                
                <div class="modal-content">

                    <form action="#" name="2fa-form" id="2fa-form">
						
						<div class="modal-header">
							<h4 class="modal-title"> <span class="coin-name"></span> <?php echo e(($user_data['user']->auth_enabled==0)?'Enable 2FA':'Disabled 2FA'); ?></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
			
                        <div class="modal-body scrol-p">
                            
                            <div class="row address-sec" style="display: block;">
                            <?php
                                if($user_data['user']->auth_enabled==0)
                                {?>
                                <input type="hidden"  name="atcion" value="0">
                                <div class="col-md-12 mt-20 text-center">
                                    <h4 class="text-center" style="margin-top: 8px;">2FA QR Code</h4>
                                    <img class="qr-img" id="qr-img" src="<?php echo e($user_data['user']->auth_code_url); ?>">
                                    <h3 class="text-center pb-10">&nbsp;</h3>
                                    <!-- <p class="text-center" id="c_address">ENTER 2FA OTP</p> -->
                                </div>
                                <div class="col-md-12 mt-20 text-center">
                                    <div class="col-md-9">
                                        <div class="form-group name-group">
                                            <input type="text" class="form-control" placeholder="ENTER 2FA OTP" id="g2fa" name="g2fa" onkeypress="return isNumberKey(event);" onkeyup="return submit2FaSetting();" autocomplete="off"> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button name="btnCopy"  id="btnCopy" class="btn btn-global submit-2fa" type="submit"> SUBMIT</button>
										
										<div id="2faResp" style="display:none;" ></div>
                                    </div>
                                </div>
                                <?php 
                                }else{?>
                                    <input type="hidden"  name="atcion" value="1">
                                    
									<div class="error-txt" id="2faResp" style="padding-left:33px; display:none;"></div>
									
									<div class="col-md-12 mt-20 text-center">
                                        <div class="col-md-9">
                                            <div class="form-group name-group">
                                                <input type="text" class="form-control" placeholder="ENTER 2FA OTP" id="g2fa" name="g2fa" onkeypress="return isNumberKey(event);" onkeyup="return submit2FaSetting();" autocomplete="off"> 
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button name="btnCopy"  id="btnCopy" class="ladda-button ladda-button-demo btn btn-global submit-2fa" data-style="zoom-in" type="submit"> SUBMIT</button>
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
        

    <!--  END of Modal Enable 2FA QR Code-->
	
	
	
	<!-- Deposit Request Model Popup Box start-->											
    <div id="2fa-form-psw" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <span class="coin-name"></span> Enter Google 2FA</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                    <form class="form" action="#" name="login-2fa-form" id="login-2fa-form" >
                    <fieldset>
                        
						<div id="fa-resp-msg" style="color: #ff0000; font-size:12px;" ></div>
						
						
						<div class="form-group">
                            <div class="input-group">														  			  
                                <input placeholder="ENTER 2FA OTP" id="2fa-code" name="2fa-code" class="form-control" type="text" onkeyup="return submit2FaPsw();" >
                            </div>
                        </div>
						
                        <button type="button" class="btn btn-global psw-submit-2fa">Submit <span><img src="<?php echo e(asset('/public/gilt/img/btn-arrow.png')); ?>"/></span></button>
						
                    </fieldset>
                    </form>
            </div>
            <div class="modal-footers"></div>
        </div>
        </div>
    </div>
    <!-- deposit request Model Popup Box end-->
        

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footerjs'); ?>
    <script src="<?php echo e(asset('/public/gilt/js/account.js')); ?>"></script>
	<script src="<?php echo e(asset('/public/gilt/js/common.js')); ?>"></script>
	<script src="<?php echo e(asset('/public/gilt/js/otherform.js')); ?>"></script>
    <!-- Data picker -->
    <script src="<?php echo e(asset('/public/js/plugins/datapicker/bootstrap-datepicker.js')); ?>"></script>
    <script>
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            
            $.getJSON("public/countries.json", function (obj) {
                var options = "<option value=''>Select Country *</option>";
                $.each(obj.Country, function (key, value) {
                    selected = '';
                    if(value.name=="<?php if(isset($user_data['user']->country)): ?><?php echo e($user_data['user']->country); ?><?php endif; ?>")
                        selected = 'selected'; 


                    options += ("<option "+selected+" value='" + value.name + "'>" + value.name + "</option>");
				});
				$("#country").html(options);


				$.each(obj.Country, function (key, value) {
                    selected = '';
                    if(value.name=="<?php echo e($user_data['address']->country); ?>")
                        selected = 'selected'; 
					options += ("<option "+selected+" value='" + value.name + "'>" + value.name + "</option>");
                });
				$(document).find(".country").html(options);
                
                //$("#country").selectpicker();
            });

			
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('xchange.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>