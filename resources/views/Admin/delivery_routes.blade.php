@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <a>DELIVERY ROUTES</a>&nbsp;&nbsp;<i class="fa fa-plus-circle" title="Add Client" data-toggle="modal" data-target="#add_client"></i>
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
                            <th>No.</th>
                            <th>Route Name</th>
                            <th>Charges</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($d_routes as $d_route)
                          <tr>
                              <td>{{$cnt}}</td>
                              <td>{{$d_route->name}}</td>
                              <td>{{$d_route->charges}}</td>
                              <td> 
                                 <i class="fa fa-edit" data-toggle="modal" data-target="#edit_delivery_route_{{$d_route->id}}"></i></a>
                                 <i class="fa fa-trash" data-toggle="modal" data-target="#delete_delivery_route_{{$d_route->id}}"></i></a>
                              </td>
                          </tr>
                          @php
                            $cnt++;
                          @endphp

                        <!-- Modal for editting a client--> 
                        <div id="edit_delivery_route_{{$d_route->id}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">Edit Delivery Route</h4>
                                </div>

                            <div class="modal-body">
                            <form method="post" action="{{ route('update_delivery_route','test')}} ">
                            {{ csrf_field() }}
                            @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="form-field-username">Route Name</label>
                                        <div>
                                            <input type="text" name="routename" class="form-control" value="{{$d_route->name}}" required/>
                                            <input type="hidden" name="delivery_id" value="{{$d_route->id}}" required/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="form-field-username">Charges</label>
                                        <div>
                                            <input type="text" name="charges" value="{{$d_route->charges}}" class="form-control"/>
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
                        <!-- Modal for deleting a client --> 
                        <div id="delete_delivery_route_{{$d_route->id}}" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Delete {{$d_route->name}}</h4>
                                    </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('delete_delivery_route','test')}} ">
                                    {{ csrf_field() }}
                                    {{method_field('delete')}}
                                    <div class="row" align="center">
                                        <p>Are you sure you want to delete this record?</p>
                                        <input type="hidden" name="delivery_id" value="{{$d_route->id}}" required/>
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
</div><!-- clossing card -->

<!-- Modal for adding a delivery route--> 
<div id="add_client" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Delivery Route</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('add_delivery_route')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Route Name</label>
                  <div>
                    <input type="text" name="routename" class="form-control" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Charges</label>
                  <div>
                    <input type="number" name="charges" class="form-control"/>
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
