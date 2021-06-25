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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
                                    <span class="kt-widget26__number" id="total_customer">0</span>
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
                                    <span class="kt-widget26__number" id="total_driver">0</span>
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
                                    <span class="kt-widget26__number" id="total_armada">0</span>
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
                                                <span class="badge badge-success" id="total_armada_ready">0</span>
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
                                                <span class="badge badge-danger text-white" id="total_armada_not_ready">0</span>
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
                                    <span class="kt-widget26__number" id="total_transaction_done">0</span>
                                    <span class="kt-widget26__desc">Total Transaction Done</span>

                                    <div class="my-card-custom">
                                        <div class="kt-widget12__info">
                                            <div class="row item-card">
                                                <span class="total-income" id="total_transaction_done_income">Rp. {{number_format(0,0,',','.')}}</span>
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
    <script src="{{asset('assets/plugins/countUp.js-1.9.3/dist/countUp.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>

        function piechart(transaction_status_sum){
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
                    "litres": transaction_status_sum.pending,
                    "color": am4core.color("#ffb822")
                }, {
                    "status": "On Rent",
                    "litres": transaction_status_sum.on_rent,
                    "color": am4core.color("#5867dd")
                }];

                // Add data
                chart2.data = [ {
                    "status": "Success",
                    "litres": transaction_status_sum.success,
                    "color": am4core.color("#1dc9b7")
                }, {
                    "status": "Cancelled",
                    "litres": transaction_status_sum.cancelled,
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
        }
    </script>

    <script>
        $(function() {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            // var _promiseDasbor = function(start, end){
            //     return $.ajax({
            //         url: "{{ route('admin.dashboard') }}",
            //         dataType: 'json',
            //         async: true,
            //         method: 'POST',
            //         data: {
            //             '_token': csrf_token,
            //             'start': start,
            //             'end': end,
            //         }
            //     });
            // }

            var start = moment('1970-01-01');
            var end = moment();
            var label = 'All Time';

            function cb(start, end, label) {
                $('#date_picker_custom_date').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#date_picker_custom_title').html(label);

                let date_start = start.format('Y-MM-DD');
                let date_end = end.format('Y-MM-DD');

                $.ajax({
                    url: "{{ route('admin.dashboard.info') }}",
                    dataType: 'json',
                    async: true,
                    method: 'POST',
                    data: {
                        '_token': csrf_token,
                        'start': date_start,
                        'end': date_end,
                    }
                }).done(function (response) {
                    console.log('response:',response)
                    if(typeof response.total_customer !== undefined){
                        let countUp = new CountUp("total_customer", 0, response.total_customer, 0, 1);
                        countUp.start();

                        countUp = new CountUp("total_driver", 0, response.total_driver, 0, 1);
                        countUp.start();

                        countUp = new CountUp("total_armada", 0, response.armada.total, 0, 1);
                        countUp.start();

                        countUp = new CountUp("total_armada_ready", 0, response.armada.ready, 0, 1);
                        countUp.start();

                        countUp = new CountUp("total_armada_not_ready", 0, response.armada.not_ready, 0, 1);
                        countUp.start();

                        countUp = new CountUp("total_transaction_done", 0, response.transaction_done.total, 0, 1);
                        countUp.start();

                        const options = {
                            duration: 1,
                            separator: '.',
                            decimal: ',',
                            prefix: 'Rp.'
                        }

                        countUp = new CountUp("total_transaction_done_income", 0, response.transaction_done.income, 0, 1, options);
                        countUp.start();

                        piechart(response.transaction_status_sum)
                    }else{
                        $('#total_customer').html('error, please reload the page')
                    }
                }).fail(function (jqXHR, textStatus) {
                    console.log(textStatus)
                });

                // $.ajax({
                //     url: "{{ route('admin.dashboard') }}",
                //     dataType: 'json',
                //     async: true,
                //     method: 'POST',
                //     data: {
                //         '_token': csrf_token,
                //         'start': start,
                //         'end': end,
                //     },
                //     success: function(response){
                //         console.log('response:',response)
                //         if(typeof response.result.total_customer !== undefined){
                //             let countUp = new CountUp("total_customer", 0, response.result.total_customer, 0, 1);
                //             countUp.start();
                //         }else{
                //             $('#total_customer').html('error, please reload the page')
                //         }
                //     },
                //     error: function(xhr){
                //         console.log(xhr)
                //     }
                // })
            }

            $('#date_picker_custom').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                'All Time': [moment('1970-01-01 00:00:00'), moment()],
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end, label);
        });
    </script>

    {{-- DATE PICKER --}}
    {{-- <script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        "use strict";
        // Class definition
        var KTWidgets = function() {
            // Private properties
            // General Controls
            var _initDaterangepickercustom = function() {
                if ($('#date_picker_custom').length == 0) {
                    return;
                }
                var picker = $('#date_picker_custom');
                // var start = moment();
                // var start = moment().subtract(29, 'days');
                // var end = moment();
                // var label = 'Last 30 Days';
                var start = moment('1970-01-01');
                var end = moment();
                var label = 'All Time';
                function cb(start, end, label) {
                    var title = '';
                    var range = '';
                    var label = label || 'All Time';
                    // console.log('label', labelll)
                    if ((end - start) < 100 || label == 'Today') {
                        title = 'Today:';
                        range = start.format('MMM D');
                    } else if (label == 'Yesterday') {
                        title = 'Yesterday:';
                        range = start.format('MMM D');
                    } else if (label == 'Last 30 Days') {
                        title = 'Last 30 Days:';
                    }else if(label == 'All Time'){
                        title = 'All Time:';
                    } else {
                        range = start.format('MMM D') + ' - ' + end.format('MMM D');
                    }
                    $('#date_picker_custom_date').html(range);
                    $('#date_picker_custom_title').html(title);
                    // START:: Code AJAX
                    let date_start = start.format('Y-MM-DD');
                    let date_end = end.format('Y-MM-DD');
                    // Section 1
                    let promised_data_dasbor = _promiseDasbor(date_start, date_end)
                        promised_data_dasbor.done(function(response){
                            if(typeof response.result.total_customer !== undefined){
                                let countUp = new CountUp("total_customer", 0, response.result.total_customer, 0, 1);
                                countUp.start();
                            }else{
                                $('#total_customer').html('error, please reload the page')
                            }
                        })
                }
                picker.daterangepicker({
                    direction: KTUtil.isRTL(),
                    startDate: start,
                    endDate: end,
                    opens: 'left',
                    applyClass: 'btn-primary',
                    cancelClass: 'btn-light-primary',
                    ranges: {
                        'All Time': [moment('1970-01-01 00:00:00'), moment()],
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                        'Last 3 Month': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    }
                }, cb);
                cb(start, end, '');
            }
            // Promises for Guarantee the Asynchronus
            var _promiseDasbor = function(start, end){
                return $.ajax({
                    url: "{{ route('admin.dashboard') }}",
                    dataType: 'json',
                    async: true,
                    method: 'POST',
                    data: {
                        '_token': csrf_token,
                        'start': start,
                        'end': end,
                    }
                });
            }

            // Public methods
            return {
                init: function() {
                    _initDaterangepickercustom();
                    _promiseDasbor();
                }
            }
        }();
    </script> --}}
@endsection


