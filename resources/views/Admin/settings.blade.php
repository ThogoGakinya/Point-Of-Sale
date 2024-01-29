@extends('layouts.staff')

@section('content')
    <div class="row">
        <div class="col-sm-6">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="smaller">
                Product Categories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="green" data-toggle="modal" data-target="#add-category"><i class="fa fa-plus-circle" title="Add new Category"></i></a>
              </h4>
            </div>
            @php
              $cnt=1;
            @endphp
            <div class="widget-body">
              
                <table id="dynamic-table" class="customers-actions">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>View</th>
                      <th>-</th>
                      <th>-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($categories as $category)
                      <tr>
                          <td>{{$cnt}}</td>
                          <td>{{$category->name}}</td>
                          <td>
                              <a class="green" data-toggle="modal" data-target="#update-category_{{$category->id}}">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
                              </a>
                          </td>
                          <td>
                              <a class="green" data-toggle="modal" data-target="#delete-category" data-categoryid="{{$category->id}}">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                              </a>
                          </td>
                          <td>
                              <a class="blue" href="{{url('/category-details/'.$category->id)}}">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                              </a>
                          </td>
                          <td>-</td>	
                          <td>-</td>
                      </tr>	
                      @php
                        $cnt++;
                      @endphp
                       <!-- Modal for updating a product category --> 
                      <div id="update-category_{{$category->id}}" class="modal" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="blue bigger">Update Product Category</h4>
                              </div>

                            <div class="modal-body">
                              <form method="post" action="{{ route('update-category','test')}} ">
                              {{ csrf_field() }}
                              @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="form-field-username">Name</label>
                                        <div>
                                          <input type="text" placeholder="Category name" name="category_name"   value="{{$category->name}}" required/>
                                          <input type="hidden" placeholder="Category name" name="category_id"   value="{{$category->id}}" required/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="form-field-username">Short</label>
                                        <div>
                                          <input type="text" placeholder="Short form" name="short"  value="{{$category->short_form}}"/>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="thumbnail search-thumbnail">
                                        <img class="media-object" src="{{asset('storage/Images/'.$category->image_name)}}"/>
                                        </div>
                                      </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="form-field-username">Change Product Image</label>
                                        <div>
                                            <input type="file" name="product_image" class="form-control"/>
                                            <input type="hidden" name="old_product_image" value="{{$category->image_name}}" class="form-control"/>
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
                    @endforeach
                  </tbody>
                </table>
              </div><!-- /.col -->
             
            </div>
          
        </div>
        <div class="col-sm-6">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="smaller">
                Sub Categories&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="green" data-toggle="modal" data-target="#add-flavour"><i class="fa fa-plus-circle" title="Add new Flavour"></i></a>
              </h4>
            </div>
            @php
              $cnt=1;
            @endphp
            <div class="widget-body">
              <table id="dynamic-table5" class="customers-actions">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>-</th>
                      <th>-</th>
                      <th>-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($flavours as $flavour)
                      <tr>
                          <td>{{$cnt}}</td>
                          <td>{{$flavour->name}}</td>
                          <td>
                             <a class="green" data-toggle="modal" data-target="#update-flavour" data-flavourid="{{$flavour->id}}"
                              data-flavourname="{{$flavour->name}}" data-flavourshort="{{$flavour->short_form}}" data-categoryid="{{$flavour->category_id}}">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
                              </a>
                          </td>
                          <td>
                              <a class="green" data-toggle="modal" data-target="#delete-flavour" data-flavourid="{{$flavour->id}}">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                              </a>
                          </td>
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>
                          <!-- </td>
                              <a href="{{url('view-flavour/'.$flavour->id)}}">
                                <i class="ace-icon fa fa-eye bigger-130"></i>
                              </a>
                          </td>		 -->
                      </tr>	
                      @php
                        $cnt++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div><!-- /.col -->
            </div>
          </div>
        </div>
        <br/><br/>
        <!-- <input type="hidden" value="{{$launcher}}" id="launcher"> -->
        <div class="col-sm-6">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="smaller">
                Product Sizes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="green" data-toggle="modal" data-target="#add-size"><i class="fa fa-plus-circle" title="Add new Size"></i></a>
              </h4>
            </div>
            @php
              $cnt=1;
            @endphp
            <div class="widget-body">
             
              <table id="dynamic-table2" class="customers-actions">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>-</th>
                      <th>-</th>
                      <th>-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sizes as $size)
                      <tr>
                          <td>{{$cnt}}</td>
                          <td>{{$size->name}}</td>
                          <td>
                             <a class="green" data-toggle="modal" data-target="#update-size" data-sizeid="{{$size->id}}"
                              data-sizename="{{$size->name}}" data-sizeshort="{{$size->short_form}}" data-uomid="{{$size->uom_id}}" data-uomname="{{$size->uom->name}}">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
                              </a>
                          </td>
                          <td>
                              <a class="green" data-toggle="modal" data-target="#delete-size" data-sizeid="{{$size->id}}">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                              </a>
                          </td>	
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>	
                      </tr>	
                      @php
                        $cnt++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div><!-- /.col -->
            </div>
          </div>
       
        <div class="col-sm-6">
            <div class="widget-box">
              <div class="widget-header">
                <h4 class="smaller">
                  Toppings / Spices&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a class="green" data-toggle="modal" data-target="#add-topping"><i class="fa fa-plus-circle" title="Add new Topping"></i></a>
                </h4>
              </div>
              @php
                $cnt=1;
              @endphp
              <div class="widget-body">
           
                   <table id="dynamic-table3" class="customers-actions">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Edit</th>
                        <th>Delete</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($toppings as $topping)
                        <tr>
                            <td>{{$cnt}}</td>
                            <td>{{$topping->name}}</td>
                            <td>
                              <a class="green" data-toggle="modal" data-target="#update-topping" data-toppingid="{{$topping->id}}"
                                data-toppingname="{{$topping->name}}" data-toppingshort="{{$topping->short_form}}" data-uomid="{{$topping->uom_id}}"
                                data-uomname="{{$topping->uom->name}}">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                            </td>
                            <td>
                                <a class="green" data-toggle="modal" data-target="#delete-topping" data-toppingid="{{$topping->id}}">
                                  <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                            </td>	
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>	
                        </tr>	
                        @php
                          $cnt++;
                        @endphp
                      @endforeach
                    </tbody>
                  </table>
                </div><!-- /.col -->
             
            </div>
          </div>  
          <br/><br/>
        <div class="col-sm-6">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="smaller">
                Colors&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="green" data-toggle="modal" data-target="#add-uom"><i class="fa fa-plus-circle" title="Add new UOM"></i></a>
              </h4>
            </div>
            @php
              $cnt=1;
            @endphp
            <div class="widget-body">
            <table id="dynamic-table4" class="customers-actions">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>-</th>
                      <th>-</th>
                      <th>-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($uoms as $uom)
                      <tr>
                          <td>{{$cnt}}</td>
                          <td>{{$uom->name}}</td>
                          <td>
                             <a class="green" data-toggle="modal" data-target="#update-uom" data-uomid="{{$uom->id}}"
                              data-uomname="{{$uom->name}}" data-uomshort="{{$uom->short_form}}" data-categoryid="{{$uom->category_id}}" >
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
                              </a>
                          </td>
                          <td>
                              <a class="green" data-toggle="modal" data-target="#delete-uom" data-uomid="{{$uom->id}}">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                              </a>
                          </td>	
                          <td>-</td>
                          <td>-</td>
                          <td>-</td>	
                      </tr>	
                      @php
                        $cnt++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div><!-- /.col -->
            </div>
          </div>
        
        <div class="col-sm-6">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="smaller">
                Customers Tables&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="green" data-toggle="modal" data-target="#add-table"><i class="fa fa-plus-circle" title="Add new Table"></i></a>
              </h4>
            </div>
            @php
              $cnt=1;
            @endphp
            <div class="widget-body">
              <table id="dynamic-table6" class="customers-actions">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Table Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                      <th>-</th>
                      <th>-</th>
                      <th>-</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tables as $table)
                      <tr>
                          <td>{{$cnt}}</td>
                          <td>{{$table->name}}</td>
                          <td>
                             <a class="green" data-toggle="modal" data-target="#update-table" data-tableid="{{$table->id}}"
                             data-tablename="{{$table->name}}" data-tablecapacity="{{$table->capacity}}">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
                              </a>
                          </td>
                          <td>
                              <a class="green" data-toggle="modal" data-target="#delete-table" data-tableid="{{$table->id}}">
                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                              </a>
                          </td>	
                          <td>-</td>	
                          <td>-</td>	
                          <td>-</td>	
                      </tr>	
                      @php
                        $cnt++;
                      @endphp
                    @endforeach
                  </tbody>
                </table>
              </div><!-- /.col -->
          </div>
        </div>
        <br/><br/>
        <div class="col-sm-6">
          <div class="widget-box">
            <div class="widget-header">
              <h4 class="smaller">
                Company Settings&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
              </h4>
            </div>
            @php
              $cnt=1;
            @endphp
            <div class="widget-body">
              <div class="widget-main">
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#company-settings">Click to view</button>
                
              </div><!-- /.col -->
            </div>
          </div>
        </div>
    </div><br/>
    <div class="row">
        
        
    </div>

 <!-- Modal for adding a product category --> 
