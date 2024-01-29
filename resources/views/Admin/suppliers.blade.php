@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <a>SUPPLIERS</a>&nbsp;&nbsp;<i class="fa fa-plus-circle" title="Add supplier" data-toggle="modal" data-target="#add_supplier"></i>
    </div>
 
         <div class="clearfix">
         @php
          $cnt = 1;
        @endphp
         </div>
            <div>
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                            
                            <th>Company Names</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>KRA Pin</th>
                            <th>Products</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($suppliers as $supplier)
                          <tr>
                            
                              <td>{{$supplier->companyname}}</td>
                              <td>{{$supplier->phone}}</td>
                              <td>{{$supplier->address}}</td>
                              <td>{{$supplier->email}}</td>
                              <td>{{$supplier->pin}}</td>
                              <td>{{$supplier->products}}</td>
                              <td> 
                                 <i class="fa fa-edit" data-toggle="modal" data-target="#add_supplier_{{$supplier->id}}"></i></a>
                                 <i class="fa fa-trash" data-toggle="modal" data-target="#delete-supplier_{{$supplier->id}}"></i></a>
                                 <i class="fa fa-eye"></i></a>
                              </td>
                          </tr>
                          @php
                            $cnt++;
                          @endphp

                        <!-- Modal for editting a supplier--> 
                        <div id="add_supplier_{{$supplier->id}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">Edit Supplier</h4>
                                </div>

                            <div class="modal-body">
                            <form method="post" action="{{ route('update_supplier','test')}} ">
                            {{ csrf_field() }}
                            @method('put')
                                <div class="row">
                                   <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form-field-username">Company Name</label>
                                        <div>
                                          <input type="text" name="companyname" value="{{$supplier->companyname}}" required/>
                                          <input type="hidden" name="supplier_id" value="{{$supplier->id}}" required/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form-field-username">Email</label>
                                        <div>
                                          <input type="email" name="email" value="{{$supplier->email}}"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form-field-username">Company Phone</label>
                                        <div>
                                          <input type="number" name="phone" id="mpesa_number" value="{{$supplier->phone}}" oninput="checkMpesaNumber();"/>
                                        </div>
                                        <span id="mpesa_no" style="color:red;"></span>
                                      </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form-field-username">KRA Pin</label>
                                        <div>
                                          <input type="text" name="pin" value="{{$supplier->pin}}"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form-field-username">Address</label>
                                        <div>
                                          <textarea name="address">{{$supplier->address}}</textarea>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="form-field-username">Products</label>
                                        <div>
                                          <textarea name="product">{{$supplier->products}}</textarea>
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
                                    Update
                                    </button>
                                </div>
                                </form>
                            </div>   
                            </div>
                        </div>
                        </div>
                        <!-- Modal for deleting a supplier --> 
                        <div id="delete-supplier_{{$supplier->id}}" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Delete {{$supplier->companyname}}</h4>
                                    </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('delete_supplier','test')}} ">
                                    {{ csrf_field() }}
                                    {{method_field('delete')}}
                                    <div class="row" align="center">
                                        <p>Are you sure you want to delete this record?</p>
                                        <input type="hidden" name="supplier_id" value="{{$supplier->id}}" required/>
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
                            
                          @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->

<!-- Modal for adding a supplier--> 
<div id="add_supplier" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add supplier</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('add_supplier')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Company Name</label>
                  <div>
                    <input type="text" name="companyname" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Email</label>
                  <div>
                    <input type="email" name="email"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Company Phone</label>
                  <div>
                    <input type="number" name="phone" id="mpesa_number" oninput="checkMpesaNumber();"/>
                  </div>
                  <span id="mpesa_no" style="color:red;"></span>
                </div>
              </div>
              
          </div>
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">KRA Pin</label>
                  <div>
                    <input type="text" name="pin"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Address</label>
                  <div>
                    <textarea name="address"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Products</label>
                  <div>
                    <textarea name="product"></textarea>
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
