@extends('layouts.print')
@section('content')
<div class="card">
    <div class="card-header">
       <a href="{{route('home')}}" class="btn btn-default btn-sm">Live Orders</a>
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