<div id="add-category" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Product Category</h4>
        </div>

        <div class="modal-body">
          <form method="post" action="{{ url('/add_category')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text" placeholder="Category name" name="category_name" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" placeholder="Short form" name="short"/>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="form-field-username">Image</label>
                  <div>
                    <input type="file" placeholder="Category name" name="image_name" class="form-control" required/>
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

 

<!-- Modal for deleting a product category --> 
<div id="delete-category" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Product Category</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-category','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="category_id" id="category_id"  value="" required/>
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

  <!-- Modal for adding a product size --> 
<div id="add-size" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Product Size</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ url('/add_size')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text" placeholder="Size name" name="size_name" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" placeholder="Short form" name="short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Unit</label>
                  <div>
                    <select name="uom_id" class="form-control">
                      <option value="">Select UOM</option>
                      @foreach($uoms as $uom)
                         <option value="{{$uom->id}}">{{$uom->name}}</option>
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

  <!-- Modal for updating a product size --> 
<div id="update-size" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Update Product Size</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('update-size','test')}} ">
         {{ csrf_field() }}
         @method('put')
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text"  name="size_name" id="size_name"  value="" required/>
                    <input type="hidden"  name="size_id" id="size_id"  value="" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" placeholder="Short form" name="short" id="size_short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Unit</label>
                  <div>
                    <select name="uom_id" class="form-control">
                      <option id="uom_id" value="">Select Unit</option>
                      @foreach($uoms as $uom)
                         <option value="{{$uom->id}}">{{$uom->name}}</option>
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
              Update
              </button>
          </div>
        </form>
      </div>
      </div> 
    </div> 
  </div>

