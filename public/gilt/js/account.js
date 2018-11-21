freez = 0;
f = '';

function calCoin(currency, amount)
{
  if(currency=='eth')
    return eval(amount)/1000000000000000000;
  else
  if(currency=='xrp')
    return eval(amount)/1000000;
  if(currency=='bch')
    return eval(amount)/100000000;
  if(currency=='ltc')
    return eval(amount)/100000000;
}
function getTransfer(){
  $.ajax({
    type: 'post',
    url: bu + '/txn-history',
    dataType: 'json',
    data: {},
    beforeSend: function () {
      freez = 1;
    },

    success: function (response) {
      console.log(response.statuscode);
      tr ='';
      if(response.statuscode=='SUCC')
      {
        $.each(response.data, function(k,v){
            if(v.state!='confirmed'){
              status = 'label-danger';
            }
            else
              status = 'label-primary';
           tr+='<tr><td>'+v.createdTime+'</td><td>'+(v.currency).toUpperCase()+'</td><td>'+calCoin(v.currency, v.amount)+'</td><td>'+(v.txn_type).toUpperCase()+'</td><td style="text-align:right"><label class="label '+status+'">'+(v.state).toUpperCase()+'</label></td></tr>';
          
        });

        $(document).find('.txn-rows').html(tr);

      }
      
      
    },
    complete: function () {
      freez = 0;
    }
  });
}



