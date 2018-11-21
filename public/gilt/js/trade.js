freez = 0;
clicked_action = '';
requested_coin = '';
f ='';
trade_type ='';



function bidGrid(bid)
{
    tr='';
    if(bid.length > 0)
    {
      i=true;
      $.each(bid, function(k,v){
        
        r = v.rate;
        if(i==true)
          $(document).find('.highest-bid').html(parseFloat(r).toFixed(2));
        
          tr+='<tr><td><p class="no-margin color-green">'+parseFloat(v.volume).toFixed(5)+'</p></td>'+
          '<td class="text-center"><p class="no-margin">'+parseFloat(v.rate).toFixed(5)+'</p></td>'+
          '<td class="no-wrap"><span class="change-down label label-light-danger">'+parseFloat((eval(v.volume)*eval(v.rate))).toFixed(5)+'</span></td></tr>';
          i=false;
      
      });
    }
    else{
      $(document).find('.highest-bid').html('-----');
      tr+='<tr><td colspan="3" align="center">No Bid Yet</td></tr>';
    }
    $(document).find('.buy-orders').html(tr)
}
function sellGrid(ask)
{
    tr = '';
    if(ask.length > 0)
    {
      i=true;
      $.each(ask, function(k,v){
        
        r = v.rate;
        if(i==true)
          $(document).find('.lowest-ask').html(parseFloat(r).toFixed(2));
          tr+='<tr><td><p class="no-margin color-red">'+parseFloat(v.volume).toFixed(5)+'</p></td>'+
          '<td class="text-center"><p class="no-margin">'+parseFloat(v.rate).toFixed(5)+'</p></td>'+
          '<td class="no-wrap"><span class="change-down label label-light-danger">'+parseFloat((eval(v.volume)*eval(v.rate))).toFixed(5)+'</span></td></tr>';
        
          i=false;
      });
      
    }
    else{
      $(document).find('.lowest-ask').html('----');
      tr+='<tr><td colspan="3" align="center">No Ask Yet</td></tr>';
    }
    $(document).find('.sell-orders').html(tr);
}

function getTrade(trade)
{
    tr = '';
    
    if(trade.length > 0)
    {
      $.each(trade, function(k,v){

        if(v.trade_type=='BUY')
        {
          rate = v.buyer_rate;
          clas="green";
        }
        else
        if(v.trade_type=='SELL')
        {
          rate = v.seller_rate;
          clas = "red";
        }

        var ts  = new Date(v.trade_at);
              ts  = ts.toLocaleString();
              ts  = ts.split(",");
              time= ts[1];  
          //tr+='<tr><td>'+time+'</td><td>'+v.volume+'</td><td>'+parseFloat(rate).toFixed(2)+'</td></tr>';
          
		  tr+='<tr><td>'+time+'</td><td class="no-wrap">'+rate+'</td>'+
          '<td>'+v.volume+'</td><td>'+parseFloat((eval(v.volume)*eval(rate))).toFixed(5)+'</td></tr>';



      });
    }
    else{
      tr+='<tr><td colspan="5" align="center">No Trade Yet</td></tr>';
    }
    $(document).find('.trade-history').html(tr);
}


var socket = io(node_server_point);


socket.on('sell', function(response) {

  //console.log(response);

  if(c[1]==response.from_currency && c[0]==response.to_crrency)
    sellGrid(response.sell)
});

socket.on('buy', function(response) {
  //console.log(response);

  if(c[1]==response.from_currency && c[0]==response.to_crrency)
      bidGrid(response.bid)
});

socket.on('trade', function(response) {
  //console.log(response);
  if(c[1]==response.from_currency && c[0]==response.to_crrency)
    getTrade(response.trade)
});
pairs = Array();
a=0;
socket.on('ticker', function(response) {
  
  console.log(response);

  $.each(response.ticker, function(k,v){
    
    console.log(v.parent_coin);
    if(typeof pairs[v.parent_coin] === 'undefined') {
        pairs[v.parent_coin] = Array();
        pairs[v.parent_coin][0] = v;
        a = eval(a)+1;
    }
    else {
        pairs[v.parent_coin][k] = v;
    }

    console.log(pairs);
  });
  
  

  for (var key in pairs) {
    tr = '';
    for (var k in pairs[key]) {
        
        p = pairs[key][k].pair_coin;
        l = pairs[key][k].parent_coin;
        r = pairs[key][k].rate;
      
        tr += '<tr><td><p class="text-muted no-margin"><a href="">'+p.toUpperCase()+'/'+l.toUpperCase()+'</a></p></td>'+
        '<td><p class="no-margin"><span></span>'+parseFloat(r).toFixed(5)+'</p></td></tr>';
        p_coin = l;
    }
    $(document).find('.'+p_coin+'-pair').html(tr);
  }
});




