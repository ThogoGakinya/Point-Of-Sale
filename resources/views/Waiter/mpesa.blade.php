@extends('layouts.waiter')
@section('content')
<div class="row">
    <div class="col-md-1">
      <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#deposit"><i class="fa fa-plus-circle"></i> Deposit Cash</a>
     </br></br>
      <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#float"><i class="fa fa-plus-circle"></i> Topup Float. </a></br></br>
       <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#ctf"><i class="fa fa-plus-circle"></i>Cash to Float</a>
    </div>
   <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h3>
          <a href="{{route('home')}}" class="btn btn-success btn-xs"><< Go Back</a> MPESA TRANSACTIONS TODAY
          </h3>
        </div>
         <div class="clearfix">
         @php
          $cnt = 1;
          $t_commision = 0;
        @endphp
         </div>
            <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Identity</th>
                        <th>Withdraw</th>
                        <th>Deposit</th>
                        <th>Float</th>
                        <th>Cash</th>
                        <th>Commision</th>
                        <th>Description</th>                     
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($mpesas as $mpesa)
                    @php
                       $t_commision += $mpesa->commision;
                    @endphp
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$mpesa->ref}}</td>
                            <td>{{number_format($mpesa->withdraw,2)}}</td>
                            <td>{{number_format($mpesa->deposit,2)}}</td>
                            <td>{{number_format($mpesa->float,2)}}</td>
                            <td>{{number_format($mpesa->cash,2)}}</td>
                            <td>{{number_format($mpesa->commision,2)}}</td>
                            <td>{{$mpesa->description}}</td> 
                        </tr>
                          @php
                            $cnt++;
                          @endphp                 
                          @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th colspan="6">TOTAL COMMISION TODAY</th>
                        <th>Ksh {{number_format($t_commision,2)}}</th>
                        <th>-</th>                     
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div><!-- clossing column -->
        <div class="col-md-1">
           <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#withdraw"><i class="fa fa-minus-circle"></i> Withdrawal</a>
           </br></br>
           <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#cash"><i class="fa fa-plus-circle"></i> Topup Cash</a>
        </div>
</div>

<!-- Modal for withdrawal--> 
<div id="withdraw" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">MPESA Withdrawal</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('withdraw')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">ID Number</label>
                  <div>
                    <input type="number" name="identity" class="form-control" required/>
                    <input type="hidden" name="cash" value="{{$daily->cash}}" class="form-control" required/>
                    <input type="hidden" name="float" value="{{$daily->float}}" class="form-control" required/>
                    <input type="hidden" id="withdrawal_commision" name="withdrawal_commision" value="" class="form-control" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Amount</label>
                  <div>
                    <input type="number" name="amount"  id="withdrawal_amount"  class="form-control" oninput="getWithdrawalCommision()"/>
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
<!-- Modal for cash to float--> 
<div id="ctf" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Cash to Float</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('ctf')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Amount</label>
                  <div>
                    <input type="number" name="amount" class="form-control"/>
                    <input type="hidden" name="cash" value="{{$daily->cash}}" class="form-control" required/>
                    <input type="hidden" name="float" value="{{$daily->float}}" class="form-control" required/>
                    <input type="hidden" name="withdrawal_commision" value="0" class="form-control" required/>
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
<!-- Modal for float topup--> 
<div id="cash" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Topup Cash</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('cash')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Amount</label>
                  <div>
                    <input type="number" name="amount" class="form-control" required/>
                    <input type="hidden" name="cash" value="{{$daily->cash}}" class="form-control" required/>
                    <input type="hidden" name="float" value="{{$daily->float}}" class="form-control" required/>
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
<!-- Modal for float topup--> 
<div id="float" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Topup Float</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('float')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Amount</label>
                  <div>
                    <input type="number" name="amount" class="form-control" required/>
                    <input type="hidden" name="cash" value="{{$daily->cash}}" class="form-control" required/>
                    <input type="hidden" name="float" value="{{$daily->float}}" class="form-control" required/>
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
<!-- Modal for deposit--> 
<div id="deposit" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">MPESA Deposit</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('deposit')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">ID Number</label>
                  <div>
                    <input type="number" name="identity" class="form-control" required/>
                    <input type="hidden" name="cash" value="{{$daily->cash}}" class="form-control" required/>
                    <input type="hidden" name="float" value="{{$daily->float}}" class="form-control" required/>
                    <input type="hidden" id="deposit_amount" name="deposit_commision" value="" class="form-control" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Amount</label>
                  <div>
                    <input type="number" name="amount" id="deposit_commision" class="form-control" oninput="getDepositCommision()"/>
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
