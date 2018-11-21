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


  $('form[name="profile-form"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    form_id = this;
    
    $.ajax({
      type: 'post',
      url: bu + '/submit-profile',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        l = $('.profile-submit-action').ladda();
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
        freez = 1;
        l = $('.bank-submit-action').ladda();
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

  $('form[name="reset-password-form"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();

    var formData = new FormData($(this)[0]);
    
    if (freez == 1)
      return false;

    form_id = this;
    
    $.ajax({
      type: 'post',
      url: bu + '/reset-password',
      dataType: 'json',
      data: $(this).serialize(),
      beforeSend: function () {
        freez = 1;
        l = $('.submit-reset').ladda();
        l.ladda('start');
      },

      success: function (response) {
        
        if (response.statuscode == 'SUCC') {
          shownotice(response.message, 1);
          $(document).find('.close-reset').click();
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
  

  

}); // End of load function document