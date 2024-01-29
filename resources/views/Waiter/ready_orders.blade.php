@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header">
       <h3><a>Please proceed to collect the orders below</a> <a href="{{route('home')}}" class="btn btn-default"><< Back</a> </h3>
    </div>
         <div class="clearfix">
         @php
          $cnt = 1;
        @endphp
         </div>
            <div>
            <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Product</th>
                        <th>Toppings</th>
                        <th>Qty</th>
                        <th>Orderd Time</th>
                        <th>Wait Time</th>
                        <th>Station</th>
                       

                        </tr>
                    </thead>
                    <tbody>
                    @foreach($my_processed_orders as $order)
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
                            <td>{{$cnt}}</td>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->toppings}}</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$array2[1]}}</td>
                            <td>{{$diff_in_minutes}} min</td>
                            <td><strong>{{$order->category->name}}</strong></td>
                          
                        </tr>
                          @php
                            $cnt++;
                          @endphp

                        
                          @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
