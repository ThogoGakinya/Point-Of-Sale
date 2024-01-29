@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <a>INVOICES</a>
    </div>
         <div class="clearfix">
            
         </div>
            <div>
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th>Receipt No.</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Owner</th>
                            <th>Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($receipts as $receipt)
                          <tr>
                              <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                              </td>
                              <td>{{$receipt->receipt_no}}</td>
                              <td>{{$receipt->to_pay}}</td>
                              <td>{{$receipt->serving_mode}}</td>
                              <td>{{$receipt->user->name}}</td>
                              <td>{{$receipt->created_at}}</td>
                              <td> 
                                 <a href="{{url('/view-invoice/'.$receipt->receipt_no .'/' .$receipt->id)}}"><i class="fa fa-eye"></i></a>
                              </td>
                          </tr>
                          @endforeach
                    </tbody>
                </table>
            </div>
</div><!-- clossing card -->
@endsection
