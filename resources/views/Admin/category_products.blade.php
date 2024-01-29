@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <a>{{strtoupper($category_name)}}</a>
    </div>
    <div class="card-body">
        <div class="container row">
        @foreach($products as $product)
            <div class="col-md-3">
                <a href="">
                    <div class="thumbnail search-thumbnail">
                    <div class="clearfix" align="center">
                            <h5><strong>{{$product->name}}</strong></h5>
                    </div>
                        <img class="media-object" src="{{asset('scoopsroot/public/Documents/'.$product->image_name)}}" height="50%" width="50%"/>
                        <div class="caption" align="center">
                        <strong>Price each</strong> {{$product->regular_price}}<br/> <strong>Size</strong> {{$product->size->name}}<br/>
                        <span class="btn btn-info btn-xs tooltip-info" data-rel="tooltip" data-placement="bottom" title="Bottm Info">INSTOCK: {{$product->instock}}</span>
                            </div>
                    </div>
                </a>
            </div>
        @endforeach
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
