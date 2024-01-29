@extends('layouts.staff')

@section('content')
    <div class="row">
									<div class="col-sm-7">
										<div class="widget-box">
											<div class="widget-header">
                      <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                          <li>
                          <i class="fa fa-product-hunt" aria-hidden="true"></i>
                          @if($toaster == 0)
                            <a href="#">{{$header}}</a>
                          @elseif($toaster == 1)
                          <a href="{{route('home')}}">Categories</a> / <a href="#">{{$header}}</a>
                          @endif
                          </li>
                         
                        </ul><!-- /.breadcrumb -->

                        <div class="nav-search" id="nav-search">
                          <form class="form-search">
                            <span class="input-icon">
                              <input type="text" placeholder="Search Product" class="nav-search-input" id="nav-search-input" autocomplete="off" />
                              <i class="ace-icon fa fa-search nav-search-icon"></i>
                            </span>
                          </form>
                        </div><!-- /.nav-search -->
                      </div>
                  	</div>

										<div class="widget-body">
											<div class="widget-main">

												<div class="row">
                      @if($toaster == 0)
                        @foreach($categories as $category)
                           <div class="col-sm-4">
                           <a href="{{url ('/category/'.$category->id)}}">
															<div class="thumbnail search-thumbnail">
                                <div class="clearfix" align="center">
                                      <h5><strong>{{$category->name}}</strong></h5>
                                </div>
                                  <img class="media-object" src="{{asset('storage/Images/'.$category->image_name)}}"/>
                                  <div class="caption" align="center">
                                  <strong>In Stock</strong> 30<br/>
                                    <span class="btn btn-info btn-xs tooltip-info" data-rel="tooltip" data-placement="bottom" title="Bottm Info"><i class="ace-icon fa fa-shopping-cart bigger-80"></i>&nbsp;Expand</span>
																 </div>
															</div>
                              </a>
                            </div>
                        @endforeach 
                      @elseif($toaster == 1)
                      <form method="post" action="{{ route('find_product')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="form-field-username">{{$header}}</label>
                                <div>
                                  <select name="flavour_id" class="form-control flavour_id" required>
                                      <option value="">Select Flavour</option>
                                      @foreach($flavours as $flavour)
                                      <option value="{{$flavour->id}}">{{$flavour->name}}</option>
                                      @endforeach
                                  </select>
                                  <input type="hidden" name="category_id" value="{{$category_id}}"/>
                                </div>
                              </div>
                            </div> 
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="form-field-username">Unit</label>
                                <div>
                                  <select name="uom_id"  class="form-control unit_id" id="unit_id" required> 
                                      <option value="">Select Unit</option>
                                      @foreach($uoms as $uom)
                                      <option value="{{$uom->id}}">{{$uom->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                            </div> 
                            <div class="col-md-4 box Scoops_With Slider_Spice">
                              <div class="form-group">
                                <label for="form-field-username">Topping / Spices</label>
                                <div>
                                  <select name="topping_id" id="toppings" class="form-control"></select>
                                </div>
                              </div>
                            </div> 
                            <div class="col-md-3 box Tubs Slider_Regular Single Double Litres Scoops_With Slider_Spice">
                              <div class="form-group">
                                <label for="form-field-username">Size</label>
                                <div>
                                  <select name="size_id"  class="form-control">
                                      <option value="0" selected>Select Size</option>
                                      @foreach($sizes as $size)
                                      <option value="{{$size->id}}">{{$size->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              </div>
                            </div> 
                            <div class="col-md-1" align="center">
                              <div class="form-group">
                                <label for="form-field-username">Find</label>
                                <div>
                                   <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                                </div>
                              </div>
                            </div> 
                          </form>     
                      @endif  
                        </div>
										  </div>
										</div>
                  </div>
                  <hr/>
                @if(count($selected) > 0)
                @foreach($selected as $product)
                  <div class="row">
                  <form method="post" action="{{ route('add_to_cart')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <input type="hidden" name="product_receipt" id="product_name" value="{{$current_receipt}}">
                    <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                    <input type="hidden" name="product_price" id="product_price" value="{{$product->regular_price}}">
                    <input type="hidden" name="category_id" id="product_category" value="{{$product->category_id}}">
                    <div class="col-md-3">
                      <br/><br/><br/><br/><br/><br/><br/>
                    Instock : {{$product->instock}} {{$product->uom->name}}
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-6">
                        <div class="thumbnail search-thumbnail" align="center">
                          <h3 class="search-title">
                              <a href="#" class="blue">{{$product->name}}</a>
                          </h3>
                          <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                               <div class="input-group" >
                                  <span class="input-group-btn">
                                    <button type="button" class="btn btn-warning btn-sm">
                                        QTY
                                    </button>
                                  </span>
                                  <input type="number" name="product_quantity" class="input-small" id="product_quantity" required/>
                                </div>
                              </div>
                            <div class="col-md-3">
                            </div>
                          </div>
                          <img class="media-object" src="{{asset('storage/Images/'.$product->image_name)}}"/>
                          <div class="modal-footer">
                            <a href="{{route('home')}}" class="btn btn-default" data-dismiss="modal">
                              <i class="ace-icon fa fa-times bigger-120"></i>
                              Cancel
                            </a>
                          &nbsp;
                            <button class="btn btn-primary addProduct" type="submit">
                            <i class="ace-icon fa fa-shopping-cart bigger-120"></i>
                            Add to Cart
                            </button>
                          </div>
                        </div>
                     </div>
                    <div class="col-md-3">
                    </div>
                  </form>
                @endforeach 
                @else
                <div class="row">
                    <div class="col-md-3">
  
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-6">
                        <div class="thumbnail search-thumbnail" align="center">
                          <h3 class="search-title">
                              <a href="#" class="blue">Scoops!</a>
                          </h3>
                          Your found product will be displayed here.<br/><br/>
                          <div class="modal-footer" align="center">
                            <a href="{{route('home')}}" class="btn btn-default btn-xs" data-dismiss="modal">
                            << Back
                            </a>
                          </div>
                        </div>
                    </div>
                   
                    <div class="col-md-3">
                    </div>
                @endif
                  </div>
                  </div><!-- /.col -->
                  <div class="col-sm-5">
										<div class="widget-box">
											<div class="widget-header">
												<h4 class="smaller">
                        <i class="ace-icon fa fa-shopping-cart bigger-100"></i>
													Cart  &nbsp;&nbsp;Receipt #{{$current_receipt}}
												</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main">
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
                              <i class="ace-icon fa fa-trash bigger-60" id="deleteEntry" data-id="{{ $product->id }}"></i>
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
                        $all = $tax + $grand_totals;
                      @endphp
                      
                        <tr>
                          <td style="border:none;"></td>
                          <td style="border:none;"></td>
                          <td style="border:none;"><strong>Totals</strong></td>
                          <td colspan="2" width="20%"><strong>Ksh.{{$grand_totals}}</strong></td> 
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
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-purple btn-sm">
                                         To Pay&nbsp;&nbsp;&nbsp;
                                      </button>
                                    </span>
                                    <input type="number" name="to_pay" class="input-small" id="to_pay" readonly/>
                                    <input type="hidden" class="input-small" name="mpesa_number" value=""/>
                                    <input type="hidden" name="mode" class="input-small" value="CASH"/>
                                    <input type="hidden" name="receipt_no" class="input-small" id="receipt_no" value=""/>
                                    <input type="hidden" name="tax" class="input-small" id="receipt_no" value="{{$tax}}"/>
                                    <input style="border:none;" type="hidden" name="total" id="grand_totals" value="{{$grand_totals}}" class="form-control"/> 
                                  </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-purple btn-sm">
                                         Tenderd
                                      </button>
                                    </span>
                                       <input type="number" class="input-small"  value="" id="tenderd" name="tenderd" onkeyup="issue()" required/> 
                                  </div>
                                  <br/><br/>
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-purple btn-sm">
                                         CHANGE
                                      </button>
                                    </span>
                                    <input type="number" class="input-small" value="" id="change" name="change" />
                                  </div>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <button type="submit" class="btn btn-success btn-sm">
                                         Complete
                                      </button> 
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
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-purple btn-sm">
                                         To Pay &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      </button>
                                    </span>
                                    <input type="number" name="to_pay" class="input-small" id="mpesa_to_pay" readonly/>
                                    <input type="hidden" name="mode" class="input-small" value="M-PESA"/>
                                    <input type="hidden" class="input-small" value="0" name="change" />
                                    <input type="hidden" class="input-small" value="0" id="change" name="tenderd" />
                                    <input type="hidden" name="receipt_no" class="input-small" value="{{$current_receipt}}"/>
                                    <input type="hidden" name="tax" class="input-small" value="{{$tax}}"/>
                                    <input style="border:none;" type="hidden" name="total" id="grand_totals" value="{{$grand_totals}}" class="form-control"/> 
                                  </div>
                                  <br/><br/>
                                  <div class="input-group">
                                    <span class="input-group-btn">
                                      <button type="button" class="btn btn-purple btn-sm">
                                         Mpesa No.
                                      </button>
                                    </span>
                                    <input type="text" class="input-small" name="mpesa_number" required/>
                                  </div>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <button type="submit" class="btn btn-success btn-sm">
                                         Initiate
                                      </button>
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
                            <button type="button" class="btn btn-success btn-sm">
                              Process Invoice
                            </button>
													</div>
												</div>
											</div>
										</div>
									</div><!-- /.col -->

												</div>
											</div>
										</div>
									</div><!-- /.col -->
		</div><!-- /.row -->
<!-- Modal for choosen product--> 
<div id="product_popup" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Flavour</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ url('/add_flavour')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text" placeholder="Flavour name" name="flavour_name" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" placeholder="Short form" name="short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Category</label>
                  <div>
                   
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
            Save
            </button>
          </div>
        </form>
      </div>   
    </div>
  </div>
</div>
<!-- Modal for deleting  cart entry --> 
<div id="delete-entry" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Entry</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-flavour','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="flavour_id" id="flavour_id"  value="" required/>
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
@endsection
