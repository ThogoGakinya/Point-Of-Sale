@extends('layouts.cashier')
@section('content')
<div class="card">
    <div class="card-header">
       <strong><h4><a> {{$product_details->name}}</a></h4></strong>
      <strong><h6><a>  Regular Price : Ksh.{{$product_details->regular_price}}</a></h6></strong>
       <strong><h6><a> In Stock : {{$product_details->instock}}</a></h6></strong>
        <strong><h6><a> TOTAL SALES TODAY : Ksh.{{$total_product_sales}} </a></h6></strong>
       {{date("l jS \of F Y h:i:s A")}}  
    </div>
   <div class="card-body">
    <div class="table-responsive">
        <table id="dynamic-table2" class="customers-actions">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Sold Quantity</th>
                <th>Line Total</th>
                <th>Sold By</th>
                <th>Date</th>
                <th>Mode</th>
                <th>Toppings</th>
            </tr>
            </thead>
            <tbody>
            @php
            $cnt = 1;
            @endphp
            @foreach($product_sales as $product_sale)
            <tr>
                <td>{{$cnt}}</td>
                <td>{{$product_sale->product->name}}</td>
                <td>{{$product_sale->quantity}}</td>
                <td>{{$product_sale->line_total}}</td>
                <td>{{$product_sale->user->name}}</td>
                <td>{{$product_sale->created_at}}</td>
                <td>{{$product_sale->mode}}</td>
                <td>{{$product_sale->toppings}}</td>
            </tr>
            @php
            $cnt ++;
            @endphp
            @endforeach
            
            </form>
            </tbody>
        </table>
    </div><!-- clossing table responsive -->
                    
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