$(function () {


  l = '';

  $('.next-wdrl-amt-btn').click(function () {		
		var amt = $('#amount').val();		
		if(checkBlankField(amt)==false) {		
			$('#amount').addClass('form-control is-invalid');
			$('#amount').focus();
			return false;
		}		
		
		$('#wdrl-amt-modal-body').hide();
		$('#wdrl-2fa-modal-body').show();
		
		$('.next-wdrl-amt-btn').hide();
		$('.submit-wdrl-2fa-btn').show();
		
		$("#2fa-code").focus();
		
	});  
  $("input.wdrl-amt").keypress(function(){
    $('#amount').removeClass('is-invalid');
  });
  $("input#2fa-code").keypress(function(){
    $('#2fa-code').removeClass('is-invalid');
  });

$('.withdraw-inr-button').click(function () {
	
	$('#withdrawFormReqResp').hide();
	$('#withdrawFormReqResp').html('');
	
	$('#wdrl-amt-modal-body').show();
	$('#wdrl-2fa-modal-body').hide();

	$('.next-wdrl-amt-btn').show();
	$('.submit-wdrl-2fa-btn').hide();
	
});

  $('form[name="withdraw-inr-form-request"]').submit(function (e) {
    
	e.preventDefault();
    $(document).find('.input-error').remove();
	
	var amount = $(document).find('#amount').val();
	var secret = $(document).find('#2fa-code').val();
	
	
	if(checkBlankField(amount)==false) {
		$('#amount').addClass('form-control is-invalid');
		$('#amount').focus();
		
		$('#wdrl-amt-modal-body').show();
		$('#wdrl-2fa-modal-body').hide();
		
		$('.next-wdrl-amt-btn').show();
		$('.submit-wdrl-2fa-btn').hide();
		return false;
	}	
	if(checkBlankField(secret)==false) {		
		$('#2fa-code').addClass('is-invalid');
		$('#2fa-code').focus();
		return false;
	}
	
	    
    if (freez == 1)
      return false;
	
    form_id = this;
    
    $.ajax({
      type: 'post',
      url: bu + '/submit-withdraw-request',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;        
		l = $('.submit-wdrl-2fa-btn').html();
        $('.submit-wdrl-2fa-btn').html('<i class="fa fa-spinner fa-spin"></i>');
      },
      success: function (response) {
        
        //alert(response.statuscode);
		//alert(response.message);
		//alert(response.data);
		
		if (response.statuscode == 'RPI') {
          /*
		  $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v + '</span>');
          });
		  $('.submit-withdraw-btn').html(l);
		  */
        }		
		else if (response.statuscode == 'GFC') {
			$('#withdrawFormReqResp').removeClass('success-txt');
			$('#withdrawFormReqResp').addClass('error-txt');
			
			$('#withdrawFormReqResp').show();
			$('#withdrawFormReqResp').html(response.message);
		}
		else if (response.statuscode == 'CST') {
			
			$('#withdrawFormReqResp').removeClass('success-txt');
			$('#withdrawFormReqResp').addClass('error-txt');			
			
			$('#wdrl-amt-modal-body').show();
			$('#wdrl-2fa-modal-body').hide();
		
			$('.next-wdrl-amt-btn').show();
			$('.submit-wdrl-2fa-btn').hide();
			
			$('#withdrawFormReqResp').show();
			$('#withdrawFormReqResp').html(response.message);
			
        }else if(response.statuscode == 'ERR2FA' || response.statuscode == 'CUST') {
			
			$('#withdrawFormReqResp').removeClass('success-txt');
			$('#withdrawFormReqResp').addClass('error-txt');
			
			$('#withdrawFormReqResp').show();
			$('#withdrawFormReqResp').html(response.message);			
		}else if (response.statuscode == 'SUCC') {
          	  
		  $('#withdrawFormReqResp').removeClass('error-txt');
		  $('#withdrawFormReqResp').addClass('success-txt');
		  
		  $('.submit-wdrl-2fa-btn').hide();
		  $('.next-wdrl-amt-btn').hide();
		  
		  $("#withdraw-inr-form-request")[0].reset();
		  		  
		  $('#withdrawFormReqResp').show();
		  $('#withdrawFormReqResp').html(response.message);
		  
		  setTimeout(function(){
			$('#withdrawFormReqResp').html('');
			$('#withdrawFormReqResp').hide();
			$(document).find('.close').click();			
			
			window.location.reload();
			
		  }, 5000);
		  
        }
      },
      complete: function () {
        freez = 0;
        //l.ladda('stop');
		$('.submit-wdrl-2fa-btn').html(l);
      }
    });
  });


  $('form[name="depoisted-form-request"]').submit(function (e) {
	
	$(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    form_id = this;
	
    $.ajax({
      type: 'post',
      url: bu + '/submit-deposit-request',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        //l = $('.submit-deposit-btn').ladda();
        //l.ladda('start');		
		l = $('.submit-deposit-btn').html();
        $('.submit-deposit-btn').html('<i class="fa fa-spinner fa-spin"></i>');
		
      },

      success: function (response) {
        
		if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
		  $('.submit-deposit-btn').html(l);
        } else
        if (response.statuscode == 'CST') {
          //shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          
		  $('.submit-deposit-btn').hide();
		  $("#depoisted-form-request")[0].reset();
		  $('.submit-deposit-btn').html(l);
		  
		  $('#depositedFormReqResp').show();
		  $('#depositedFormReqResp').html(response.message);
		  
		  setTimeout(function(){			
			$('#depositedFormReqResp').html('');
			$('#depositedFormReqResp').hide();
			$(document).find('.close').click();					
			window.location.reload();
		  }, 5000);
		  
        }
      },
      complete: function () {
        freez = 0;
        //l.ladda('stop');
		$('.submit-deposit-btn').html(l);
      }
    });
  });
  
  $(document).on('click','.holdLoader',function(){
      
      
      $(this).removeClass('holdLoader').addClass('profile-submit-action');
      l = $(document).find('.profile-submit-action').html();
      $(document).find('.profile-submit-action').html('<i class="fa fa-spinner fa-spin"></i>');
      
      $(this).attr("type", "submit");
      // setTimeout(function(){
      //   $(document).find('.profile-submit-action').click();
      // },5000);
  });
  
  $('form[name="profile-form"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    var formData = new FormData($(this)[0]);
    form_id = this;

    

    $.ajax({
      type: 'post',
      url: bu + '/submit-profile',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        freez = 1;
        l = $('.profile-submit-action').html();
        $('.profile-submit-action').html('<i class="fa fa-spinner fa-spin"></i>');
      },

      success: function (response) {
        
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        }else
        if(response.statuscode == 'CST') {
          
        }else
        if (response.statuscode == 'SUCC') {
          $('.profile-submit-action').after();
          window.location.reload();
        }
      },
      complete: function () {
        freez = 0;
        $('.profile-submit-action').html(l);
      }
    });
  });

  $('form[name="address-form"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    var formData = new FormData($(this)[0]);
    form_id = this;

    

    $.ajax({
      type: 'post',
      url: bu + '/submit-address',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        freez = 1;
        l = $('.sub-address').html();
        $('.sub-address').html('<i class="fa fa-spinner fa-spin"></i>');
      },

      success: function (response) {
        
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        }else
        if(response.statuscode == 'CST') {
          $('.sub-address').after('<span class="error-txt">'+response.message+'</span>');
        }else
        if (response.statuscode == 'SUCC') {
          $('.sub-address').after();
          window.location.reload();
        }
      },
      complete: function () {
        freez = 0;
        $('.sub-address').html(l);
      }
    });
  });


