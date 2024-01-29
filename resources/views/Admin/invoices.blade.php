@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <a>RECEIPTS</a>
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
                            <th>Invoice No.</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Owner</th>
                            <th>Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($invoices as $invoice)
                          <tr>
                              <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                              </td>
                              <td>{{$invoice->receipt_no}}</td>
                              <td>{{$invoice->to_pay}}</td>
                              <td>{{$invoice->serving_mode}}</td>
                              <td>{{$invoice->user->name}}</td>
                              <td>{{$invoice->created_at}}</td>
                              <td> 
                                 <a href="{{url('/view-invoice/'.$invoice->receipt_no .'/' .$invoice->id)}}"><i class="fa fa-eye"></i></a>
                              </td>
                          </tr>
                          @endforeach
                    </tbody>
                </table>
            </div>
</div><!-- clossing card -->
@endsection
