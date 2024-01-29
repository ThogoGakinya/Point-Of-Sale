@extends('layouts.staff')
@section('content')
  <div class="row">
        <div class="col-xs-12">
         <div class="clearfix">
            <div class="pull-left tableTools-container"></div>
            <button class="btn btn-white btn-warning btn-xs" title="Add Product" data-toggle="modal" data-target="#add-product">
                <i class="ace-icon fa fa-plus-circle bigger-220 orange"></i>
            </button>
            <strong>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;STOCK VALUE : Ksh. {{number_format($stock_value,2)}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SALE VALUE : Ksh. {{number_format($sale_value,2)}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APPROXIMATE RETURN : Ksh. {{number_format($profit,2)}}
            </strong>
         </div>
            <div class="table-header">
                INVENTORY as at {{date("l jS \of F Y h:i:s A")}}
              
            </div>

            <!-- div.table-responsive -->

            <!-- div.dataTables_borderWrap -->
            <div>
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
                            <th>Cost</th>
                            <th>Instock</th>
                            <th>Size</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($products as $product)
                          <tr>
                              <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                              </td>
                              <td>{{$product->name}}</td>
                              <td>{{number_format($product->regular_price,2)}}</td>
                              <td>{{number_format($product->cost,2)}}</td>
                              <td>{{$product->instock}}</td>
                             
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

                          <!-- Modal for editing a product entry --> 
                            <div id="update-product_{{$product->id}}" class="modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Edit Product</h4>
                                    </div>

                                    <div class="modal-body">
                                    <form method="post" action="{{ route('update-product','test')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('put')
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Product Code</label>
                                            <div>
                                                <input type="text"  name="product_code" value="{{$product->code}}" class="form-control" readonly/>
                                                <input type="hidden"  name="product_id" value="{{$product->id}}" class="form-control"/>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                            <label for="form-field-username">Product Name *</label>
                                            <div>
                                                <input type="text" placeholder="Product Name" name="product_name" class="form-control" value="{{$product->name}}"/>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Category</label>
                                            <div>
                                                <select name="category_id"  class="form-control">
                                                    <option value="{{$product->category_id}}">{{$product->category->name}}</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Unit</label>
                                            <div>
                                                <select name="unit_id"  class="form-control">
                                                    <option value="{{$product->uom_id}}">{{$product->uom->name}}</option>
                                                    @foreach($uoms as $uom)
                                                    <option value="{{$uom->id}}">{{$uom->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Size</label>
                                            <div>
                                                <select name="size_id"  class="form-control">
                                                    <option value="{{$product->size_id}}">{{$product->size->name}}</option>
                                                    @foreach($sizes as $size)
                                                    <option value="{{$size->id}}">{{$size->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        </div> 
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Regular Price</label>
                                            <div>
                                                <input type="text" placeholder="Regular Price" value="{{$product->regular_price}}" name="regular_price" class="form-control"/>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Flavour</label>
                                            <div>
                                                <select name="flavour_id"  class="form-control">
                                                    <option value="{{$product->flavour_id}}">{{$product->flavour_id}}</option>
                                                    @foreach($flavours as $flavour)
                                                    <option value="{{$flavour->id}}">{{$flavour->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Cost Price</label>
                                            <div>
                                                <input type="text" placeholder="Cost Price" value="{{$product->cost}}" name="cost_price" class="form-control"/>
                                            </div>
                                            </div>
                                        </div>
                                        </div> 
                                        <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Quantity</label>
                                            <div>
                                                <input type="text" placeholder="Quantity" name="quantity" value="{{$product->instock}}" class="form-control"/>
                                            </div>
                                            </div>
                                        </div>
                                          <div class="col-sm-4">
                                            <div class="thumbnail search-thumbnail">
                                            <img class="media-object" src="{{asset('scoopsroot/public/Documents/'.$product->image_name)}}"/>
                                           </div>
                                          </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Change Product Image</label>
                                            <div>
                                                <input type="file" name="product_image" class="form-control"/>
                                                <input type="hidden" name="old_product_image" value="{{$product->image_name}}" class="form-control"/>
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

                            <!-- Modal for deleting a product --> 
                            <div id="delete-product_{{$product->id}}" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Delete {{$product->name}}</h4>
                                    </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('delete-product','test')}} ">
                                    {{ csrf_field() }}
                                    {{method_field('delete')}}
                                    <div class="row" align="center">
                                        <p>Are you sure you want to delete this record?</p>
                                        <input type="hidden" name="product_id" value="{{$product->id}}" required/>
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
                            </div></div></div>
                          @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
 <!-- Modal for adding a new product --> 
 <div id="add-product" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add New Product</h4>
        </div>

        <div class="modal-body">
          <form method="post" action="{{ url('/new_product')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
              @php 
                $product_code = rand(1000,9999);
              @endphp
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Product Code</label>
                  <div>
                    <input type="text"  name="product_code" value="{{$product_code}}" class="form-control" readonly/>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="form-field-username">Product Name *</label>
                  <div>
                    <input type="text" placeholder="Product Name" name="product_name" class="form-control"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Category</label>
                  <div>
                    <select name="category_id" id="category_id"  class="form-control category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Sub-Category</label>
                  <div>
                    <select name="flavour_id"  id="flavours" class="form-control"></select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Color</label>
                  <div>
                    <select name="unit_id" id="unit_id" class="form-control unit_id">
                 
                    </select>
                  </div>
                </div>
              </div>
            </div> 
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Size</label>
                  <div>
                    <select name="size_id" id="size_id" class="form-control"></select>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Regular Price</label>
                  <div>
                     <input type="text" placeholder="Regular Price" name="regular_price" class="form-control" value="100"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Price Level 2</label>
                  <div>
                     <input type="text" placeholder="Level 2" name="price_level_2" class="form-control"/>
                  </div>
                </div>
              </div>
            </div> 
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Cost Price</label>
                  <div>
                     <input type="number" placeholder="Cost Price" name="cost_price" class="form-control" value="45"/>
                  </div>
                </div>
              </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Quantity</label>
                  <div>
                     <input type="text" placeholder="Quantity" name="quantity" class="form-control" value="50"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Product Image</label>
                  <div>
                    <input type="file" name="product_image" class="form-control" required/>
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
@endsection