/*
  $('form[name="bank-form"]').submit(function (e) {
	
    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    form_id = this;
    
    $.ajax({
      type: 'post',
      url: bu + '/submit-bank',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        //freez = 1;
        //l = $('.bank-submit-action').ladda();
        //l.ladda('start');
      },
		
      success: function (response) {
        
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        } else
        if (response.statuscode == 'CST') {
          shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          //shownotice(response.message, 1);
		  
		  $(document).find('#showmsgbank').html(response.message);
		  
        }
		
      },
      complete: function () {
        //freez = 0;
       // l.ladda('stop');
      }
    });
  });

*/

$('form[name="bank-form"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    var formData = new FormData($(this)[0]);
    form_id = this;

    $.ajax({
      type: 'post',
      url: bu + '/submit-bank',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        freez = 1;
        l = $('.sub-bank').html();
        $('.sub-bank').html('<i class="fa fa-spinner fa-spin"></i>');
      },

      success: function (response) {
        
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        }else
        if(response.statuscode == 'CST') {
          $('.sub-bank').after('<span class="error-txt">'+response.message+'</span>');
        }else
        if (response.statuscode == 'SUCC') {
          $('.sub-bank').after();
          window.location.reload();
        }
      },
      complete: function () {
        freez = 0;
        $('.sub-bank').html(l);
      }
    });
  });


  $('form[name="kyc-form"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();

    var formData = new FormData($(this)[0]);
    
    if (freez == 1)
      return false;

    form_id = this;
    
    $.ajax({
      type: 'post',
      url: bu + '/submit-kyc',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        freez = 1;
        l = $('.kyc-submit-action').ladda();
        l.ladda('start');
      },

      success: function (response) {
        
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        } else
        if (response.statuscode == 'CST') {
          shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          shownotice(response.message, 1);
        }
      },
      complete: function () {
        freez = 0;
        l.ladda('stop');
      }
    });
  });


  $('form[name="2fa-form"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();
	
	$('#2faResp').hide();
	$('#2faResp').html('');

    var formData = new FormData($(this)[0]);
    
    if (freez == 1)
      return false;

    form_id = this;
	
    $.ajax({
      type: 'post',
      url: bu + '/set2FA',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        //l = $('.submit-2fa').ladda();
        //l.ladda('start');
		sh = $('.submit-2fa').html();
		$('.submit-2fa').html('<i class="fa fa-spinner fa-spin"></i>');
      },

      success: function (response) {
        
		if (response.statuscode == 'SUCC') {
          //shownotice(response.message, 1);
          window.location.reload();
        }
        else{
          
		  $('#2faResp').show();
		  
		  if(response.message == 'CUST'){
			$('#2faResp').html('Please enter 2fa code.');  
		  }else{
			$('#2faResp').html(response.message);		  
		  }
		  
		 	  
		  $('.submit-2fa').html(sh);
		  
		  //shownotice(response.message, 0);
        }
      },
      complete: function () {
        freez = 0;
		$('.submit-2fa').html(sh);
        //l.ladda('stop');
      }
    });
  });
  
  $('.psw-submit-2fa').click(function(){	 	 
	 $(document).find('.psw-submit-2fa').html('<i class="fa fa-spinner fa-spin"></i>');
	 $(document).find('.submit-reset').click();
	 
  });
	
  $('form[name="reset-password-form"]').submit(function (e) {
		
    //alert("Rest password form has been submitted just now.");
	
	$(document).find('.input-error').remove();
    $(document).find('.error-txt').remove();
    $(document).find('.success-txt').remove();
    e.preventDefault();

    var formData = new FormData($(this)[0]);
    
    if (freez == 1)
      return false;

    form_id = this;
	
	var secret = $(document).find('#2fa-code').val();
    //$(document).find('#reset-password-form').append('<input type="hidden" value="' + secret + '" name="secret" id="secret">');
	
	$('#secret').val(secret);
	
	secret = $(document).find('#secret').val();
	
	//alert($('#secret').val());
	var h = 'Submit <span><img src="'+bu+'/public/gilt/img/btn-arrow.png"/></span>';
    
    $.ajax({
      type: 'post',
      url: bu + '/reset-password',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        l = $('.submit-reset').html();
        $('.submit-reset').html('<i class="fa fa-spinner fa-spin"></i>');
      },
	
      success: function (response) {
        
		//alert(response.statuscode);
		//alert(response.message);
		
		st1 = response.message;
		var a1 = st1.includes("2FA");
		
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        }
        else if (response.statuscode == 'SUCC') 
		{
          $(document).find('.text-message').html('<span class="success-txt">'+response.message+'</div>');
		  $("#reset-password-form")[0].reset();
        }
        else
		{
			//alert("controll --- in");
			//$(document).find('.text-message').html('<span class="error-txt">'+response.message+'</div>');
			if (response.statuscode == 'VER' && a1 == true) 
			{			 
				$('#2fa-form').modal('show');
				$(document).find('#fa-resp-msg').html(response.message);
				$(document).find('.psw-submit-2fa').html(h);
			}
			else if (response.statuscode == 'VER') 
			{
			  $.each(response.data, function (k, v) {
				$(document).find('#' + k).after('<span class="error-txt">' + v[0] + '</span>');
			  });
			  $(document).find('.psw-submit-2fa').html(h);
			
			} else if (response.statuscode == 'SUCC') {
				//shownotice(response.message, 1);
				window.location = bu +'/';
			} 
			else if (response.statuscode == 'ERR' && a1 == true) {
				$(document).find('#fa-resp-msg').html(response.message);
				$(document).find('.psw-submit-2fa').html(h);				
				$('#2fa-form').modal('show');				
			}
			else {
				
				$(document).find('#resetPswAjxResp').html('<div class="input-error">'+response.message+'</div>');				
			}
        }
		/*
		else if (response.statuscode == 'ERR' && secret != '') {
			
			
			$(document).find('.2fa-resp-msg').html(response.message);
		}
		*/
		
      },
      complete: function () {
        freez = 0;
        $('.submit-reset').html(l);
		$(document).find('.psw-submit-2fa').html(h);
      }
    });
  });
	
	
	// Delete Deposit and Withdraw Request (start) //
	$('form[name="del-deposit-form-request"]').submit(function (e) {
		
		$(document).find('.input-error').remove();
		e.preventDefault();
		
		if (freez == 1)
		  return false;

		form_id = this;
		
		$.ajax({
		  type: 'post',
		  url: bu + '/submit-del-deposit-req',
		  dataType: 'json',
		  data: $(this).serialize(),
		  beforeSend: function () {
			freez = 1;			
			//l = $('.submit-deposit-btn').ladda();
			//l.ladda('start');		
			l = $('.submit-del-deposit-btn').html();
			$('.submit-del-deposit-btn').html('<i class="fa fa-spinner fa-spin"></i>');
			
		  },
			
		  success: function (response) {
			
			if (response.statuscode == 'RPI') {				
				$('.ajaxResponse').show();
				$('.ajaxResponse').html(response.message);
				$('.ajaxResponse').addClass('error-txt');				
				$('.ajaxResponse').removeClass('success-txt');				
				$('.submit-del-deposit-btn').html(l);			
			}else if(response.statuscode == 'SUCC'){				
				$('.ajaxResponse').show();
				$('.ajaxResponse').addClass('success-txt');
				$('.ajaxResponse').html(response.message);				
				$('.submit-del-deposit-btn').hide();								
				setTimeout(function(){								
					window.location.reload();
				}, 3000);					
			}else{
				$('.submit-del-deposit-btn').html(l);			
			}
			
		  },
		  complete: function () {			
			freez = 0;
			//l.ladda('stop');
			//$('.submit-deposit-btn').html(l);
		  }
		});
	});
		
	$('form[name="del-withdraw-form-request"]').submit(function (e) {
		
		$(document).find('.input-error').remove();
		e.preventDefault();
		
		if (freez == 1)
		  return false;

		form_id = this;
		
		$.ajax({
		  type: 'post',
		  url: bu + '/submit-del-withdraw-req',
		  dataType: 'json',
		  data: $(this).serialize(),
		  beforeSend: function () {
			freez = 1;			
			//l = $('.submit-deposit-btn').ladda();
			//l.ladda('start');		
			l = $('.submit-del-withdraw-btn').html();
			$('.submit-del-withdraw-btn').html('<i class="fa fa-spinner fa-spin"></i>');
			
		  },
			
		  success: function (response) {
			
			if (response.statuscode == 'RPI') {				
				$('.ajaxResponse').show();
				$('.ajaxResponse').html(response.message);
				$('.ajaxResponse').addClass('error-txt');				
				$('.ajaxResponse').removeClass('success-txt');				
				$('.submit-del-withdraw-btn').html(l);			
			}else if(response.statuscode == 'SUCC'){				
				$('.ajaxResponse').show();
				$('.ajaxResponse').addClass('success-txt');
				$('.ajaxResponse').html(response.message);				
				$('.submit-del-withdraw-btn').hide();								
				setTimeout(function(){								
					window.location.reload();
				}, 3000);					
			}else{
				$('.submit-del-withdraw-btn').html(l);			
			}
			
		  },
		  complete: function () {			
			freez = 0;
			//l.ladda('stop');
			//$('.submit-deposit-btn').html(l);
		  }
		});
	});
	// Delete Deposit and Withdraw Request (end) //
  

}); // End of load function document

