@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header">
       <a href="{{route('home')}}" class="btn btn-default btn-sm">Home</a> / My Receipts and orders
    </div>
   
            <div class="tabbable" style="background-color: #ffffff;">
                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#home4">ORDERS&nbsp;<span class="badge badge-warning">{{count($invoices)}}</span></a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#profile4">RECEIPTS&nbsp;<span class="badge badge-warning">{{count($receipts)}}</span></a>
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
                                    <th>Amount Due</th>
                                    <th>Mode</th>
                                    <th>Location</th>
                                    <th>Date</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                <form method="post" action="{{route('combine_receipt')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @php 
                                    $combined_receipt_no = rand(100000,999999);
                                @endphp
                                @foreach($invoices as $receipt)
                                <tr>
                                    <td class="center">
                                        <input type="hidden" name="to_combine_amount[]" value="{{$receipt->to_pay}}"/>
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace check" name="to_combine[]" value="{{$receipt->receipt_no}}" />
                                            <span class="lbl"></span>
                                        </label>
                                        <input type="hidden" value="{{$combined_receipt_no}}" name="combined_receipt_number">
                                    </td>
                                    <td>{{$receipt->receipt_no}}</td>
                                    <td>{{$receipt->to_pay}}</td>
                                    <td>{{$receipt->mode}}</td>
                                    <td>{{$receipt->serving_mode}}</td>
                                    <td>{{$receipt->created_at}}</td>
                                    <td> 
                                        <a href="{{url('/view-invoice/'.$receipt->receipt_no .'/' .$receipt->id)}}" class="btn btn-success btn-sm">View<i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @php
                                $cnt ++;
                                @endphp
                                @endforeach
                                <tr>
                                    <td colspan="7"><button class="btn btn-primary btn-sm" type="submit" disabled>Combine Selected Orders ?</button></td>
                                </tr>
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
                            <table id="dynamic-table" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt No.</th>
                                    <th>Amount Paid</th>
                                    <th>Mode</th>
                                    <th>Location</th>
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
                                    <td>{{$receipt->serving_mode}}</td>
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
        </div>
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
