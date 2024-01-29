@extends('layouts.staff')
@section('content')
<div class="card">
    <div class="card-header">
       <h4>{{$category->name}} Category
       <a href="{{url('/settings')}}" class="btn btn-default btn-xs"><< Back</a></h4>
    </div>
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-header">
                       <h5>{{$category->name}} Flavours
                       <a data-toggle="modal" data-target="#add-flavour" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Add Flavour</a></h5>  
                    </div>
                    @php
                    $cnt = 1;
                    @endphp
                        <table id="dynamic-table" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Names</th>  
                                    <th>Delete</th> 
                                    <th>View</th> 
                                    <th>-</th> 
                                    <th>-</th> 
                                    <th>-</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($flavours as $flavour)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$flavour->flavour->name}}</td>
                                    <td> 
                                    <a class="green" data-toggle="modal" data-target="#delete-category-flavour_{{$flavour->id}}">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                    </td>
                                    <td> 
                                    <a class="green">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <!-- Modal for deleting a product flavour --> 
<div id="delete-category-flavour_{{$flavour->id}}" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Category Flavour</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-category-flavour','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="category_flavour_id" id="category_flavour_id"  value="{{$flavour->id}}" required/>
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
  </div></div></div>
                                @php
                                    $cnt++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div><!-- clossing card-body -->
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-header">
                        <a><h5>{{$category->name}} Sizes
                        <a data-toggle="modal" data-target="#add-size" class="btn btn-primary btn-xs"><i class="fa fa-plus-circle"></i> Add Size</a></h5>  
                    </div>
                    @php
                    $cnt = 1;
                    @endphp
                        <table id="dynamic-table" class="customers-actions">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Names</th>  
                                    <th>Delete</th> 
                                    <th>View</th> 
                                    <th>-</th> 
                                    <th>-</th> 
                                    <th>-</th>  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sizes as $size)
                                <tr>
                                    <td>{{$cnt}}</td>
                                    <td>{{$size->size->name}}</td>
                                    <td> 
                                    <a class="green" data-toggle="modal" data-target="#delete-category-size_{{$size->id}}">
                                        <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                    </a>
                                    </td>
                                    <td> 
                                    <a class="green">
                                        <i class="ace-icon fa fa-eye bigger-130"></i>
                                    </a>
                                    </td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                @php
                                    $cnt++;
                                @endphp
                                 <!-- Modal for deleting a product category sizes --> 
<div id="delete-category-size_{{$size->id}}" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Category Size</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-category-size','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="category_size_id" id="category_size_id"  value="{{$size->id}}" required/>
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
  </div></div></div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- clossing card-body -->
                </div>
        </div><!-- clossing container -->
    </div><!-- clossing card-body -->
</div><!-- clossing card -->

  <!-- Modal for adding a product size --> 
  <div id="add-size" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Category Size</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{url('/add-size/'.$category->id)}}">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Category Name</label>
                  <div>
                    <input type="text" placeholder="Size name" name="category_name" value="{{$category->name}}" class="form-control" required/>
                    <input type="hidden" placeholder="Size name" name="category_id" value="{{$category->id}}" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Category Size</label>
                  <div>
                    <select name="size_id" class="form-control">
                      <option value="">Select Size</option>
                      @foreach($all_sizes as $size)
                         <option value="{{$size->id}}">{{$size->name}}</option>
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
 <!-- Modal for adding a product flavour --> 
 <div id="add-flavour" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Category Flavour</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{url('/add-flavour/'.$category->id)}}">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Category Name</label>
                  <div>
                    <input type="text" placeholder="Size name" name="category_name" value="{{$category->name}}" class="form-control" required/>
                    <input type="hidden" placeholder="Size name" name="category_id" value="{{$category->id}}" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Category Flavour</label>
                  <div>
                    <select name="flavour_id" class="form-control">
                      <option value="">Select Flavour</option>
                      @foreach($all_flavours as $flavour)
                         <option value="{{$flavour->id}}">{{$flavour->name}}</option>
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

@endsection
