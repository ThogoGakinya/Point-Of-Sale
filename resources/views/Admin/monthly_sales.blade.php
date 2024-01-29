@extends('layouts.staff')
@section('content')
        <form method="post" action="{{route('monthlysales')}}">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                    Select Month
                    <select name="month" required>
                        <option value="">Select Month</option>
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>&nbsp;&nbsp;&nbsp;
                    Select Year 
                    @php
                       $current = date('Y');
                       $last = ($current -1);
                       $lastlast = ($current -2);
                    @endphp
                    <select name="year" required>
                        <option value="">Select Year</option>
                        <option value="{{$current}}">{{$current}}</option>
                        <option value="{{$last}}">{{$last}}</option>
                        <option value="{{$lastlast}}">{{$lastlast}}</option>
                    </select>&nbsp;&nbsp;&nbsp;
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
        <h4><strong><a> Monthly Sales Report</a></strong></h4>
        <h6><a> MONTH : </a>{{$month}}</h6>
        <h6><a> YEAR: </a>{{$year}}</h6>
        <h6><a> TOTAL SALES:</a> Ksh.{{$total_receipts}}</h6>
        <a> Report Generated on :</a> {{date("l jS \of F Y h:i:s A")}}  

    </div>
   
            <div class="tabbable" style="background-color: #ffffff;">
                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#home4">ITEMIZED SALES&nbsp;<span class="badge badge-warning">Ksh.{{$total_receipts}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#category">SALES BY CATEGORY&nbsp;<span class="badge badge-warning"></span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#cash">CASH &nbsp;<span class="badge badge-warning">Ksh.{{$total_cash}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#mpesa">M-PESA&nbsp;<span class="badge badge-warning">Ksh.{{$total_mpesa}}</span></a>
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
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Sales</th>
                                    <th>C.O.G</th>
                                    <th>Profit</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $cnt = 1;
                                    $totals = 0;
                                    $total_quantity =0;
                                    $total_cog = 0;
                                    $grand_qty = 0;
                                    $grand_totals = 0;
                                @endphp
                                @foreach($inventories as $inventory)
                                    @foreach($items as $item)
                                        @if($inventory->id == $item->product_id )
                                            @php
                                                $totals += $item->amount;
                                                $total_quantity += $item->quantity;
                                                
                                            @endphp
                                        @endif
                                    @endforeach
                                            <tr>
                                                <td>{{$cnt}}</td>
                                                <td>{{$inventory->name}}</td>
                                                <td>{{$inventory->category->name}}</td>
                                                <td>{{$total_quantity}}</td>
                                                <td>{{$totals}}</td>
                                                <td>{{$inventory->cost * $total_quantity}}</td>
                                                <td>{{$totals - ($inventory->cost * $total_quantity)}}</td>
                                                
                                                
                                                
                                            </tr>
                                       
                                        
                                    @php
                                    $total_cog += $total_quantity * $inventory->cost;
                                    $grand_qty += $total_quantity;
                                    $grand_totals += $totals;
                                    $cnt ++;
                                    $totals = 0;
                                    $total_quantity = 0;
                                    @endphp
                                    
                                @endforeach
                                <tfoot> 
                                <tr>
                                    <td><strong>#</strong></td>
                                    <td><strong>GRAND TOTALS</strong></td>
                                    <td>CATEGORIES</td>
                                    <td><strong>{{$grand_qty}}</strong></td>
                                    <td><strong>{{$grand_totals}}</strong></td>
                                    <td><strong>{{$total_cog}}</strong></td>
                                    <td><strong>{{$grand_totals - $total_cog}}</strong></td>
                                    
                                </tr>
                                </tfoot>
                                </tbody>
                            </table>
                        </div><!-- clossing table responsive -->
                    </div><!-- card -->
                </div>
                <div id="category" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>SALES BY CATEGORY<small><i>(Total sales per category)</i></small></a>
                        </div>
                            @php
                                $cnt = 1;
                                $totals = 0;
                                $total_quantity =0;
                            @endphp
                        <div id="accordion" class="accordion-style1 panel-group">
                        </div>
                    </div><!-- card -->
                </div>
                
        </div>
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