function enable_disable_date_add_issue(vl)
{
	//var faCodeVal = $(document).find('#2fa-code').val();	
	//var endi = document.getElementById('is_addoc_issue_date').value;
	
	var endi = $('#is_addoc_issue_date').val();
	//alert(endi);
	if($('#is_addoc_issue_date').is(":checked"))
	{
		 $("#doc_issue_year").prop("disabled", true);
		 $("#doc_issue_day").prop("disabled", true);
		 $("#doc_issue_month").prop("disabled", true);
	}
	else
	{
		$("#doc_issue_year").prop("disabled", false);
		 $("#doc_issue_day").prop("disabled", false);
		 $("#doc_issue_month").prop("disabled", false);	
	}
}

function enable_disable_date_add_expiration(vl)
{
	//var faCodeVal = $(document).find('#2fa-code').val();	
	//var endi = document.getElementById('is_addoc_issue_date').value;
	
	var endi = $('#is_addoc_exp_date').val();
	//alert(endi);
	if($('#is_addoc_exp_date').is(":checked"))
	{
		 $("#doc_exp_day").prop("disabled", true);
		 $("#doc_exp_month").prop("disabled", true);
		 $("#doc_exp_year").prop("disabled", true);
	}
	else
	{
		$("#doc_exp_day").prop("disabled", false);
		 $("#doc_exp_month").prop("disabled", false);
		 $("#doc_exp_year").prop("disabled", false);	
	}
}

