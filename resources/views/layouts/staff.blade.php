<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Pink App</title>
		
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		 <!-- CSRF Token -->
		 <meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/font-awesome/4.5.0/css/font-awesome.min.css')}}" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-duallistbox.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-multiselect.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/select2.min.css')}}"/>
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-timepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/daterangepicker.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}" />

		<!-- text fonts -->
		<link rel="stylesheet" href="{{asset('assets/css/fonts.googleapis.com.css')}}" />

		<!-- ace styles -->
		<link rel="stylesheet" href="{{asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="{{asset('css/custom.css')}}"/>
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="{{asset('assets/css/ace-skins.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/ace-rtl.min.css')}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="{{asset('assets/js/ace-extra.min.js')}}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default    navbar-collapse       ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="{{route('home')}}" class="navbar-brand">
						<small>
						<img class="nav-user-photo" src="{{asset('assets/images/mojito/pinkyapp2.png')}}" alt="mojito"/>
						</small>
					</a>

					<button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse" data-target=".navbar-buttons">
						<span class="sr-only">Toggle user menu</span>
						  Pink App
					</button>
				</div>

				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
	 					<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							    <img class="nav-user-photo" src="{{asset('assets/images/mojito/'.auth::user()->user_image)}}" alt="Boozy Logo"/>
								{{strtoupper(auth::user()->name)}}
							</a>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
					  <strong></strong>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
				@if(Auth::user()->level_id == 3)
					<li class="active open">
						<a href="{{url('/home')}}">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
					   <a href="{{route('admin_pos')}}">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Point of Sale
							</span>
						</a>
					</li>

					<li class="">
						<a href="{{route('inventory')}}">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text">Inventory</span>
						</a>
					</li>
					<li class="">
						<a href="{{route('receive_stock')}}"	>
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">Receive Stock</span>
						</a>
					</li>
					<li class="">
						<a href="{{route('invoices')}}"	>
							<i class="menu-icon fa fa-pencil-square-o"></i>
							<span class="menu-text">Receipts</span>
						</a>
					</li>
                    <li class="">
						<a href="{{route('accounts')}}">
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text">Accounts</span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
					    <a href="{{route('receipts')}}"	>
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text"> Invoices</span>
						</a>
						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="{{route('clients')}}">
							<i class="menu-icon fa fa-calendar"></i>
							<span class="menu-text">Clients</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="{{route('suppliers')}}">
							<i class="menu-icon fa fa-picture-o"></i>
							<span class="menu-text">Suppliers</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="{{route('settings')}}">
							<i class="menu-icon fa fa-tag"></i>
							<span class="menu-text">Settings</span>
						</a>
					</li>
                @endif
					<li class="">
						<a href="{{ route('logout') }}" class="dropdown-toggle" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
							<i class="fa fa-sign-out"></i>
							<span class="menu-text">Logout</span>
						</a> 
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
					<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="invisible">
									<button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
										<span class="sr-only">Toggle sidebar</span>

										<i class="ace-icon fa fa-dashboard white bigger-125"></i>
									</button>

									<div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
										<ul class="nav nav-list">
										    @if(Auth::user()->level_id == 3)
											<li class="hover">
											    <a href="{{route('admin_pos')}}">
													<i class="menu-icon fa fa-tachometer"></i>
													<span class="menu-text"> Point of Sale </span>
												</a>

												<b class="arrow"></b>
											</li>

											<li class="hover">
												<a href="{{route('admin_station')}}">
													<i class="menu-icon fa fa-list-alt"></i>
													<span class="menu-text">Realtime Orders</span>
												</a>

												<b class="arrow"></b>
											</li>

											<li class="hover">
												<a href="{{route('receipts')}}"	>
													<i class="menu-icon fa fa-calendar"></i>

													<span class="menu-text">
														Invoices
													</span>
												</a>

												<b class="arrow"></b>
											</li>
											<li class="hover">
												<a href="{{route('delivery_routes')}}"	>
												<i class="menu-icon fa fa-tag"></i>

													<span class="menu-text">
														Delivery Routes
													</span>
												</a>

												<b class="arrow"></b>
											</li>
											<li class="hover">
												<a href="{{route('register')}}"	>
												<i class="menu-icon fa fa-tag"></i>

													<span class="menu-text">
														Registers
													</span>
												</a>

												<b class="arrow"></b>
											</li>
											@endif
											<li class="hover">
												<a href="{{route('expenses')}}"	>
												<i class="menu-icon fa fa-tag"></i>

													<span class="menu-text">
														Expenses
													</span>
												</a>

												<b class="arrow"></b>
											</li>
                                        @if(Auth::user()->level_id == 3)
											<li class="hover">
											   <a href="{{route('users')}}"	>
													<i class="menu-icon fa fa-picture-o"></i>
													<span class="menu-text"> Users</span>
												</a>

												<b class="arrow"></b>
											</li>

											<li class="hover">
												<a class="dropdown-toggle" href="#">
													<i class="menu-icon fa fa-tag"></i>
													<span class="menu-text"> Reports </span>

													<b class="arrow fa fa-angle-down"></b>
												</a>

												<b class="arrow"></b>

													@php
												  $today = date("Y-m-d");
												@endphp
												<ul class="submenu">
													<li class="hover">
														<a href="{{url('close-of-day/'.$today)}}">
															<i class="menu-icon fa fa-caret-right"></i>
															Close of Day
														</a>

														<b class="arrow"></b>
													</li>

													<li class="hover">
													    <a href="{{url('dailysales/'.$today)}}">
															<i class="menu-icon fa fa-caret-right"></i>
															Daily Sales Report
														</a>

														<b class="arrow"></b>
													</li>

													<li class="hover">
														<a href="{{route('currentmonth')}}">
															<i class="menu-icon fa fa-caret-right"></i>
															Monthly Sales Report
														</a>

														<b class="arrow"></b>
													</li>

													<!--<li class="hover">-->
													<!--	<a href="#">-->
													<!--		<i class="menu-icon fa fa-caret-right"></i>-->
													<!--		Annual Sales Report-->
													<!--	</a>-->

													<!--	<b class="arrow"></b>-->
													<!--</li>-->

													<!--<li class="hover">-->
													<!--	<a href="#">-->
													<!--		<i class="menu-icon fa fa-caret-right"></i>-->
													<!--		Itemized Sales Report-->
													<!--	</a>-->

													<!--	<b class="arrow"></b>-->
													<!--</li>-->

													<!--<li class="hover">-->
													<!--	<a href="#">-->
													<!--		<i class="menu-icon fa fa-caret-right"></i>-->
													<!--		Sales By Category Report-->
													<!--	</a>-->

													<!--	<b class="arrow"></b>-->
													<!--</li>-->
													<!--<li class="hover">-->
													<!--	<a href="#">-->
													<!--		<i class="menu-icon fa fa-caret-right"></i>-->
													<!--		Periodic Sales Report-->
													<!--	</a>-->

													<!--	<b class="arrow"></b>-->
													<!--</li>-->

													
												</ul>
											</li>

											<li class="hover">
												<a class="dropdown-toggle" href="#">
													<i class="menu-icon fa fa-file-o"></i>

													<span class="menu-text">
														Categories
													</span>

													<b class="arrow fa fa-angle-down"></b>
												</a>

												<b class="arrow"></b>

												<ul class="submenu">
													@foreach($categories as $category)
													<li class="hover">
														<a href="{{url('cat/'.$category->id)}}">
															<i class="menu-icon fa fa-caret-right"></i>
															{{$category->name}}
														</a>
														<b class="arrow"></b>
													</li>
													@endforeach
													<li class="hover">
														<a href="{{url('cat/1')}}">
															<i class="menu-icon fa fa-caret-right"></i>
															All
														</a>
														<b class="arrow"></b>
													</li>
                                            
												</ul>
											</li>
											@endif
										</ul><!-- /.nav-list -->
									</div><!-- .sidebar -->
                                </div>
								
								@include('sweetalert::alert')
									@yield('content')
								
								
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Pink App</span>
							&copy; {{date('Y')}}
							<small>Helpline +254713287641</small>
						</span>

						&nbsp; &nbsp;
						<!-- <span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span> -->
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
		<script src="{{ asset('js/dataFunctions.js')}}"></script>
		<script src="{{ asset('js/pos_scripts.js')}}"></script>
		<!-- <script src="{{ asset('js/change.js')}}"></script> -->
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		
		<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
		<script src="{{asset('assets/js/ace.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#unit_id').change(function(){
    $(this).find("option:selected").each(function(){
		var optionText = $(this).text();
        if(optionText)
        {
            $(".box").not("."+ optionText).hide();
            $("."+ optionText).show();
        }
        else
        {
            $(".box").hide();
        }
    });      
  }).change();
});
</script>
<script type="text/javascript">
	var trigger_popup = document.getElementById("launcher").value;
    if(trigger_popup == 1)
    {
       $('#associate').modal('show');
    }  
