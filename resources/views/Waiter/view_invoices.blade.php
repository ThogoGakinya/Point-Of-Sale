@extends('layouts.waiter')
@section('content')
<div class="card">
    <div class="card-header"><a href="{{url('home')}}" class="btn btn-default btn-sm">Home</a> - <a href="{{route('receipts-invoices')}}" class="btn btn-default btn-sm">Invoices</a> - {{$invoice_details->receipt_no}}</div>
        <div class="card-body" style="background-image: url('{{asset('assets/images/mojito/texture_bg.jpg')}}');">
                <div class="row justify-content-center align-items-round" >
                    <div class="col-md-4">
                        <div class="widget-header">
								<h4 class="widget-title">
                                   <button type="button" class="btn btn-success btn-sm" onclick="printContent('to_print')"><i class="ace-icon fa fa-print"></i></i>&nbsp;&nbsp;Print</button>
                                </h4>
                                @if(auth::user()->level_id == 3)
                                <h4 class="widget-title">
                                   <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#recall"><i class="ace-icon fa fa-refresh"></i>&nbsp;&nbsp;Recall Bill</button>
                                </h4>
                                @endif
						</div>
                        <div class="widget-body">
                        <div class="widget-main" id="to_print">
                            <!--<img class="media-object" height="40%" width="40%" src="{{asset('Documents/hwd.jpg')}}"/>-->
                            @foreach($company as $data)
                            <div align="left"style="font-size: 20px;
                                font-family: 'Arial Narrow';">{{strtoupper($data->name)}} {{strtoupper($data->branch)}}
                             </div>
                             <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">TEL 1 :{{strtoupper($data->tel_one)}}
                             </div>
                             <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">TEL 2 :{{strtoupper($data->tel_two)}}
                             </div>
                            <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">
                                     PIN :{{$data->pin}}&nbsp;&nbsp;&nbsp;{{date("j/n/Y")}} {{date("H:i:s")}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                font-family: 'Arial Narrow';">RECEIPT NO :{{strtoupper($invoice_details->receipt_no)}} &nbsp;&nbsp;&nbsp;{{strtoupper($invoice_details->serving_mode)}}
                             </div>
                            @endforeach
                            <hr/>
                            <div>--------------------------------------------
                            --------------------------------------------</div>
                                <div>
                                    
                                    <table>
                                        
                                        <thead style="background-color:#fff;">
                                        
                                            <tr style="border:none;">
                                                <div align="left">
                                                     <th style="border:none;padding-right: 18px;padding-left:18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">ITEM</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">QTY</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 17px;font-family: 'Arial Narrow';font-family: 'Arial Narrow';">PRICE</th>
                                                <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">TOTAL</th>
                                                </div>
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        @foreach($invoice_data as $item)
                                            <tr style="border:none;">
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{strtoupper($item->product->name)}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->quantity}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->product->regular_price}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->line_total}}</td>
                                            </tr>
                                         @endforeach
                                        @if(count($delivery_charges) != 0)
                                            @foreach($delivery_charges as $delivery)
                                            <tr style="border:none;">
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';" colspan="3">Delivery to {{$delivery->route->name}}</td>
                                                <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$delivery->charges}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                          </tbody>
                                    </table> 
                                      <div>--------------------------------------------
                            --------------------------------------------</div>     
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        TOTAL : {{($invoice_details->to_pay)-($invoice_details->tax)}}.00</strong>
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        V.A.T &nbsp;&nbsp;&nbsp;: {{$invoice_details->tax}}.00</strong>
                                    </div>
                                     <div align="left"style="font-size: 20px;
                                     font-family: 'Arial Narrow';"><strong>
                                        *GRAND TOTAL* : {{$invoice_details->to_pay}}.00</strong>
                                    </div>
                                     
                                </div>
                            <hr/>
                            <div>--------------------------------------------
                            -------------------------------------------</div>
                            <div align="left"style="font-size: 20px;
                                     font-family: 'Arial Narrow';"><strong>M-PESA Till No : 9014221</strong></div>
                            <hr/>
                            <div>--------------------------------------------
                            --------------------------------------------</div>
                            <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">MODE : {{$invoice_details->mode}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">TOTAL QTY : {{count($invoice_data)}}
                            </div>
                             <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">SERVED BY  &nbsp;&nbsp;&nbsp;: {{$invoice_details->user->name}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                    font-family: 'Arial Narrow';"><i>Thank you for enjoying our services.Kindly keep this receipt for any product <br> exchange or return. T&C applies</i><br/>
                                -----------</div>
                            
                        </div><!-- /to print -->
                        </div><!-- widget body -->
                    </div><!-- Ending column 1-->
                    <div class="col-md-6">
                            <div class="widget-header">
								<h4 class="widget-title">
								<i class="ace-icon fa fa-money"></i>
                                 PAYMENT
                                </h4>
							</div>
                            <div id="accordion" class="accordion-style1 panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;CASH
                                            </a>
                                        </h4>
                                    </div>
									<div class="panel-collapse collapse in" id="collapseOne">
									    <div class="panel-body">
                                            <form class="form-inline" method="post" action="{{route('pay-invoice')}}">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                To Pay&nbsp;&nbsp;&nbsp;
                                                            </button>
                                                        </span>
                                                        <input type="number" name="to_pay" class="form-control" id="to_pay" value="{{$invoice_details->to_pay}}" readonly/>
                                                        <input type="hidden" class="input-small" name="receipt_id" value="{{$invoice_details->id}}"/>
                                                        <input type="hidden" class="input-small" name="status" value="1"/>
                                                        <input type="hidden" class="input-small" name="mode" value="CASH"/>
                                                        <input type="hidden" class="input-small" name="receipt_no" value="{{$invoice_details->receipt_no}}"/>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                     <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                Tenderd
                                                            </button>
                                                         </span>
                                                         <input type="number" class="form-control"  value="" id="tenderd" name="tenderd" onkeyup="issue()" required/> 
                                                      </div> 
                                                    </div>
                                                    <div class="col-md-6">.</div>
                                                    <div class="col-md-6">.</div>
                                                    <div class="col-md-6">
                                                      <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                CHANGE
                                                            </button>
                                                        </span>
                                                        <input type="number" class="form-control" value="" id="change" name="change" readonly/>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Complete
                                                        </button>
                                                    </div>
                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                                &nbsp;M-PESA
                                            </a>
                                        </h4>
                                    </div>
                            		<div class="panel-collapse collapse" id="collapseTwo">
										<div class="panel-body">
                                            <form class="form-inline" method="post" action="{{route('pay-invoice')}}">
                                            {{ csrf_field() }}
                                            @method('put')
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                To Pay &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </button>
                                                            </span>
                                                            <input type="number" name="to_pay" class="form-control" id="mpesa_to_pay" value="{{$invoice_details->to_pay}}" readonly/>
                                                            <input type="hidden" class="input-small" name="receipt_id" value="{{$invoice_details->id}}"/>
                                                            <input type="hidden" class="input-small" name="status" value="1"/>
                                                            <input type="hidden" class="input-small" name="tenderd" value="0"/>
                                                            <input type="hidden" class="input-small" name="change" value="0"/>
                                                            <input type="hidden" class="input-small" name="mode" value="M-PESA"/>
                                                            <input type="hidden" class="input-small" name="receipt_no" value="{{$invoice_details->receipt_no}}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                            <button type="button" class="btn btn-purple btn-sm">
                                                                Mpesa No.
                                                            </button>
                                                            </span>
                                                            <input type="text" class="form-control" name="mpesa_number" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            Initiate
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Ending payment tabs -->
                    </div><!-- Ending column 2 -->
                </div><!-- Ending row -->
        </div><!-- Ending card body -->
    </div><!-- Ending card header -->
