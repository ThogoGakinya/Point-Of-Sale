@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header"><a href="{{url('home')}}" class="btn btn-default btn-sm">Home</a> - Customers Table</div>
        <div class="card-body" style="background-image: url('{{asset('assets/images/mojito/texture_bg.jpg')}}');">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                @foreach($tables as $table)
                    <div class="col-md-3 col-sm-4 col-xs-4">
                        <a href="{{route('categories',$table->name)}}">
                            <div class="thumbnail search-thumbnail">
                                <div class="clearfix" align="center">
                                        <h5><strong>{{$table->name}}</strong></h5>
                                </div>
                                <img class="media-object" src="{{asset('assets/images/mojito/table.png')}}" height="30%" width="30%"/>
                                <div class="caption" align="center">
                                <strong>Capacity</strong> {{$table->capacity}}<br/>
                                
                                </div>
                        </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div><!-- Ending card body -->
    </div><!-- Ending header -->
</div><!-- Ending card -->
@endsection
