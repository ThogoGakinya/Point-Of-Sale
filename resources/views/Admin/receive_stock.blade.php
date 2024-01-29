@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <a>RECEIVE STOCK</a>
    </div>
         <div class="clearfix">
            
         </div>
            <div>
            <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Cost</th>
                            <th>Size</th>
                            <th>In-Stock</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    @php
                       $cnt = 1;
                    @endphp
                    <tbody>
                          @foreach($stocks as $stock)
                          <tr>
                              <td>{{$cnt}}</td>
                              <td>{{$stock->name}}</td>
                              <td>{{$stock->regular_price}}</td>
                              <td>{{$stock->cost}}</td>
                              <td>{{$stock->size->name}}</td>
                                @if($stock->instock <= $stock->base_stock)
                                  <td style="background-color:red;" title="Below base stock">{{$stock->instock}}</td>
                                @else
                                  <td>{{$stock->instock}}</td>
                                @endif
                              <td>
                                <a class="green" data-toggle="modal" data-target="#update-stock_{{$stock->id}}" >
                                   <i class="ace-icon fa fa-plus bigger-130"></i>
                                </a>
                                <a class="green" href="{{url('/product/history/'.$stock->id)}}">
                                    <i class="fa fa-eye bigger-130" title="View product History"></i>
                                </a>
                              </td>	
                          </tr>

                          <!-- Modal for editing a stock entry --> 
                            <div id="update-stock_{{$stock->id}}" class="modal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">{{$stock->name}}</h4>
                                    </div>

                                    <div class="modal-body">
                                    <form method="post" action="{{ route('update_stock','test')}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('put')
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Regular Price</label>
                                            <div>
                                                <input type="text" placeholder="Regular Price" value="{{$stock->regular_price}}" name="regular_price" class="form-control"/>
                                                <input type="hidden" placeholder="Regular Price" value="{{$stock->id}}" name="stock_id" class="form-control"/>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Price Level 2</label>
                                            <div>
                                                <input type="text" placeholder="Level 2" name="price_level_2" value="{{$stock->price_level2}}" class="form-control"/>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Cost Price Each</label>
                                            <div>
                                                <input type="text" placeholder="Cost Price" name="cost_price" value="{{$stock->cost}}" class="form-control"/>
                                            </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">In-Stock</label>
                                            <div>
                                                <input type="text" name="instock" value="{{$stock->instock}}" class="form-control" readonly/>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="form-field-username">Quantity to add</label>
                                            <div>
                                                <input type="text" name="quantity" value="" class="form-control" required/>
                                            </div>
                                            </div>
                                        </div>
                                          <div class="col-sm-4">
                                            <div class="thumbnail search-thumbnail">
                                            <img class="media-object" src="{{asset('scoopsroot/public/Documents/'.$stock->image_name)}}"/>
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
                            @php
                             $cnt++;
                            @endphp
                          @endforeach
                    </tbody>
                </table>
            </div>
   
</div><!-- clossing card -->
@endsection