</div><!-- Ending card -->


<!-- Modal for recalling a transaction--> 
<div id="recall" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="blue bigger">Recall bill ref #{{$invoice_details->receipt_no}}</h4>
        </div>

      <div class="modal-body">
      <form method="post" action="{{ route('recall','bill')}} ">
        {{ csrf_field() }}
        {{method_field('delete')}}
          <div class="row">
          <input type="hidden" name="receipt_no"  value="{{$invoice_details->receipt_no}}" class="form-control"/>
              <div class="col-md-6">
                 <table>
                    <thead style="background-color:#fff;">
                        <tr style="border:none;">
                            <div align="left">
                                    <th style="border:none;padding-right: 18px;padding-left:18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">ITEM</th>
                            <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">QTY</th>
                            <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 17px;font-family: 'Arial Narrow';font-family: 'Arial Narrow';">PRICE</th>
                            <th style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black; font-size: 17px;font-family: 'Arial Narrow';">TOTAL</th>
                            </div>
                        </tr>
                    
                    </thead>
                    <tbody>
                    @foreach($invoice_data as $item)
                        <tr style="border:none;">
                            <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{strtoupper($item->product->name)}}</td>
                            <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->quantity}}</td>
                            <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->product->regular_price}}</td>
                            <td style="border:none;padding-right: 18px;padding-left: 18px;text-align: left;background-color: #fff;color: black;font-size: 15px;font-family: 'Arial Narrow';">{{$item->line_total}}</td>
                        </tr>
                    @endforeach
                        </tbody>
                   </table> 
              </div>
          </div>
          
          <div class="modal-footer">
            <button class="btn btn-sm" data-dismiss="modal">
              <i class="ace-icon fa fa-times"></i>
              Cancel
            </button>
            <button class="btn btn-sm btn-primary" type="submit">
            <i class="ace-icon fa fa-check"></i>
              Proceed
            </button>
          </div>
        </form>
      </div>   
    </div>
  </div>
</div>
@endsection
