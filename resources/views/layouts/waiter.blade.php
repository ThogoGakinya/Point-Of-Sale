<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<!-- <meta http-equiv="refresh" content="10"/> -->
		<title>UltraGlamour</title>

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
		<link rel="stylesheet" href="{{asset('assets/css/jquery-ui.custom.min.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/jquery.gritter.min.css')}}" />

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
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
		<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
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
						  <img class="nav-user-photo" src="{{asset('assets/images/mojito/'.auth::user()->user_image)}}" alt="User Photo" />
					</button>
				</div>
				<button onclick="new Audio('assets/audio/alert.mp3').play()" id="myCheck" style="display:none;">aaa</button>
				<div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
					<ul class="nav ace-nav">
					    <li class="light-blue dropdown-modal">
						<a data-toggle="dropdown" href="#" class="dropdown-toggle">
							<img class="nav-user-photo" src="{{asset('assets/images/mojito/'.auth::user()->user_image)}}" alt="User Photo" />
							 {{strtoupper(auth::user()->name)}}
						</a>
						</li>
					    <li class="light-blue dropdown-modal">
								<a href="{{ route('logout') }}" class="dropdown-toggle" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									<i class="fa fa-sign-out"></i>
									<span class="menu-text">Logout</span>
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
			<div class="main-content">
				<div class="main-content-inner">
					<div class="page-content">
					<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							
								
								@include('sweetalert::alert')
									@yield('content')
								
								
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<!-- <div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Cybrex</span>
							Systems &copy; {{date('Y')}}
							<small>Licensed to Mojito</small>
						</span>

					</div>
				</div>
			</div> -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
		<script src="{{ asset('js/dataFunctions.js')}}"></script>
		
		<script src="{{ asset('js/pos_scripts.js')}}"></script>
		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		
		<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

		<!-- page specific plugin scripts -->

		<!-- ace scripts -->
		<script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
		<script src="{{asset('assets/js/ace.min.js')}}"></script>

<!-- script to download invoice -->		
<script type="text/javascript">
	function getInvoice()
	{
		html2canvas(document.getElementById('content')).then(function(canvas){
			document.getElementById('invoice_content').appendChild(canvas)
			$(".whatsapp").show();
			$(".capture").show();
			$(".thisinvoice").hide();
		
			
		})
	}
	function closeInvoice()
	{
		$(".whatsapp").hide();
		$(".capture").hide();
	}
</script>
<!-- script to download invoice -->		
<script type="text/javascript">
	function getReceipt()
	{
		html2canvas(document.getElementById('content')).then(function(canvas){
			document.getElementById('receipt_content').appendChild(canvas)
			$(".whatsapp").show();
			$(".capture").show();
			
			
			
		})
	}
	function closeReceipt()
	{
		$(".whatsapp").hide();
		$(".capture").hide();
	}
</script>
<!-- script to generate secrete keys -->		
<script type="text/javascript">
	function generateSecretKey(min, max)
	{ 
		$secret_key = Math.floor(Math.random() * (max - min + 1) ) + min; 
		document.getElementById("secret_key").innerHTML = $secret_key; 
		document.getElementById("secret").value = $secret_key; 
	}

</script>
<!-- script to download D-note -->		
<script type="text/javascript">
	function getDnote()
	{
		html2canvas(document.getElementById('dnote')).then(function(canvas){
			document.getElementById('dnote_content').appendChild(canvas)
			$(".whatsapp").show();
			$(".capture_dnote").show();
			$(".thisdnote").hide();
			
			
		})
	}
	function closeReceipt()
	{
		$(".whatsapp").hide();
		$(".capture").hide();
	}
</script>

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
$(document).ready(function(){
	var trigger_popup = document.getElementById("popup_trigger").value;
    if(trigger_popup == 1)
    {
       $('#product').modal('show');
    }  
});
</script>

<!--Script to validate whatsapp number-->
<script type="text/javascript">
 var numberChecker = document.getElementById('numberChecker');
 var whatsappNumber = document.getElementById('whatsappNumber')
 var letters = /^[a-zA-Z]+$/;
 function checkNumber()
 {

	if(whatsappNumber.value.match(letters))
	{
		numberChecker.innerHTML = "Invalid Number";
	}
	else
	{
		if(whatsappNumber.value.length < 12)
		{
		numberChecker.innerHTML = "Invalid number length";
		}
		else
		{
		numberChecker.innerHTML = "";
		}
	}
	
	
}

</script>

<!--triggering a sound notification on orders change-->
<script type="text/javascript">
	var my_old_orders = document.getElementById("my_old_orders").value;
	var my_new_orders = document.getElementById("my_new_orders").value;
    if(my_new_orders > my_old_orders)
    {
		document.getElementById("myCheck").click();
		
	}  
</script>

