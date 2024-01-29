@extends('layouts.realtime')
@section('content')
<div class="card" style="height: 80vh;">
    <div class="card-header">
       Realtime Orders
    </div>
    <div class="card-body" style="background-image: url('{{asset('assets/images/mojito/texture_bg.jpg')}}');">
        <div class="container">
            @widget('recent_orders')
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
