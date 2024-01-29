@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <a>DAILY REGISTER</a>
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
                            <th>Name</th>
                            <th>Clock Inn</th> 
                            <th>Actions</th>    
                        </tr>
                    </thead>
                    <tbody>
                          @foreach($entries as $entry)
                          <tr>
                              <td class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                              </td>
                              <td>{{$entry->user->name}}</td>
                              <td>{{$entry->created_at}}</td>
                              <td> 
                                 
                              </td>
                          </tr>
                          @endforeach
                    </tbody>
                </table>
            </div>
</div><!-- clossing card -->
@endsection
