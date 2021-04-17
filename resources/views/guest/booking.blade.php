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

        .booking-btn:hover{
            background-color: #D44911 !important;
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
                                        <option value="{{ $key }}" @if(old('tipe_armada') && old('tipe_armada') == $key) selected @endif>{{ ucfirst($key) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-armada">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Armada"></i>
                                </div>
                            </label>
                            <select class="form-control" name="id_armada" id="armada" data-current-price = '0' required disabled>
                                {{-- generate armada --}}
                            </select>
                            @error('id_armada')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-durasi-sewa">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Durasi Sewa <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Durasi Sewa (hari)"></i>
                                </div>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <a class="btn btn-secondary">Days</a>
                                </div>
                                <input class="form-control" type="number" min="1" name="durasi_sewa" id="durasi_sewa" autocomplete="off" value="{{ old('durasi_sewa') ?? 1 }}" placeholder="e.g 2" required disabled>
                            </div>
                            @error('durasi_sewa')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-pickup-date">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Pickup Date <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Pickup Date"></i>
                                </div>
                            </label>
                            {{-- <input class="form-control datetimepicker" type="text" name="pickup_date" id="pickup_date" autocomplete="off" required disabled> --}}
                            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                                <input type="text" name="pickup_date" class="form-control datetimepicker-input" data-target="#datetimepicker1" value="{{ old('pickup_date') }}" required/>
                                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @error('pickup_date')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-status-lepas-kunci">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Status Lepas Kunci <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Lepas Kunci"></i>
                                </div>
                            </label>
                            <select name="status_lepas_kunci" id="status_lepas_kunci" class="form-control" data-current-tambahan = '{{ old('status_lepas_kunci') && old('status_lepas_kunci') == 'shipped off key' ? $price_lepas_kunci_dikirim :  0}}' disabled>
                                <option value="">Pilih Status Lepas Kunci</option>
                                @foreach ($status_lepas_kunci as $item)
                                    <option value="{{$item}}" @if(old('status_lepas_kunci') == $item) selected @endif>{{$item}}</option>
                                @endforeach
                            </select>
                            @error('status_lepas_kunci')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-status-pengambilan">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Status Pengambilan <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Pengambilan"></i>
                                </div>
                            </label>
                            <select name="status_pengambilan" id="status_pengambilan" class="form-control" data-current-tambahan = '{{ old('status_pengambilan') && old('status_pengambilan') == 'send out car' ? $price_pengambilan_dikirim :  0}}' disabled>
                                <option value="">Pilih Status Pengambilan</option>
                                @foreach ($status_pengambilan as $item)
                                    <option value="{{$item}}" @if(old('status_pengambilan') == $item) selected @endif>{{$item}}</option>
                                @endforeach
                            </select>
                            @error('status_pengambilan')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-grand-total">
                            <label class="col-form-label">
                                <div class="pull-right" style="color:black; font-size:15px;">
                                    Grand Total <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Grand Total"></i>
                                </div>
                            </label>
                            <input type="text" min="0" class="form-control" name="grand_total" id="grand_total" data-total="{{ old('grand_total') ? str_replace([' ', 'Rp', 'Rp.', '.', ','], '', old('grand_total')) : 0 }}" value="{{ old('grand_total') ?? 'Rp 0' }}" readonly disabled>
                            @error('grand_total')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div style="margin: auto; width:50%; text-align:center">
                            <button class="btn btn-primary btn-sm" style="background-color:#FF5C00; border-radius: 6px; border:none; width:140px; height:44px; font-size:16px">
                                Booking
                            </button>
                        </div>
                    </div>
                </div>
        </form>
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
                $('#armada').trigger('change')
                $('#status_lepas_kunci').trigger('change')
                $('#status_pengambilan').trigger('change')
                $('#durasi_sewa').trigger('keyup')

                console.log($('#armada').data('current-price'))
                console.log($('#grand_total').data('total'))
                console.log($('#status_lepas_kunci').data('current-tambahan'))
                console.log($('#status_pengambilan').data('current-tambahan'))
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
            $('#pickup_date').prop('disabled', true)
            $('#status_lepas_kunci').prop('disabled', true)
            $('#status_pengambilan').prop('disabled', true)
            $('#status_lepas_kunci').prop('selectedIndex', 0)
            $('#status_pengambilan').prop('selectedIndex', 0)
            $('#grand_total').prop('disabled', true)
            $('#grand_total').data('total', 0)
            $('#grand_total').val('Rp 0')

            $('#status_lepas_kunci').data('current-tambahan',0)
            $('#status_pengambilan').data('current-tambahan',0)
            $('#armada').data('current-price',0)

            $('#form-group-durasi-sewa').slideUp(200)
            $('#form-group-pickup-date').slideUp(200)
            $('#form-group-status-lepas-kunci').slideUp(200)
            $('#form-group-status-pengambilan').slideUp(200)
            $('#form-group-grand-total').slideUp(200)
        }

        function enabledCertainInput(){
            $('#durasi_sewa').prop('disabled', false)
            $('#pickup_date').prop('disabled', false)
            $('#status_lepas_kunci').prop('disabled', false)
            $('#status_pengambilan').prop('disabled', false)
            $('#grand_total').prop('disabled', false)

            $('#form-group-durasi-sewa').slideDown(200)
            $('#form-group-pickup-date').slideDown(200)
            $('#form-group-status-lepas-kunci').slideDown(200)
            $('#form-group-status-pengambilan').slideDown(200)
            $('#form-group-grand-total').slideDown(200)
        }


        $('#tipe_armada').on('change', function(e){
            var value = $('#tipe_armada option:selected').val();

            if(value != ''){

                var data = @json($tipe_armada);
                var old_armada = {!! old('id_armada') !!}

                $('#form-group-armada').slideDown(200);
                $('#armada').prop('disabled', false)
                $('#armada').html('')
                $('#armada').append('<option value="">Pilih Armada</option>')

                $.each(data[value], function(index, value){
                    if(old_armada !== null && old_armada == value['id']){
                        $('#armada').data('current-price', value['price'])
                        $('#armada').append("<option value="+value['id']+" data-price="+value['price']+" data-status-driver='"+value['status_driver']+"' selected>"+value['kode_armada']+"</option>")
                    }else{
                        $('#armada').append("<option value="+value['id']+" data-price="+value['price']+" data-status-driver='"+value['status_driver']+"'>"+value['kode_armada']+"</option>")
                    }
                });

            }else{
                disabledCertainInput();

                $('#form-group-armada').slideUp(200);
                $('#armada').prop('disabled', true);
            }
        })

        $('#armada').on('change', function(e){
            var value = $('#armada option:selected').val()
            var current_price = $(this).data('current-price')
            var current_grand_total = $('#grand_total').data('total')

            if(value != ''){
                enabledCertainInput();

                var price = $('#armada option:selected').data('price');
                var total = (parseInt(current_grand_total) + parseInt(price)) - parseInt(current_price)
                $(this).data('current-price', price)
                $('#grand_total').val('Rp '+number_format(total,0,',','.'))
                $('#grand_total').data('total',total)

            }else{
                disabledCertainInput();
            }

        })

        $('#status_lepas_kunci').on('change', function(e){
            var current_tambahan = $(this).data('current-tambahan')
            var current_grand_total = $('#grand_total').data('total')
            var value = $('#status_lepas_kunci option:selected').val();
            var tambahan_harga = 0

            if(value == 'shipped off key'){
                tambahan_harga = {!! $price_lepas_kunci_dikirim !!}
            }

            var total = (parseInt(current_grand_total) + parseInt(tambahan_harga)) - parseInt(current_tambahan)
            $(this).data('current-tambahan', tambahan_harga)
            $('#grand_total').val('Rp '+number_format(total,0,',','.'))
            $('#grand_total').data('total', total)
        })

        $('#status_pengambilan').on('change', function(e){
            var current_tambahan = $(this).data('current-tambahan')
            var current_grand_total = $('#grand_total').data('total')
            var value = $('#status_pengambilan option:selected').val();
            var tambahan_harga = 0

            if(value == 'send out car'){
                tambahan_harga = {!! $price_pengambilan_dikirim !!}
            }

            var total = (parseInt(current_grand_total) + parseInt(tambahan_harga)) - parseInt(current_tambahan)
            $(this).data('current-tambahan', tambahan_harga)
            $('#grand_total').val('Rp '+number_format(total,0,',','.'))
            $('#grand_total').data('total', total)
        })

        $('#durasi_sewa').on('keyup', function(e){
            var days = $(this).val()
            var current_price = $('#armada').data('current-price')
            var current_tambahan_lepas_kunci = $('#status_lepas_kunci').data('current-tambahan')
            var current_tambahan_pengambilan = $('#status_pengambilan').data('current-tambahan')

            var total = (parseInt(days) * parseInt(current_price)) + (parseInt(current_tambahan_lepas_kunci) + parseInt(current_tambahan_pengambilan))

            $('#grand_total').val('Rp '+number_format(total,0,',','.'))
            $('#grand_total').data('total', total)

        })
    </script>
</body>

</html>