</script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','.account_id',function(){
		var account_id = $(this).val();
        var div = $(this).parent().parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        $.ajax({
            type:'get',
            url:'{!!URL::to("findbalance")!!}',
            data:{'id':account_id},
            success:function(data){
				op+='<option value="0" selected>'+data.current_balance+'</option>';
				
                div.find('#balance').html("");
                div.find('#balance').append(op);
            },
            error:function(){
                console.log('failed');
            }
        });
	});
});
</script>
<!--Getting pos dynamic toppings-->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','.unit_id',function(){
		var unit_id = $(this).val();
        var div = $(this).parent().parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        $.ajax({
            type:'get',
            url:'{!!URL::to("findtoppings")!!}',
            data:{'id':unit_id},
            success:function(data){
				op+='<option value="0" selected>Select Topping</option>';
				for( var i=0; i<data.length;i++)
				{
					op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
				} 
                div.find('#toppings').html("");
                div.find('#toppings').append(op);
            },
            error:function(){
                console.log('failed');
            }
        });
	});
});
</script>
</script>
<!-- update without page refresh
<script type="text/javascript">
$(document).ready(function(){
    $('#editFlavour').on('submit',function(e){
		e.preventDefault();

		var id = $('#flavour_id').val();

        $.ajax({
            type:'PUT',
            url:"/updateflavour"+id,
            data: $('#editFlavour').serialize(),
            success:function(response){
				console.log(response);
				$('#update-flavour').modal('hide');
				alert("Data Updated");
            },
            error:function(){
                console.log('failed');
            }
        });
	});
});
</script> -->
<script type="text/javascript">
$(document).ready(function () {
$("body").on("click","#deleteEntry",function(e){
   var id = $(this).data("id");
   // var id = $(this).attr('data-id');
   var token = $("meta[name='csrf-token']").attr("content");
   var url = e.target;
   $.ajax(
	   {
		 url: "remove/"+id, //or you can use url: "company/"+id,
		 type: 'DELETE',
		 data: {
		   _token: token,
			   id: id
	   },
	  
	  
	});
	
  });
   

});
   