<!-- Modal for deleting a product size --> 
<div id="delete-size" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Product Size</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-size','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="size_id" id="size_id"  value="" required/>
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
  </div> </div></div>

    <!-- Modal for adding a product UOM --> 
<div id="add-uom" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Unit Of Measure</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ url('/add_uom')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text" placeholder="uom name" name="uom_name" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" placeholder="Short form" name="short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Category</label>
                  <div>
                    <select name="category_id" class="form-control">
                      <option value="">Select Category</option>
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

  <!-- Modal for updating a product UOM--> 
<div id="update-uom" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Update Unit Of Measure</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('update-uom','test')}} ">
         {{ csrf_field() }}
         @method('put')
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text"  name="uom_name" id="uom_name"  value="" required/>
                    <input type="hidden"  name="uom_id" id="uom_id"  value="" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" name="short" id="uom_short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Category</label>
                  <div>
                    <select name="category_id" class="form-control">
                      <option id="category_id" value="">Select Category</option>
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
              Update
              </button>
          </div>
        </form>
      </div>
      </div> 
    </div> 
  </div>

<!-- Modal for deleting a product UOM --> 
<div id="delete-uom" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Unit Of Measure</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-uom','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="uom_id" id="uom_id"  value="" required/>
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
  </div> </div></div>

    <!-- Modal for adding a topping --> 
<div id="add-topping" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Topping</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ url('/add_topping')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text" placeholder="Topping name" name="topping_name" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" placeholder="Short form" name="short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Unit</label>
                  <div>
                    <select name="uom_id" class="form-control">
                      <option value="">Select UOM</option>
                      @foreach($uoms as $uom)
                         <option value="{{$uom->id}}">{{$uom->name}}</option>
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

  <!-- Modal for updating toppings--> 
<div id="update-topping" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Update Topping</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('update-topping','test')}} ">
         {{ csrf_field() }}
         @method('put')
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text"  name="topping_name" id="topping_name"  value="" required/>
                    <input type="hidden"  name="topping_id" id="topping_id"  value="" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" name="short" id="topping_short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Unit</label>
                  <div>
                    <select name="uom_id" class="form-control">
                      <option id="uom_id" value="">Select Unit</option>
                      @foreach($uoms as $uom)
                         <option value="{{$uom->id}}">{{$uom->name}}</option>
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
              Update
              </button>
          </div>
        </form>
      </div>
      </div> 
    </div> 
  </div>

<!-- Modal for deleting  topping --> 
<div id="delete-topping" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Topping</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-topping','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="topping_id" id="topping_id"  value="" required/>
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
  </div> </div></div>

