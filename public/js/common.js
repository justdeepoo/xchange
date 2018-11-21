freez=0;

function shownotice(message, status)
{
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
      };
      if(status==1)
        toastr.success(message, 'Success');
      else
        toastr.error(message, 'Error');
}



function ticker()
  {
	var parent_coin = $(document).find('#parent_coin').val();	
	if(parent_coin != '') {
		var ticker_url = bu+'/ticker/'+parent_coin;
	}else {
		var ticker_url = bu+'/ticker';
	}
  
  $.ajax({
          type: 'get',
          url:ticker_url,
          dataType: 'json',
          beforeSend: function () {
            
          },
          success: function (response) {

              if(response.statuscode)
              {
                  tkr = '';
                  $.each(response.data, function(k,v){
                    tkr+='<div class="col-md-2 col-xs-6 pl">'+v.pair_coin.toUpperCase()+':'+parseFloat(v.rate).toFixed(2)+'</div>';
                  });

                  $(document).find('.ticker').html(tkr);
              }
          },
          complete:function () {
          
          }
      });
  }
  ticker();

  $(function(){
    $('form[name="withdraw-form-request"]').submit(function(e){

      e.preventDefault();
      $(document).find('.input-error').remove();
      $(document).find('.requested-coin').remove();
  
      if(freez==1)
        return false;
      
      form_id = this;
  
      $(this).append('<input type="hidden" name="coin" class="requested-coin" id="coin" value="'+requested_coin+'">');
      $.ajax({
          type: 'post',
          url:bu+'/withdraw',
          dataType: 'json',
          data:$(this).serialize(),
          beforeSend: function () {
            freez=1;
            
            l = $( '.confirm-withdraw' ).ladda();
            l.ladda( 'start' );
          },
          success: function (response) {
            //console.log(response.statuscode);
            if(response.statuscode=='VER')
            {
              $.each(response.data, function(k,v){
                $(form_id).find('#'+k).after('<span class="input-error">'+v[0]+'</span>');
              });
            }
            else
            if(response.statuscode!='SUCC')
            {
              shownotice(response.message, 0);
            }
            else
            if(response.statuscode=='SUCC')
            {
              shownotice(response.message, 1);
              window.location.reload();
            }
              
          },
          complete:function () {
            
            //freez=0;
            l.ladda('stop');
          }
      });
    
    });
  });
