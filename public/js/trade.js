  freez = 0;
  clicked_action = '';
  requested_coin = '';
  f ='';
  trade_type ='';

  

  function bidGrid(bid)
  {
      tr = '<tr><th>Volume</th><th>Price /'+c[1].toUpperCase()+'</th></tr>';
      if(bid.length > 0)
      {
        i=true;
        $.each(bid, function(k,v){
          
          r = v.rate;
          if(i==true)
            $(document).find('.highest-bid').html(parseFloat(r).toFixed(2));
          
          tr+='<tr><td>'+parseFloat(v.volume).toFixed(3)+'</td><td>'+parseFloat(v.rate).toFixed(2)+'</td></tr>';
          i=false;
        
        });
      }
      else{
        $(document).find('.highest-bid').html('-----');
        tr+='<tr><td colspan="2" align="center">No Bid Yet</td></tr>';
      }
      $(document).find('.buy-orders').html(tr)
  }
  function sellGrid(ask)
  {
      tr = '<tr><th>Volume</th><th>Price /'+c[1].toUpperCase()+'</th></tr>';
      if(ask.length > 0)
      {
        i=true;
        $.each(ask, function(k,v){
          
          r = v.rate;
          if(i==true)
            $(document).find('.lowest-ask').html(parseFloat(r).toFixed(2));
          
          tr+='<tr><td>'+parseFloat(v.volume).toFixed(3)+'</td><td>'+parseFloat(v.rate).toFixed(2)+'</td></tr>';
          i=false;
        });
        
      }
      else{
        $(document).find('.lowest-ask').html('----');
        tr+='<tr><td colspan="2" align="center">No Ask Yet</td></tr>';
      }
      $(document).find('.sell-orders').html(tr);
  }

  function getTrade(trade)
  {
      tr = '<tr><th>Time</th><th>Volume</th><th>Price /'+c[1].toUpperCase()+'</th></tr>';
      if(trade.length > 0)
      {
        $.each(trade, function(k,v){

          if(v.trade_type=='BUY')
            rate = v.buyer_rate;
          else
          if(v.trade_type=='SELL')
            rate = v.seller_rate;

            var ts  = new Date(v.trade_at);
                ts  = ts.toLocaleString();
                ts  = ts.split(",");
                time= ts[1];  
            tr+='<tr><td>'+time+'</td><td>'+v.volume+'</td><td>'+parseFloat(rate).toFixed(2)+'</td></tr>';
        });
      }
      else{
        tr+='<tr><td colspan="3" align="center">No Trade Yet</td></tr>';
      }
      
      $(document).find('.trade-list').html(tr);
  }




  var socket = io(node_server_point);
  

  socket.on('sell', function(response) {
      sellGrid(response.sell)
      //console.log(response);
  });

  socket.on('buy', function(response) {
      bidGrid(response.bid)
      //console.log(response);
  });

  socket.on('trade', function(response) {
    getTrade(response.trade)
    //console.log(response);
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
                  tr = '<tr><th>Volume</th><th>Price</th><th>Fee</th><th>Action</th></tr>';
                  if(response.data.bid.length > 0)
                  {
                    $.each(response.data.bid, function(k,v){
                      tr+='<tr><td>'+parseFloat(v.volume).toFixed(3)+'</td><td>'+parseFloat(v.rate).toFixed(2)+'</td><td>'+parseFloat(v.fee).toFixed(2)+'</td><td><span class="cancel-trade" data-trade-type="bid" data-trade-id="'+v.id+'">Cancel</span></td></tr>';
                    });
                    
                  }
                  else{
                    tr+='<tr><td colspan="4" align="center">No Bid Yet</td></tr>';
                    
                  }
                  $(document).find('.open-bid-orders').html(tr);

                  tr = '<tr><th>Volume</th><th>Price</th><th>Fee</th><th>Action</th></tr>';
                  if(response.data.ask.length > 0)
                  {
                    $.each(response.data.ask, function(k,v){
                      tr+='<tr><td>'+parseFloat(v.volume).toFixed(3)+'</td><td>'+parseFloat(v.rate).toFixed(2)+'</td><td>'+parseFloat(v.fee).toFixed(2)+'</td><td><span class="cancel-trade" data-trade-type="ask" data-trade-id="'+v.id+'">Cancel</span></td></tr>';
                    });
                    
                  }
                  else{
                    tr+='<tr><td colspan="4" align="center">No Ask Yet</td></tr>';
                    
                  }
                  $(document).find('.open-ask-orders').html(tr);

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
                    $(document).find('.selected-'+k).html(parseFloat(v).toFixed(2));
                  });
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
              console.log(response);
              tr = '<tr><th>Date</th><th>Vol</th><th>Price</th><th>Trade Type</th></tr>';
              if(response.data.length > 0)
              {
                $.each(response.data, function(k,v){
                  if(v.trade_type=='BUY')
                    rate = v.buyer_rate;
                  else
                    rate = v.seller_rate;
                  var ts = new Date(v.trade_at);
                  tr+='<tr><td>'+ts.toLocaleString()+'</td><td>'+parseFloat(v.volume).toFixed(3)+'</td><td>'+parseFloat(rate).toFixed(2)+'</td><td>'+v.trade_type+'</td></tr>';
                });
              }
              else{
                tr+='<tr><td colspan="4" align="center">No Trade Yet</td></tr>';
              }
              $(document).find('.my-trades').html(tr);
            }
          },
          complete:function () {
          
          }
      });
  }

