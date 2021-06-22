@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Dashboard
    </h3>

    <div class="d-flex align-items-center">
        <a href="#" class="btn btn-sm btn-light font-weight-bold mr-2" id="date_picker_custom" data-toggle="tooltip" title="" data-placement="left" data-original-title="Select dashboard daterange">
            <span class="text-muted font-size-base font-weight-bold mr-2" id="date_picker_custom_title">All Time:</span>
            <span class="text-primary font-size-base font-weight-bolder" id="date_picker_custom_date"></span>
        </a>
    </div>
@endsection

@section('styles')
    <style>
        #chartdiv, #chartdiv2 {
            width: 100%;
            height: 220px;
        }

        .label-text{
            color: #74788d;
            font-size: 1.1rem;
            font-weight: 400;
            margin-top: 0.55rem;
        }

        .item-card{
            padding-top: 10px;
            padding-top: 5px;
            padding-left: 2px;
        }

        .label-icon{
            font-size: 1.5rem;
        }

        .my-card-custom{
            padding-top: 12%;
            width: 268px;
        }

        .total-income{
            color: #74788d;
            font-size: 1.75rem;
            font-weight: 600;
            padding: 20px;
            width: 100%;
            text-align: center;
            /* background-color: #90a0ee; */
            border-radius: 10px;
            /* color: white; */
            border: dashed rgb(73, 72, 72) 1px;
            opacity: 0.7;
        }
    </style>
@endsection

@section('content')
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid" style="padding: 0">
    <!--Begin::Dashboard 4-->
    <!--Begin::Row-->
    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/Quick Stats-->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4" style="height: 260px">
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand" style="height: calc(45%)">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26 row">
                                <div class="col-2 col-sm-2 col-md-3 mt-2">
                                    <i class="flaticon-users-1" style="font-size: 2.75rem; margin-top:30px"></i>
                                </div>
                                <div class="kt-widget26__content col-10 col-sm-10 col-md-9">
                                    <span class="kt-widget26__number">57</span>
                                    <span class="kt-widget26__desc">Total Customer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-space-20"></div>
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-danger" style="height: calc(45%)">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26 row">
                                <div class="col-2 col-sm-2 col-md-3 mt-2">
                                    <i class="flaticon-users" style="font-size: 2.75rem; margin-top:30px"></i>
                                </div>
                                <div class="kt-widget26__content col-10 col-sm-10 col-md-9">
                                    <span class="kt-widget26__number">4</span>
                                    <span class="kt-widget26__desc">Total Driver</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand" style="height: calc(92.5%)">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26 row">
                                <div class="kt-widget26__content col-10 col-sm-10 col-md-9">
                                    <span class="kt-widget26__number">10</span>
                                    <span class="kt-widget26__desc">Total Armada</span>

                                    <div class="my-card-custom">
                                        <div class="row item-card">
                                            <div class="col-md-2" style="padding-top: 3px">
                                                <i class="flaticon-squares-1 label-icon"></i>&nbsp;
                                            </div>
                                            <div class="col-md-8">
                                                <label for="" class="label-text">Ready</label>
                                            </div>
                                            <div class="col-md-2" style="padding-top: 5px">
                                                <span class="badge badge-success">3</span>
                                            </div>
                                        </div>
                                        <div class="row item-card">
                                            <div class="col-md-2" style="padding-top: 3px">
                                                <i class="flaticon-squares-1 label-icon"></i>&nbsp;
                                            </div>
                                            <div class="col-md-8">
                                                <label for="" class="label-text">Not Ready</label>
                                            </div>
                                            <div class="col-md-2" style="padding-top: 5px">
                                                <span class="badge badge-danger text-white">7</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-space-20"></div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-warning" style="height: calc(92.5%)">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26 row">
                                <div class="kt-widget26__content col-10 col-sm-10 col-md-9">
                                    <span class="kt-widget26__number">75</span>
                                    <span class="kt-widget26__desc">Total Transaction</span>

                                    <div class="my-card-custom">
                                        <div class="kt-widget12__info">
                                            <div class="row item-card">
                                                <span class="total-income">Rp. {{number_format(45000000,0,',','.')}}</span>
                                            </div>
                                            <div class="row item-card">
                                               <span style="text-align: center; width:100%"><i>Total Income</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-space-20"></div>
                </div>
            </div>
            <!--end:: Widgets/Quick Stats-->
            <div class="row mt-2">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-warning" style="height: calc(98%)">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26 row">
                                <h5 style="text-align: center">Total Pending & On Rent Transaction</h5>
                                <div id="chartdiv" style="margin-top: 30px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-space-20"></div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-warning" style="height: calc(98%)">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26 row">
                                <h5 style="text-align: center">Total Success & Cancelled Transaction</h5>
                                <div id="chartdiv2" style="margin-top: 30px"></div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-space-20"></div>
                </div>
            </div>
        </div>
    </div>
    <!--End::Row-->
    <!--End::Dashboard 4-->
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/pages/dashboard.js') }}" type="text/javascript"></script>
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
    <script>
        am4core.ready(function() {

        // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            // Create chart instance
            var chart = am4core.create("chartdiv", am4charts.PieChart);
            var chart2 = am4core.create("chartdiv2", am4charts.PieChart);

            // Add data
            chart.data = [ {
                "status": "Pending",
                "litres": 12,
                "color": am4core.color("#ffb822")
            }, {
                "status": "On Rent",
                "litres": 8,
                "color": am4core.color("#5867dd")
            }];

            // Add data
            chart2.data = [ {
                "status": "Success",
                "litres": 500,
                "color": am4core.color("#1dc9b7")
            }, {
                "status": "Cancelled",
                "litres": 20,
                "color": am4core.color("#fd397a")
            }];

            chart.legend = new am4charts.Legend();
            chart2.legend = new am4charts.Legend();

            // Add and configure Series
            var pieSeries = chart.series.push(new am4charts.PieSeries());
            pieSeries.dataFields.value = "litres";
            pieSeries.dataFields.category = "status";
            pieSeries.slices.template.stroke = am4core.color("#fff");
            pieSeries.slices.template.strokeWidth = 2;
            pieSeries.slices.template.strokeOpacity = 1;
            pieSeries.slices.template.propertyFields.fill = "color";

            // This creates initial animation
            pieSeries.hiddenState.properties.opacity = 1;
            pieSeries.hiddenState.properties.endAngle = -90;
            pieSeries.hiddenState.properties.startAngle = -90;

            // Add and configure Series
            var pieSeries2 = chart2.series.push(new am4charts.PieSeries());
            pieSeries2.dataFields.value = "litres";
            pieSeries2.dataFields.category = "status";
            pieSeries2.slices.template.stroke = am4core.color("#fff");
            pieSeries2.slices.template.strokeWidth = 2;
            pieSeries2.slices.template.strokeOpacity = 1;
            pieSeries2.slices.template.propertyFields.fill = "color";

            // This creates initial animation
            pieSeries2.hiddenState.properties.opacity = 1;
            pieSeries2.hiddenState.properties.endAngle = -90;
            pieSeries2.hiddenState.properties.startAngle = -90;

        }); // end am4core.ready()
    </script>
@endsection


