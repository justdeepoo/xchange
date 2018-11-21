@extends('xchange.master')
@section('headerjs')
@endsection()

@section('content')

 
        <div class="wrapper wrapper-content">
               <div class="row">

                    <div class="col-lg-4">
                        <div class="ibox float-e-margins">
                                <div class="">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>PORTFOLIO</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>CURRENCY</th>
                                                        <th>BALANCE</th>
                                                        <th>IN ORDERS</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($coin_list as $k=>$c){?>
                                                        <tr>
                                                            <td><i class="cf cf-eth cyp-color"></i> {{strtoupper($c['coin'])}}</td>
                                                            <td>{{strtoupper(number_format($c['balance'],4))}}</td>
                                                            <td class="text-navy"><span>{{number_format($c['in_order'],4)}}</span></td>
                                                        </tr>
                                                    <?php 
                                                    }?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    
                                    </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                    </div>
                    <div class="col-lg-8 ">
                            <div class="ibox float-e-margins">
                                <div class="">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>WALLET</h5>
                                            <div class="pull-right">
                                                
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row">
                                            <div class="col-lg-12">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>CURRENCY</th>
                                                        <th>BALANCE</th>
                                                        <th>IN ORDERS</th>
                                                        <th>TRANSACT</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($coin_list as $k=>$c){
                                                        $address = $c['address'];
                                                        $dt='';
                                                        if(strtolower($c['coin']=='xrp'))
                                                        {
                                                            $a = explode('?dt=', $c['address']);
                                                            $address = $a[0];
                                                            $dt = $a[1];
                                                        }
                                                    ?>

                                                        <tr>
                                                            <td><i class="cf cf-{{$c['coin']}} cyp-color"></i> {{strtoupper($c['coin'])}}</td>
                                                            <td>{{number_format($c['balance'],4)}}</td>
                                                            <td>{{number_format($c['in_order'],4)}}</td>
                                                            <td class="text-navy">  <label class="withdraw-request label label-primary"  data-toggle="modal" data-target="#myModal" data-coin-name="{{$c['coin']}}" data-coin-bal="{{$c['balance']}}" >Withdraw</label> | <label class="deposit-details label label-warning-light" data-toggle="modal" data-coin-name="{{$c['coin']}}"  data-coin-qrc="{{$c['qr_code_url']}}"  data-coin-address="{{$address}}" data-dt="{{$dt}}" data-target="#myModal2"> Deposit</label></td>
                                                        </tr>

                                                       
                                                    <?php 
                                                    }?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    
                                    </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                    </div>
                 
                    

                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="ibox float-e-margins">
                            <div class="">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title">
                                        <h5>TRANSACTION HISTORY</h5>
                                        <div class="pull-right">
                                            
                                        </div>
                                    </div>
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-lg-12" style="max-height: 500px;overflow-y: auto;">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>DATE</th>
                                                            <th>CURRENCY</th>
                                                            <th>AMOUNT</th>
                                                            <th>TRANSACT TYPE</th>
                                                            <th style="text-align:right">STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="txn-rows">
                                                       
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
                                     



            </div>
        <div class="footer">
            
            <div>
                <strong>Copyright</strong>  Company &copy; 2018
            </div>
        </div>
        </div>
        
    </div>




    <!--  Modal for managing deposit crypto-->
    
    <div class="coin-deposit">
        
        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="modal-header d-details">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h3 class="h3"><span class="coin-name"></span> Deposit Address </h3>
                        
                    </div>
                    <div class="modal-body scrol-p">
                        
                        <div class="row address-sec" style="display: block;">
                            <div class="des-tag-section" style="display: none;">
                                <div class="destination-tag">Destination Tag</div>
                                <div class="tag-value"></div>
                            </div>

                            <div class="col-md-12 mt-20 text-center">
                                <h4 class="text-center" style="margin-top: 8px;">Scan QR Code</h4>
                                <img class="qr-img" id="qr-img" src="">
                                <h3 class="text-center pb-10">OR</h3>
                                <p class="text-center" id="c_address">Address</p>
                            </div>
                            <div class="col-md-12 mt-20 text-center">
                                <div class="col-md-12">
                                    <div class="form-group name-group">
                                        <div id="coin_address" class="coin_address text-center"></div>
                                        <!-- <input type="text" class="form-control" id="coin_address" name="coin_address" readonly=""> -->
                                    </div>
                                </div>
                                <!-- <div class="col-md-2">
                                    <button name="btnCopy" title="Click To Copy" id="btnCopy" type="button">
                                        <i class="fa fa-clipboard" aria-hidden="true"></i></button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!--  End of Modal for managing deposit crypto-->






    <!--  Modal for managing withdrawal crypto-->

    <div class="coin-withdrawal">
        
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">  WITHDRAWAL</h4>
                    </div>
                    <form name="withdraw-form-request" id="withdraw-form-request">
                        <div class="modal-body" style="">
                            <div>
                                <div class="form-group destination-t" style="display:none">
                                    <input type="text" class="form-control" name="dt" id="dt" placeholder="Destination Tag" >
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="destination" id="destination" placeholder="Destination wallet address">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Volume" >
                                </div>
                                <div class="current-val"></div>
                            </div>
                            <div style="text-align:center;">
                                <!-- <small><strong>WITHDRAWAL FEES</strong></small> -->
                                <p></p>

                                <p>
                                    <small>NOTE: 
        Please verify the destination wallet address. Once submitted, the withdrawal request cannot be reverted back.</small>
                                </p>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button class="ladda-button ladda-button-demo btn btn-primary confirm-withdraw"  data-style="zoom-in">Next</button>
                            <!--<button type="submit" class="btn btn-primary block full-width m-b">Next</button>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
        

    <!--  END of Modal for managing withdrawal crypto-->

        

@endsection()
@section('footerjs')
    <script src="{{asset('/public/js/account.js')}}"></script>
    <script>
        $(document).on('click', '.deposit-details', function(){

            $(document).find('.des-tag-section').css('display','none');
            $(document).find('#qr-img').attr('src', $(this).attr('data-coin-qrc'));
            $(document).find('#coin_address').html($(this).attr('data-coin-address'));

            coin = $(this).attr('data-coin-name');

            $(document).find('.coin-name').html($(this).attr('data-coin-name').toUpperCase());
            if(coin=='xrp')
            {
                $(document).find('.des-tag-section').css('display','block');
                $(document).find('.tag-value').html($(this).attr('data-dt'));
                
            }
        });
        
        $(document).on('click', '.withdraw-request', function(){
            $(document).find('.destination-t').css('display','none');
            coin = $(this).attr('data-coin-name');
            if(coin=='xrp')
            {
                $(document).find('.destination-t').css('display','block');
            }
            bal = $(this).attr('data-coin-bal');
            $(document).find('.current-val').html(parseFloat(bal).toFixed(4)+' '+coin.toUpperCase());
            requested_coin = coin.toUpperCase();
            console.log(requested_coin);
        });

        getTransfer();
    </script>

@endsection()