</script>

<!--Getting inventory form dynamic flavours-->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','.category_id',function(){
		var category_id = $(this).val();
		var div = $(this).parent().parent().parent().parent();
		var div2 = $(this).parent().parent().parent().parent().parent();
        var op = "";
		var ap = "";
		var ss = "";
        var modal = $(this)
        $.ajax({
            type:'get',
            url:'{!!URL::to("findflavours")!!}',
            data:{'id':category_id},
            success:function(data){
				op+='<option value="0" selected>Select Flavour</option>';
				for( var i=0; i<data.length;i++)
				{
					op+='<option value="'+data[i].flavour_id+'">'+data[i].flavour.name+'</option>';
				} 
                div.find('#flavours').html("");
                div.find('#flavours').append(op);
            },
            error:function(){
                console.log('failed');
            }
		});
		$.ajax({
            type:'get',
            url:'{!!URL::to("findunits")!!}',
            data:{'id':category_id},
            success:function(data){
                ap+='<option value="0" selected>Default</option>';
				for( var i=0; i<data.length;i++)
				{
					ap+='<option value="'+data[i].id+'" selected>'+data[i].name+'</option>';
				} 
                div.find('#unit_id').html("");
                div.find('#unit_id').append(ap);
            },
            error:function(){
                console.log('failed');
            }
		});
		$.ajax({
            type:'get',
            url:'{!!URL::to("findsizes")!!}',
            data:{'id':category_id},
            success:function(data){
				ss+='<option value="0" selected>Select Size</option>';
				for( var i=0; i<data.length;i++)
				{
					ss+='<option value="'+data[i].size_id+'" selected>'+data[i].size.name+'</option>';
				} 
                div2.find('#size_id').html("");
                div2.find('#size_id').append(ss);
            },
            error:function(){
                console.log('failed');
            }
        });
	});
});
</script>
@if(isset($chart1))
	{!! $chart1->renderChartJsLibrary() !!}
	{!! $chart1->renderJs() !!}
	{!! $chart2->renderJs() !!}
	{!! $chart3->renderJs() !!}
	{!! $chart4->renderJs() !!}
