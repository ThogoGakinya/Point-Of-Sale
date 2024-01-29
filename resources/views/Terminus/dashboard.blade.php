@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header">
        <h3><a>BURGERS</a></h3>
    </div>
    <div class="table-responsive">
        <table id="dynamic-table2" class="customers-actions">
        <thead>
            <tr>
                    <th>No.</th>
                    <th>Product</th>
                    <th>Toppings</th>
                    <th>Qty</th>
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
                        <td>{{$cnt}}</td>
                        <td>{{$order->product->name}}</td>
                        <td>{{$order->toppings}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$diff_in_minutes}} min</td>
                        <td>{{$array[0]}}</td>
                        <td align="center">
                            <a href=""><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @php
                    $cnt++;
                    @endphp
            @endforeach
            </tbody>
        </table>
    </div><!-- clossing table responsive -->
</div><!-- card -->
@endsection