function enable_disable_date_idver_expiration(vl)
{
	//var faCodeVal = $(document).find('#2fa-code').val();	
	//var endi = document.getElementById('is_addoc_issue_date').value;
	
	var endi = $('#is_iddoc_exp_date').val();
	//alert(endi);
	if($('#is_iddoc_exp_date').is(":checked"))
	{
		 $("#doc_exp_day_id").prop("disabled", true);
		 $("#doc_exp_month_id").prop("disabled", true);
		 $("#doc_exp_year_id").prop("disabled", true);
	}
	else
	{
		$("#doc_exp_day_id").prop("disabled", false);
		 $("#doc_exp_month_id").prop("disabled", false);
		 $("#doc_exp_year_id").prop("disabled", false);	
	}
}

function enable_disable_date_idver_issue(vl)
{
	//var faCodeVal = $(document).find('#2fa-code').val();	
	//var endi = document.getElementById('is_addoc_issue_date').value;
	
	var endi = $('#is_iddoc_issue_date').val();
	//alert(endi);
	if($('#is_iddoc_issue_date').is(":checked"))
	{
		 $("#doc_issue_year_id").prop("disabled", true);
		 $("#doc_issue_month_id").prop("disabled", true);
		 $("#doc_issue_day_id").prop("disabled", true);
	}
	else
	{
		$("#doc_issue_year_id").prop("disabled", false);
		 $("#doc_issue_month_id").prop("disabled", false);
		 $("#doc_issue_day_id").prop("disabled", false);	
	}
}

function submit2FaPsw () {	
	var faCodeVal = $(document).find('#2fa-code').val();		
	if(faCodeVal != '' && faCodeVal.length == 6){		
		$(document).find('#2fa-form').focus();		
		$(document).find('.psw-submit-2fa').click();
	}	
}
function submit2FaSetting () {	
	var faCodeVal = $(document).find('#g2fa').val();		
	if(faCodeVal != '' && faCodeVal.length == 6){				
		$(document).find('.submit-2fa').click();
	}	
}
function submit2FaWithdraw()
{
	var faCodeVal = $(document).find('#2fa-code').val();		
	if(faCodeVal != '' && faCodeVal.length == 6){				
		$(document).find('.submit-wdrl-2fa-btn').click();
	}
}
