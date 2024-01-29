@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header">
       <a>Change Password</a> &nbsp;&nbsp;&nbsp;<a href="{{route('home')}}" class="btn btn-success btn-sm"><< Back </a>
    </div>
         <div class="clearfix">
            
         </div>
         <div class="row justify-content-center align-items-round" >
             <div class="col-md-4">
                <form method="post" action="{{ route('change_password')}} ">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-field-username">Old Password</label>
                                <div>
                                <input type="password" name="current_password" class="form-control" required/>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-field-username">New Password</label>
                                <div>
                                <input type="password" name="password" class="form-control" required/>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                                <label for="form-field-username">Confirm New Password</label>
                                <div>
                                <input type="password" class="form-control" name="password_confirmation"/>
                                </div>
                            </div>
                            </div>   
                        </div>
                        
                        <div class="modal-footer">
                        <button class="btn btn-sm btn-primary" type="submit">
                        <i class="ace-icon fa fa-check"></i>
                            Change
                        </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
</div><!-- clossing card -->
@endsection
