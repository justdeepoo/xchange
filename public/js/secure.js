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
        l = $('.reg-submit').ladda();
        l.ladda('start');
      },
      success: function (response) {

        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            if (k == 'terms')
              $(document).find('#' + k).parent().parent().after('<span class="input-error">' + v[0] + '</span>');
            else
              $(document).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
        } else
        if (response.statuscode == 'SUCC') {
          $(document).find('.success-message').removeClass('hide');
          shownotice(response.message, 1);
        } else {
          shownotice(response.message, 0);
        }

      },
      complete: function () {
        freez = 0;
        l.ladda('stop');
      }
    });
  });
  g = '';
  $(document).on('click', '.submit-2fa', function () {
    $(document).find('.input-error').remove();
    if ($(document).find('#2fa-code').val() == '') {
      $(document).find('#2fa-code').after('<span class="input-error">Please enter Google OTP</span>');
      return false;
    } else {


      g = $('.submit-2fa').ladda();
      g.ladda('start');

      $(document).find('#secret').remove();
      secret = $(document).find('#2fa-code').val();
      $(document).find('#login-form').append('<input type="hidden" value="' + secret + '" name="secret" id="secret">');
      $(document).find('.login-submit').click();

    }
  });



  $('form[name="login-form"]').submit(function (e) {

    e.preventDefault();

    $(document).find('.input-error').remove();

    if (freez == 1)
      return false;

    $.ajax({
      type: 'post',
      url: bu + '/post-login',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        l = $('.login-submit').ladda();
        if (g == '')
          l.ladda('start');
      },
      success: function (response) {

        if (response.statuscode == '2fa') {
          l.ladda('stop');
          $(document).find('#2fa-form').modal('show');
        } else
        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            $(document).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
          shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          shownotice(response.message, 1);
          window.location = bu +'/trade/inr-xrp';
          //window.location = bu + '/profile'

        } else {
          shownotice(response.message, 0);
        }
      },
      complete: function () {
        freez = 0;
        if (g == '')
          l.ladda('stop');
        g.ladda('stop');

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
        l = $('.res-pwd').ladda();
        l.ladda('start');
      },
      success: function (response) {

        
        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            $(document).find('#' + k).after('<span class="input-error">' + v[0] + '</span>');
          });
          shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
          shownotice(response.message, 1);
          window.location = bu + '/secure/login'
        } else {
          shownotice(response.message, 0);
        }
      },
      complete: function () {
        freez = 0;
        
        l.ladda('stop');
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
        l = $('.forgot-sub').ladda();
        l.ladda('start');
      },
      success: function (response) {

        
        if (response.statuscode == 'VER') {
          $.each(response.data, function (k, v) {
            $(document).find('#' + k).after('<span class="input-error">' + v + '</span>');
          });
          shownotice(response.message, 0);
        } else
        if (response.statuscode == 'SUCC') {
            shownotice(response.message, 1);
          //window.location = bu + '/secure/login'
        } else {
          shownotice(response.message, 0);
        }
      },
      complete: function () {
        freez = 0;
        
        l.ladda('stop');
      }
    });
  });

}); // End of load function document
