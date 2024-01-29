@extends('layouts.staff')
@section('content')
  <div class="row justify-content-center align-items-round">
<!--      <marquee direction="left" class="marq" behavior="alternate"-->
<!--                 direction="left" loop=""><font size="5px" color="red">-->
<!--Your subscription for Cybrex POS expires on 8/31/2021.Please buy full license                   .</font></marquee>-->
        <div class="col-md-6">
            <div class="widget-box" style="height:300px;">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        {{ $chart1->options['chart_title'] }}
                    </h5>

                    <div class="widget-toolbar no-border">
                        <div class="inline dropdown-hover">
                            <button class="btn btn-minier btn-primary">
                                Today
                                <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                <li class="active">
                                    <a href="#" class="blue">
                                        <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                        This Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Month
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Year
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        {!! $chart1->renderHtml() !!}
                    </div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->
        </div><!-- /.col -->
        <div class="col-md-6">
            <div class="widget-box" style="height:300px;">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        {{ $chart2->options['chart_title'] }}
                    </h5>

                    <div class="widget-toolbar no-border">
                        <div class="inline dropdown-hover">
                            <button class="btn btn-minier btn-primary">
                                This Week
                                <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                <li class="active">
                                    <a href="#" class="blue">
                                        <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                        This Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                    {!! $chart2->renderHtml() !!}
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
            <br/>
            <div class="col-md-6">
            <div class="widget-box" style="height:300px;">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        {{ $chart3->options['chart_title'] }}
                    </h5>

                    <div class="widget-toolbar no-border">
                        <div class="inline dropdown-hover">
                            <button class="btn btn-minier btn-primary">
                                Today
                                <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                <li class="active">
                                    <a href="#" class="blue">
                                        <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                        This Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                    {!! $chart3->renderHtml() !!}
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box --><div class="col-md-6">
            <div class="widget-box" style="height:300px;">
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-signal"></i>
                        {{ $chart4->options['chart_title'] }}
                    </h5>

                    <div class="widget-toolbar no-border">
                        <div class="inline dropdown-hover">
                            <button class="btn btn-minier btn-primary">
                                Today
                                <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                                <li class="active">
                                    <a href="#" class="blue">
                                        <i class="ace-icon fa fa-caret-right bigger-110">&nbsp;</i>
                                        This Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Week
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        This Month
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        Last Month
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="widget-body">
                    <div class="widget-main">
                        {!! $chart4->renderHtml() !!}
                        </div>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
    </div>
@endsection

