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
    $.ajax({
          type: 'get',
          url:bu+'/ticker',
          dataType: 'json',
          beforeSend: function () {
            
          },
          success: function (response) {


          },
          complete:function () {
          
          }
      });
  }
  //ticker();

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
            l = $('.confirm-withdraw').html();
            $('.confirm-withdraw').html('<i class="fa fa-spinner fa-spin"></i>');
            // l = $( '.confirm-withdraw' ).ladda();
            // l.ladda( 'start' );
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
            $('.confirm-withdraw').html(l);
            //freez=0;
            //l.ladda('stop');
          }
      });
    
    });
  });
function isNumberKey(evt) /* 16 May 2018 */
{
	var charCode = (evt.which) ? evt.which : event.keyCode;				
	if (charCode > 31 && (charCode < 48 || charCode > 57) )
	{
		return false;
	}
	return true;
}
function checkBlankField (txt)
{
	var mint_txt = txt.length;
	var mstr_txt = txt;
	var mint_count = 0;
	for (var iloop = 0; iloop<mint_txt; iloop++)
	{
        if (mstr_txt.charAt(iloop) == " ")
        {
           mint_count = mint_count+1;
        }
	}    
// if nothing entered in the field
	if (txt == "")
   	{
		return false;
	}
	else if (mint_count == mint_txt)
	{
		return false;
	}
	return true;
}
function isNumberKeyWithDot(evt,field,formName)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;	
	//alert(charCode);	
	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
	{
		return false;
	}
	
	var mint_dot=0;
	if(formName){
		var amount = $(document).find('#'+formName).find('#'+field).val();		
	}else{
		var amount = document.getElementById(field).value;	
	}
	
	
	if(amount != ""){
		for(var i=0; i<amount.length; i++){			
			if(amount[i] == '.'){
				mint_dot++;
			}			
		}
	}else{
		document.getElementById(field).value = '';
	}	
	if (charCode == 46 && mint_dot > 0){
        return false;
    }
	
	if(field == 'vol'){
		
		var max_decimals = $("#to_coin_decimals").val();		
		if(max_decimals != "" && parseInt(max_decimals) > 0){
			if(amount != "" && charCode != 8 && max_decimals != ""){						
				var q = amount;
				var qArr = q.split(".");
				if(qArr.length == 2 && qArr[1].length && qArr[1].length == parseFloat(max_decimals)){
					 return false;	
				}
			}			
		}				
			
	}else if( (field == 'at') && amount != "" && charCode != 8){
		
		var max_decimals = $("#from_coin_decimals").val();
		if(max_decimals != "" && parseInt(max_decimals) > 0){
			var q = amount;
			var qArr = q.split(".");
			if(qArr.length == 2 && qArr[1].length && qArr[1].length == parseFloat(max_decimals)){
				 return false;	
			}	
		}		
	}	
	return true;	
}