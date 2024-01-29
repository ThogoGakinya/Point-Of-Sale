@extends('layouts.staff')
@section('content')
<div class="card" style="height: 80vh;">
    <div class="card-header">
       <a>SYSTEM USERS</a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <a  data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add User</a>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr>
                                                <td>{{$cnt}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->level_id}}</td>
                                                <td> 
                                                @if($user->name != "Admnistrator")
                                                    <i class="fa fa-edit" data-toggle="modal" data-target="#edit_user_{{$user->id}}"></i>
                                                    <i class="fa fa-trash" data-toggle="modal" data-target="#delete_user_{{$user->id}}"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                            <!-- Modal for editting a user--> 
                                            <div id="edit_user_{{$user->id}}" class="modal" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="blue bigger">Edit User</h4>
                                                    </div>

                                                <div class="modal-body">
                                                <form method="post" action="{{ route('update_user','test')}} ">
                                                {{ csrf_field() }}
                                                @method('put')
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="form-field-username">User Name</label>
                                                            <div>
                                                            <input type="text" name="username" value="{{$user->name}}" required/>
                                                            <input type="hidden" name="user_id" value="{{$user->id}}" required/>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="form-field-username">Email</label>
                                                            <div>
                                                            <input type="email" name="email" value="{{$user->email}}"/>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="form-field-username">Phone</label>
                                                            <div>
                                                            <input type="number" name="phone" id="mpesa_number" value="{{$user->phone}}" oninput="checkMpesaNumber();"/>
                                                            </div>
                                                            <span id="mpesa_no" style="color:red;"></span>
                                                        </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                        <label for="form-field-username">Level</label>
                                                        <div>
                                                            <select name="level" class="form-control" required>
                                                                <option value="{{$user->level_id}}">{{$user->level_id}}</option>
                                                               <option value="3">Administrator</option>
                                        <option value="1">Agent</option>
                                                            </select>
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
                                            <!-- Modal for deleting a user --> 
                                            <div id="delete_user_{{$user->id}}" class="modal" tabindex="-1">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="blue bigger">Delete {{$user->name}}</h4>
                                                        </div>

                                                    <div class="modal-body">
                                                        <form method="post" action="{{ route('delete_user','test')}} ">
                                                        {{ csrf_field() }}
                                                        {{method_field('delete')}}
                                                        <div class="row" align="center">
                                                            <p>Are you sure you want to delete this record?</p>
                                                            <input type="hidden" name="user_id" value="{{$user->id}}" required/>
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
                                                    @php
                                                    $cnt ++;
                                                    @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                            
                    </div><!--Closing card-body for col 1-->
                </div><!--Closing card for col 1-->

            </div>
            <div class="col-md-6">
                 <div class="card">
                    <div class="card-header">
                        <a>Users Levels Guide</a>
                    </div>
                    
                        <div class="alert alert-success">
							<strong>1 &nbsp;&nbsp;Administrator - </strong>
                                All administrative functions					
						</div>
                        <div class="alert alert-success">
							<strong>2 &nbsp;&nbsp;Manager - </strong>
                                All managerial functions limited to some operations					
						</div>
                        <div class="alert alert-success">
							<strong>3 &nbsp;&nbsp;Cashier - </strong>
                                Can only access POS and Cash Drawer					
						</div>
                        <div class="alert alert-success">
							<strong>4 &nbsp;&nbsp;Agent - </strong>
                                Can only access POS				
						</div>
                    </div><!--Closing card-body for col 2-->
                </div><!--Closing card for col 2-->
            </div>
        </div>
        
   
</div><!-- clossing card -->


<!-- Modal for adding a user--> 
<div id="add_user" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add User</h4>
        </div>

      <div class="modal-body">
        <div id="accordion" class="accordion-style1 panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                        <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                            
                            &nbsp;SYSTEM USER
                        </a>
                    </h4>
                </div>
                <div class="panel-collapse collapse in" id="collapseOne">
                    <div class="panel-body">
                        <form method="post" action="{{ route('add_user')}} ">
                          {{ csrf_field() }}
                          <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">User Name</label>
                                  <div>
                                    <input type="text" name="username" class="form-control" required/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">Email</label>
                                  <div>
                                    <input type="email" name="email" class="form-control" required/>
                                    <input type="hidden" name="password" value="user123"  required/>
                                    <input type="hidden" name="checker"  value="0" class="form-control" required/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">Phone</label>
                                  <div>
                                    <input type="number" class="form-control" name="phone" id="mpesa_number" oninput="checkMpesaNumber();"/>
                                  </div>
                                  <span id="mpesa_no" style="color:red;"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">Level</label>
                                  <div>
                                    <select name="level" class="form-control" required>
                                        <option value="">Select Level</option>
                                        <option value="3">Administrator</option>
                                        <option value="1">Agent</option>
                                    </select>
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;STATION ATTENDANT
                            </a>
                        </h4>
                    </div>
                <div class="panel-collapse collapse" id="collapseThree">
										<div class="panel-body">
                    <form method="post" action="{{ route('add_user')}} ">
                          {{ csrf_field() }}
                          <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">User Name</label>
                                  <div>
                                    <input type="text" name="username" class="form-control" required/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">Email</label>
                                  <div>
                                    <input type="email" name="email" class="form-control" required/>
                                    <input type="hidden" name="password" value="user123"  required/>
                                    <input type="hidden" name="checker"  value="1" class="form-control" required/>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">Phone</label>
                                  <div>
                                    <input type="number" class="form-control" name="phone" id="mpesa_number" oninput="checkMpesaNumber();"/>
                                  </div>
                                  <span id="mpesa_no" style="color:red;"></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="form-field-username">Station</label>
                                  <div>
                                    <select name="level" class="form-control" required>
                                    <option value="">Select Station</option>
                                      @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach
                                    </select>
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
      </div>   
    </div>
  </div>
</div>
@endsection
