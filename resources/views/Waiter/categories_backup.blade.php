@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header">
        @if($toaster == 0)
        <a href="{{url('home')}}">Home</a>@if($mode == 'sit-inn')<a href="{{url('mode/sit-inn')}}">{{$mode}}</a>@endif/Categories</>
        @elseif($toaster == 1)
        <a href="{{url('home')}}">Home</a>/<a href="{{route('mode',$mode)}}">Categories</a> / <a href="#">{{$header}}</a>
        @elseif($toaster == 2)
        <a href="{{url('home')}}">Home</a>/{{$mode}}
        @elseif($toaster == 3)
        <a href="{{url('home')}}">Home</a>/{{$mode}}
        @endif
    </div>
        <div class="card-body" style="background-image: url('{{asset('assets/images/mojito/texture_bg.jpg')}}');">
        @if($toaster == 0)
            <div class="container">
                <div class="row justify-content-center align-items-round">
                @foreach($categories as $category)
                    <div class="col-md-3">
                        <a href="{{url ('/category/'.$category->id .'/' .$mode)}}">
                            <div class="thumbnail search-thumbnail">
                                <div class="clearfix" align="center">
                                        <h4><strong>{{$category->name}}</strong></h4>
                                </div>
                                <img class="media-object" src="{{asset('storage/Images/'.$category->image_name)}}"/>
                                <div class="caption" align="center">
                                <button class="btn btn-primary btn-sm">Expand</button>
                                
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div><!-- Ending row -->
            </div><!-- Ending container -->
        @elseif($toaster == 1)
                <div class="row justify-content-center align-items-round">
                    <div class="col-md-6">
                     <div class="card" style="height: 81.5vh;">
                         <div class="card-header">
                          <a><h4>{{$header}}</h4></a>
                         </div>
                         <div class="card-body">
                            <form method="post" action="{{ route('find_product')}}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Flavours</label>
                                        <div>
                                        <select name="flavour_id" class="form-control flavour_id" required>
                                            <option value="">Select Flavour</option>
                                            @foreach($flavours as $flavour)
                                            <option value="{{$flavour->flavour_id}}">{{$flavour->flavour->name}}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="category_id" value="{{$category_id}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form-field-username">Unit</label>
                                        <div>
                                        <select name="uom_id"  class="form-control unit_id" id="unit_id" required> 
                                        @if(count($uoms) == 1)
                                            @foreach($uoms as $uom)
                                            <option value="{{$uom->id}}" selected>{{$uom->name}}</option>
                                            @endforeach
                                        @else
                                            <option value="">Select Unit</option>
                                            @foreach($uoms as $uom)
                                            <option value="{{$uom->id}}">{{$uom->name}}</option>
                                            @endforeach
                                        @endif
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 box Scoops_With Slider_Spice">
                                    <div class="form-group">
                                       <label for="form-field-username">Toppings/Spices</label>
                                       <div class="checkbox" id="toppings">
                                        
                                        </div>
                                    </div>
                                </div> 
                                  
                                <div class="col-md-6 box Tubs Slider_Regular Single Double Litres Scoops_With Slider_Spice">
                                    <div class="form-group">
                                        <label for="form-field-username">Size</label>
                                        <div>
                                        <select name="size_id"  class="form-control">
                                            <option value="0" selected>Regular</option>
                                            @foreach($sizes as $size)
                                            <option value="{{$size->id}}">{{$size->name}}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>
                                </div> <br/><br/>
                            <div class="col-md-12" align="center">
                                <div class="form-group">
                                    <div>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp;Find</button>
                                    <input type="hidden" name="mode" value="{{$mode}}">
                                    <input type="hidden" class="popup_trigger" id="popup_trigger" value="{{$popup_trigger}}">
                                    </div>
                                </div>
                           </div>   
                            </form> 
                        </div><!-- Ending card body -->
                      </div><!-- Ending card -->
                    </div><!-- Ending first column -->
                    <div class="col-md-6">
                     <div class="card" style="min-height: 100px; overflow: hidden;">
                         <div class="card-header">
                         <a><h4>Current Receipt #{{$current_receipt}}</h4></a>
                         </div>
                         <div class="card-body">
                            <table id="simple-table" class="table  table-bordered table-hover">
                              <thead>
                                <tr>
                                    <th>Product</th>
                                     <th>Qty</th>
                                    <th>Cost @</th>
                                    <th>Tot</th>
                                    <th>Del</th>
                                </tr>
                              </thead>
                              <tbody class="cart">
                                @php
                                    $grand_totals =0;
                                @endphp
                                @foreach($products as $product)
                                    @php
                                    $grand_totals += $product->line_total;
                                    @endphp
                                                        <tr>
                                    <td>{{$product->product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                    <td>{{$product->product->regular_price}}</td>
                                    <td>{{$product->line_total}}</td>
                                    <td>
                                        <i class="ace-icon fa fa-trash bigger-60" data-toggle="modal" data-target="#delete-entry"></i>
                                    </td>
                                </tr>	
                                <!-- Modal for deleting  cart entry --> 
                                <div id="delete-entry" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="blue bigger">Delete Entry</h4>
                                                </div>

                                            <div class="modal-body">
                                                <form method="post" action="{{ route('remove_from_cart','test')}} ">
                                                {{ csrf_field() }}
                                                {{method_field('delete')}}
                                                <div class="row" align="center">
                                                    <p>Are you sure you want to delete this entry?</p>
                                                    <input type="hidden" name="product_id"  value="{{$product->id}}" required/>
                                                    <input type="hidden" name="serving_mode"  value="{{$mode}}" required/>
                                                    <input type="hidden" name="category_id"  value="{{$category_id}}" required/>
                                                    <input type="hidden" name="receipt_id"  value="{{$current_receipt}}" required/>
                                                    <input type="hidden" name="line_total"  value="{{$product->line_total}}" required/>
                                                    <input type="hidden" name="product_quantity"  value="{{$product->quantity}}" required/>
                                                    <input type="hidden" name="inventory_id"  value="{{$product->product_id}}" required/>
                                                </div><br/>
                                                <div class="row" align="right">
                                                    <button class="btn btn-sm" data-dismiss="modal">
                                                        <i class="ace-icon fa fa-times"></i>
                                                        Cancel
                                                    </button>&nbsp;&nbsp;
                                                    <button class="btn btn-sm btn-warning" type="submit">
                                                    <i class="ace-icon fa fa-trash"></i>
                                                    Delete
                                                    </button>
                                                <div>
                                                </form>
                                            </div>
                                            </div> 
                                            </div> 
                                        </div>
                                @endforeach
                                </tbody>
                                <tfoot>
                                
                                @foreach($company as $data)
                                @php
                                    $vat = $data->vat;
                                @endphp
                                @endforeach
                                @php
                                $tax = $vat/100*$grand_totals;
                                $without = $grand_totals - $tax;
                                $all = $tax + $without;
                                @endphp
                                
                                <tr>
                                    <td style="border:none;"></td>
                                    <td style="border:none;"></td>
                                    <td style="border:none;"><strong>Totals</strong></td>
                                    <td colspan="2" width="20%"><strong>Ksh.{{$without}}</strong></td> 
                                    <input style="border:none;" type="hidden" name="receipt_id" id="receipt_id" value="{{$current_receipt}}" class="form-control"/> 
                                </tr>
                                <tr>
                                    <td style="border:none;"></td>
                                    <td style="border:none;"></td>
                                    <td style="border:none;"><strong>Tax</strong></td>
                                    <td colspan="2" width="20%"><strong>Ksh.{{$tax}}</strong></td> 
                                </tr>
                                <tr>
                                    <td style="border:none;"></td>
                                    <td style="border:none;"></td>
                                    <td style="border:none;"><strong>Grand Total</strong></td>
                                    <input style="border:none;" type="hidden" name="grand_totals" id="grand_totals" value="{{$all}}" class="form-control"/> 
                                    <td colspan="2" width="20%"><strong>Ksh.{{$all}}</strong></td> 
                                </tr>
                                </tfoot>
                            </table>
                            <br/>
                            <div class="widget-header">
								<h4 class="widget-title">
								<i class="ace-icon fa fa-money"></i>
                                 PAYMENT
                                </h4>
							</div>
                            <div id="accordion" class="accordion-style1 panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;CASH
                                            </a>
                                        </h4>
                                    </div>
									<div class="panel-collapse collapse in" id="collapseOne">
									    <div class="panel-body">
                                            <form class="form-inline" method="post" action="{{route('complete_transaction')}}">
                                              {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                To Pay&nbsp;&nbsp;&nbsp;
                                                            </button>
                                                        </span>
                                                        <input type="number" name="to_pay" class="form-control" id="to_pay" readonly/>
                                                        <input type="hidden" class="input-small" name="mpesa_number" value=""/>
                                                        <input type="hidden" name="mode" class="input-small" value="CASH"/>
                                                        <input type="hidden" class="input-small" value="1" name="status" />
                                                        <input type="hidden" name="serving_mode" class="input-small" value="{{$mode}}"/>
                                                        <input type="hidden" name="receipt_no" class="input-small" id="receipt_no" value=""/>
                                                        <input type="hidden" name="tax" class="input-small" id="receipt_no" value="{{$tax}}"/>
                                                        <input style="border:none;" type="hidden" name="total" id="grand_totals" value="{{$grand_totals}}" class="form-control"/> 
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                     <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                Tenderd
                                                            </button>
                                                         </span>
                                                         <input type="number" class="form-control"  value="" id="tenderd" name="tenderd" onkeyup="issue()" required/> 
                                                      </div> 
                                                    </div>
                                                    <div class="col-md-6">.</div>
                                                    <div class="col-md-6">.</div>
                                                    <div class="col-md-6">
                                                      <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                CHANGE
                                                            </button>
                                                        </span>
                                                        <input type="number" class="form-control" value="" id="change" name="change" readonly/>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Complete
                                                        </button>
                                                    </div>
                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;M-PESA
                                            </a>
                                        </h4>
                                    </div>
                            		<div class="panel-collapse collapse" id="collapseTwo">
										<div class="panel-body">
                                            <form class="form-inline" method="post" action="{{route('complete_transaction')}}">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                To Pay &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </button>
                                                            </span>
                                                            <input type="number" name="to_pay" class="form-control" id="mpesa_to_pay" readonly/>
                                                            <input type="hidden" name="mode" class="input-small" value="M-PESA"/>
                                                            <input type="hidden" class="input-small" value="0" name="change" />
                                                            <input type="hidden" class="input-small" value="1" name="status" />
                                                            <input type="hidden" name="serving_mode" class="input-small" value="{{$mode}}"/>
                                                            <input type="hidden" class="input-small" value="0" id="change" name="tenderd" />
                                                            <input type="hidden" name="receipt_no" class="input-small" value="{{$current_receipt}}"/>
                                                            <input type="hidden" name="tax" class="input-small" value="{{$tax}}"/>
                                                            <input style="border:none;" type="hidden" name="total" id="grand_totals" value="{{$grand_totals}}" class="form-control"/> 
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                Mpesa No.
                                                            </button>
                                                            </span>
                                                            <input type="text" class="form-control" name="mpesa_number" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Initiate
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            	<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;ON ACCOUNT
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="collapseThree">
                                        <div class="panel-body">
                                            <form class="form-inline" method="post" action="{{route('invoice')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="to_pay" class="form-control" id="invoice_to_pay" readonly/>
                                                <input type="hidden" name="mode" class="input-small" value="on-account"/>
                                                <input type="hidden" class="input-small" value="0" name="change" />
                                                <input type="hidden" name="serving_mode" class="input-small" value="{{$mode}}"/>
                                                <input type="hidden" class="input-small" value="0" name="tenderd" />
                                                <input type="hidden" class="input-small" value="0" name="change" />
                                                <input type="hidden" class="input-small" value="0" name="status" />
                                                <input type="hidden" name="receipt_no" class="input-small" value="{{$current_receipt}}"/>
                                                <input type="hidden" name="tax" class="input-small" value="{{$tax}}"/>
                                                <input style="border:none;" type="hidden" name="total" id="grand_totals" value="{{$grand_totals}}" class="form-control"/> 
                                              <button type="submit" class="btn btn-success btn-sm">
                                                Process Invoice
                                                </button>
                                             </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Ending payment tabs -->

                        </div><!-- Ending card body -->
                      </div><!-- Ending card -->
                    </div><!-- Ending first column -->
                </div><!-- Ending row -->
        @elseif($toaster == 2) 
            <div class="container">
                <div class="row justify-content-center align-items-round">
                    <div class="col-md-4">
                        <div class="widget-box">
                            <div class="widget-header">
                            <h4 class="smaller">
                                Receipt&nbsp;&nbsp;
                                <a class="green" data-toggle="modal" data-target="#add-uom"><i class="fa fa-print" title="Print Receipt"></i></a>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-default btn-xs" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                                &nbsp;Next Customer</a>
                                <button class="btn btn-default btn-xs" onclick="saveReceipt({{$request->receipt_no}})">Download</button>
                            </h4>
                            </div>
                            <div class="widget-body">
                            <div class="widget-main">
                            @foreach($company as $data)
                            <div align="left"><strong>{{strtoupper($data->name)}} {{strtoupper($data->branch)}}</strong></div>
                            <div align="left"><strong>{{$data->address_one}}</strong></div>
                            <div align="left"><strong>{{$data->tel_one}}</strong></div>
                            <div align="left"><strong>{{$data->tel_two}}</strong></div>
                            <div align="left">KRA Pin :{{$data->pin}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{date("j/n/Y")}} {{date("H:i:s")}}</div>
                            <div align="left">Receipt No : {{$request->receipt_no}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                           {{$request->serving_mode}}</div>
                            @endforeach
                            <hr/>
                            <div class="row">
                                <div class="col-md-6"><strong>Item</strong></div>
                                <div class="col-md-2"><strong>Qty</strong></div>
                                <div class="col-md-2"><strong>Each</strong></div>
                                <div class="col-md-2"><strong>Total</strong></div>
                            </div><br/>
                            @foreach($items as $item)
                            <div class="row">
                                <div class="col-md-6">{{$item->product->name}}</div>
                                <div class="col-md-2">{{$item->quantity}}</div>
                                <div class="col-md-2">{{$item->product->regular_price}}</div>
                                <div class="col-md-2">{{$item->line_total}}</div>
                            </div>
                            @endforeach
                            <hr/>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>TOTAL :</strong></div>
                                <div class="col-md-2"><strong>{{$request->total}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>VAT:</strong></div>
                                <div class="col-md-2"><strong>{{$request->tax}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>GRAND TOTAL :</strong></div>
                                <div class="col-md-2"><strong>{{$request->to_pay}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>TENDERD :</strong></div>
                                <div class="col-md-2"><strong>{{$request->tenderd}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>CHANGE :</strong></div>
                                <div class="col-md-2"><strong>{{$request->change}}</strong></div>
                            </div>
                            <hr/>
                            <div align="center"><strong><h3>MPESA NO : 711674</h3></strong></div>
                            <hr/>
                            <strong>MODE : {{$request->mode}}</strong><br/>
                            Total Qty : {{count($items)}}<br/>
                            Cashier &nbsp;&nbsp;&nbsp;: {{auth::user()->name}}<br/>
                            Receipt Ref: #{{$request->receipt_no}}
                            <br/> <br/>
                            <i>Thank you for shopping.Kindly keep this receipt for any product exchange or return. T&C applies</i>
                            <br/>
                            </div><!-- /.col -->
                            </div>
                        </div>
                    </div>
                </div><!-- Ending row -->
            </div><!-- Ending container -->  
        @elseif($toaster == 3) 
            <div class="container">
                <div class="row justify-content-center align-items-round">
                    <div class="col-md-4">
                    <a class="btn btn-default btn-sm" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next Order</a>
                      
                        <div class="widget-box" id="content">
                            <div class="widget-header">
                            <h4 class="smaller">
                                Invoice&nbsp;&nbsp;
                            </h4>
                            </div>
                            <div class="widget-body">
                            <div class="widget-main">
                            @foreach($company as $data)
                            <div align="left"><strong>{{strtoupper($data->name)}} {{strtoupper($data->branch)}}</strong></div>
                            <div align="left"><strong>{{$data->address_one}}</strong></div>
                            <div align="left"><strong>{{$data->tel_one}}</strong></div>
                            <div align="left"><strong>{{$data->tel_two}}</strong></div>
                            <div align="left">KRA Pin :{{$data->pin}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{date("j/n/Y")}} {{date("H:i:s")}}</div>
                            <div align="left">Receipt No : {{$request->receipt_no}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                           {{$request->serving_mode}}</div>
                            @endforeach
                            <hr/>
                            <div class="row">
                                <div class="col-md-6"><strong>Item</strong></div>
                                <div class="col-md-2"><strong>Qty</strong></div>
                                <div class="col-md-2"><strong>Each</strong></div>
                                <div class="col-md-2"><strong>Total</strong></div>
                            </div><br/>
                            @foreach($items as $item)
                            <div class="row">
                                <div class="col-md-6">{{$item->product->name}}</div>
                                <div class="col-md-2">{{$item->quantity}}</div>
                                <div class="col-md-2">{{$item->product->regular_price}}</div>
                                <div class="col-md-2">{{$item->line_total}}</div>
                            </div>
                            @endforeach
                            <hr/>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>TOTAL :</strong></div>
                                <div class="col-md-2"><strong>{{$request->total}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>VAT:</strong></div>
                                <div class="col-md-2"><strong>{{$request->tax}}</strong></div>
                            </div>
                            <div class="row">
                                <div class="col-md-10" align="right"><strong>GRAND TOTAL :</strong></div>
                                <div class="col-md-2"><strong>{{$request->to_pay}}</strong></div>
                            </div>
                            <hr/>
                            <div align="center"><strong><h3>MPESA NO : 711674</h3></strong></div>
                            <hr/>
                            <strong>MODE : {{$request->mode}}</strong><br/>
                            Total Qty : {{count($items)}}<br/>
                            Cashier &nbsp;&nbsp;&nbsp;: {{auth::user()->name}}<br/>
                            Receipt Ref: #{{$request->receipt_no}}
                            <br/> <br/>
                            <i>Thank you for shopping.Kindly keep this receipt for any product exchange or return. T&C applies</i>
                            <br/>
                            </div><!-- /.col -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" ><button class="btn btn-default btn-sm" onclick="getReceipt()"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Click on this button to get a screenshot of this Receipt</button>
                    <br/>
                    <div id="receipt_content"></div>
                    </div>
               
                    
                </div><!-- Ending row -->
            </div><!-- Ending container -->  
        @endif

        </div><!-- Ending card body -->
    </div><!-- Ending header -->
</div><!-- Ending card -->


  <!-- Modal found product--> 
<div id="product" class="modal" tabindex="-1">
    @foreach($selected as $product)
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">{{strtoupper($product->name)}}</h4>
        </div>

      <div class="modal-body">
      <form method="post" action="{{ route('add_to_cart')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
         <div class="row">
              <div class="col-md-6">
                    <input type="hidden" name="product_receipt" id="product_name" value="{{$current_receipt}}">
                    <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                    <input type="hidden" name="mode" value="{{$mode}}">
                    <input type="hidden" name="product_price" id="product_price" value="{{$product->regular_price}}">
                    <input type="hidden" name="category_id" id="product_category" value="{{$product->category_id}}">
                    <input type="hidden" name="flavour_id" id="flavour_category" value="{{$product->flavour_id}}">
                 <img class="media-object" src="{{asset('storage/Images/'.$product->image_name)}}" height="100%" width="100%" style="border-radius:5%"/>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <div>
                  @if(empty($toppings))
                     Toppings : <input type="text" class="form-control" name="toppings" value="{{ json_encode($toppings,TRUE) }}" readonly> 
                  @else
                     Toppings ( {{count($toppings)}} )   <input type="text" class="form-control" name="toppings" value="{{ json_encode($toppings,TRUE) }}" readonly> 
                  @endif  
                  </div>
                </div>
                <div class="form-group">
                  <div>
                   Product Code : <input type="text" name="capacity" id="capacity" value="{{strtoupper($product->code)}}" class="form-control" readonly/>
                  </div>
                </div>
                <div class="form-group">
                  <div>
                    In-Stock : <input type="text" name="capacity" id="quantity" value="{{strtoupper($product->instock)}}" class="form-control" readonly/>
                  </div>
                </div>
                <div class="form-group">
                  <div>
                    QUANTITY : <input type="number" name="product_quantity" id="product_quantity" class="form-control" required/>
                  </div>
                </div>
              </div>
          </div>
          @endforeach
          <div class="modal-footer">
              <button class="btn btn-sm" data-dismiss="modal">
                <i class="ace-icon fa fa-times"></i>
                Cancel
              </button>
              <button class="btn btn-sm btn-primary addProduct" type="submit">
              <i class="ace-icon fa fa-shopping-cart bigger-120"></i>
              Add to Cart
              </button>
          </div>
        </form>
      </div>
      </div> 
    </div> 
  </div>

@endsection
