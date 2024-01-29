@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header">
        @if($toaster == 0)
        <a href="{{url('home')}}" class="btn btn-default btn-sm">Home</a>@if($mode == 'sit-inn')<a href="{{url('mode/sit-inn')}}" class="btn btn-default btn-sm">{{$mode}}</a>@endif - Categories</>
        @elseif($toaster == 1)
        <a href="{{url('home')}}" class="btn btn-default btn-sm">Home</a> - <a href="{{route('mode',$mode)}}" class="btn btn-default btn-sm">Categories</a> - <a href="#">{{$header}}</a>
        @elseif($toaster == 2)
        <a href="{{url('home')}}" class="btn btn-default btn-sm">Home</a> - {{$mode}}
        @elseif($toaster == 3)
        <a href="{{url('home')}}" class="btn btn-default btn-sm">Home</a> - {{$mode}}
        @elseif($toaster == 4)
        <a href="{{url('home')}}" class="btn btn-default btn-sm">Home</a> - {{$mode}}
        @endif
    </div>
        <div class="card-body">
        @if($toaster == 0)
            @php
                $day_today = date("l");
            @endphp
            <div class="container">
                <div class="row">
                    @foreach($categories as $category)
                        @if($category->status != 2)
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <a href="{{url ('/category/'.$category->id .'/' .$mode)}}">
                                    <div class="thumbnail search-thumbnail">
                                        <div class="clearfix" align="center">
                                                <h4><strong>{{$category->name}}</strong></h4>
                                        </div>
                                        <img class="img-rounded" src="{{asset('scoopsroot/public/Documents/'.$category->image_name)}}" height="100%" width="100%" style="border-radius:5%"/>
                                        <div class="caption" align="center">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div><!-- Ending row -->
            </div><!-- Ending container -->
        @elseif($toaster == 1)
                <div class="row justify-content-center align-items-round">
                    <div class="col-md-6 col-sm-6">
                     <div class="card">
                         <div class="card-header">
                          <a><h4>{{$header}}</h4></a>
                         </div>
                                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Instock</th>
                                            <th>Category</th>
                                            <th>Size</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($inventories as $product)
                                        <tr data-toggle="modal" data-target="#product_{{$product->id}}">
                                            <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->regular_price}}</td>
                                            <td>{{$product->instock}}</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>{{$product->size->name}}</td>
                                            <td>
                                                <a class="green" data-toggle="modal" data-target="#update-product_{{$product->id}}" >
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                                <a class="green" data-toggle="modal" data-target="#delete-product_{{$product->id}}">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </td>	
                                        </tr>
                                        <!--Start of found product modal-->
                                        <div id="product_{{$product->id}}" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="blue bigger">{{strtoupper($product->name)}} {{strtoupper($product->size->name)}}</h4>
                                                </div>
                                            <div class="modal-body">
                                            <form method="post" action="{{ route('add_to_cart')}}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6">
                                                            <input type="hidden" name="product_receipt" id="product_name" value="{{$current_receipt}}">
                                                            <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                                                            <input type="hidden" name="mode" value="{{$mode}}">
                                                            
                                                            <input type="hidden" name="category_id" id="product_category" value="{{$product->category_id}}">
                                                            <input type="hidden" name="all_checker" id="all_checker" value="{{$category_id}}">
                                                            <input type="hidden" name="flavour_id" id="flavour_category" value="{{$product->flavour_id}}">
                                                        <img class="img-rounded" src="{{asset('scoopsroot/public/Documents/'.$product->image_name)}}" height="100%" width="100%" style="border-radius:5%"/>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <div class="form-group"> 
                                                        <div>
                                                        @if(empty($toppings))
                                                            <input type="hidden" class="form-control" name="toppings" value="{{ json_encode($toppings,TRUE) }}" readonly> 
                                                            <input type="hidden" class="form-control" name="toppings_amount" value="0" readonly> 
                                                        @else
                                                            @php
                                                                $toppings_totals = count($toppings)*50;
                                                            @endphp
                                                            Toppings ( {{count($toppings)}} )   <input type="hidden" class="form-control" name="toppings" value="{{ json_encode($toppings,TRUE) }}" readonly> 
                                                            Toppings Amount ( {{$toppings_totals}} /= )   <input type="text" class="form-control" name="toppings_amount" value="{{$toppings_totals}}" readonly> 
                                                        @endif 
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <div>
                                                        <input type="hidden" name="capacity" id="capacity" value="{{strtoupper($product->code)}}" class="form-control" readonly/>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <div>
                                                         <input type="hidden" name="stock" id="product_instock" value="{{$product->instock}}" class="form-control" readonly/>
                                                        </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                        <div>
                                                        <h4>QUANTITY :</h4> <input type="text" onkeyup = Check() style="height:50px;font-size:28pt;" name="product_quantity" id="prod" class="form-control" required/>
                                                        </div>
                                                        </div>
                                                        <div class="form-group">
                                                        <div>
                                                        <h4>PRICE :</h4> 
                                                            <input type="number" name="product_price" id="product_price" value="{{$product->regular_price}}">
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        <!--End of found product modal-->
                                        @endforeach
                                </tbody>
                            </table>
                                 <!-- End of Category table -->
                      </div><!-- Ending card -->
                    </div><!-- Ending first column -->
                    <div class="col-md-6 col-sm-6">
                     <div class="card">
                         <div class="card-header">
                         <a><h4>Current Receipt #{{$current_receipt}}</a> <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_delivery">Add Delivery Charges</button></h4>
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
                                        <i class="ace-icon fa fa-trash bigger-60" data-toggle="modal" data-target="#delete-entry_{{$product->id}}"></i>
                                    </td>
                                </tr>	
                                <!-- Modal for deleting  cart entry --> 
                                        <div id="delete-entry_{{$product->id}}" class="modal" tabindex="-1">
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
                                @if(count($delivery_charges) ==0)
                                    @php
                                        $delivery = 0;
                                    @endphp
                                @else
                                    @foreach($delivery_charges as $dcharges)
                                        @php
                                            $delivery = $dcharges->charges;
                                        @endphp
                                    @endforeach
                                @endif
                                @php
                                $tax = $vat/100*$grand_totals;
                                $without = $grand_totals - $tax;
                                $all = $tax + $without + $delivery;
                                @endphp
                                <tr>
                                    <td colspan="6"></td>
                                </tr>
                                <tr>
                                @foreach($delivery_charges as $dcharges)
                                    <td colspan="3">Delivery to {{$dcharges->route->name}}</td>
                                    <td width="20%"><strong>{{$dcharges->charges}}</strong></td> 
                                    <input style="border:none;" type="hidden" name="receipt_id" id="receipt_id" value="{{$current_receipt}}" class="form-control"/> 
                                    <td>
                                         <i class="ace-icon fa fa-trash bigger-60" data-toggle="modal" data-target="#delete-delivery"></i>
                                    </td>
                                    <!-- Modal for deleting  delivery charges --> 
                                    <div id="delete-delivery" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="blue bigger">Delete Delivery charges for this receipt</h4>
                                                </div>

                                            <div class="modal-body" align="center">
                                                <form method="post" action="{{ route('remove_delivery','test')}} ">
                                                {{ csrf_field() }}
                                                {{method_field('delete')}}
                                                <div class="row" align="center">
                                                    <p>Are you sure you want to delete this entry?</p>
                                                    <input type="hidden" name="delivery_id"  value="{{$dcharges->id}}" required/>
                                                    <input type="hidden" name="serving_mode"  value="{{$mode}}" required/>
                                                    <input type="hidden" name="category_id"  value="{{$category_id}}" required/>
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
                                </tr>
                                
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
                            @if(count($products) != 0)
                            <div id="accordion" class="accordion-style1 panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;CASH
                                            </a>
                                        </h4>
                                    </div>
									<div class="panel-collapse collapse in" id="collapseTwo">
									    <div class="panel-body" align="center">
                                        <button type="submit" data-toggle="modal" data-target="#cash_payment" class="btn btn-success btn-sm"><i class="fa fa-money"></i> CASH</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button type="submit" data-toggle="modal" data-target="#mpesa_payment" class="btn btn-success btn-sm"><i class="fa fa-money"></i> MPESA</button>    
                                    </div>
                                    </div>
                                        <div id="cash_payment" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                     <div class="modal-header">
                                                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                     <h4 class="blue bigger">Cash Payments Only</h4>
                                                    </div>
                                                    <div class="modal-body" align="center">
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
                                        </div>
                                        </div>
                                    </div>
                                </div>
                             <div id="mpesa_payment" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="blue bigger">M-PESA Payment Only</h4>
                                        </div>

                                    <div class="modal-body">
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
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                Mpesa No.
                                                            </button>
                                                            </span>
                                                            <input type="number" id="mpesa_number" oninput="checkMpesaNumber();" class="form-control" name="mpesa_number" value="254" required/>
                                                        </div>
                                                        <span id="mpesa_no" style="color:red;"></span>
                                                    </div><br/> 
                                                    </div>
                                                </div>
                                                <div align="center">
                                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-money"></i> Next</button>
                                                </div><br/>
                                            </form>
                                            </div>   
                                            </div>
                                        </div>
                                        </div>
                                <!-- <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;M-PESA
                                            </a>
                                        </h4>
                                    </div>
                            		<div class="panel-collapse collapse in" id="collapseThree">
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
                                                    <div class="col-md-7">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                Mpesa No.
                                                            </button>
                                                            </span>
                                                            <input type="number" id="mpesa_number" oninput="checkMpesaNumber();" class="form-control" name="mpesa_number" value="254" required/>
                                                        </div>
                                                        <span id="mpesa_no" style="color:red;"></span>
                                                    </div><br/> 
                                                    </div>
                                                </div>
                                                <div align="center">
                                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-money"></i> Next</button>
                                                </div><br/>
                                            </form>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;HOLD TRANSACTION
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="panel-collapse collapse in" id="collapseOne">
                                        <div class="panel-body" align="center">
                                            <form class="form-inline" method="post" action="{{route('order-receipt')}}">
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
                                                Hold
                                                </button>
                                             </form>
                                        </div>
                                    </div>
                                </div>
                            	<div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;ON ACCOUNT
                                            </a>
                                        </h4>
                                    </div>
                                    <div class="panel-collapse collapse" id="collapseFour">
                                        <div class="panel-body">
                                            <form method="post" action="{{route('invoice')}}">
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
                                                <div class="widget-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                Customer Name : 
                                            </div>
                                            <div class="col-lg-4" align="left">
                                              <input type="text"  class="form-control" name="customer_name" id="customer_name" value="" required/>
                                            </div> or 
                                            <div class="col-lg-4" align="left">
                                              <select class="form-control" name="customer_id" id="customer_id">
                                                <option value="">Select Client</option>
                                                @foreach($clients as $client)
                                                 <option value="{{$client->id}}">{{$client->firstname}} {{$client->lastname}}</option>
                                                @endforeach
                                              </select>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                Telephone : 
                                            </div>
                                            <div class="col-lg-9" align="left">
                                              <input type="number"  class="form-control" value="254" name="customer_telephone" id="client_tel" value=""/>
                                            </div>
                                        </div><br/>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                Delivery Address : 
                                            </div>
                                            <div class="col-lg-9" align="left">
                                            <textarea name="customer_delivery_address" class="form-control" rows="4" id="address"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-3">
                                                
                                            </div>
                                            <div style="position: relative; display: block; margin-top: 10px; margin-bottom: 10px;" class="add_customer">
                                                <input name="add_client" class="ace ace-checkbox-2" value="1" type="checkbox"/>
                                                &nbsp;&nbsp;<span class="lbl">&nbsp;&nbsp;Add this customer to client list?</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                
                                            </div>
                                            <div class="col-lg-9" align="left">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                 Process Invoice
                                                </button>
                                            </div>
                                        </div>
                                     </div>
                                               
                                             </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div><!-- Ending payment tabs -->

                        </div><!-- Ending card body -->
                      </div><!-- Ending card -->
                    </div><!-- Ending first column -->
                </div><!-- Ending row -->
        @elseif($toaster == 2) 
            <div class="container">
                <div class="row justify-content-center align-items-round">
                  <div class="col-md-4">
                    <a class="btn btn-default btn-sm" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next Order</a>
                     <button type="button" class="btn btn-success btn-sm" onclick="printContent('to_print')"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
                       <div class="widget-box" id="content">
                            <div class="widget-header">
                            <h4 class="smaller">
                                Receipt&nbsp;&nbsp;
                           </h4>
                            </div>
                            <div class="widget-body">
                <!-- start of new -->
                                <div class="widget-main" id="to_print">
                            <!--<img class="media-object" height="40%" width="40%" src="{{asset('Documents/hwd.jpg')}}"/>-->
                            @foreach($company as $data)
                            <div align="left"style="font-size: 20px;
                                font-family: 'Arial Narrow';">{{strtoupper($data->name)}} </br>{{strtoupper($data->branch)}}
                             </div>
                             <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">TEL 1 :{{strtoupper($data->tel_one)}}
                             </div>
                             <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">TEL 2 :{{strtoupper($data->tel_two)}}
                             </div>
                            <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">
                                     PIN :{{$data->pin}}&nbsp;&nbsp;&nbsp;{{date("j/n/Y")}} {{date("H:i:s")}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">RECEIPT NO :{{strtoupper($request->receipt_no)}} &nbsp;&nbsp;&nbsp;
                             </div>
                            @endforeach
                            <hr/>
                            <div>--------------------------------------------
                            --------------------------------------------</div>
                                <div>
                                    
                                    <table>
                                        
                                        <thead style="background-color:#fff;">
                                        
                                            <tr style="border:none;">
                                                <div align="left">
                                                     <th style="border:none;padding-right: 18px;padding-left:18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">ITEM</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">QTY</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 17px;font-family: 'Arial Narrow';font-family: 'Arial Narrow';">PRICE</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">TOTAL</th>
                                                </div>
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr style="border:none;">
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{strtoupper($item->product->name)}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->quantity}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->product->regular_price}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->line_total}}</td>
                                            </tr>
                                        @endforeach
                                        @if(count($delivery_charges) != 0)
                                            @foreach($delivery_charges as $delivery)
                                            <tr style="border:none;">
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';" colspan="3">Delivery to {{$delivery->route->name}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$delivery->charges}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                          </tbody>
                                    </table> 
                                      <div>--------------------------------------------
                            --------------------------------------------</div>     
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        TOTAL : {{($request->to_pay)-($request->tax)}}.00
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        V.A.T &nbsp;&nbsp;&nbsp;: {{$request->tax}}.00
                                    </div>
                                     <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        GRAND TOTAL : {{$request->to_pay}}.00
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        TENDERD : {{$request->tenderd}}.00
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        CHANGE : {{$request->change}}.00
                                    </div>
                                </div>
                            <hr/>
                            <div>--------------------------------------------
                            -------------------------------------------</div>
                            <div align="left"style="font-size: 20px;
                                     font-family: 'Arial Narrow';"><strong>M-PESA Till No : 9249251</strong></div>
                            <hr/>
                            <div>--------------------------------------------
                            --------------------------------------------</div>
                            <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">MODE : {{$request->mode}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">TOTAL QTY : {{count($items)}}
                            </div>
                             <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">SERVED BY  &nbsp;&nbsp;&nbsp;: {{auth::user()->name}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                    font-family: 'Arial Narrow';"><i>Thank you for enjoying our services.Kindly keep this receipt for<br/>  any product exchange or return. T&C applies</i><br/>
                                <div>------Powerd by Cybrex Systems +254713287641---------------</div>
                            </div>
                        </div><!-- /to print -->
            <!-- End of New -->
                    <div class="col-md-4 capture" style="display:none;" >
                      <button class="btn btn-default btn-sm"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Right click to save this Receipt</button>
                    <div id="receipt_content" class="widget-box" ></div>
                    </div>
                    <div class="col-md-4 whatsapp" style="display:none;">
                    <button class="btn btn-default btn-sm" onclick="closeReceipt()"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</button>
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="smaller">
                                <img class="nav-user-photo" src="{{asset('assets/images/theboozybunch/whatsaap2.png')}}" alt="whatsapp" height="10%" width="10% " />
                                    Open Whatsapp Chat to share Receipt
                                </h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <form method="post" action="{{ url('/whatsapp')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="form-field-username">Whatsapp Number<br/> <small><i>NOTE: Format should be : 254713287654</i></small></label>
                                                <div>
                                                    <input type="number" class="form-control" value="{{$request->mpesa_number}}" name="whatsapp_number" id="whatsappNumber" oninput="checkNumber();" required/>
                                                    <span id="numberChecker" style="color:red;"></span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="form-field-username">Message</label>
                                                <div>
                                                    <textarea name="whatsapp_message" class="form-control" rows="4">Dear Customer,Attached please find your receipt.We thank you for doing bussiness with us.</textarea>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-sm" data-dismiss="modal">
                                            <i class="ace-icon fa fa-times"></i>
                                            Cancel
                                        </button>
                                        <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="ace-icon fa fa-check"></i>
                                           Send
                                        </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Ending row -->
            </div><!-- Ending container -->  
        @elseif($toaster == 3) 
            <div class="container">
                <div class="row justify-content-center align-items-round">
                    <div class="col-md-4 thisinvoice">
                    <a class="btn btn-default btn-sm" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next Order</a>
                    <button class="btn btn-default btn-sm" onclick="getInvoice()"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Click to generate Invoice</button>
                        <div class="widget-box" >
                            <div class="widget-body" id="content">
                            <div class="widget-header" >
                            <h4 class="smaller">
                                INVOICE&nbsp;&nbsp;
                            </h4>
                            </div>
                            <div class="widget-main">
                            <div class="row">
                            <div class="col-md-8">
                             @foreach($company as $data)
                                <strong>{{strtoupper($data->name)}} {{strtoupper($data->branch)}}</strong><br/>
                                <strong>{{$data->address_one}}</strong><br/>
                                <strong>{{$data->tel_one}}</strong><br/>
                                <strong>{{$data->tel_two}}</strong><br/>
                                KRA Pin :{{$data->pin}}<br/>
                                {{date("j/n/Y")}} {{date("H:i:s")}}<br/>
                            @endforeach
                            </div>
                            <div class="col-md-4">
                              <img class="nav-user-photo" src="{{asset('assets/images/mojito/scoops.png')}}" alt="Boozy Logo"  height="65%" width="70%"/>
                            </div>
                            </div>
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
                            @if(count($delivery_charges) != 0)
                                @foreach($delivery_charges as $delivery)
                                    <div class="row">
                                        <div class="col-md-10">Delivery to {{$delivery->route->name}}</div>
                                        <div class="col-md-2">{{$delivery->charges}}</div>
                                    </div>
                                @endforeach
                            @endif
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
                            <div align="center"><strong><h3>MPESA NO : 9249251</h3></strong></div>
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
                    <div class="capture" style="display:none;" >
                        <span class="label label-success arrowed arrowed-right">Please right click anywhere inside the Invoice to download</span><br/>
                        <div id="invoice_content" class="widget-box" ></div>
                    </div>
                    <div class="col-md-4 thisdnote">
                    <a class="btn btn-default btn-sm" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next Order</a>
                    <button class="btn btn-default btn-sm" onclick="getDnote()"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;Click to generate Delivery Note</button>
                        <div class="widget-box" >
                            <div class="widget-body" id="dnote">
                            <div class="widget-header" >
                            <h4 class="smaller">
                                DELIVERY NOTE&nbsp;&nbsp;
                            </h4>
                            </div>
                            <div class="widget-main">
                            <div class="row">
                            <div class="col-md-8">
                             @foreach($company as $data)
                                <strong>{{strtoupper($data->name)}} {{strtoupper($data->branch)}}</strong><br/>
                                <strong>{{$data->address_one}}</strong><br/>
                                <strong>{{$data->tel_one}}</strong><br/>
                                <strong>{{$data->tel_two}}</strong><br/>
                                KRA Pin :{{$data->pin}}<br/>
                                {{date("j/n/Y")}} {{date("H:i:s")}}<br/>
                            @endforeach
                            </div>
                            <div class="col-md-4">
                              <img class="nav-user-photo" src="{{asset('assets/images/theboozybunch/the_boozy.png')}}" alt="Boozy Logo"  height="65%" width="70%"/>
                            </div>
                            </div>
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
                            @if(count($delivery_charges) != 0)
                                @foreach($delivery_charges as $delivery)
                                    <div class="row">
                                        <div class="col-md-10">Delivery to {{$delivery->route->name}}</div>
                                        <div class="col-md-2">{{$delivery->charges}}</div>
                                    </div>
                                @endforeach
                            @endif
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
                            <div align="center"><strong><h3>MPESA NO : 9249251</h3></strong></div>
                            <hr/>
                            <strong>Deliver to :</strong><br/>
                            {{$request->customer_name}}<br/>
                            {{$request->customer_telephone}}<br/>
                            {{$request->customer_delivery_address}}<br/>
                            <br/>
                            Items received in good order and condition
                            <br/>
                            <i>Sign/Date</i>
                            </div><!-- /.col -->
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-md-4 capture_dnote" style="display:none;" >
                        <span class="label label-success arrowed arrowed-right">Please right click anywhere inside the D-Note to download</span><br/>
                        <div id="dnote_content" class="widget-box" ></div>
                    </div>
                    <div class="col-md-4 whatsapp" style="display:none;">
                    <button class="btn btn-default btn-sm" onclick="closeInvoice()"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</button>
                    <a class="btn btn-default btn-sm" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next Order</a>
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="smaller">
                                <img class="nav-user-photo" src="{{asset('assets/images/scoops/whatsaap2.png')}}" alt="whatsapp" height="10%" width="10% " />
                                    Open Whatsapp Chat to share Invoice
                                </h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <form method="post" action="{{ url('/whatsapp')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="form-field-username">Whatsapp Number<br/> <small><i>NOTE: Format should be : 254713287654</i></small></label>
                                                <div>
                                                    <input type="number" class="form-control" value="254" name="whatsapp_number" id="whatsappNumber" oninput="checkNumber();" required/>
                                                    <span id="numberChecker" style="color:red;"></span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                <label for="form-field-username">Message</label>
                                                <div>
                                                    <textarea name="whatsapp_message" class="form-control" rows="4">Dear Customer,Attached please find your invoice.We thank you for doing bussiness with us.</textarea>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button class="btn btn-sm" data-dismiss="modal">
                                            <i class="ace-icon fa fa-times"></i>
                                            Cancel
                                        </button>
                                        <button class="btn btn-sm btn-primary" type="submit">
                                        <i class="ace-icon fa fa-check"></i>
                                           Send
                                        </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
               
                    
                </div><!-- Ending row -->
            </div><!-- Ending container -->  
            @elseif($toaster == 4) 
            <div class="container">
                <div class="row justify-content-center align-items-round">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 col-sm-12" align="center">
                                <a class="btn btn-default btn-sm" href="{{route('home')}}"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;Next Order</a>&nbsp;&nbsp;
                                <button type="button" class="btn btn-success btn-sm" onclick="printContent('to_print')"><i class="fas fa-print"></i>&nbsp;&nbsp;Print</button>
                            </div>
                        </div>
                        <div class="widget-box">
                            <div class="widget-header">
                            <h4 class="smaller">
                                Order Receipt&nbsp;&nbsp;
                            </h4>
                            </div>
                            <div class="widget-body">
                            <div class="widget-main" id="to_print">
                            @foreach($company as $data)
                            <div align="left"style="font-size: 20px;
                                font-family: 'Arial Narrow';">{{strtoupper($data->name)}} {{strtoupper($data->branch)}}
                             </div>
                             <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">TEL 1 :{{strtoupper($data->tel_one)}}
                             </div>
                             <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">TEL 2 :{{strtoupper($data->tel_two)}}
                             </div>
                            <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">
                                     PIN :{{$data->pin}}&nbsp;&nbsp;&nbsp;{{date("j/n/Y")}} {{date("H:i:s")}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">RECEIPT NO :{{strtoupper($request->receipt_no)}} &nbsp;&nbsp;&nbsp;{{strtoupper($request->serving_mode)}}
                             </div>
                            @endforeach
                            <hr/>
                            <div>--------------------------------------------
                            --------------------------------------------</div>
                                <div>
                                    
                                    <table>
                                        
                                        <thead style="background-color:#fff;">
                                        
                                            <tr style="border:none;">
                                                <div align="left">
                                                     <th style="border:none;padding-right: 18px;padding-left:18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">ITEM</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">QTY</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 17px;font-family: 'Arial Narrow';font-family: 'Arial Narrow';">PRICE</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">TOTAL</th>
                                                </div>
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr style="border:none;">
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{strtoupper($item->product->name)}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->quantity}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->product->regular_price}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->line_total}}</td>
                                            </tr>
                                        @endforeach
                                        
                                        @if(count($delivery_charges) != 0)
                                            @foreach($delivery_charges as $delivery)
                                            <tr style="border:none;">
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';" colspan="3">Delivery to {{$delivery->route->name}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$delivery->charges}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                          </tbody>
                                    </table> 
                                      <div>--------------------------------------------
                            --------------------------------------------</div>     
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        TOTAL : {{$request->total}}.00</strong>
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        V.A.T &nbsp;&nbsp;&nbsp;: {{$request->tax}}.00</strong>
                                    </div>
                                     <div align="left"style="font-size: 20px;
                                     font-family: 'Arial Narrow';"><strong>
                                        *GRAND TOTAL* : {{$request->to_pay}}.00</strong>
                                    </div>
                                     
                                </div>
                            <hr/>
                            <div>--------------------------------------------
                            -------------------------------------------</div>
                            <div align="left"style="font-size: 20px;
                                     font-family: 'Arial Narrow';"><strong>M-PESA Till No : 9249251</strong></div>
                            <hr/>
                            <div>--------------------------------------------
                            --------------------------------------------</div>
                            <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">MODE : {{$request->mode}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">TOTAL QTY : {{count($items)}}
                            </div>
                             <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">SERVED BY  &nbsp;&nbsp;&nbsp;: {{auth::user()->name}}
                            </div>
                              <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';"><i>Thank you for enjoying our services.Kindly keep this receipt for any product <br> exchange or return. T&C applies</i><br/>
                                    <div>-------------Powerd by Cybrex Systems +254713287641------------<div>
                            </div>
                            </div><!-- /.col -->
                            </div>
                        </div>
                    </div>
                
               
                    
                </div><!-- Ending row -->
            </div><!-- Ending container -->  
        @endif

        </div><!-- Ending card body -->
    </div><!-- Ending header -->
