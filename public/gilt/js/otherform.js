$('form[name="frm_submit_contactus"]').submit(function (e) {

    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    var formData = new FormData($(this)[0]);
    form_id = this;

	//alert(bu+"/contact"); return false;
	
    $.ajax({
      type: 'post',
      url: bu + '/contact',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        freez = 1;
        l = $('.btn-global-dark').html();
        $('.btn-global-dark').html('<i class="fa fa-spinner fa-spin"></i>');
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
          //$('.profile-submit-action').after();
		   //alert(response.statuscode);
		   $('#frm_submit_contactus input[type="text"]').val('');
		   $('#frm_submit_contactus input[type="email"]').val('');
		   //$('#frm_submit_contactus input[type="textarea"]').val('');
			$('#messages').val(''); // textarea
			$(document).find('#concat-msg-ara').html('<span class="success-txt">Thank you! Your request has been accepted and contact you as soon as possible.</span>');		   
			//alert(response.message);
			//window.location = bu;
        }
      },
      complete: function () {
        freez = 0;
        $('.btn-global-dark').html(l);
      }
    });
  });
  /*
 //--------------------------END Contact us------------//
  //============================================================//
  // ------------------Start NewsLetter subs--------------------------//*/
  
  $('form[name="frm_submit_newsletter"]').submit(function (e) {
	
    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    var formData = new FormData($(this)[0]);
    form_id = this;

	//alert(bu+"/contact"); return false;
	
    $.ajax({
      type: 'post',
      url: bu + '/contact',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        freez = 1;
        l = $('.btn_global_subsb').html();
        $('.btn_global_subsb').html('<i class="fa fa-spinner fa-spin"></i>');
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
          //$('.profile-submit-action').after();
		   //alert(response.statuscode);
		   $('#frm_submit_newsletter input[type="text"]').val('');
			$(document).find('#subsc-msg-ara').html('<span class="success-txt">Thank you! Your request has been accepted and contact you as soon as possible.</span>');		   
			//alert(response.message);
			//window.location = bu;
        }
      },
      complete: function () {
        freez = 0;
        $('.btn_global_subsb').html(l);
      }
    });
  });
  
  /*//--------------------------END Contact Newsletter------------//
  //============================================================//
  // ------------------add token start--------------------------//*/
  
    $('form[name="frm_submit_addtocken"]').submit(function (e) {
	//alert('in....');	
    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    var formData = new FormData($(this)[0]);
    form_id = this;
	
    $.ajax({
      type: 'post',
      url: bu + '/addtoken',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
        freez = 1;
        l = $('.btn_addtkn_crypto').html();
        $('.btn_addtkn_crypto').html('<i class="fa fa-spinner fa-spin"></i>');
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

		   $('#frm_submit_addtocken input[type="text"]').val(''); // for text box
		   $('#frm_submit_addtocken input[type="email"]').val('');	// for email	   
		   $('input[name="cryptocurrency_based"]').attr('checked', false); // check box
		   $('input[name="my_radio"]').attr('checked', false); // redio button
			$(document).find('#add_tkn_dis_msg').html('<span class="success-txt"><h3>Thank you! Your request has been accepted and contact you as soon as possible.</h3></span>');		   
        }
      },
      complete: function () {
        freez = 0;
        $('.btn_addtkn_crypto').html(l);
      }
    });
  });
  /*
  //---------- END Add Token -------------------*/
  
  // start ... Add support Ticket - added by harikesh -dated: 02-06-2018
  
  $('form[name="frm_submit_support"]').submit(function (e) {

  
    $(document).find('.input-error').remove();
    e.preventDefault();
    
    if (freez == 1)
      return false;

    var formData = new FormData($(this)[0]);
    form_id = this;

	//alert(bu+"/contact"); return false;
	
	
	
    $.ajax({
      type: 'post',
      url: bu + '/customersupport',
      dataType: 'json',
      data: formData,
      // THIS MUST BE DONE FOR FILE UPLOADING
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
		  
        freez = 1;
        l = $('.btn-global-dark').html();
        $('.btn-global-dark').html('<i class="fa fa-spinner fa-spin"></i>');
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
          //$('.profile-submit-action').after();
		   //alert(response.statuscode);
		   $('#frm_submit_support input[type="text"]').val('');
		   $('#frm_submit_support input[type="email"]').val('');
		   //$('#frm_submit_support input[type="textarea"]').val('');
			$('#messages').val(''); // textarea
			$('#category').find('option:first').attr('selected', 'selected');
			$(document).find('#support-msg-ara').html('<span class="success-txt">Thank you! Your request has been accepted and contact you as soon as possible.</span>');		   
			//alert(response.message);
			//window.location = bu;
        }
      },
      complete: function () {
        freez = 0;
        $('.btn-global-dark').html(l);
      }
    });
  });
  
  //end
  
  

  // 26th May 2018 front - start
function isNumberKeyFront(evt) /* 16 May 2018 */
{
	var charCode = (evt.which) ? evt.which : event.keyCode;				
	if (charCode > 31 && (charCode < 48 || charCode > 57) )
	{
		return false;
	}
	return true;
}
function checkBlankFieldFront (txt)
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
// 26th May 2018 front - end
function notificationGrid()
{	
	var tr='';	
	$.ajax({
		  type: 'get',
		  url:bu+'/header-notification',
		  dataType: 'json',
		  data:'',
		  beforeSend: function () {
			
		  },
		  success: function (response) {			
			if(response.length > 0)
			{
				var resLen = response.length;
				var cl = '';
				tr+='<ul>';
				$.each(response, function(k,v){
					if( (resLen - 1) == k){ cl = 'class="last"';  }else{ }
					tr+= '<li '+cl+'><a href="#"><div class="view-rows"><h4>'+v.subject+'</h4><p>'+v.message+'</p></div></a></li>';					
				});
				tr+='</ul>';
				$(document).find('#notifications').html(tr);
			}
			
		  },
		  complete:function () {
			
		  }
	  });
	  
	  

}
notificationGrid();