<!--Script to validate mpesa number-->
<script type="text/javascript">
 var mpesa_no = document.getElementById('mpesa_no');
 var mpesa_number = document.getElementById('mpesa_number')
 var letters = /^[a-zA-Z]+$/;
 function checkMpesaNumber()
 {

	if(mpesa_number.value.match(letters))
	{
		numberChecker.innerHTML = "Invalid Number";
	}
	else
	{
		if(mpesa_number.value.length != 12)
		{
			mpesa_no.innerHTML = "Invalid number length";
		}
		else
		{
			mpesa_no.innerHTML = "";
		}
	}
	
	
}

</script>
<!--Getting pos dynamic clients data-->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','#customer_id',function(){
		var customer_id = $(this).val();
        var div = $(this).parent().parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        $.ajax({
            type:'get',
            url:'{!!URL::to("findclientdata")!!}',
            data:{'id':customer_id},
            success:function(data){

				document.getElementById('customer_name').value = data.firstname .concat (data.lastname);
				document.getElementById('client_tel').value = data.phone;
				document.getElementById('address').innerHTML = data.address;

				op+='<label>'+
						'<input name="add_client" class="ace ace-checkbox-2" value="0" type="checkbox" checked/>'+
						'&nbsp;&nbsp;<span class="lbl">&nbsp;&nbsp;Add this customer to Clients list?</span>'+
						'</label>';

				div.find('.add_customer').html("");
                div.find('.add_customer').append(op);
				// $(".add_to_list").hide();
            },
            error:function(){
                console.log('failed');
            }
        });
	});
});
</script>

<!--disable submit button until a checkbox is clicked-->
<script>
    $('.check').click(function(){
          if($(this).prop('checked') == true){
             $('button[type="submit"]').prop('disabled', false);
          }else{
               $('button[type="submit"]').prop('disabled', true);
        }
     });
</script>
<script type="text/javascript">
function printContent(to_print)
     {
     var restorepage = document.body.innerHTML;
     var printcontent = document.getElementById(to_print).innerHTML;
     document.body.innerHTML = printcontent;
     window.print();
     document.body.innerHTML = restorepage;

     }