$(function(){

  
  l = '';

  $(document).on('click', '.confirm-action',function(){

    f = $( this ).ladda();
    f.ladda('start');
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




  $('form[name="buy-form"]').submit(function(e){

    

    clicked_action = 'buy';
    $(document).find('.input-error').remove();
    e.preventDefault();
    if(freez==1)
      return false;
    
    form_id = this;
    $.ajax({
        type: 'post',
        url:bu+'/buy',
        dataType: 'json',
        data:$(this).serialize(),
        beforeSend: function () {
          freez=1;
          l = $( '.buy-btn' ).ladda();
          l.ladda( 'start' );
        },

        success: function (response) {
        //console.log(response.statuscode);
          if(response.statuscode=='RPI')
          {
            $.each(response.data, function(k,v){
              $(form_id).find('#'+k).after('<span class="input-error">'+v[0]+'</span>');
            });
          }
          else
          if(response.statuscode=='CST')
          {
            shownotice(response.message, 0);
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
                  $(document).find('.selected-rate').html(parseFloat(response.data.rate).toFixed(2));
                  $(document).find('.total-fee').html(parseFloat(response.data.fee).toFixed(2));
                  $(document).find('.total-amt').html(parseFloat(response.data.tradable_amt).toFixed(2));
              }
              else{
                  $('#myModal').modal('hide');
                  getBalance(c);
                  operOrders(c);
                  //trads(c);
                  ticker();
                  buySell(c);
                  shownotice(response.message, 1);
              }
          }
        },
        complete:function () {
          $(document).find('.confirm-call').remove();
          freez=0;
          l.ladda('stop');
          f.ladda('stop');
        }
    });
  });

  $(document).on('click', '.back-popup',function(){
    $('#myModal').modal('hide');
  });
  
  $(document).on('click','.cancel-trade',function(e){

      row_id = $(this).attr('data-trade-id');
      trade_type = $(this).attr('data-trade-type');

    e.preventDefault();
    if(freez==1)
      return false;

      
    
    $.ajax({
        type: 'post',
        url:bu+'/cancel-trade',
        dataType: 'json',
        data:{'row_id':row_id, 'trade_type':trade_type},
        beforeSend: function () {
          freez=1;
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
        },

        success: function (response) {
          
          if(response.statuscode!='SUCC')
          {
              shownotice(response.message, 0);
          }
          else
          if(response.statuscode=='SUCC')
          {
              getBalance(c);
              operOrders(c);
              buySell(c);
              shownotice(response.message, 1);
          }
        },
        complete:function () {
          freez=0;
        }
    });
  });

  $('form[name="sell-form"]').submit(function(e){
    clicked_action = 'sell';
    $(document).find('.input-error').remove();

    e.preventDefault();
    if(freez==1)
      return false;
    
    form_id = this;
    $.ajax({
        type: 'post',
        url:bu+'/sell',
        dataType: 'json',
        data:$(this).serialize(),
        beforeSend: function () {
          freez=1;
          l = $( '.sell-btn' ).ladda();
          l.ladda( 'start' );
        },
        success: function (response) {
          //console.log(response.statuscode);
          if(response.statuscode=='RPI')
          {
            $.each(response.data, function(k,v){
              $(form_id).find('#'+k).after('<span class="input-error">'+v[0]+'</span>');
            });
          }
          else
          if(response.statuscode=='CST')
          {
            shownotice(response.message, 0);
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
                  //trads(c);
                  ticker();
                  buySell(c);
                  shownotice(response.message, 1);
              }
          }
            
        },
        complete:function () {
          $(document).find('.confirm-call').remove();
          freez=0;
          l.ladda('stop');
          f.ladda('stop');
        }
    });
  
  });

  


  
  
  function checkInput(ob) {
    
    var invalidChars = /[^0-9.]/gi

    if (invalidChars.test(ob.value)) {
        ob.value = ob.value.replace(invalidChars, "");
    }
    else{
      if($(ob).hasClass('buy-input'))
      {     
          v1 = $(document).find('#buy-form').find('#vol').val();
          v2 = $(document).find('#buy-form').find('#at').val();
          v = eval(v1)*eval(v2);
          if(v.toFixed(3)=='NaN')
              v = 0.000;
          else
              v = v.toFixed(3);
         

          $(document).find('.buy-price').html(v);
      }
      else
      if($(ob).hasClass('sell-input'))
      {     
          v1 = $(document).find('#sell-form').find('#vol').val();
          v2 = $(document).find('#sell-form').find('#at').val();
          v = eval(v1)*eval(v2);
          if(v.toFixed(3)=='NaN')
              v = 0.000;
          else
             v = v.toFixed(3);
          $(document).find('.sell-price').html(v);
      }
    }
  };

  
  $('.only-int').keyup(function() {
      checkInput(this);
  });
  


});  // End of load function document