function operOrders(c)
{
  $.ajax({
        type: 'post',
        url:bu+'/open-orders',
        dataType: 'json',
        data:{'from_currency':c[0], 'to_currency':c[1]},
        beforeSend: function () {
          
        },
        success: function (response) {
            if(response.statuscode)
            {
                tr = '';
                exit = false;
                if(response.data.bid.length > 0)
                {
                  exit =true;
                  $.each(response.data.bid, function(k,v){
                    
                   
                    cla ='green';

						/*
							tr+='<tr><td class="color-'+cla+'">buy</td><td class="no-wrap">'+parseFloat(v.rate).toFixed(3)+'</td><td>'+parseFloat(v.volume).toFixed(3)+'</td>'+
						'<td>'+parseFloat((eval(v.volume)*eval(v.rate))).toFixed(5)+'</td><td align="center"><span class="cancel-trade" data-trade-type="bid" data-trade-id="'+v.id+'">Cancel</span></td></tr>';
						*/
						
						/* 06th June 2018 (start) */
						buyR = parseFloat(v.rate).toFixed(5);
						buyV = parseFloat(v.volume).toFixed(5);				
						buyC = (eval(v.rate) * eval(v.volume) * eval(v.fee) )/100;
						buyF = parseFloat(buyC).toFixed(5);
						buyT = parseFloat(((eval(v.volume) * eval(v.rate)) + eval(buyC))).toFixed(5);
						
						tr+='<tr><td class="color-'+cla+'">buy</td><td class="no-wrap">'+buyR+'</td><td>'+buyV+'</td>'+
						'<td>'+buyT+'</td><td align="center"><span class="cancel-trade" data-trade-type="bid" data-trade-id="'+v.id+'" data-trade-volume="'+buyV+'" data-trade-rate="'+buyR+'" data-trade-fee="'+buyF+'" data-trade-amount="'+buyT+'" ><i class="fa fa-window-close cancel-trade-request" title="Cancel Buy Order"></i></span></td></tr>';
						/* 06th June 2018 (end) */

                  });
                  
                }
                // else{
                //   tr+='<tr><td colspan="5" align="center">No order open</td></tr>';
                  
                // }
                

               // tr = '<tr><th>Volume</th><th>Price</th><th>Fee</th><th>Action</th></tr>';
                if(response.data.ask.length > 0)
                {
                    exit =true;
                    cla ='red';

                    $.each(response.data.ask, function(k,v){

						/*
					  tr+='<tr><td class="color-'+cla+'">sell</td><td class="no-wrap">'+parseFloat(v.rate).toFixed(3)+'</td><td>'+parseFloat(v.volume).toFixed(3)+'</td>'+
                '<td>'+parseFloat((eval(v.volume)*eval(v.rate))).toFixed(5)+'</td><td align="center"><span class="cancel-trade" data-trade-type="sell" data-trade-id="'+v.id+'"><i class="fa fa-window-close"></i></span></td></tr>';
						*/
						
						/* 06th June 2018 (start) */
						sellR = parseFloat(v.rate).toFixed(5);
						sellV = parseFloat(v.volume).toFixed(5);				
						sellC = (eval(v.rate) * eval(v.volume) * eval(v.fee) )/100;
						sellF = parseFloat(sellC).toFixed(5);
						sellT = parseFloat(((eval(v.volume) * eval(v.rate)) + eval(sellC))).toFixed(5);
						
						tr+='<tr><td class="color-'+cla+'">sell</td><td class="no-wrap">'+sellR+'</td><td>'+sellV+'</td><td>'+sellT+'</td><td align="center"><span class="cancel-trade" data-trade-type="sell" data-trade-id="'+v.id+'" data-trade-volume="'+sellV+'" data-trade-rate="'+sellR+'" data-trade-fee="'+sellF+'" data-trade-amount="'+sellT+'" ><i class="fa fa-window-close cancel-trade-request" title="Cancel Sell Order"></i></span></td></tr>';
						/* 06th June 2018 (end) */
                    
                  
                  });
                }

                if(exit==false){
                  tr+='<tr><td colspan="5" align="center">No Ask Yet</td></tr>';
                }
                //$(document).find('.open-ask-orders').html(tr);

                $(document).find('.my-open-trade').html(tr);

            }
        },
        complete:function () {
          
          if(trade_type=='bid')
          {
            $(document).find('.open-bid-orders').removeClass('hide');
            $(document).find('.open-buy-loader').addClass('hide');
          }
          else
          if(trade_type=='ask')
          {
              $(document).find('.open-ask-orders').removeClass('hide');
              $(document).find('.open-ask-loader').addClass('hide');
          }
        }
    });
}

