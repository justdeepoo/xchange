@extends('xchange.master')


@section('headerjs')

@endsection()

@section('content')

    <div class="wrapper wrapper-content">

        <div class="col-md-12 trade-section p-0">
            <div class="col-lg-8 on-line-data">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12 head row">Buy Orders</div>
                            <table class="table-responsive buy-orders">
                                <tr><th>Volume</th><th>Price</th></tr>
                                
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12 head row">Sell Orders</div>
                            <table class="table-responsive sell-orders">
                                <tr><th>Volume</th><th>Price</th></tr>
                                
                            </table>
                        </div>
                    </div>
                </div>   
                <div class="col-md-6 trade-part">
                
                    <div class="col-md-12 head">Trade History</div>
                    <table class="table-responsive trade-list">
                        <tr><th>Date</th><th>Volume</th><th>Price</th></tr>
                    </table>
                
                    
                </div>    
            </div>
            <div class="col-md-4 buy-sell-sec">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-b-s">Let's Trade</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-m-b-s">My Recent Trade</a></li>
                    </ul>
                    <div class="tab-content" >
                        <div id="tab-b-s" class="tab-pane active">
                            <div class="panel-body" style="min-height: 343px; border-bottom:none;">
                                <form action="#" name="buy-form" id="buy-form" autocomplete="off">    
                                    <div class="col-md-12 b-s-f">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <small>{{strtoupper($from_currency)}} Balance: <span class="selected-{{($from_currency)}}"></span></small>
                                                <input type="text" name="vol" class="form-control cust-inp only-int buy-input" placeholder="{{strtoupper($to_currency)}} Volume" id="vol">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <small> Lowest ask: <span class="lowest-ask"></span></small>
                                                <input type="text" name="at"  class="form-control cust-inp only-int buy-input" placeholder="Price per {{strtoupper($to_currency)}}" id="at">
                                            </div>
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <small> Total {{strtoupper($to_currency)}} will be : <span class="buy-price">00.00</span></small> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="from_coin" id="from_coin" value="{{strtoupper($from_currency)}}">
                                            <input type="hidden" name="to_coin" id="to_coin" value="{{strtoupper($to_currency)}}">
                                            <?php
                                            if($can_trade)
                                            {?>
                                                <button class="ladda-button ladda-button-demo btn btn-primary buy buy-btn" style="width:100%"  data-style="zoom-in">Buy</button>
                                            <?php }
                                            ?>
                                            
                                            
                                        </div>

                                    </div> 
                                </form>
                                <form action="#" name="sell-form" id="sell-form" autocomplete="off"> 
                                    <div class="col-md-12 b-s-f border-f">
                                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <small>{{strtoupper($to_currency)}} Balance: <span class="selected-{{($to_currency)}}"></span></small>
                                                <input type="text" class="form-control cust-inp only-int sell-input" name="vol" placeholder="{{strtoupper($to_currency)}} Volume" id="vol">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <small>Highest Bid: <span class="highest-bid"></span></small>
                                                <input type="text" class="form-control cust-inp only-int sell-input" id="at" placeholder="Price per {{strtoupper($to_currency)}}" name="at">
                                            </div>
                                        
                                        </div>
                                    
                                        <div class="col-md-6">
                                            <small> Total {{strtoupper($from_currency)}} will be : <span class="sell-price">00.00</span></small> 
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="from_coin"  value="{{strtoupper($to_currency)}}">
                                            <input type="hidden" name="to_coin"  value="{{strtoupper($from_currency)}}">
                                            <?php
                                            if($can_trade)
                                            {?>
                                                <button class="ladda-button ladda-button-demo btn btn-primary sell sell-btn" style="width:100%" data-style="zoom-in">Sell</button>
                                            <?php }?>

                                            
                                        </div>
                                    </div> 
                                </form>
                            </div>
                            
                        </div>
                        <div id="tab-m-b-s" class="tab-pane" >
                            <div class="panel-body " style="max-height: 380px; overflow-y: auto;border-bottom:none;">
                                <table class="table-responsive my-trades">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12 pad-0">
            <div class="col-md-8 pad-0" style="padding-right:8px">
                <!-- <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Line Chart Example
                            <small>With custom colors.</small>
                        </h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="lineChart" height="140"></canvas>
                        </div>
                    </div>
                </div>   -->
            </div>
            <div class="col-md-4 pad-0">
                
                <div class="tabs-container pad-0" style="margin-top:2px;">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Open Buy Orders</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2">Open Sell Orders</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <table class="table-responsive open-bid-orders">
                                    
                                </table>
                                <div class="spiner-example open-buy-loader hide">
                                    <div class="sk-spinner sk-spinner-rotating-plane"></div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <table class="table-responsive open-ask-orders">
                                    
                                </table>
                                <div class="spiner-example open-ask-loader hide">
                                    <div class="sk-spinner sk-spinner-rotating-plane"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
       

       <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>

    <!--  Modal for managing withdrawal crypto-->

    <div class="coin-deposit">
        
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <div class="modal-title action-heading"><span class="coin-request">NEW BUY ORDER</span></div>
                        
                    </div>
                        <div class="modal-body" style="">
                            <div>
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>COIN</strong> </div>
                                    <div class="col-md-6 selected-coin">---</div>
                                </div>  
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>VOLUME</strong> </div>
                                    <div class="col-md-6 selected-vol">0</div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>RATE</strong> </div>
                                    <div class="col-md-6 selected-rate">0</div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>FEE</strong> </div>
                                    <div class="col-md-6 total-fee">0</div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-6"><strong>TOTAL AMOUNT</strong> </div>
                                    <div class="col-md-6 total-amt">00</div>
                                </div>   
                            </div>
                            <!-- -->
                            <div class="clearfix"></div>
                            <br/><br/>
                            <small><strong>TRADE FEES</strong></small>
                            <small> Trade Fee charged for this order is 0.00% (inclusive of all taxes)</small>
                        </div>
                        <div class="modal-footer">
                            <button class="ladda-button ladda-button-demo btn btn-default back-popup" data-style="zoom-in">Back</button>
                            <button class="ladda-button ladda-button-demo btn btn-primary confirm-action" data-style="zoom-in">Confirm</button>
                        </div>
                    </div>
                </div>
    </div>
</div>
<!--  END of Modal for managing withdrawal crypto-->
@endsection()
@section('footerjs')

    
    <script src="{{env('node_server_point')}}/socket.io/socket.io.js"></script>
    <script src="{{asset('/public/js/trade.js')}}"></script>
    <script>

        


        var lineData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [

                {
                    label: "XRP",
                    backgroundColor: 'rgba(151, 151, 186, 1)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90]
                }
                // ,{
                //     label: "Data 2",
                //     backgroundColor: 'rgba(220, 220, 220, 0.5)',
                //     pointBorderColor: "#fff",
                //     data: [65, 59, 80, 81, 56, 55, 40]
                // }
            ]
        };

        var lineOptions = {
            responsive: true
        };


        //var ctx = document.getElementById("lineChart").getContext("2d");
        //new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
        
        c = Array('{{$from_currency}}', '{{$to_currency}}');

        $(function(){
            //Get Current Balance 
            getBalance(c);
            operOrders(c);
            buySell(c);
            myTrades(c);
            
        });

    </script>
@endsection()