@endif
		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			   $('#sidebar2').insertBefore('.page-content');
			   
			   $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');
			   
			   
			   $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
				 if(event_name == 'sidebar_fixed') {
					 if( $('#sidebar').hasClass('sidebar-fixed') ) {
						$('#sidebar2').addClass('sidebar-fixed');
						$('#navbar').addClass('h-navbar');
					 }
					 else {
						$('#sidebar2').removeClass('sidebar-fixed')
						$('#navbar').removeClass('h-navbar');
					 }
				 }
			   }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
			})
		</script>
		<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script type="text/javascript">
	if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

<!-- page specific plugin scripts -->
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.raty.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-multiselect.min.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-typeahead.js')}}"></script>

<!-- ace scripts -->
<script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
<script src="{{asset('assets/js/ace.min.js')}}"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
	jQuery(function($) {
		//initiate dataTables plugin
		var myTable = 
		$('#dynamic-table , #dynamic-table2, #dynamic-table3, #dynamic-table4, #dynamic-table5, #dynamic-table6, #dynamic-table7')
		//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
		.DataTable( {
			bAutoWidth: false,
			"aoColumns": [
			  { "bSortable": false },
			  null, null,null, null, null,
			  { "bSortable": false }
			],
			"aaSorting": [],
			
			
			//"bProcessing": true,
			//"bServerSide": true,
			//"sAjaxSource": "http://127.0.0.1/table.php"	,
	
			//,
			//"sScrollY": "200px",
			//"bPaginate": false,
	
			//"sScrollX": "100%",
			//"sScrollXInner": "120%",
			//"bScrollCollapse": true,
			//Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
			//you may want to wrap the table inside a "div.dataTables_borderWrap" element
	
			//"iDisplayLength": 50
	
	
			select: {
				style: 'multi'
			}
		} );
	
		
		
		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
		
		new $.fn.dataTable.Buttons( myTable, {
			buttons: [
			  {
				"extend": "colvis",
				"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
				"className": "btn btn-white btn-primary btn-bold",
				columns: ':not(:first):not(:last)'
			  },
			  {
				"extend": "copy",
				"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
				"className": "btn btn-white btn-primary btn-bold"
			  },
			  {
				"extend": "csv",
				"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
				"className": "btn btn-white btn-primary btn-bold"
			  },
			  {
				"extend": "excel",
				"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
				"className": "btn btn-white btn-primary btn-bold"
			  },
			  {
				"extend": "pdf",
				"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
				"className": "btn btn-white btn-primary btn-bold"
			  },
			  {
				"extend": "print",
				"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
				"className": "btn btn-white btn-primary btn-bold",
				autoPrint: false,
				message: 'This print was produced using the Print button for DataTables'
			  }		  
			]
		} );
		myTable.buttons().container().appendTo( $('.tableTools-container') );
		
		//style the message box
		var defaultCopyAction = myTable.button(1).action();
		myTable.button(1).action(function (e, dt, button, config) {
			defaultCopyAction(e, dt, button, config);
			$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
		});
		
		
		var defaultColvisAction = myTable.button(0).action();
		myTable.button(0).action(function (e, dt, button, config) {
			
			defaultColvisAction(e, dt, button, config);
			
			
			if($('.dt-button-collection > .dropdown-menu').length == 0) {
				$('.dt-button-collection')
				.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
				.find('a').attr('href', '#').wrap("<li />")
			}
			$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
		});
	
		////
	
		setTimeout(function() {
			$($('.tableTools-container')).find('a.dt-button').each(function() {
				var div = $(this).find(' > div').first();
				if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
				else $(this).tooltip({container: 'body', title: $(this).text()});
			});
		}, 500);
		
		
		
		
		
		myTable.on( 'select', function ( e, dt, type, index ) {
			if ( type === 'row' ) {
				$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
			}
		} );
		myTable.on( 'deselect', function ( e, dt, type, index ) {
			if ( type === 'row' ) {
				$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
			}
		} );
	
	
	
	
		/////////////////////////////////
		//table checkboxes
		$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
		
		//select/deselect all rows according to table header checkbox
		$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header
			
			$('#dynamic-table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) myTable.row(row).select();
				else  myTable.row(row).deselect();
			});
		});
		
		//select/deselect a row when the checkbox is checked/unchecked
		$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
			var row = $(this).closest('tr').get(0);
			if(this.checked) myTable.row(row).deselect();
			else myTable.row(row).select();
		});
	
	
	
		$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
			e.stopImmediatePropagation();
			e.stopPropagation();
			e.preventDefault();
		});
		
		
		
		//And for the first simple table, which doesn't have TableTools or dataTables
		//select/deselect all rows according to table header checkbox
		var active_class = 'active';
		$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
			var th_checked = this.checked;//checkbox inside "TH" table header
			
			$(this).closest('table').find('tbody > tr').each(function(){
				var row = this;
				if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
				else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
			});
		});
		
		//select/deselect a row when the checkbox is checked/unchecked
		$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
			var $row = $(this).closest('tr');
			if($row.is('.detail-row ')) return;
			if(this.checked) $row.addClass(active_class);
			else $row.removeClass(active_class);
		});
	
		
	
		/********************************/
		//add tooltip for small view action buttons in dropdown menu
		$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
		
		//tooltip placement on right or left
		function tooltip_placement(context, source) {
			var $source = $(source);
			var $parent = $source.closest('table')
			var off1 = $parent.offset();
			var w1 = $parent.width();
	
			var off2 = $source.offset();
			//var w2 = $source.width();
	
			if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
			return 'left';
		}
		
		
		
		
		/***************/
		$('.show-details-btn').on('click', function(e) {
			e.preventDefault();
			$(this).closest('tr').next().toggleClass('open');
			$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
		});
		/***************/
		
		
		
		
		
		/**
		//add horizontal scrollbars to a simple table
		$('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
		  {
			horizontal: true,
			styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
			size: 2000,
			mouseWheelLock: true
		  }
		).css('padding-top', '12px');
		*/
	
	
	})
</script>

	</body>
</html>
