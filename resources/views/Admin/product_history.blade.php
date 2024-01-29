@extends('layouts.staff')
@section('content')
<div class="card" style="height: 80vh;">
    <div class="card-header">
       <a>PRODUCT HISTORY</a>
    </div>
    <div class="card-body">
        <div class="container">
        <div class="row">
        <div class="col-xs-12">
         <div class="clearfix">
         @php
        $cnt =1;
        @endphp
         </div>
            <div>
               <div class="table-responsive row">
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                            <td colspan="10">
                            <div class="col-md-4">
                            <strong>Product Name : </strong><a>{{$product->name}}</a><br/>
                            <strong>Current Stock : </strong><a>{{$product->instock}}</a><br/>
                            <strong>Regular Price : </strong><a>{{$product->regular_price}}</a><br/>
                            <strong>Date : </strong><a>{{date("l jS \of F Y h:i:s A")}}</a>
                            </div>
                            <div class="col-md-4">
                                 <img class="media-object" src="{{asset('scoopsroot/public/Documents/'.$product->image_name)}}" height="30%" width="30%"/>
                                           </div>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>New Stock</th>
                            <th>Receipt Ref</th>
                            <th>Owner</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($historys as $history)
                          <tr>
                              <td>{{$cnt}}</td>
                              <td>{{$history->created_at}}</td>
                              <td>{{$history->credit}}</td>
                              <td>{{$history->debit}}</td>
                              <td>{{$history->new_stock}}</td>
                              <td>{{$history->receipt_id}}</td>
                              <td>{{$history->user->name}}</td>
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
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
