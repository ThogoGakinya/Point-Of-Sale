@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
    <a>EXPENSES</a>&nbsp;&nbsp;<button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#add_expense"><i class="fa fa-plus-circle" title="Add Expense"></i> Add</button>
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
                            <th>Expense Ref.</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Owner</th>
                            <th>Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($expenses as $expense)
                          <tr>
                              <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                              </td>
                              <td>EXP_{{$expense->id}}</td>
                              <td>{{$expense->description}}</td>
                              <td>{{number_format($expense->amount,2)}}</td>
                              <td>{{$expense->user->name}}</td>
                              <td>{{$expense->created_at}}</td>
                              <td> 
                                 <i class="fa fa-trash" data-toggle="modal" data-target="#delete_expense_{{$expense->id}}"></i></a>
                              </td>
                          </tr>
                           <!-- Modal for deleting an expense --> 
                        <div id="delete_expense_{{$expense->id}}" class="modal" tabindex="-1">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger">Delete {{$expense->description}}</h4>
                                    </div>

                                <div class="modal-body">
                                    <form method="post" action="{{ route('delete_expense','test')}} ">
                                    {{ csrf_field() }}
                                    {{method_field('delete')}}
                                    <div class="row" align="center">
                                        <p>Are you sure you want to delete this record?</p>
                                        <input type="hidden" name="expense_id" value="{{$expense->id}}" required/>
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
<div id="add_expense" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Expense</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('add_expense')}} ">
          {{ csrf_field() }}
          <div class="row">
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Expense Account</label>
                  <div>
                    <select name="account" class="form-control" required>
                      <option value="">Please select Account</option>
                      @foreach($accounts as $account)
                          <option value="{{$account->id}}">{{$account->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Amount</label>
                  <div>
                    <input type="number" name="amount" class="form-control"/>
                  </div>
                </div>
              </div><br/>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="form-field-username">Description</label>
                  <div>
                    <textarea name="description" class="form-control" rows="3"></textarea>
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
