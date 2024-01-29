@extends('layouts.station')
@section('content')
<div class="card">
    <div class="card-header">
       <h3><a>{{$header}}</a>&nbsp;&nbsp;&nbsp;@if($toaster == 5)<i>{{$waiter->name}}</i>@endif</h3>
    
    </div>
         <div class="clearfix">   
         </div>
            <input type="hidden" id="old_orders" value="{{$old_orders}}">
            <input type="hidden" id="new_orders" value="{{$new_orders}}"> 
         <button onclick="new Audio('assets/audio/alert.mp3').play()" id="myCheck" style="display:none;">aaa</button> 
            <div class="table-responsive"> 
                @if($toaster == 0 || $toaster ==1)
                    <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                        <th>Product</th>
                        <th>Toppings</th>
                        <th>Qty</th>
                        <th>Orderd Time</th>
                        <th>Wait Time</th>
                        <th>Owner</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                    @php
                        
                        $username = $order->user->name;
                        $array = explode(' ', $username);
                        $created = $order->created_at;
                        $array2 = explode(' ', $created);
                        $today = date("Y-m-d H:i:s");
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created);
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today);
                        $diff_in_minutes = $to->diffInMinutes($from);
                    @endphp
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->toppings}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$array2[1]}}</td>
                            <td>{{$diff_in_minutes}} min</td>
                            <td>{{$array[0]}}</td>
                            <td align="center">
                                 <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_status_{{$order->id}}"><i class="fa fa-eye"></i> Status</button>
                            </td>
                        </tr>
                        <!-- Modal for changing status of an order--> 
                        <div id="edit_status_{{$order->id}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">{{$order->product->name}}</h4>
                                </div>

                            <div class="modal-body">
                
                                <div class="row">
                                    <div class="col-md-6" align="center">
                                        <a href="">
                                            <div class="thumbnail search-thumbnail">
                                                <div class="clearfix" align="center">
                                                        <h4><strong>{{strtoupper($order->product->name)}}</strong></h4>
                                                </div>
                                                <img class="media-object" src="{{asset('Documents/'.$order->product->image_name)}}"/>
                                                
                                            </div>
                                        </a>
                                    </div> 
                                    <div class="col-md-6" align="center">
                                        <form method="post" action="{{ route('update_order_status','test')}} ">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <input type="hidden" name="order_id" value="{{$order->id}}" required/>
                                                <input type="hidden" name="status" value="1" required/>
                                            <button class="btn btn-primary btn-lg" type="submit">
                                              <i class="ace-icon fa fa-check"></i>
                                               Ready
                                            </button>
                                        </form></br></br></br>
                                        <form method="post" action="{{ route('update_order_status','test')}} ">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <input type="hidden" name="order_id" value="{{$order->id}}" required/>
                                                <input type="hidden" name="status" value="2" required/>
                                            <button class="btn btn-warning btn-lg" type="submit">
                                              <i class="ace-icon fa fa-spinner"></i>
                                              Waiting
                                            </button>
                                        </form><br/></br></br>
                                        <button class="btn btn-default btn-lg" data-dismiss="modal">
                                              <i class="ace-icon fa fa-times"></i>
                                              Not Now
                                        </button>
                                    </div> 
                               </div>
                        </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                @elseif($toaster == 2)
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                        <th>Product</th>
                        <th>Toppings</th>
                        <th>Qty</th>
                        <th>Processed Time</th>
                        <th>Wait Time</th>
                        <th>Owner</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($processed_orders as $order)
                    @php
                        
                        $username = $order->user->name;
                        $array = explode(' ', $username);
                        $created = $order->processed_time;
                        $array2 = explode(' ', $created);
                        $today = date("Y-m-d H:i:s");
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created);
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today);
                        $diff_in_minutes = $to->diffInMinutes($from);
                    @endphp
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->toppings}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$array2[1]}}</td>
                            <td>{{$diff_in_minutes}} min</td>
                            <td>{{$array[0]}}</td>
                            <td align="center">
                                 <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit_status_{{$order->id}}"><i class="fa fa-eye"></i> Status</button>
                            </td>
                        </tr>
                        <!-- Modal for changing status of an order--> 
                        <div id="edit_status_{{$order->id}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">{{$order->product->name}}</h4>
                                </div>

                            <div class="modal-body">
                
                                
                                <div class="row">
                                    <div class="col-md-6" align="center">
                                        <a href="">
                                            <div class="thumbnail search-thumbnail">
                                                <div class="clearfix" align="center">
                                                        <h4><strong>{{strtoupper($order->product->name)}}</strong></h4>
                                                </div>
                                                <img class="media-object" src="{{asset('Documents/'.$order->product->image_name)}}"/>
                                                
                                            </div>
                                        </a>
                                    </div> 
                                    <div class="col-md-6" align="center">
                                        <form method="post" action="{{ route('update_order_status','test')}} ">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <input type="hidden" name="order_id" value="{{$order->id}}" required/>
                                                <input type="hidden" name="status" value="0" required/>
                                            <button class="btn btn-primary btn-lg" type="submit">
                                            <i class="ace-icon fa fa-arrow-circle-left"></i>
                                               Revert
                                            </button>
                                        </form></br></br></br>
                                        <button class="btn btn-default btn-lg" data-dismiss="modal">
                                              <i class="ace-icon fa fa-times"></i>
                                              Not Now
                                        </button>
                                    </div> 
                               </div>
                        </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                @elseif($toaster == 3)
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                        <th>Product</th>
                        <th>Toppings</th>
                        <th>Qty</th>
                        <th>Orderd Time</th>
                        <th>Wait Time</th>
                        <th>Owner</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($waiting_orders as $order)
                    @php
                        
                        $username = $order->user->name;
                        $array = explode(' ', $username);
                        $created = $order->created_at;
                        $array2 = explode(' ', $created);
                        $today = date("Y-m-d H:i:s");
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created);
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today);
                        $diff_in_minutes = $to->diffInMinutes($from);
                    @endphp
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->toppings}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$array2[1]}}</td>
                            <td>{{$diff_in_minutes}} min</td>
                            <td>{{$array[0]}}</td>
                            <td align="center">
                                 <button class="btn btn-success" data-toggle="modal" data-target="#edit_status_{{$order->id}}"><i class="fa fa-eye"></i> Status</button>
                            </td>
                        </tr>
                        <!-- Modal for changing status of an order--> 
                        <div id="edit_status_{{$order->id}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">{{$order->product->name}}</h4>
                                </div>

                            <div class="modal-body">
            
                                
                            <div class="row">
                                    <div class="col-md-6" align="center">
                                        <a href="">
                                            <div class="thumbnail search-thumbnail">
                                                <div class="clearfix" align="center">
                                                        <h4><strong>{{strtoupper($order->product->name)}}</strong></h4>
                                                </div>
                                                <img class="media-object" src="{{asset('Documents/'.$order->product->image_name)}}"/>
                                                
                                            </div>
                                        </a>
                                    </div> 
                                    <div class="col-md-6" align="center">
                                        <form method="post" action="{{ route('update_order_status','test')}} ">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <input type="hidden" name="order_id" value="{{$order->id}}" required/>
                                                <input type="hidden" name="status" value="1" required/>
                                            <button class="btn btn-primary btn-large" type="submit">
                                              <i class="ace-icon fa fa-check"></i>
                                               Ready
                                            </button>
                                        </form></br></br></br>
                                        <form method="post" action="{{ route('update_order_status','test')}} ">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <input type="hidden" name="order_id" value="{{$order->id}}" required/>
                                                <input type="hidden" name="status" value="0" required/>
                                            <button class="btn btn-warning btn-large" type="submit">
                                              <i class="ace-icon fa fa-arrow-circle-left"></i>
                                              Revert
                                            </button>
                                        </form><br/></br></br>
                                        <button class="btn btn-default btn-large" data-dismiss="modal">
                                              <i class="ace-icon fa fa-times"></i>
                                              Not Now
                                        </button>
                                    </div> 
                               </div>
                        </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                @elseif($toaster == 4)
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                        <th>Product</th>
                        <th>Toppings</th>
                        <th>Qty</th>
                        <th>Processed Time</th>
                        <th>Collection Time</th>
                        <th>Wait Time</th>
                        <th>Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($collected as $order)
                    @php
                        
                        $username = $order->user->name;
                        $array = explode(' ', $username);
                        $created = $order->collection_time;
                        $array2 = explode(' ', $created);
                        $today = date("Y-m-d H:i:s");
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created);
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today);
                        $diff_in_minutes = $to->diffInMinutes($from);
                    @endphp
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->toppings}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->processed_time}}</td>
                            <td>{{$array2[1]}}</td>
                            <td>{{$diff_in_minutes}} min</td>
                            <td>{{$array[0]}}</td>
                        
                        </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                @elseif($toaster == 5)
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                        <th>Product</th>
                        <th>Toppings</th>
                        <th>Qty</th>
                        <th>Orderd Time</th>
                        <th>Wait Time</th>
                        <th>Owner</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($myorders as $order)
                    @php
                        
                        $username = $order->user->name;
                        $array = explode(' ', $username);
                        $created = $order->created_at;
                        $array2 = explode(' ', $created);
                        $today = date("Y-m-d H:i:s");
                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created);
                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $today);
                        $diff_in_minutes = $to->diffInMinutes($from);
                    @endphp
                        <tr>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->toppings}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$array2[1]}}</td>
                            <td>{{$diff_in_minutes}} min</td>
                            <td>{{$array[0]}}</td>
                            <td align="center">
                                 <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#edit_status_{{$order->id}}"><i class="fa fa-eye"></i> Collect</button>
                            </td>
                        </tr>
                        <!-- Modal for changing status of an order--> 
                        <div id="edit_status_{{$order->id}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" align="center">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">Are you sure you want to collect this order?</h4>
                                </div>

                            <div class="modal-body">
                
                                <div class="row">
                                    <div class="col-md-6" align="center">
                                        <a href="">
                                            <div class="thumbnail search-thumbnail">
                                                <div class="clearfix" align="center">
                                                        <h4><strong>{{strtoupper($order->product->name)}}</strong></h4>
                                                </div>
                                                <img class="media-object" src="{{asset('Documents/'.$order->product->image_name)}}"/>
                                                
                                            </div>
                                        </a>
                                    </div> 
                                    <div class="col-md-6" align="center">
                                        <form method="post" action="{{ route('update_order_status','test')}} ">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <input type="hidden" name="order_id" value="{{$order->id}}" required/>
                                                <input type="hidden" name="status" value="3" required/>
                                            <button class="btn btn-primary btn-lg" type="submit">
                                              <i class="ace-icon fa fa-check"></i>
                                              Collect
                                            </button>
                                        </form></br></br></br>
                                        <button class="btn btn-default btn-lg" data-dismiss="modal">
                                              <i class="ace-icon fa fa-times"></i>
                                              Not Now
                                        </button>
                                    </div> 
                               </div>
                        </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
                @endif
                
            </div>
</div><!-- clossing card -->
 <!-- Modal for confirming secret key--> 
 <div id="confirm_secret" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="blue bigger">Please enter your SECRET KEY for today</h4>
            </div>

        <div class="modal-body">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-3" align="center">
                   </br>
                    <form method="post" action="{{ route('confirm_secret')}} ">
                        {{ csrf_field() }}
                            <input type="number" name="secret_key" class="form-control" style="padding: 20px 20px 20px 20px;
                            font-size: 30px; background-color:#eeeeee;" required/></br></br></br>
                        <button class="btn btn-primary btn-sm" type="submit">
                        <i class="ace-icon fa fa-arrow-circle-right"></i>
                            Next
                        </button>
                    </form>
    
                </div> 
            </div>
    </div>
    </div>
@endsection