</script>
<script type="text/javascript">
const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
</script>
<!--Getting pos dynamic routes data-->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','#route_id',function(){
		var route_id = $(this).val();
        var div = $(this).parent().parent().parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        $.ajax({
            type:'get',
            url:'{!!URL::to("findroutedata")!!}',
            data:{'id':route_id},
            success:function(data){

				document.getElementById('route_name').value = data.name;
				document.getElementById('charges').value = data.charges;
		
				op+='<label>'+
						'<input name="add_route" class="ace ace-checkbox-2" value="0" type="checkbox" checked/>'+
						'&nbsp;&nbsp;<span class="lbl">&nbsp;&nbsp;Add this route to routes list?</span>'+
						'</label>';

				div.find('.add_to_list').html("");
                div.find('.add_to_list').append(op);
				$(".add_to_list").hide();
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
				for( var i=0; i<data.length;i++)
				{
					op+='<label>'+
					    '<div class="col-md-12 col-sm-12">'+
						'<input name="topping[]" class="form-control ace ace-checkbox-2" value="'+data[i].name+'" type="checkbox"/>'+
						'&nbsp;<span class="lbl">'+data[i].name+'</span>'+
						'</div>'+
					    '</label>';
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
<!--Getting withdrawal commisions-->
<script>
function getWithdrawalCommision() {
  var w_amount = document.getElementById("withdrawal_amount").value;

  if (w_amount >=10 && w_amount <= 49)
  {
    document.getElementById("withdrawal_commision").value = 0;
  }
  if (w_amount >=50 && w_amount <= 100)
  {
    document.getElementById("withdrawal_commision").value = 5;
  }
  if (w_amount >=101 && w_amount <= 500)
  {
    document.getElementById("withdrawal_commision").value = 8;
  }
  if (w_amount >=501 && w_amount <= 1000)
  {
    document.getElementById("withdrawal_commision").value = 10;
  }
  if (w_amount >=1001 && w_amount <= 1500)
  {
    document.getElementById("withdrawal_commision").value = 12;
  }
  if (w_amount >=1501 && w_amount <= 2500)
  {
    document.getElementById("withdrawal_commision").value = 15;
  }
  if (w_amount >=2501 && w_amount <= 3500)
  {
    document.getElementById("withdrawal_commision").value = 20;
  }
  if (w_amount >=3501 && w_amount <= 5000)
  {
    document.getElementById("withdrawal_commision").value = 25;
  }
  if (w_amount >=5001 && w_amount <= 7500)
  {
    document.getElementById("withdrawal_commision").value = 30;
  }
  if (w_amount >=7501 && w_amount <= 10000)
  {
    document.getElementById("withdrawal_commision").value = 35;
  }
  if (w_amount >=10001 && w_amount <= 15000)
  {
    document.getElementById("withdrawal_commision").value = 45;
  }
  if (w_amount >=15001 && w_amount <= 20000)
  {
    document.getElementById("withdrawal_commision").value = 60;
  }
  if (w_amount >=20001 && w_amount <= 25000)
  {
    document.getElementById("withdrawal_commision").value = 65;
  }
  if (w_amount >=25001 && w_amount <= 30000)
  {
    document.getElementById("withdrawal_commision").value = 70;
  }
  if (w_amount >=30001 && w_amount <= 35000)
  {
    document.getElementById("withdrawal_commision").value = 80;
  }
  if (w_amount >=35001 && w_amount <= 40000)
  {
    document.getElementById("withdrawal_commision").value = 100;
  }
  if (w_amount >=40001 && w_amount <= 45000)
  {
    document.getElementById("withdrawal_commision").value = 150;
  }
  if (w_amount >=45001 && w_amount <= 50000)
  {
    document.getElementById("withdrawal_commision").value = 180;
  }
  if (w_amount >=50001 && w_amount <= 150000)
  {
    document.getElementById("withdrawal_commision").value = 200;
  }

  

}
</script>

<script>
function getDepositCommision() 
{
  var d_amount = document.getElementById("deposit_commision").value;

  if (d_amount >=50 && d_amount <= 100)
  {
    document.getElementById("deposit_amount").value = 4;
  }
  if (d_amount >=101 && d_amount <= 510)
  {
    document.getElementById("deposit_amount").value = 8;
  }
  if (d_amount >=511 && d_amount <= 1010)
  {
    document.getElementById("deposit_amount").value = 9;
  }
  if (d_amount >=1011 && d_amount <= 1510)
  {
    document.getElementById("deposit_amount").value = 10;
  }
  if (d_amount >=1511 && d_amount <= 2510)
  {
    document.getElementById("deposit_amount").value = 11;
  }
  if (d_amount >=2511 && d_amount <= 3510)
  {
    document.getElementById("deposit_amount").value = 12;
  }
  if (d_amount >=3511 && d_amount <= 5010)
  {
    document.getElementById("deposit_amount").value = 14;
  }
  if (d_amount >=5011 && d_amount <= 7510)
  {
    document.getElementById("deposit_amount").value = 20;
  }
  if (d_amount >=7511 && d_amount <= 10010)
  {
    document.getElementById("deposit_amount").value = 28;
  }
  if (d_amount >=10011 && d_amount <= 15010)
  {
    document.getElementById("deposit_amount").value = 40;
  }
  if (d_amount >=10011 && d_amount <= 15010)
  {
    document.getElementById("deposit_amount").value = 40;
  }
  if (d_amount >=15011 && d_amount <= 20020)
  {
    document.getElementById("deposit_amount").value = 55;
  }
  if (d_amount >=20021 && d_amount <= 25020)
  {
    document.getElementById("deposit_amount").value = 71;
  }
  if (d_amount >=25021 && d_amount <= 30020)
  {
    document.getElementById("deposit_amount").value = 87;
  }
  if (d_amount >=30021 && d_amount <= 35020)
  {
    document.getElementById("deposit_amount").value = 103;
  }
  if (d_amount >=35021 && d_amount <= 35020)
  {
    document.getElementById("deposit_amount").value = 119;
  }
  if (d_amount >=40021 && d_amount <= 45020)
  {
    document.getElementById("deposit_amount").value = 135;
  }
  if (d_amount >=45021 && d_amount <= 50020)
  {
    document.getElementById("deposit_amount").value = 150;
  }
  if (d_amount >=50021 && d_amount <= 150000)
  {
    document.getElementById("deposit_amount").value = 190;
  }
}
</script>
<!--Getting inventory form dynamic flavours-->
<script type="text/javascript">
$(document).ready(function(){
    $(document).on('change','.category_id',function(){
		var category_id = $(this).val();
        var div = $(this).parent().parent().parent().parent();
        var op = "";
        var ap = "";
        var modal = $(this)
        $.ajax({
            type:'get',
            url:'{!!URL::to("findflavours")!!}',
            data:{'id':category_id},
            success:function(data){
				op+='<option value="0" selected>Select Flavour</option>';
				for( var i=0; i<data.length;i++)
				{
					op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
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
				ap+='<option value="0" selected>Select Unit</option>';
				for( var i=0; i<data.length;i++)
				{
					ap+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
				} 
                div.find('#unit_id').html("");
                div.find('#unit_id').append(ap);
            },
            error:function(){
                console.log('failed');
            }
        });
	});
});
</script>
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
		$('#dynamic-table , #dynamic-table2')
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
