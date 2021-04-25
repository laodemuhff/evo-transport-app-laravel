<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Evo Transport | @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('/') }}">

    {{-- begin::Fonts --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">
    {{-- end::Fonts --}}

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>


    {{-- begin::Global Theme Styles(used by all pages) --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom_switch_button.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {{-- end::Global Theme Styles --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('custom_style/home.css')}}">
    @yield('styles')

    <style>
        select:focus > option:hover {
            background: #FF5C00 !important;
        }

        #booking-btn:hover{
            background-color: #D44911 !important;
        }

        #cek-harga-sewa-btn:hover{
            cursor: pointer;
        }
    </style>
</head>
<!-- begin::Body -->

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('home')}}">
            <img src="{{asset('assets/img/web-icon.png')}}" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}#about-us" data-scroll="" data-options="easing: easeOutQuart">Tentang Kami <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{route('katalog')}}" data-scroll="" data-options="easing: easeOutQuart">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('kontak')}}" data-scroll="" data-options="easing: easeOutQuart">Contact</a>
                </lai>
                <li class="nav-item separator">
                    <a class="nav-link" href="#">|</a>
                </li>
                <li class="nav-item phone-number">
                    {{-- <a class="nav-link" href="#" style="color:#D44911 !important"><i class="la la-phone"
                            style="color:#D44911; font-size:1.3em"></i> &nbsp;&nbsp;(+62) 822 6189 9199</a> --}}
                        <a class="btn-booking" href="{{route('booking')}}" role="button">Booking</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 15%; padding-left:10%; padding-right:10%">
        <h3 style="color: #000000; font-family:Poppins; font-size:30px; font-weight:bold; text-align:center">Data Pemesanan</h3>
        {{-- <div class="row">
            <div class="col">
                <div class="alert alert-light alert-elevate fade show" role="alert">
                    <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                    <div class="alert-text">
                        Pada page ini anda dapat membuat transaksi baru
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row" style="margin: auto; width:50%">
            <div class="col-md-12">
                @include('layouts.notification')
            </div>
        </div>

        <form action="{{route('transaction.store')}}" method="POST" enctype="multipart/form-data" style="margin-top: 6%">
            <input type="hidden" name="guest_booking" value="{{true}}">
            @csrf
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-6" style="margin:auto; width:50%">
                        <div class="form-group row">
                            <label class="col-form-label">
                                <div class="pull-left" style="color:black; font-size:15px;">
                                    Nama Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Nama Customer"></i>
                                </div>
                            </label>
                            <input type="text" name="nama_customer" id="nama_customer" class="form-control" value="{{ old('nama_customer') }}" placeholder="e.g John Wick" required>
                            @error('nama_customer')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    No. Telepon Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="No. Telp."></i>
                                </div>
                            </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="no_hp_customer" id="no_hp_customer" autocomplete="off" value="{{ old('no_hp_customer') }}" placeholder="e.g 081234872640" required>
                            </div>
                            @error('no_hp_customer')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Alamat Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Alamat Customer"></i>
                                </div>
                            </label>
                            <textarea name="alamat_customer" id="alamat_customer" cols="30" rows="10" class="form-control">{{old('alamat_customer')}}</textarea>
                            @error('alamat_customer')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 5%">
                    {{-- Input field --}}
                    <div class="col-md-6" style="margin:auto;width:50%">
                        <div class="form-group row">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Tipe Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Tipe Armada"></i>
                                </div>
                            </label>
                            <select class="form-control" name="tipe_armada" id="tipe_armada" required>
                                <option value="">Pilih Tipe Armada</option>
                                @foreach ($tipe_armada as $key => $item)
                                    @if (!empty($item))
                                        @if (!empty($cat_id_tipe_armada))
                                            <option value="{{ $item[0]['id_tipe_armada'] }}" @if($cat_id_tipe_armada == $item[0]['id_tipe_armada']) selected @endif data-is-driver-allowed="{{$item[0]['is_driver_allowed']}}">{{ ucfirst($key) }}</option>
                                        @else
                                            <option value="{{ $item[0]['id_tipe_armada'] }}" @if(old('tipe_armada') && old('tipe_armada') == $item[0]['id_tipe_armada']) selected @endif data-is-driver-allowed="{{$item[0]['is_driver_allowed']}}">{{ ucfirst($key) }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row" @if (empty($cat_id_tipe_armada)) style="display: none" @endif id="form-group-durasi-sewa">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Durasi Sewa <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Durasi Sewa (Jam)"></i>
                                </div>
                            </label>

                            <div class="input-group" id="durasi_sewa_box">
                                <div class="input-group-prepend">
                                    <a class="btn btn-danger" type="button" style="color: white; font-weight:bolder" id="sub_durasi_sewa">-</a>
                                </div>
                                <input class="form-control" type="text" name="durasi_sewa" id="durasi_sewa" autocomplete="off" value="{{ old('durasi_sewa') ?? 12 }}" required @if(empty($cat_id_tipe_armada)) disabled @endif style="text-align:center; font-weight:bold">
                                <div class="input-group-prepend">
                                    <a class="btn btn-primary" type="button" style="color: white; font-weight:bolder" id="add_durasi_sewa">+</a>
                                </div>
                            </div>
                            @error('durasi_sewa')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" @if (empty($cat_id_tipe_armada)) style="display: none" @endif id="form-group-pickup-date">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Pickup Date <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Pickup Date"></i>
                                </div>
                            </label>
                            {{-- <input class="form-control datetimepicker" type="text" name="pickup_date" id="pickup_date" autocomplete="off" required disabled> --}}
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input type="text" name="pickup_date" id="pickup_date" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="{{ old('pickup_date') }}" required/>
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('pickup_date')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" @if (empty($cat_id_tipe_armada)) style="display: none" @endif id="form-group-status-lepas-kunci">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Status Lepas Kunci <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Lepas Kunci"></i>
                                </div>
                            </label>
                            <select name="status_lepas_kunci" id="status_lepas_kunci" class="form-control" @if(empty($cat_id_tipe_armada)) disabled @endif>
                                @foreach ($status_lepas_kunci as $item)
                                    <option value="{{$item}}" @if(old('status_lepas_kunci') == $item) selected @endif>
                                        @if ($item == 'off key')
                                            Lepas Kunci
                                        @else
                                            Mobil + Driver
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('status_lepas_kunci')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" @if (empty($cat_id_tipe_armada)) style="display: none" @endif id="form-group-status-pengambilan">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Status Pengambilan <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Pengambilan"></i>
                                </div>
                            </label>
                            <select name="status_pengambilan" id="status_pengambilan" class="form-control" @if(empty($cat_id_tipe_armada)) disabled @endif>
                                @foreach ($status_pengambilan as $item)
                                    <option value="{{$item}}" @if(old('status_pengambilan') == $item) selected @endif>
                                        @if ($item == 'taken in place')
                                            Ambil di Tempat
                                        @else
                                            Mobil Dikirimkan
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('status_pengambilan')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" id="cek-harga-sewa-btn-form" @if (empty($cat_id_tipe_armada)) style="display: none" @endif>
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Cek Harga Sewa <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Cek Harga Sewa"></i>
                                </div>
                            </label>
                            &nbsp;&nbsp;
                            <a data-toggle="modal" data-target="#cek-grand-total" class="btn btn-success" id="cek-harga-sewa-btn" style="border-radius: 50%; width:8.5%"><i class="flaticon-price-tag" style="color: white"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div style="margin: auto; width:50%; text-align:center">
                            <button id="booking-btn" class="btn btn-primary btn-sm" style="background-color:#FF5C00; border-radius: 6px; border:none; width:140px; height:44px; font-size:16px">
                                Booking
                            </button>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <div id="cek-grand-total" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Grand Total</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 id="grand-total-modal"></h3>
                    <hr>
                    <p>Detail : </p>
                    <table class="table">
                        <tr>
                            <td>Status Lepas Kunci</td>
                            <td id="status-lepas-kunci-modal"></td>
                        </tr>
                        <tr>
                            <td>Status Pengambilan</td>
                            <td id="status-pengambilan-modal"></td>
                        </tr>
                        <tr>
                            <td>Durasi</td>
                            <td id="durasi-modal"></td>
                        </tr>
                        <tr>
                            <td>Harga per Hari</td>
                            <td id="price24-modal"></td>
                        </tr>
                        <tr>
                            <td>Harga per 12 Jam</td>
                            <td id="price12-modal"></td>
                        </tr>
                        <tr>
                            <td>Penambahan Harga</td>
                            <td id="penambahan-harga-modal"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <footer style="padding: 3% 15% 2% 15%; text-align:center" id="contact">
        <img src="{{asset('image/full-logo.png')}}" alt="">
        <p style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; margin-top:2%">Jl. Bangau Gang Merak Plemburan Sariharjo Ngaglik, Sleman, Yogyakarta, 55581</p>
        <p>
            <span><img src="{{asset('image/insta.png')}}" alt="instagram"></span>
            <span style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; vertical-align:middle; margin-left:1%">0812 2638 5760</span>

            <span style="margin-left:3%"><img src="{{asset('image/wa.png')}}" alt="instagram"></span>
            <span style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; vertical-align:middle; margin-left:1%; margin-right:3%">EVO_TRANSPORT</span>

            <span><img src="{{asset('image/loc.png')}}" alt="instagram"></span>
            <span style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; vertical-align:middle; margin-left:1%">EVO_TRANSPORT</span>
        </p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        $(function(){
            AOS.init({
                easing: 'ease',
                duration: 1000,
            });
        })
    </script>

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <!-- end::Global Config -->

    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha512-2JBCbWoMJPH+Uj7Wq5OLub8E5edWHlTM4ar/YJkZh3plwB2INhhOC3eDoqHm1Za/ZOSksrLlURLoyXVdfQXqwg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/helper.js') }}" type="text/javascript"></script>
    <script>
        $(function(){
            $('#datetimepicker1').datetimepicker({
                format: 'D MMM Y - HH:mm:ss',
                defaultDate: new Date(),
            });

            // retrieve old input data
            var old_input = "{!! old('nama_customer') !!}"
            if(old_input !== ""){
                $('#tipe_armada').trigger('change')
                $('#status_lepas_kunci').trigger('change')
                $('#status_pengambilan').trigger('change')
                $('#durasi_sewa').trigger('keyup')
            }

        })

        function getFormattedDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear().toString().slice(2);
            return day + '-' + month + '-' + year;
        }

        function disabledCertainInput(){
            $('#durasi_sewa').prop('disabled', true)
            $('#durasi_sewa').prop('readonly', false)
            $('#pickup_date').prop('disabled', true)
            $('#status_lepas_kunci').prop('disabled', true)
            $('#status_pengambilan').prop('disabled', true)
            $('#status_lepas_kunci').prop('selectedIndex', 0)
            $('#status_pengambilan').prop('selectedIndex', 0)

            $('#status_lepas_kunci').data('current-tambahan',0)
            $('#status_pengambilan').data('current-tambahan',0)

            $('#form-group-durasi-sewa').slideUp(200)
            $('#form-group-pickup-date').slideUp(200)
            $('#form-group-status-lepas-kunci').slideUp(200)
            $('#form-group-status-pengambilan').slideUp(200)
            $('#cek-harga-sewa-btn-form').slideUp(200);
        }

        function enabledCertainInput(){
            $('#durasi_sewa').prop('disabled', false)
            $('#durasi_sewa').prop('readonly', true)
            $('#pickup_date').prop('disabled', false)
            $('#status_lepas_kunci').prop('disabled', false)
            $('#status_pengambilan').prop('disabled', false)

            $('#form-group-durasi-sewa').slideDown(200)
            $('#form-group-pickup-date').slideDown(200)
            $('#form-group-status-lepas-kunci').slideDown(200)
            $('#form-group-status-pengambilan').slideDown(200)
            $('#cek-harga-sewa-btn-form').slideDown(200);
        }


        $('#tipe_armada').on('change', function(e){
            var index = $('#tipe_armada option:selected').data('index');
            var value = $('#tipe_armada option:selected').val();

            if(value != ''){
                enabledCertainInput();

                var data = @json($tipe_armada);
                var is_driver_allowed =$('#tipe_armada option:selected').data('is-driver-allowed');
                var status_lepas_kunci = {!! json_encode($status_lepas_kunci) !!};


                var old_status_lepas_kunci = "{!! old('status_lepas_kunci') !!}"
                if(!is_driver_allowed){
                    $('#status_lepas_kunci').html('')
                    $.each(status_lepas_kunci, function(i, val){
                        if(val != 'with driver'){
                            $('#status_lepas_kunci').append("<option value='"+val+"'>Lepas Kunci</option>");
                        }
                    });
                }else{
                    $('#status_lepas_kunci').html('')
                    $.each(status_lepas_kunci, function(i, val){
                        if(val == 'off key'){
                            item_name = 'Lepas Kunci';
                        }else{
                            item_name = 'Mobil + Driver'
                        }

                        if (old_status_lepas_kunci !== undefined && old_status_lepas_kunci == val) {
                            $('#status_lepas_kunci').append("<option value='"+val+"' selected>"+item_name+"</option>");
                        } else {
                            $('#status_lepas_kunci').append("<option value='"+val+"'>"+item_name+"</option>");
                        }

                    });
                }


            }else{
                disabledCertainInput();
            }
        })

        $('#sub_durasi_sewa').on('click', function(e){
            let hours = $('#durasi_sewa').val()

            if(hours != 12){
                $('#durasi_sewa').val(parseInt(hours) - 12);
            }
        });


        $('#add_durasi_sewa').on('click', function(e){
            let hours = $('#durasi_sewa').val()

            // max 5 days (60 hours)
            if(hours != 60){
                $('#durasi_sewa').val(parseInt(hours) + 12);
            }
        });

        $('#cek-harga-sewa-btn').click(function(){
            let url = $("meta[name='base_url']").attr('content');
            let _token = $('meta[name="csrf-token"]').attr('content');
            let id_tipe_armada = parseInt($('#tipe_armada option:selected').val());
            let durasi = parseInt($ ('#durasi_sewa').val())
            let status_pengambilan = $('#status_pengambilan option:selected').val()
            let status_lepas_kunci = $('#status_lepas_kunci option:selected').val()

            $.ajax({
                url : url+"/transaction/cek-harga-sewa",
                dataType : "json",
                method: "POST",
                data : {
                    _token : _token,
                    id_tipe_armada : id_tipe_armada,
                    durasi : durasi,
                    status_pengambilan : status_pengambilan,
                    status_lepas_kunci : status_lepas_kunci,
                }
            }).done(function(data){
                console.log('success',data)
                $('#grand-total-modal').html(data.grand_total);
                $('#status-lepas-kunci-modal').html(data.status_lepas_kunci);
                $('#status-pengambilan-modal').html(data.status_pengambilan);
                $('#price12-modal').html(data.price12);
                $('#price24-modal').html(data.price24);
                $('#penambahan-harga-modal').html(data.penambahan_harga);
                $('#durasi-modal').html(data.durasi);

            }).fail(function(data){
                console.log('fail', data)
            })
        })

    </script>
</body>

</html>
