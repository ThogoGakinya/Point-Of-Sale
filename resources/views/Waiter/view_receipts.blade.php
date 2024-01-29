@extends('layouts.waiter')
@section('content')
<div class="card" style="height: 80vh;">
    <div class="card-header"><a href="{{url('home')}}">Home</a>/<a href="{{route('receipts-invoices')}}">Receipts</a>/{{$receipt_details->receipt_no}}</div>
        <div class="card-body" style="background-image: url('{{asset('assets/images/mojito/texture_bg.jpg')}}');">
                <div class="row justify-content-center align-items-round" >
                    <div class="col-md-4">
                        <div class="widget-header">
								<h4 class="widget-title">
								<button type="button" class="btn btn-success btn-sm" onclick="printContent('to_print')"><i class="ace-icon fa fa-print"></i></i>&nbsp;&nbsp;Print</button>
                                </h4>
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
                                font-family: 'Arial Narrow';">RECEIPT NO :{{strtoupper($receipt_details->receipt_no)}} &nbsp;&nbsp;&nbsp;{{strtoupper($receipt_details->serving_mode)}}
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
                                        @foreach($receipt_data as $item)
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
                                        TOTAL : {{($receipt_details->to_pay)-($receipt_details->tax)}}.00
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        V.A.T &nbsp;&nbsp;&nbsp;: {{$receipt_details->tax}}.00
                                    </div>
                                     <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        GRAND TOTAL : {{$receipt_details->to_pay}}.00
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        TENDERD : {{$receipt_details->tenderd}}.00
                                    </div>
                                    <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">
                                        CHANGE : {{$receipt_details->change}}.00
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
                                     font-family: 'Arial Narrow';">MODE : {{$receipt_details->mode}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">TOTAL QTY : {{count($receipt_data)}}
                            </div>
                             <div align="left"style="font-size: 17px;
                                     font-family: 'Arial Narrow';">SERVED BY  &nbsp;&nbsp;&nbsp;: {{$receipt_details->user->name}}
                            </div>
                            <div align="left"style="font-size: 17px;
                                    font-family: 'Arial Narrow';"><i>Thank you for enjoying our services.Kindly keep this receipt for<br/>  any product exchange or return. T&C applies</i><br/>
                                <div>------Powerd by Cybrex Systems +254713287641---------------</div>
                            </div>
                        </div><!-- /to print -->
                        </div><!-- widget body -->
                    </div><!-- Ending column 1-->
                </div><!-- Ending row -->
        </div><!-- Ending card body -->
    </div><!-- Ending card header -->
</div><!-- Ending card -->
@endsection
