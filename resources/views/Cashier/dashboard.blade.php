@extends('layouts.cashier')
@section('content')
<div class="card">
    <div class="card-header">
       <a href="{{route('home')}}" class="btn btn-default btn-sm">Live Orders</a>
    </div>
        <div class="card-body">
            <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-3">
                    <a href="{{route('daily_sales')}}">
                        <div class="small-box bg-primary">
                            <div class="card-statistic-3 p-4">
                                <div class="card-icon card-icon-large"><i class="fa fa-money"></i></div>
                                <div class="mb-4">
                                    <h5 class="card-title mb-0">Sales Today</h5>
                                </div>
                                <div class="row align-items-center mb-2 d-flex">
                                    <div class="col-6">
                                        <h2 class="d-flex align-items-center mb-0">
                                          Ksh.{{$total_receipts}}
                                        </h2>
                                    </div>
                                    <div class="col-6 text-right">
                                       <span>Due = Ksh.{{$total_invoice}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                    <div></div>
                    <!--<div class="col-xl-3 col-lg-6 col-md-3">-->
                    <!--    <div class="small-box bg-primary">-->
                    <!--        <div class="card-statistic-3 p-4">-->
                    <!--            <div class="card-icon card-icon-large"><i class="fa fa-money"></i></div>-->
                    <!--            <div class="mb-4">-->
                    <!--                <h5 class="card-title mb-0">Sales Today</h5>-->
                    <!--            </div>-->
                    <!--            <div class="row align-items-center mb-2 d-flex">-->
                    <!--                <div class="col-8">-->
                    <!--                    <h2 class="d-flex align-items-center mb-0">-->
                    <!--                      Ksh.{{$total_receipts}}-->
                    <!--                    </h2>-->
                    <!--                </div>-->
                    <!--                <div class="col-4 text-right">-->
                    <!--                    <span>12.5% <i class="fa fa-arrow-up"></i></span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div></div>
                    <!--<div class="col-xl-3 col-lg-6 col-md-3">-->
                    <!--    <div class="small-box bg-warning">-->
                    <!--        <div class="card-statistic-3 p-4">-->
                    <!--            <div class="card-icon card-icon-large"><i class="fa fa-shopping-cart"></i></div>-->
                    <!--            <div class="mb-4">-->
                    <!--                <h5 class="card-title mb-0">New Orders</h5>-->
                    <!--            </div>-->
                    <!--            <div class="row align-items-center mb-2 d-flex">-->
                    <!--                <div class="col-8">-->
                    <!--                    <h2 class="d-flex align-items-center mb-0">-->
                    <!--                        3,243-->
                    <!--                    </h2>-->
                    <!--                </div>-->
                    <!--                <div class="col-4 text-right">-->
                    <!--                    <span>12.5% <i class="fa fa-arrow-up"></i></span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div></div>
                    <!--<div class="col-xl-3 col-lg-6 col-md-3">-->
                    <!--    <div class="small-box bg-danger">-->
                    <!--        <div class="card-statistic-3 p-4">-->
                    <!--            <div class="card-icon card-icon-large"><i class="fa fa-shopping-cart"></i></div>-->
                    <!--            <div class="mb-4">-->
                    <!--                <h5 class="card-title mb-0">New Orders</h5>-->
                    <!--            </div>-->
                    <!--            <div class="row align-items-center mb-2 d-flex">-->
                    <!--                <div class="col-8">-->
                    <!--                    <h2 class="d-flex align-items-center mb-0">-->
                    <!--                        3,243-->
                    <!--                    </h2>-->
                    <!--                </div>-->
                    <!--                <div class="col-4 text-right">-->
                    <!--                    <span>12.5% <i class="fa fa-arrow-up"></i></span>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
            </div><!-- clossing row-->
         </div><!-- clossing card-body -->
</div><!-- clossing card -->
@endsection
