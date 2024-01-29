@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
        <strong><h6><a> TOTAL SALES TODAY : Ksh.{{$total_receipts}} </a></h6></strong>
        <strong><h6><a> CASH : Ksh. {{$total_cash}}  </a></h6></strong>
        <strong><h6><a> M-PESA :  Ksh. {{$total_mpesa}} </a></h6></strong>
        <strong><h6><a> INVOICES : Ksh.{{$total_invoice}} </a></h6></strong>
       {{date("l jS \of F Y h:i:s A")}}  
    </div>
   
            <div class="tabbable" style="background-color: #ffffff;">
                <ul class="nav nav-tabs padding-12 tab-color-blue background-blue" id="myTab4">
                    <li class="active">
                        <a data-toggle="tab" href="#home4">ITEMIZED SALES&nbsp;<span class="badge badge-warning">{{count($items)}}</span></a>
                        
                    </li>
                         <li>
                        <a data-toggle="tab" href="#items">INVOICES&nbsp;<span class="badge badge-warning">{{count($invoices)}}</span></a>
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
                        <a data-toggle="tab" href="#waiters">AGENTS&nbsp;<span class="badge badge-warning">{{count($waiters)}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#expenses">EXPENSES&nbsp;<span class="badge badge-warning">{{number_format($total_expenses,2)}}</span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#stock">STOCK MOVEMENT&nbsp;<span class="badge badge-warning"></span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#xreport">X REPORT&nbsp;<span class="badge badge-warning"></span></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#voids">VOIDS&nbsp;<span class="badge badge-warning"></span></a>
                    </li>

                </ul>
                @php
                $cnt = 1;
                @endphp
            <div class="tab-content">
                 <div id="items" class="tab-pane">
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
                                    <th>Amount</th>
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
                                    <td>{{$receipt->to_pay}}</td>
                                    <td>{{$receipt->serving_mode}}</td>
                                    <td>{{$receipt->created_at}}</td>
                                    <td><strong>{{$receipt->user->name}}</strong></td>
                                    <td> 
                                        <a href="{{url('/view-invoice/'.$receipt->receipt_no .'/' .$receipt->id)}}"><i class="fa fa-eye"></i></a>
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
                                        <a href="{{url('/view-receipt/'.$receipt->receipt_no .'/' .$receipt->id)}}" ><i class="fa fa-eye"></i></a>
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
                <div id="stock" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>STOCK MOVEMENT <small><i>(Stock History Today)</i></small></a>
                        </div>
                        <div class="table-responsive">
                        <table id="dynamic-table8" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Regular Price</th>
                                    <th>Size</th>
                                    <th>Opening Stock</th>
                                    <th>Sold Quantity</th>
                                    <th>Current Stock</th>
                                    <th>Category</th>
                                    <th>Sold Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $cnt = 1;
                                    $totals = 0;
                                    $total_quantity =0;
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
                                                <td>{{$inventory->regular_price}}</td>
                                                <td>{{$inventory->size->name}}</td>
                                                <td>{{$inventory->instock + $total_quantity}}</td>
                                                <td>{{$total_quantity}}</td>
                                                <td>{{$inventory->instock}}</td>
                                                <td>{{$inventory->category->name}}</td>
                                                <td>{{$totals}}</td>
                                            </tr>
                                       
                                        
                                    @php
                                    $cnt ++;
                                    $totals = 0;
                                    $total_quantity = 0;
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
                <div id="voids" class="tab-pane">
                   <div class="card">
                        <div class="card-header">
                            <a>Recalled Bills<small><i>(Void Payments)</i></small></a>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table4" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receipt No.</th>
                                    <th>Product Name</th>
                                    <th>Product Size</th>
                                    <th>Quantity</th>
                                    <th>Owner</th>
                                    <th>Totals</th>
                                    <th>Serving Mode</th>
                                    <th>Order Time</th>
                                    <th>Recall Time</th>
                                    <th>Recalled By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                @endphp
                                @foreach($voids as $voidss)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$voidss->receipt_no}}</td>
                                    <td>{{$voidss->product->name}}</td>
                                    <td>{{$voidss->product->size->name}}</td>
                                    <td>{{$voidss->quantity}}</td>
                                    <td>{{$voidss->user->name}}</td>
                                    <td>{{number_format($voidss->line_total,2)}}</td>
                                    <td>{{$voidss->mode}}</td>
                                    <td>{{$voidss->order_time}}</td>
                                    <td>{{$voidss->created_at}}</td>
                                    <td>{{$voidss->recall->name}}</td>
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
                        <table id="dynamic-table4" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>@ Price</th>
                                    <th>@ Cost</th>
                                    <th>Total Cost</th>
                                    <th>Tetal Sales</th>
                                    <th>Profit/Loss</th>
                                    <th>View</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $cnt = 1;
                                $total_sales = 0;
                                $total_cost = 0;
                                @endphp
                                @foreach($items as $item)
                                <tr>
                                    @php
                                        $total_sales += $item->amount;
                                        $total_cost += $item->quantity*$item->product->cost;
                                    @endphp
                                    <td>{{$cnt}}</td>
                                    <td>{{$item->product->name}}</td>
                                     <td>{{$item->product->size->name}}</td>
                                     <td>{{$item->category->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{number_format($item->product->regular_price,2)}}</td>
                                    <td>{{number_format($item->product->cost,2)}}</td>
                                    <td>{{number_format($item->quantity*$item->product->cost,2)}}</td>
                                    <td>{{number_format($item->amount,2)}}</td>
                                    <td>{{number_format(($item->amount)-($item->quantity*$item->product->cost),2)}}</td>
                                    <td>
                                      <a href="{{route('product_daily',$item->product_id)}}"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @php
                                $cnt ++;
                                @endphp
                                @endforeach
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                                <tr>
                                    <th colspan="7">GRAND TOTALS</th>
                                    <th>Ksh {{number_format($total_cost,2)}}</th>
                                    <th>Ksh {{number_format($total_receipts,2)}}</th>
                                    <th>Ksh {{number_format($total_receipts - $total_cost,2) }}</th>
                                    <th>{{round(($total_receipts - $total_cost)/$total_cost*100,2)}} %</th>
                                </tr>
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
                <div id="xreport" class="tab-pane">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4><a href="#">Sales v/s Expenditures</a></h4>
                                </div>
                                <div class="card-body">
                                <table id="dynamic-table2" class="customers-actions">
                                    <thead>
                                        <tr>
                                            <th>Today's Float</th>
                                            <td>Ksh. 6,000.00</td>
                                        </tr>
                                        <tr>
                                            <th>Total Sales</th>
                                            <td>Ksh. {{number_format($total_receipts,2)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Cash Box</th>
                                            <td>Ksh. {{number_format($total_receipts + 6000,2)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Expenses</th>
                                            <td>Ksh. {{number_format($total_expenses,2)}}</td>
                                        </tr>
                                        <tr>
                                            <th>Income(<small><i>Sales less expenses</i></small>)</th>
                                            <td>Ksh. {{number_format($total_receipts - $total_expenses,2)}}</td>
                                        </tr>
                                        <tr>
                                            <th>To Bank(<small><i>cashbox-expenses-float</i></small>)</th>
                                            <td>Ksh. {{number_format($total_receipts - $total_expenses,2)}}</td>
                                        </tr>
                                    </thead>
                                </table>
                                </div>
                            </div><!-- card -->
                        </div>
                    </div>
                </div>
        </div>
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
