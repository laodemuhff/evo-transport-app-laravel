@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Dashboard
    </h3>


@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <!--Begin::Dashboard 4-->
    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/Quick Stats-->
            <div class="row row-full-height">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26">
                                <div class="kt-widget26__content">
                                    <span class="kt-widget26__number">570</span>
                                    <span class="kt-widget26__desc">Total Sales</span>
                                </div>
                                <div class="kt-widget26__chart" style="height:100px; width: 230px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="kt_chart_quick_stats_1" width="230" height="115" style="display: block; width: 230px; height: 115px;" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-space-20"></div>
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-danger">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26">
                                <div class="kt-widget26__content">
                                    <span class="kt-widget26__number">640</span>
                                    <span class="kt-widget26__desc">Completed Transactions</span>
                                </div>
                                <div class="kt-widget26__chart" style="height:100px; width: 230px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="kt_chart_quick_stats_2" width="230" height="115" style="display: block; width: 230px; height: 115px;" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-success">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26">
                                <div class="kt-widget26__content">
                                    <span class="kt-widget26__number">234+</span>
                                    <span class="kt-widget26__desc">Transactions</span>
                                </div>
                                <div class="kt-widget26__chart" style="height:100px; width: 230px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="kt_chart_quick_stats_3" width="230" height="115" style="display: block; width: 230px; height: 115px;" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-space-20"></div>
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-warning">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26">
                                <div class="kt-widget26__content">
                                    <span class="kt-widget26__number">4.4M$</span>
                                    <span class="kt-widget26__desc">Paid Comissions</span>
                                </div>
                                <div class="kt-widget26__chart" style="height:100px; width: 230px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="kt_chart_quick_stats_4" width="230" height="115" style="display: block; width: 230px; height: 115px;" class="chartjs-render-monitor"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Quick Stats-->
        </div>
    </div>
    <!--End::Row-->
    <!--End::Dashboard 4-->
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>
@endsection
