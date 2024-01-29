@extends('layouts.staff')
@section('content')
<div class="card" style="height: 80vh;">
    <div class="card-header">
       <a>CLIENTS</a>&nbsp;&nbsp;<i class="fa fa-plus-circle" title="Add Client" data-toggle="modal" data-target="#add_client"></i>
    </div>
    <div class="card-body">
        <div class="container">
        <div class="row">
        <div class="col-xs-12">
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
                            <th>Names</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Points</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($clients as $client)
                          <tr>
                              <td>{{$cnt}}</td>
                              <td>{{$client->firstname}} {{$client->lastname}}</td>
                              <td>{{$client->phone}}</td>
                              <td>{{$client->address}}</td>
                              <td>{{$client->email}}</td>
                              <td>{{$client->points}}</td>
                              <td> 
                                 <i class="fa fa-edit" data-toggle="modal" data-target="#add_client_{{$client->id}}"></i></a>
                                 <i class="fa fa-trash" data-toggle="modal" data-target="#delete-client_{{$client->id}}"></i></a>
                                 <i class="fa fa-eye"></i></a>
                              </td>
                          </tr>
                          @php
                            $cnt++;
                          @endphp

                        <!-- Modal for editting a client--> 
                        <div id="add_client_{{$client->id}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">Edit Client</h4>
                                </div>

                            <div class="modal-body">
                            <form method="post" action="{{ route('update_client','test')}} ">
                            {{ csrf_field() }}
                            @method('put')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="form-field-username">First Name</label>
                                        <div>
                                            <input type="text" name="firstname" value="{{$client->firstname}}" required/>
                                            <input type="hidden" name="client_id" value="{{$client->id}}" required/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="form-field-username">Last Name</label>
                                        <div>
                                            <input type="text" name="lastname" value="{{$client->lastname}}"/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="form-field-username">Phone</label>
                                        <div>
                                            <input type="text" name="phone" value="{{$client->phone}}"/>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="form-field-username">Email</label>
                                        <div>
                                            <input type="text" name="email" value="{{$client->email}}"/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="form-field-username">Region</label>
                                        <div>
                                            <input type="text" name="region" value="{{$client->region}}"/>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="form-field-username">Address</label>
                                        <div>
                                            <textarea name="address">{{$client->address}}</textarea>
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
                        <div id="delete-client_{{$client->id}}" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Delete {{$client->name}}</h4>
                                    </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('delete_client','test')}} ">
                                    {{ csrf_field() }}
                                    {{method_field('delete')}}
                                    <div class="row" align="center">
                                        <p>Are you sure you want to delete this record?</p>
                                        <input type="hidden" name="client_id" value="{{$client->id}}" required/>
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

<!-- Modal for adding a client--> 
<div id="add_client" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Client</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('add_client')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">First Name</label>
                  <div>
                    <input type="text" name="firstname" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Last Name</label>
                  <div>
                    <input type="text" name="lastname"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Phone</label>
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
                  <label for="form-field-username">Email</label>
                  <div>
                    <input type="text" name="email"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Region</label>
                  <div>
                    <input type="text" name="region"/>
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
