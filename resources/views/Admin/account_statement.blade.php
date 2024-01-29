@extends('layouts.staff')
@section('content')
<div class="card" style="height: 80vh;">
    <div class="card-header">
       <a>ACCOUNT STATEMENT</a>
    </div>
    <div class="card-body">
        <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
        <div class="col-xs-10 col-md-10">
         <div class="clearfix">
         @php
        $cnt =1;
        @endphp
         </div>
            <div>
               <div class="table-responsive row">
                <table id="dynamic-table" class="customers-actions">
                    <thead>
                        <tr>
                            <td colspan="10">
                            <div class="col-md-4">
                            <strong>Account Name : </strong><a>{{$account->name}}</a><br/>
                            <strong>Opening Balance : </strong><a>{{number_format($account->opening_balance,2)}}</a><br/>
                            <strong>Current Balance : </strong><a>{{number_format($account->current_balance,2)}}</a><br/>
                            <strong>Date : </strong><a>{{date("l jS \of F Y h:i:s A")}}</a>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Credit</th>
                            <th>Debit</th>
                            <th>Balance</th>
                            <th>User</th>
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($statements as $statement)
                          <tr>
                              <td>{{$cnt}}</td>
                              <td>{{$statement->created_at}}</td>
                              <td>{{$statement->description}}</td>
                              <td>{{number_format($statement->credit,2)}}</td>
                              <td>{{number_format($statement->debit,2)}}</td>
                              <td>{{number_format($statement->current_balance,2)}}</td>
                              <td>{{$statement->user->name}}</td>
                          </tr>
                          @php
                            $cnt++;
                          @endphp
                          @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
