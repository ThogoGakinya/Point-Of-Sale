@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
    <a>OPERATION ACCOUNTS</a>&nbsp;&nbsp;<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_account"><i class="fa fa-plus-circle" title="Add account"></i> Add</button>
    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#transfer"><i class="fa fa-plus-circle" title="Inter-Account Transfer"></i> Inter-Account Transfer</button>
    </div>
         <div class="clearfix">
            
         </div>
            <div>
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                            <th class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th>Acc No / Till</th>
                            <th>Acc Name</th>
                            <th>Type</th>
                            <th>Opening Balance</th>
                            <th>Current Balance</th>                          
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($accounts as $account)
                          <tr>
                              <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                              </td>
                              <td>TAMU_{{$account->acc_no}}</td>
                              <td>{{$account->name}}</td>
                              <td>{{$account->type}}</td>
                              <td>{{number_format($account->opening_balance,2)}}</td>
                              <td>{{number_format($account->current_balance,2)}}</td>
                              <td> 
                                 <i class="fa fa-trash" data-toggle="modal" data-target="#delete_account_{{$account->id}}"></i>
                                 
                                 <a class="green" href="{{url('/statement/'.$account->id)}}">
                                    <i class="fa fa-eye bigger-130" title="View product History"></i>
                                </a>
                                </td>
                          </tr>
                           <!-- Modal for deleting an account --> 
                        <div id="delete_account_{{$account->id}}" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Delete {{$account->name}}</h4>
                                    </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('delete_account','test')}} ">
                                    {{ csrf_field() }}
                                    {{method_field('delete')}}
                                    <div class="row" align="center">
                                        <p>Are you sure you want to delete this record?</p>
                                        <input type="hidden" name="account_id" value="{{$account->id}}" required/>
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
                                <!-- Modal for editting an account --> 
                        <div id="edit_account_{{$account->id}}" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Delete {{$account->name}}</h4>
                                    </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('delete_account','test')}} ">
                                    {{ csrf_field() }}
                                    {{method_field('delete')}}
                                    <div class="row" align="center">
                                        <p>Are you sure you want to delete this record?</p>
                                        <input type="hidden" name="account_id" value="{{$account->id}}" required/>
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
                                </div>
                                </div> 
                                </div>
                                </div>
                          @endforeach
                    </tbody>
                </table>
            </div>
</div><!-- clossing card -->
<!-- Modal for adding an account--> 
<div id="add_account" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Account</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('add_account')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Account Number</label>
                  <div>
                    <input type="number" name="acc_no" class="form-control" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Account Name</label>
                  <div>
                    <input type="text" name="name" class="form-control" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Account Type</label>
                  <div>
                    <input type="text" name="type" class="form-control" required/>
                    <input type="hidden" name="description" class="form-control" value="Opening Balance" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Opening Balance</label>
                  <div>
                    <input type="number" name="opening_balance" class="form-control" required/>
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
              Submit
            </button>
          </div>
        </form>
      </div>   
    </div>
  </div>
</div>
<!-- Modal for Inter Account Transfer--> 
<div id="transfer" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Fund Transfer</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('transfer')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Transfer From</label>
                  <div>
                    <select name="transfer_from" id="account_id" class="form-control account_id" required>
                      <option value="">Select Account to transfer from</option>
                      @foreach($accounts as $account)
                          <option value="{{$account->id}}">{{$account->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Account Balance</label>
                  <div>
                      <select name="account_balance" id="balance" class="form-control balance" readonly>

                      </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Amount</label>
                  <div>
                    <input type="number" name="amount" class="form-control" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Transfer To</label>
                  <div>
                    <select name="transfer_to" id="account_id" class="form-control" required>
                      <option value="">Select Account to transfer to</option>
                      @foreach($accounts as $account)
                          <option value="{{$account->id}}">{{$account->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Description</label>
                  <div>
                    <textarea class="form-control" rows="3" name="description"></textarea>
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
              Submit
            </button>
          </div>
        </form>
      </div>   
    </div>
  </div>
</div>
@endsection
