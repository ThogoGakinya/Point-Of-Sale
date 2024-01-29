@extends('layouts.cashier')
@section('content')
<div class="card">
    <div class="card-header">
       <strong><h4><a> {{$waiter_details->name}}</a></h4></strong>
        <strong><h6><a> SALES TODAY : Ksh.{{$total_receipts}} </a></h6></strong>
        <strong><h6><a> CASH : Ksh. {{$total_cash}}  </a></h6></strong>
        <strong><h6><a> M-PESA :  Ksh. {{$total_mpesa}} </a></h6></strong>
        <strong><h6><a> INVOICES : Ksh.{{$total_invoice}} </a></h6></strong>
       {{date("l jS \of F Y h:i:s A")}}  
    </div>
   
            <div class="tabbable" style="background-color: #ffffff;">
                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#home4">INVOICES&nbsp;<span class="badge badge-warning">{{count($invoices)}}</span></a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#profile4">RECEIPTS&nbsp;<span class="badge badge-warning">{{count($receipts)}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#cash">CASH &nbsp;<span class="badge badge-warning">{{count($cashs)}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#mpesa">M-PESA&nbsp;<span class="badge badge-warning">{{count($mpesas)}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#items">ITEMIZED SALES&nbsp;</a>
                    </li>

                </ul>
                @php
                $cnt = 1;
                @endphp
            <div class="tab-content">
                <div id="home4" class="tab-pane in active">
                    <div class="card">
                        <div class="card-header">
                            <a>INVOICES <small><i>(Unprocessed orders)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table2" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt No.</th>
                                    <th>Mode</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>Owner</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                @foreach($invoices as $receipt)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$receipt->receipt_no}}</td>
                                    <td>{{$receipt->mode}}</td>
                                    <td>{{$receipt->serving_mode}}</td>
                                    <td>{{$receipt->created_at}}</td>
                                    <td><strong>{{$receipt->user->name}}</strong></td>
                                    <td> 
                                        <a href="{{url('/view-invoice/'.$receipt->receipt_no .'/' .$receipt->id)}}"class="btn btn-success btn-sm">View<i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @php
                                $cnt ++;
                                @endphp
                                @endforeach
                                
                                </form>
                                </tbody>
                            </table>
                        </div><!-- clossing table responsive -->
                    </div><!-- card -->
                </div><!-- tab pane-->
                <div id="profile4" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>RECEIPTS <small><i>(Processed orders)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table1" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt No.</th>
                                    <th>Amount Paid</th>
                                    <th>Mode</th>
                                    <th>Owner</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                @foreach($receipts as $receipt)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$receipt->receipt_no}}</td>
                                    <td>{{$receipt->to_pay}}</td>
                                    <td>{{$receipt->mode}}</td>
                                    <td><strong>{{$receipt->user->name}}</strong></td>
                                    <td>{{$receipt->created_at}}</td>
                                    <td>
                                        <a href="{{url('/view-receipt/'.$receipt->receipt_no .'/' .$receipt->id)}}" class="btn btn-success btn-sm">View<i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @php
                                $cnt ++;
                                @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- clossing table responsive -->
                    </div><!-- card -->
                </div>
                <div id="cash" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>CASH PAYMENTS<small><i>(Payed over the counter)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table3" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt No.</th>
                                    <th>Amount Paid</th>
                                    <th>Mode</th>
                                    <th>Owner</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                @foreach($cashs as $cash)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$cash->receipt_no}}</td>
                                    <td>{{$cash->to_pay}}</td>
                                    <td>{{$cash->mode}}</td>
                                    <td><strong>{{$cash->user->name}}</strong></td>
                                    <td>{{$cash->created_at}}</td>
                                    <td>
                                        <a href="{{url('/view-receipt/'.$cash->receipt_no .'/' .$cash->id)}}" class="btn btn-success btn-sm">View<i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @php
                                $cnt ++;
                                @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- clossing table responsive -->
                    </div><!-- card -->
                </div>
                <div id="mpesa" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>M-PESA PAYMENTS<small><i>(Payed through till number)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table4" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt No.</th>
                                    <th>Amount Paid</th>
                                    <th>Mode</th>
                                    <th>Owner</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                @foreach($mpesas as $mpesa)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$mpesa->receipt_no}}</td>
                                    <td>{{$mpesa->to_pay}}</td>
                                    <td>{{$mpesa->mode}}</td>
                                    <td><strong>{{$mpesa->user->name}}</strong></td>
                                    <td>{{$mpesa->created_at}}</td>
                                    <td>
                                        <a href="{{url('/view-receipt/'.$mpesa->receipt_no .'/' .$mpesa->id)}}" class="btn btn-success btn-sm">View<i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @php
                                $cnt ++;
                                @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- clossing table responsive -->
                    </div><!-- card -->
                </div>
                <div id="items" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>ITEMIZED DAILY SALES<small><i>(Total sales per product)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table4" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Totals</th>
                                    <th>Serving Mode</th>
                                    <th>Reference</th>
                                    <th>Time Served</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                @foreach($daily_single_sales as $item)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->line_total}}</td>
                                    <td>{{$item->mode}}</td>
                                    <td>{{$item->receipt_no}}</td>
                                    <td>{{$item->created_at}}</td>
                                </tr>
                                @php
                                $cnt ++;
                                @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div><!-- clossing table responsive -->
                    </div><!-- card -->
                </div>
        </div>
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
