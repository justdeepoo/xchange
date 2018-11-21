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


  

  $('form[name="withdraw-inr-form-request"]').submit(function (e) {
    e.preventDefault();
    $(document).find('.input-error').remove();
    
    
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
        l = $('.submit-withdraw-btn').ladda();
        l.ladda('start');
      },

      success: function (response) {
        
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v + '</span>');
          });
        } else
        if (response.statuscode == 'CST') {
          shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          shownotice(response.message, 1);
          window.location.reload();
        }
      },
      complete: function () {
        freez = 0;
        l.ladda('stop');
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
        l = $('.submit-deposit-btn').ladda();
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
        l = $('.submit-2fa').ladda();
        l.ladda('start');
      },

      success: function (response) {
        
        if (response.statuscode == 'SUCC') {
          shownotice(response.message, 1);
          window.location.reload();
        }
        else{
          shownotice(response.message, 0);
        }
      },
      complete: function () {
        freez = 0;
        l.ladda('stop');
      }
    });
  });
  
  $('.psw-submit-2fa').click(function(){
	 //$('#reset-password-form').submit();
	 //alert('.............1.');
	 
	 
	 
	 //document.getElementById('reset-password-form').submit();
	 
	 
	 
	 $(document).find('.submit-reset').click();
	 
  });

  $('form[name="reset-password-form"]').submit(function (e) {
		
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
	
	alert($('#secret').val());
    
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
        
		alert(response.statuscode);
		alert(response.message);
		
        if (response.statuscode == 'RPI') {
          $.each(response.data, function (k, v) {
            $(form_id).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        }
        else if (response.statuscode == 'SUCC') 
		{
          $(document).find('.text-message').html('<span class="success-txt">'+response.message+'</div>');
        }
        else
		{
			alert("controll --- in");
			//$(document).find('.text-message').html('<span class="error-txt">'+response.message+'</div>');
			if (response.statuscode == 'VER') 
			{
			 
				$('#2fa-form').modal('show');
		  
			} 
			else if (response.statuscode == 'VER') 
			{
			  $.each(response.data, function (k, v) {
				$(document).find('#' + k).after('<span class="error-txt">' + v[0] + '</span>');
			  });
			
			} else if (response.statuscode == 'SUCC') {
				//shownotice(response.message, 1);
				window.location = bu +'/';
			} 
			else if (response.statuscode == 'ERR' ) {
				$(document).find('#fa-resp-msg').html(response.message);
			}
			else {
			 
				$(document).find('.login-msg-ara').html('<div class="error-txt">'+response.message+'</div>');
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
      }
    });
  });
  

  

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

