freez = 0;

$(function () {

  l = '';

  $('form[name="reg-form"]').submit(function (e) {

    e.preventDefault();

    $(document).find('.input-error').remove();

    if (freez == 1)
      return false;

    $.ajax({
      type: 'post',
      url: bu + '/post-register',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        
        l = $('.reg-submit').html();
        $('.reg-submit').html('<i class="fa fa-spinner fa-spin"></i>');
      },
      success: function (response) {
		
        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            if (k == 'terms')
              $('#reg-form').find('#' + k).parent().after('<br/><span class="input-error">' + v[0] + '</span>');
            else
              $('#reg-form').find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        } else
        if (response.statuscode == 'SUCC') {
          $("#reg-form")[0].reset();
		  $(document).find('.signup-msg-ara').html('<span class="success-txt">Thank you! Your account has been created. A confirmation link has shared at your email id. Kindly confirm to activate your account.</span>');
          //shownotice(response.message, 1);		  
		  setTimeout(function(){			
			
			var le = $('.login-email-input');	
			if(le.length > 0){
				le[0].focus();	
			}
			
			$(document).find('.close').click();
						
		  }, 5000);
		  
        } else {
          $(document).find('.signup-msg-ara').html('<span class="success-txt">'+response.message+'</span>');
        }

      },
      complete: function () {
        freez = 0;
        $('.reg-submit').html(l);
      }
    });
  });
  g = '';
  $(document).on('click', '.submit-2fa', function () {
    
	$(document).find('.2faSubmitBtn').html('Submit');
		
	$(document).find('.input-error').remove();
    
    if ($(document).find('#2fa-code').val() == '') {
      $(document).find('#2fa-code').after('<span class="input-error">Please enter Google OTP</span>');
      return false;
    } else {

      g = $('.submit-2fa').html();
      $('.submit-2fa').html('<i class="fa fa-spinner fa-spin"></i>');
      

      $(document).find('#secret').remove();
      secret = $(document).find('#2fa-code').val();
      $(document).find('#login-form').append('<input type="hidden" value="' + secret + '" name="secret" id="secret">');
      $(document).find('.login-submit').click();

    }
  });
	
  $('form[name="login-form"]').submit(function (e) {

    e.preventDefault();

    $(document).find('.input-error, .error-txt').remove();
    $(document).find('#2fa-code').val('');
    
    if (freez == 1)
      return false;

    $.ajax({
      type: 'post',
      url: bu + '/post-login',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        if (g == '')
        {
          l = $('.login-submit').html();
          $('.login-submit').html('<i class="fa fa-spinner fa-spin"></i>');
        }
      },
      success: function (response) {

        if (response.statuscode == '2fa') {
          
          $(document).find('#2fa-form').modal('show');		  
		  setTimeout(function(){ 
			document.getElementById("2fa-code").focus(); 
		  }, 1000);		  
		  
        } else
        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            $(document).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
          //shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          //shownotice(response.message, 1);
          window.location = bu +'/trade/inr-xrp';
          //window.location = bu + '/profile'

        } else {
          //shownotice(response.message, 0);
          $(document).find('.login-msg-ara').html('<div class="error-txt">'+response.message+'</div>');
        }
      },
      complete: function () {
        freez = 0;
        
        if (g == '')
          $('.login-submit').html(l);
        else{
          $('.submit-2fa').html(g);
        }

        g = '';

        $(document).find('#secret').remove();
        $(document).find('#2fa-form').modal('hide');
      }
    });
  });






  $('form[name="reset-form"]').submit(function (e) {

    e.preventDefault();

    $(document).find('.input-error').remove();

    if (freez == 1)
      return false;

    $.ajax({
      type: 'post',
      url: bu + '/secure/set_password',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        l = $('.res-pwd').html();
        $('.res-pwd').html('<i class="fa fa-spinner fa-spin"></i>');
      },
      success: function (response) {

        
        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            $(document).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
          //shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          //shownotice(response.message, 1);
          window.location = bu + '/';
        } else {
          //shownotice(response.message, 0);
        }
      },
      complete: function () {
        freez = 0;
        $('.res-pwd').html(l);
      }
    });
  });


  $('form[name="forgot-form"]').submit(function (e) {

    e.preventDefault();

    $(document).find('.input-error').remove();

    if (freez == 1)
      return false;

    $.ajax({
      type: 'post',
      url: bu + '/post_forgot',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        l = $('.forgot-sub').html();
        $('.forgot-sub').html('<i class="fa fa-spinner fa-spin"></i>');
      },
      success: function (response) {

        
        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            $('#forgot-form').find('#' + k).after('<span class="input-error">' + v + '</span>');
          });
         
        } else
        if (response.statuscode == 'SUCC') {
            //$(document).find('.forgot-messgage').html(response.message);
			$(document).find('#forgot-form').find('#email').val('');
			
			$(document).find('.forgot-messgage').html(response.message);
			$('.forgot-messgage').addClass('success-txt');
			setTimeout(function(){ 
				$(document).find('.forgot-messgage').html('');
				$('.forgot-messgage').removeClass('success-txt');
				$('#myModal').modal('hide');
			}, 5000);
        } else {
            $(document).find('.forgot-messgage').html('<span class="error-txt">'+response.message+'</span>');
        }
      },
      complete: function () {
        freez = 0;
        $('.forgot-sub').html(l);
      }
    });
  });
  
  $('.signup-close').click(function() {
	$("#reg-form")[0].reset();
  });
  
  $(document).keyup(function(e) {
		if (e.keyCode == 27) { // escape key maps to keycode `27`			
			if( $("#reg-form").length > 0 ) {
				$("#reg-form")[0].reset();	
			}				
		}
  });
  	
}); // End of load function document

function submit2Fa () {	
	var faCodeVal = $(document).find('#2fa-code').val();		
	if(faCodeVal != '' && faCodeVal.length == 6){		
		$(document).find('.2faSubmitBtn').focus();
		$(document).find('.2faSubmitBtn').html('<i class="fa fa-spinner fa-spin"></i>');
		$(document).find('.submit-2fa').click();
	}	
}