<!-- Modal for adding a flavour--> 
<div id="add-flavour" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Flavour</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ url('/add_flavour')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text" placeholder="Flavour name" name="flavour_name" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" placeholder="Short form" name="short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Category</label>
                  <div>
                    <select name="category_id" class="form-control">
                      <option value="">Select Category</option>
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

  <!-- Modal for updating flavour--> 
<div id="update-flavour" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Update Flavour</h4>
        </div>

      <div class="modal-body">
      <form method="post" action="{{ route('update-flavour','test')}} ">
         {{ csrf_field() }}
         @method('put')
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text"  name="flavour_name" id="flavour_name"  value="" required/>
                    <input type="hidden"  name="flavour_id" id="flavour_id"  value="" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Short</label>
                  <div>
                    <input type="text" name="short" id="flavour_short"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Associated Category</label>
                  <div>
                    <select name="category_id" class="form-control">
                      <option id="category_id" value="">Select Category</option>
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
              Update
              </button>
          </div>
        </form>
      </div>
      </div> 
    </div> 
  </div>

<!-- Modal for deleting  topping --> 
<div id="delete-flavour" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Flavour</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-flavour','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="flavour_id" id="flavour_id"  value="" required/>
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
  </div> </div></div>
  <!-- Modal for company details --> 
 <div id="company-settings" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Company Details</h4>
        </div>

        <div class="modal-body">
        @foreach($company as $data)
        <form method="post" action="{{ route('update-company','test')}}" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method('put')
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="form-field-username">Company Name</label>
                  <div>
                    <input type="text"  name="company_name" value="{{$data->name}}" class="form-control" />
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Branch</label>
                  <div>
                    <input type="text" name="branch" value="{{$data->branch}}" class="form-control"/>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Address 1</label>
                  <div>
                     <input type="text" name="address_one" value="{{$data->address_one}}" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Address 2</label>
                  <div>
                     <input type="text"  name="address_two" value="{{$data->address_two}}" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Tel 1</label>
                  <div>
                    <input type="text"  name="tel_one" value="{{$data->tel_one}}" class="form-control"/>
                  </div>
                </div>
              </div>
              </div>
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Tel 2</label>
                  <div>
                    <input type="text"  name="tel_two" value="{{$data->tel_two}}" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Pin No.</label>
                  <div>
                     <input type="text"  name="pin" value="{{$data->pin}}" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Email</label>
                  <div>
                     <input type="text"  name="email" value="{{$data->email}}" class="form-control"/>
                  </div>
                </div>
              </div>
            </div> 
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">V.A.T %</label>
                  <div>
                     <input type="text"  name="vat" value="{{$data->vat}}" class="form-control"/>
                     <input type="hidden"  name="data_id" value="{{$data->id}}" class="form-control"/>
                  </div>
                </div>
              </div>
            
              <div class="col-sm-4">
                  <div class="thumbnail search-thumbnail">
                  <img class="media-object" src="{{asset('storage/Images/'.$data->logo)}}"/>
                  </div>
                </div>
              <div class="col-md-4">
                  <div class="form-group">
                  <label for="form-field-username">Change Logo</label>
                  <div>
                      <input type="file" name="logo" class="form-control"/>
                      <input type="hidden" name="old_logo" value="{{$data->logo}}" class="form-control"/>
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
          @endforeach
        </div>
    </div>
  </div>
</div>


    <!-- Modal for adding a table--> 
    <div id="add-table" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Add Customer Table</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ url('/add_table')}} ">
          {{ csrf_field() }}
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text" placeholder="Table name" name="table_name" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Capacity</label>
                  <div>
                    <input type="text" placeholder="capacity" name="capacity"/>
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

  <!-- Modal for updating customer table--> 
<div id="update-table" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Update Customer Table</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('update-table','test')}} ">
         {{ csrf_field() }}
         @method('put')
          <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Name</label>
                  <div>
                    <input type="text"  name="table_name" id="table_name"  value="" required/>
                    <input type="hidden"  name="table_id" id="table_id"  value="" required/>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="form-field-username">Capacity</label>
                  <div>
                    <input type="text" name="capacity" id="capacity"/>
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

<!-- Modal for deleting a customer Table --> 
<div id="delete-table" class="modal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Delete Customer Table</h4>
        </div>

      <div class="modal-body">
        <form method="post" action="{{ route('delete-table','test')}} ">
         {{ csrf_field() }}
         {{method_field('delete')}}
          <div class="row" align="center">
              <p>Are you sure you want to delete this record?</p>
              <input type="hidden" name="table_id" id="table_id"  value="" required/>
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
  </div> </div></div>

@endsection
