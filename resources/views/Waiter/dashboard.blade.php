@extends('layouts.home_waiter')
@section('content')
@if($secret_key !='')
<div class="card">
    <div class="card-header"><a>{{date("l jS \of F Y h:i:s A")}}</a>
		<a href="{{route('expenses')}}"	class="btn btn-primary btn-xs">
		<i class="menu-icon fa fa-tag"></i>

			<span class="menu-text">
				Expenses
			</span>
		</a>
			@php
												  $today = date("Y-m-d");
												@endphp
		<a href="{{url('close-of-day/'.$today)}}" class="btn btn-success btn-xs">
		<i class="menu-icon fa fa-times"></i>

			<span class="menu-text">
				Close of Day
			</span>
		</a>
		<a href="{{url('dailysales/'.$today)}}" class="btn btn-primary btn-xs">
		<i class="menu-icon fa fa-tag"></i>

			<span class="menu-text">
				Daily Sales
			</span>
		</a>

		<b class="arrow"></b>
    </div>
        <div class="card-body">
            <div class="container">
                <div class="row justify-content-center align-items-round">
<!--                    <marquee direction="left" class="marq" behavior="alternate"-->
<!--                 direction="left" loop=""><font size="5px" color="red">-->
<!--Your subscription for Cybrex POS expires on 8/31/2021.Please buy full license                   .</font></marquee>-->
                    <!--<div class="col-md-3 col-sm-6 col-xs-6">-->
                    <!--    <div class="small-box bg-primary">-->
                    <!--        <div class="card-statistic-3 p-4">-->
                    <!--            <div class="card-icon card-icon-large"><i class="fa fa-key"></i></div>-->
                    <!--            <div class="mb-4">-->
                    <!--                <h5 class="card-title mb-0">My Secret Key Today</h5>-->
                    <!--            </div>-->
                    <!--            <div class="row align-items-center mb-2 d-flex">-->
                    <!--                <div class="col-6">-->
                    <!--                    <h2 class="d-flex align-items-center mb-0">-->
                    <!--                      {{$secret_key->secret_key}}-->
                    <!--                    </h2>-->
                    <!--                </div>-->
                    <!--                <div class="col-6 text-right">-->
                    <!--                   <span>{{$secret_key->secret_key}}</span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-md-3 col-sm-3 col-xs-3">
                    <a href="{{route('mode','Take-away')}}">
                        <div class="small-box bg-primary">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fa fa-user"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Make Sales</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-8">
                                        <h2 class="d-flex align-items-center mb-0">
                                          Sales Input
                                        </h2>
                                    </div>
                                    <div class="col-4 text-right">
                                       <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <!--<div class="col-xl-3 col-lg-3 col-md-3">-->
                    <!--<a href="{{route('mode','sit-inn')}}">-->
                    <!--    <div class="small-box bg-warning">-->
                    <!--        <div class="card-statistic-3 p-4">-->
                    <!--            <div class="card-icon card-icon-large"><i class="fa fa-user"></i></div>-->
                    <!--            <div class="mb-4">-->
                    <!--                <h5 class="card-title mb-0">Sit Inn Customers</h5>-->
                    <!--            </div>-->
                    <!--            <div class="row align-items-center mb-2 d-flex">-->
                    <!--                <div class="col-6">-->
                    <!--                    <h2 class="d-flex align-items-center mb-0">-->
                    <!--                     Sit Inn-->
                    <!--                    </h2>-->
                    <!--                </div>-->
                    <!--                <div class="col-6 text-right">-->
                    <!--                   <span></span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</a>-->
                    <!--</div>-->
                    <!--<div class="col-xl-3 col-lg-3 col-md-3">-->
                    <!--<a href="{{route('receipts-invoices')}}">-->
                    <!--    <div class="small-box bg-danger">-->
                    <!--        <div class="card-statistic-3 p-4">-->
                    <!--            <div class="mb-4">-->
                    <!--               Orders on hold <span class="badge badge-danger">{{count($invoices)}}</span></strong></h3> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
                    <!--               Receipts <span class="badge badge-danger">{{count($receipts)}}</span></strong></h3>-->
                    <!--            </div>-->
                    <!--            <div class="row align-items-center mb-2 d-flex">-->
                    <!--                <div class="col-6">-->
                    <!--                    <h3 class="d-flex align-items-center mb-0">-->
                    <!--                      On Hold/Receipts-->
                    <!--                    </h3 >-->
                    <!--                </div>-->
                    <!--                <div class="col-6 text-right">-->
                    <!--                   <span></span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</a>-->
                    <!--</div>-->
                    <!--<div class="col-md-3 col-sm-3 col-xs-3">-->
                    <!--<a href="{{route('my_ready_orders')}}">-->
                    <!--    <div class="small-box bg-primary">-->
                    <!--        <div class="card-statistic-3 p-4">-->
                    <!--            <div class="card-icon card-icon-large"><i class="fa fa-key"></i></div>-->
                    <!--            <div class="mb-4">-->
                    <!--                <h5 class="card-title mb-0">Ready for collection</h5>-->
                    <!--            </div>-->
                    <!--            <div class="row align-items-center mb-2 d-flex">-->
                    <!--                <div class="col-6">-->
                    <!--                    <h2 class="d-flex align-items-center mb-0">-->
                    <!--                     {{count($my_processed_orders)}}-->
                    <!--                    </h2>-->
                    <!--                </div>-->
                    <!--                <div class="col-6 text-right">-->
                    <!--                   <span>{{count($my_processed_orders)}}</span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</a>-->
                    <!--</div>-->
                    <div class="col-xl-3 col-lg-3 col-md-3">
                    <a href="{{route('get_form')}}">
                        <div class="small-box bg-danger">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fa fa-cogs"></i></div>
                                <div class="mb-4">
                                    <h4 class="card-title mb-0">Reset Password</h4>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-12">
                                        <h2 class="d-flex align-items-center mb-0">
                                         Reset Password
                                        </h2>
                                    </div>
                                  
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3">
                                <a href="{{route('mpesas')}}">
                                    
                                        <img class="img-rounded" src="{{asset('scoopsroot/public/Documents/mpsa agent.jpeg')}}" height="60%" width="60%" style="border-radius:5%"/>
                                     
                                </a>
                            </div>
                    <!-- <div class="col-md-3 col-sm-6 col-xs-6">
                        <a href="">
                            <div class="thumbnail search-thumbnail">
                                <div class="clearfix" align="center">
                                        <h3><strong>Your Secret Key Today</strong></h3>
                                </div>        
                                <div class="caption" align="center" style="font-size">
                                   <p style="font-size: 82px;"><strong>{{$secret_key->secret_key}}</strong></p>
                                </div>
                        </div>
                        </a>
                    </div> -->
                    <!-- <div class="col-md-3 col-sm-6 col-xs-6">
                        <a href="{{route('mode','Take-away')}}">
                            <div class="thumbnail search-thumbnail">
                                <div class="clearfix" align="center">
                                        <h3><strong>Take Away</strong></h3>
                                </div><br/>
                                <img class="media-object" src="{{asset('assets/images/mojito/otc2.png')}}" height="60%" width="60%"/>
                                <div class="caption" align="center">
                                <br/>
                                
                                </div>
                        </div>
                        </a>
                    </div> -->
                    <!-- <div class="col-md-3 col-sm-6 col-xs-6">
                        <a href="{{route('mode','sit-inn')}}">
                            <div class="thumbnail search-thumbnail">
                                <div class="clearfix" align="center">
                                        <h3><strong>Sit Inn</strong></h3>
                                </div><br/>
                                <img class="media-object" src="{{asset('assets/images/mojito/sitinn.png')}}" height="45%" width="45%"/>
                                <div class="caption" align="center">
                                <br/>
                                
                                </div>
                        </div>
                        </a>
                    </div> -->
                    <!-- <div class="col-md-3 col-sm-6 col-xs-6">
                        <a href="{{route('receipts-invoices')}}">
                            <div class="thumbnail search-thumbnail">
                                <div class="clearfix" align="center">
                                    <h3><strong>Orders&nbsp;&nbsp;<span class="badge badge-danger">{{count($invoices)}}</span></strong></h3>
                                </div>
                                <img class="media-object" src="{{asset('assets/images/mojito/receipt.png')}}" height="44%" width="44%"/>
                                <div class="clearfix" align="center">
                                    <h3><strong>Receipts&nbsp;&nbsp;<span class="badge badge-danger">{{count($receipts)}}</span></strong></h3>
                                </div>
                        </div>
                        </a>
                    </div> -->
                </div>
            </div>
        </div><!-- Ending card body -->
    </div><!-- Ending header -->
</div><!-- Ending card -->
@else
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-4 col-sm-6 col-xs-6">
             @php 
                $secret_key = rand(100,999);
              @endphp
                <div class="thumbnail search-thumbnail">
                    <div class="clearfix" align="center">
                            <h3><strong>Generate Your Secret Key</strong></h3>
                    </div>        
                    <div class="caption" align="center" style="font-size" >
                        <p style="font-size: 85px;" id="secret_key"><strong>{{$secret_key}}</strong></p>
                        <input type="hidden" name="secret_key" id="secret_key" value="">
                    </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6" align="center">
                        <button class="btn btn-success btn-sm" type="button" onclick="generateSecretKey(100,999);">
                        <i class="ace-icon fa fa-spinner"></i>
                            Re-generate
                        </button>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6" align="center">
                        <form method="post" action="{{ route('save_secret')}} ">
                            {{ csrf_field() }}
                            <input type="hidden" name="secret_key" id="secret" value="{{$secret_key}}">
                            <button class="btn btn-primary btn-sm" type="submit">
                            <i class="ace-icon fa fa-check"></i>
                                Save
                            </button>
                        </form>
                    </div>
                   </div>
                </div>
        </div>
    </div>
</div>
@endif
@endsection
