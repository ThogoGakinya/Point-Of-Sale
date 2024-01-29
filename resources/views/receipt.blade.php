@extends('layouts.staff')

@section('content')
    <div class="row">
        <div class="col-sm-4" align="right"><br/>
            <a class="btn btn-default btn-xs" href="{{route('home')}}"><i class="fa fa-print"></i>&nbsp;&nbsp;Print Receipt</a>
        </div>
        <div class="col-sm-4">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="smaller">
                Receipt&nbsp;&nbsp;
                <a class="green" data-toggle="modal" data-target="#add-uom"><i class="fa fa-print" title="Print Receipt"></i></a>
              </h4>
            </div>
            <div class="widget-body">
              <div class="widget-main">
              @foreach($company as $data)
              <div align="center"><strong>{{$data->name}} {{$data->branch}}</strong></div>
              <div align="center"><strong>{{$data->address_one}}</strong></div>
              <div align="center"><strong>{{$data->tel_one}}</strong></div>
              <div align="center"><strong>{{$data->tel_two}}</strong></div>
              <div align="center">VAT Pin :{{$data->pin}}</div>
              <div align="center">{{date("l jS \of F Y h:i:s A")}}</div>
              @endforeach
              <hr/>
              <div class="row">
                <div class="col-md-6"><strong>Item</strong></div>
                <div class="col-md-2"><strong>Qty</strong></div>
                <div class="col-md-2"><strong>Each</strong></div>
                <div class="col-md-2"><strong>Total</strong></div>
              </div><br/>
              @foreach($items as $item)
              <div class="row">
                <div class="col-md-6">{{$item->product->name}}</div>
                <div class="col-md-2">{{$item->quantity}}</div>
                <div class="col-md-2">{{$item->product->regular_price}}</div>
                <div class="col-md-2">{{$item->line_total}}</div>
              </div>
              @endforeach
              <hr/>
              <div class="row">
                <div class="col-md-10" align="right"><strong>TOTAL :</strong></div>
                <div class="col-md-2"><strong>{{$request->total}}</strong></div>
              </div>
              <div class="row">
                <div class="col-md-10" align="right"><strong>VAT:</strong></div>
                <div class="col-md-2"><strong>{{$request->tax}}</strong></div>
              </div>
              <div class="row">
                <div class="col-md-10" align="right"><strong>GRAND TOTAL :</strong></div>
                <div class="col-md-2"><strong>{{$request->to_pay}}</strong></div>
              </div>
              <div class="row">
                <div class="col-md-10" align="right"><strong>TENDERD :</strong></div>
                <div class="col-md-2"><strong>{{$request->tenderd}}</strong></div>
              </div>
              <div class="row">
                <div class="col-md-10" align="right"><strong>CHANGE :</strong></div>
                <div class="col-md-2"><strong>{{$request->change}}</strong></div>
              </div>
              <hr/>
              <strong>MODE : {{$request->mode}}</strong><br/>
              Total Qty : {{count($items)}}<br/>
              Cashier &nbsp;&nbsp;&nbsp;: {{auth::user()->name}}<br/>
              Receipt Ref: #{{$request->receipt_no}}
              <br/> <br/>
              <i>Thank you for shopping.Kindly keep this receipt for any product exchange or return. T&C applies</i>
              <br/>
              </div><!-- /.col -->
            </div>
          </div>
        </div>
		<div class="col-sm-4">
    <br/>
        <a class="btn btn-default btn-xs" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>
         &nbsp;&nbsp;Next Customer</a>
       
    </div>
	</div><!-- /.row -->

@endsection