function buySell(c)
{
  
  $.ajax({
        type: 'post',
        url:bu+'/buy-sell-trade',
        dataType: 'json',
        data:{'from_currency':c[1], 'to_currency':c[0], 'trade':'1', 'buy':'1', 'sell':'1'},
        beforeSend: function () {
        },
        success: function (response) {
          if(response.statuscode)
          {
              console.log(response);
              //bidGrid(response.data.bid);
              //sellGrid(response.data.ask);
          }
        },
        complete:function () {
        
        }
    });
}


function getBalance(c)
{
   $.ajax({
        type: 'post',
        url:bu+'/current-bal',
        dataType: 'json',
        data:{c:c},
        beforeSend: function () {
          
        },
        success: function (response) {
            if(response.statuscode)
            {
                $.each(response.data, function(k,v){
                  
                  if(k==c[0])
                  {
                     if(v != '' && parseFloat(v) > 0){
						total_buy_bal =  parseFloat(v).toFixed(5);
					 }else{
						total_buy_bal = v;	 
					 }
					 
					 
                  }
                  else
                  if(k==c[1]){						
					 
					 if(v != '' && parseFloat(v) > 0){
						total_sell_bal =  parseFloat(v).toFixed(5);
					 }else{
						total_sell_bal = v;	 
					 }
					
                  }
                  $(document).find('#selected-'+k).val(parseFloat(v).toFixed(5));
                });

                //console.log(total_buy_bal);
            }
        },
        complete:function () {
        
        }
    });
}

function myTrades(c)
{
   $.ajax({
        type: 'post',
        url:bu+'/my-trades',
        dataType: 'json',
        data:{'from_currency':c[0], 'to_currency':c[1]},
        beforeSend: function () {
          
        },
        success: function (response) {
          if(response.statuscode=='SUCC')
          {
            
            tr = '';
            if(response.data.length > 0)
            {
              var decimal_place = '';
			  var unit_price = '';
        cla = '';
			  $.each(response.data, function(k,v){
                
				if(v.type=='BUY')
                {
                  rate = v.buyer_rate;
                  cla= 'green';
                }
                else if (v.type=='SELL')
                {
                  rate = v.seller_rate;
                  cla= 'red';
                }
                var ts = new Date(v.trade_at);
                
				from_curr = v.from_currency.toUpperCase();
				to_curr = v.to_currency.toUpperCase();
				
				rateDecimalPlace = 5;
				volumeDecimalPlace = 5;
				if(from_curr == 'INR' || to_curr == 'INR'){
					rateDecimalPlace = 2;
				}
                
				tr+='<tr><td>'+ts.toLocaleString()+'</td><td class="color-'+cla+'">'+v.type+'</td><td class="no-wrap">'+parseFloat(v.unit_price).toFixed(rateDecimalPlace)+'</td><td>'+parseFloat(v.volume).toFixed(volumeDecimalPlace)+'</td>'+
                '<td>'+parseFloat(v.total_price).toFixed(volumeDecimalPlace)+'</td></tr>';
               
              });
            }
            else{
              tr+='<tr><td colspan="5" align="center">No Trade Yet</td></tr>';
            }
            $(document).find('.my-trade').html(tr);
          }
        },
        complete:function () {
        
        }
    });
}

