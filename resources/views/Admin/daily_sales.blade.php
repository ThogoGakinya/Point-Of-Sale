@extends('layouts.staff')
@section('content')
        <form method="post" action="{{route('findbydate')}}">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                    Select Date <input type="date" name="date" required/>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-sm btn-primary" type="submit">
                    <i class="ace-icon fa fa-search"></i>Find
                   </button>
              </div>
          </div>
        </form><br/>
<div class="card">
    <div class="card-header">
        <small>
        <img src="{{asset('assets/images/mojito/scoops.png')}}" alt="mojito" style="margin-left:-50px;"/>
        </small>
        <h4><strong><a> Daily Sales Report</a></strong></h4>
        <h6><a> DATE : </a>{{$date}}</h6>
        <h6><a> TOTAL SALES:</a> Ksh.{{$total_receipts}}</h6>
        <a> Report Generated on :</a> {{date("l jS \of F Y h:i:s A")}}  

    </div>
   
            <div class="tabbable" style="background-color: #ffffff;">
                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#home4">ITEMIZED SALES&nbsp;<span class="badge badge-warning">Ksh.{{$total_receipts}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#cash">CASH &nbsp;<span class="badge badge-warning">Ksh.{{$total_cash}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#mpesa">M-PESA&nbsp;<span class="badge badge-warning">Ksh.{{$total_mpesa}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#waiters">WAITERS&nbsp;<span class="badge badge-warning">{{count($waiters)}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#expenses">EXPENSES&nbsp;<span class="badge badge-warning">{{number_format($total_expenses,2)}}</span></a>
                    </li>

                </ul>
                @php
                $cnt = 1;
                @endphp
            <div class="tab-content">
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
                <div id="expenses" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>EXPENSES <small><i>(Expenses Today)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table7" class="customers-actions">
                            <thead>
                        <tr>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th>Expense Ref.</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Owner</th>
                            <th>Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                        <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                            @foreach($expenses as $expense)
                            <tr>
                                <td class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                                <td>EXP_{{$expense->id}}</td>
                                <td>{{$expense->description}}</td>
                                <td>{{number_format($expense->amount,2)}}</td>
                                <td>{{$expense->user->name}}</td>
                                <td>{{$expense->created_at}}</td>
                                <td> 
                                    <i class="fa fa-eye" data-toggle="modal" data-target="#delete_expense_{{$expense->id}}"></i></a>
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
                <div id="home4" class="tab-pane in active">
                   <div class="card">
                        <div class="card-header">
                            <a>ITEMIZED DAILY SALES<small><i>(Total sales per product)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table2" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                @foreach($items as $item)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->product->size->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>
                                      <a href="{{route('product_daily',$item->product_id)}}"><i class="fa fa-eye"></i></a>
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
                <div id="waiters" class="tab-pane">
                    <div class="row">
                      @foreach($waiters as $waiter)
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4><a href="{{route('waiter_daily',$waiter->user_id)}}"> {{$waiter->user->name}}</a></h4>
                                </div>
                                <div class="card-body">
                                TOTAL SALES : {{$waiter->total}}
                                </div>
                            </div><!-- card -->
                        </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