</div><!-- Ending card -->
<!-- Modal for adding a delivery charge--> 
<div id="add_delivery" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Delivery Charges for Receipt #{{$current_receipt}}</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('add_delivery_charges')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="form-field-username">Delivery Route</label>
                  <div>
                    <input type="text" name="routename" id="route_name" class="form-control" required/>
                    <input type="hidden" name="receipt_id" id="receipt_id" value="{{$current_receipt}}" class="form-control" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="form-field-username"></label>
                  <div align="center">
                    <strong>OR</strong>
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="form-field-username">Select Route</label>
                  <div>
                       <select class="form-control" name="route_id" id="route_id">
                            <option value="">Select Route</option>
                            @foreach($delivery_routes as $route)
                                <option value="{{$route->id}}">{{$route->name}}</option>
                            @endforeach
                        </select>
                  </div>
                  <span id="mpesa_no" style="color:red;"></span>
                </div>
              </div>
              
          </div>
          <div class="row">
              <div class="col-md-5">
                <div class="form-group">
                  <label for="form-field-username">Charges (Ksh)</label>
                  <div>
                    <input type="number" name="charges" id="charges" class="form-control"/>
                    <input type="hidden" name="serving_mode" class="input-small" value="{{$mode}}"/>
                    <input type="hidden" name="category_id" class="input-small" value="{{$category_id}}"/>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="form-field-username"></label>
                  <div align="center">
                   
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="form-field-username"></label>
                  <div>
                        
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label for="form-field-username"></label>
                  <div class="add_to_list">
                        <input name="add_route" class="ace ace-checkbox-2" value="1" type="checkbox" checked/>
                        &nbsp;&nbsp;<span class="lbl">&nbsp;&nbsp;Add this route to routes list?</span>
                  </div>
                </div>
              </div>
              
          </div>
          
          <div class="modal-footer">
            <button class="btn btn-sm" data-dismiss="modal">
              <i class="ace-icon fa fa-times"></i>
              Cancel
            </button>
            <button class="btn btn-sm btn-primary" type="submit">
            <i class="ace-icon fa fa-check"></i>
              Next
            </button>
          </div>
        </form>
      </div>   
    </div>
  </div>
</div>
@endsection