$(function(){


l = '';

$(document).on('click', '.confirm-action',function(){

  f = $(this).html();
  $(this).html('<i class="fa fa-spinner fa-spin"></i>');
  
  if(clicked_action=='sell')
  {
      $(document).find('#sell-form').append('<input type="hidden" name="confirm_sell" class="confirm-call" value="1">');
      $(document).find('.sell').click();
  }
  else
  if(clicked_action=='buy')
  {
      $(document).find('#buy-form').append('<input type="hidden" name="confirm_buy" class="confirm-call" value="1">');
      $(document).find('.buy').click();
  }
});

/*
function clearBuyInput()
{
    $(document).find('#buy-form').find('#val').val('');
    $(document).find('#buy-form').find('#at').val('');
    $(document).find('#buy-form').find('#buy-total-price').val(0);
    $(document).find('#buy-form').find('#buy-commission').val('');
}
function clearSellInput()
{
    $(document).find('#sell-form').find('#val').val('');
    $(document).find('#sell-form').find('#at').val('');
    $(document).find('#sell-form').find('#sell-total-price').val(0);
    $(document).find('#sell-form').find('#sell-commission').val('');
}*/

function clearBuyInput()
{ 	
	$('.buyVol').val('');
	$('.buyAt').val('');
	$('#buy-total-price').val('');
	$('#buy-commission').val('');	
}
function clearSellInput()
{    
	$('.sellVol').val('');
	$('.sellAt').val('');
	$('#sell-total-price').val('');
	$('#sell-commission').val('');
}

$('form[name="buy-form"]').submit(function(e){

  clicked_action = 'buy';

  $(document).find('.input-error').remove();
  $(document).find('.error-txt').remove();

  /* 16th May 2018 start */
  $('#buyVolSpan').removeClass('border-error-new');
  $('#buyAtSpan').removeClass('border-error-new');

  var buyVol = $('input.buyVol').val();
  var buyAt = $('input.buyAt').val();

  if(checkBlankField(buyVol)==false) {		
    $('#buyVolSpan').addClass('border-error-new');
    //document.getElementById("buyVol").focus();
    return false;
  }
  if(checkBlankField(buyAt)==false) {
    $('#buyAtSpan').addClass('border-error-new');
    //document.getElementById("buyAt").focus();
    return false;
  }	
  /* 16th May 2018 end */

  e.preventDefault();
  if(freez==1)
    return false;

  var vj = '';
  form_id = this;
  $.ajax({
      type: 'post',
      url:bu+'/buy',
      dataType: 'json',
      data:$(this).serialize(),
      beforeSend: function () {
        freez=1;
        vj = $( '.buy-btn' ).html();
        $( '.buy-btn' ).html('<i class="fa fa-spinner fa-spin"></i>');
      },

      success: function (response) {
      //console.log(response.statuscode);
	  
	  $( '.buy-btn' ).html(vj);
	  
        if(response.statuscode=='RPI')
        {
          $.each(response.data, function(k,v){
            $(form_id).find('#'+k).after('<span class="input-error">'+v[0]+'</span>');
          });
        }
        else
        if(response.statuscode=='CST')
        {
          //shownotice(response.message, 0);
          $('.buy-response-msg' ).html('<span class="error-txt">'+response.message+'</span>');
          
        }
        else
        if(response.statuscode=='SUCC')
        {
            if(response.data.need_confirm==1)
            {
                $(document).find('.coin-request').html('NEW BUY ORDER');
                $(document).find('#myModal').modal('show');
                $(document).find('.selected-coin').html(response.data.coin.toUpperCase());
                $(document).find('.selected-vol').html(response.data.volume);
                $(document).find('.selected-rate').html(parseFloat(response.data.rate).toFixed(5));
                $(document).find('.total-fee').html(parseFloat(response.data.fee).toFixed(5));
                $(document).find('.total-amt').html(parseFloat(response.data.tradable_amt).toFixed(5));
            }
            else{
                $('#myModal').modal('hide');
                getBalance(c);
                operOrders(c);
                myTrades(c);
                notificationGrid();
				
                $('.buy-response-msg').html('<span class="success-txt">'+response.message+'</span>');
                clearBuyInput();
				
				
            }
        }
      },
      complete:function () {
        $(document).find('.confirm-call').remove();
        freez=0;
        $( '.buy-btn' ).html(vj);
        
        if(f!='')
          $('.confirm-action').html(f);
       
      }
  });
});

$(document).on('click', '.back-popup',function(){
  $('#myModal').modal('hide');
});


/* 06th June 2018 (start) */
$(document).on('click','.cancel-trade',function(e){
	
	row_id = $(this).attr('data-trade-id');
    trade_type = $(this).attr('data-trade-type');
	
	tradeVolume = $(this).attr('data-trade-volume');
	tradeRate = $(this).attr('data-trade-rate');	
	tradeFee = $(this).attr('data-trade-fee');
	tradeAmount = $(this).attr('data-trade-amount');
	
	if(trade_type == 'bid'){
		$('.cancel-coin-request').html('Cancel Buy Order');	
	}else if(trade_type == 'sell') {
		$('.cancel-coin-request').html('Cancel Sell Order');
	}
	
	$('.cancel-trade-volume').html(tradeVolume);
	$('.cancel-trade-rate').html(tradeRate);
	$('.cancel-trade-fee').html(tradeFee);
	$('.cancel-trade-amount').html(tradeAmount);
	
	$('#cancel_row_id').val(row_id);
	$('#cancel_trade_type').val(trade_type);
	
	$('#buySellCancelModal').modal('show');
	
	$('.buysell-close-btn').show();
	$('.buysell-cancel-btn').show();
	
	$('.cancelTradeAjaxResp').html('');
	
});

$(document).on('click', '.buysell-close-btn',function(){
	$('#buySellCancelModal').modal('hide');
	$('.buysell-close-btn').show();
	$('.buysell-cancel-btn').show();
});

$('form[name="buy-sell-cancel-form"]').submit(function(e){
	e.preventDefault();
	
	if(freez==1)
		return false;
	
	$.ajax({
      type: 'post',
      url:bu+'/cancel-trade',
      dataType: 'json',
      data:$(this).serialize(),
      beforeSend: function () {
        freez=1;
        l = $( '.buysell-cancel-btn' ).html();
				
		$('.buysell-close-btn').hide();		
		$( '.buysell-cancel-btn' ).html('<i class="fa fa-spinner fa-spin"></i>');
		
		/*
		if(trade_type=='bid')
        {
          $(document).find('.open-buy-loader').removeClass('hide');
          $(document).find('.open-bid-orders').addClass('hide');
        }
        else
        if(trade_type=='ask')
        {
            $(document).find('.open-ask-loader').removeClass('hide');
            $(document).find('.open-ask-orders').addClass('hide');
        }
		*/
      },

      success: function (response) {
        
        if(response.statuscode!='SUCC')
        {
            //alert(response.message);
			$('.cancelTradeAjaxResp').addClass('error-txt');
			$('.cancelTradeAjaxResp').html(response.message);
			
			$('.buysell-close-btn').show();
			$('.buysell-cancel-btn').show();
			$('.buysell-cancel-btn').html(l);
        }
        else
        if(response.statuscode=='SUCC')
        {
            getBalance(c);
            operOrders(c);
			
			$('.buysell-close-btn').hide();
			$('.buysell-cancel-btn').hide();
			$('.buysell-cancel-btn').html(l);
			
			
			$('.cancel-trade-volume').html('');
			$('.cancel-trade-rate').html('');
			$('.cancel-trade-fee').html('');
			$('.cancel-trade-amount').html('');
            
			$('.cancelTradeAjaxResp').addClass('success-txt');			
			$('.cancelTradeAjaxResp').html(response.message);			
			
        }
      },
      complete:function () {
        freez=0;
		//$('.buysell-close-btn').show();
		$('.buysell-cancel-btn').html(l);
      }
	});	
});
/* 06th June 2018 (end) */


$('form[name="sell-form"]').submit(function(e){
  
  clicked_action = 'sell';
  $(document).find('.input-error').remove();
  $(document).find('.error-txt').remove();

  /* 16th May 2018 start */
  $('#sellVolSpan').removeClass('border-error-new');
  $('#sellAtSpan').removeClass('border-error-new');
  
  var sellVol = $('input.sellVol').val();
  var sellAt = $('input.sellAt').val();
  
  if(checkBlankField(sellVol)==false) {		
    $('#sellVolSpan').addClass('border-error-new');
    $('input.sellVol').focus();
    //document.getElementById("sellVol").focus();
    return false;
  }
  if(checkBlankField(sellAt)==false) {
    $('#sellAtSpan').addClass('border-error-new');
    $('input.sellAt').focus();
    //document.getElementById("sellAt").focus();
    return false;
  }	
  /* 16th May 2018 end */

  e.preventDefault();
  if(freez==1)
    return false;
  
  var vj = '';
  form_id = this;
  $.ajax({
      type: 'post',
      url:bu+'/sell',
      dataType: 'json',
      data:$(this).serialize(),
      beforeSend: function () {
        freez=1;
        vj  = $( '.sell-btn' ).html();
        $( '.sell-btn' ).html('<i class="fa fa-spinner fa-spin"></i>');
      },
      success: function (response) {
        //console.log(response.statuscode);
		$( '.sell-btn' ).html(vj);
        if(response.statuscode=='RPI')
        {
          $.each(response.data, function(k,v){
            $(form_id).find('#'+k).after('<span class="input-error">'+v[0]+'</span>');
          });
        }
        else
        if(response.statuscode=='CST')
        {
          
          $('.sell-response-msg').html('<span class="error-txt">'+response.message+'</span>');
        }
        else
        if(response.statuscode=='SUCC')
        {
            if(response.data.need_confirm==1)
            {
                $(document).find('.coin-request').html('NEW SELL ORDER');
                $(document).find('#myModal').modal('show');
                $(document).find('.selected-coin').html(response.data.coin.toUpperCase());
                $(document).find('.selected-vol').html(response.data.volume);
                $(document).find('.selected-rate').html(parseFloat(response.data.rate).toFixed(2));
                $(document).find('.total-fee').html(parseFloat(response.data.fee).toFixed(2));
                $(document).find('.total-amt').html(parseFloat(response.data.tradable_amt).toFixed(2));
            }
            else{
                
                $('#myModal').modal('hide');
                getBalance(c);
                operOrders(c);
				myTrades(c);
				notificationGrid();
               // ticker();
               
                $('.sell-response-msg' ).html('<span class="success-txt">'+response.message+'</span>');
                clearSellInput();
            }
        }
          
      },
      complete:function () {
        $(document).find('.confirm-call').remove();
        freez=0;
        $( '.sell-btn' ).html(vj);

        if(f!='')
          $('.confirm-action').html(f);
      }
  });

});

function checkInput(ob) {
	
  var from_coin_decimals = $("#from_coin_decimals").val();
  var to_coin_decimals = $("#to_coin_decimals").val();
    
  $('#buyAvailBalSpan').removeClass('border-error-new');  
  $('#sellAvailBalSpan').removeClass('border-error-new');  
  $('.buy-response-msg').html('');
  
  var invalidChars = /[^0-9.]/gi

  if (invalidChars.test(ob.value)) {
      ob.value = ob.value.replace(invalidChars, "");
  }
  else{
    
    if($(ob).hasClass('buy-input'))
    {     
        
		v1 = $(document).find('#buy-form').find('#vol').val();
        v2 = $(document).find('#buy-form').find('#at').val();
                
		if(v1 == "" || v2 == "")
		{
			v = 0;			
		}else{			
			v = eval(v1)*eval(v2);
		}
		
		//console.log(v);
		
		if(v.toFixed(3)=='NaN')
		{
          v = 0.000;
		}
		
		if(parseFloat(v) > 0){
						
			t_com = (eval(v)*eval(b_com))/100;            
			totalPrice = (eval(v)+eval(t_com));
			
			if(parseFloat(totalPrice) > total_buy_bal) {
				$('#buyAvailBalSpan').addClass('border-error-new');
				$(document).find('#selected-'+c[0]).val(total_buy_bal);
			} else {
				t =eval(total_buy_bal)-(eval(v)+eval(t_com));			
				$(document).find('#selected-'+c[0]).val(t.toFixed(5));
				
				$('#buy-commission').val(t_com.toFixed(5));			
				$(document).find('#buy-total-price').val(v.toFixed(5));	
			}
			
			
			
			
		}else{			
			$(document).find('#buy-total-price').val('');
			$(document).find('#buy-commission').val('');
			$(document).find('#selected-'+c[0]).val(total_buy_bal);
		}		
    }
    else if($(ob).hasClass('sell-input'))
    {     
        
		v1 = $(document).find('#sell-form').find('#vol').val();
        v2 = $(document).find('#sell-form').find('#at').val();
        
		if(v1 == "" || v2 == "")
		{
			v = 0;			
		}else{			
			v = eval(v1)*eval(v2);
		}
		
		if(v.toFixed(3)=='NaN')
		{
          v = 0.000;
		}
		
		if(parseFloat(v) > 0){
			
			if(parseFloat(v1) > parseFloat(total_sell_bal)) {
				$('#sellAvailBalSpan').addClass('border-error-new');
				$(document).find('#selected-'+c[1]).val(total_sell_bal);
			} else {
				t_com = (eval(v)*eval(s_com))/100;
				t =eval(total_sell_bal)-(eval(v1));

				$(document).find('#selected-'+c[1]).val(t.toFixed(5));
				$('#sell-commission').val(t_com.toFixed(5));

				v = v.toFixed(3);

				$(document).find('#sell-total-price').val(v);	
			}
			
		}else{			
			$('#sell-commission').val('');
			$(document).find('#sell-total-price').val('');
			$(document).find('#selected-'+c[1]).val(total_sell_bal);
		}
		
    }
  }
};


$('.only-int').keyup(function() {
    checkInput(this);
});



});  // End of load function document
