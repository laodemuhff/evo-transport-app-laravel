@extends('layouts.app')

@section('title', 'Create Transaction')
@section('transaction', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Transaction Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('transaction.create')}}" class="kt-subheader__breadcrumbs-link">
            Create Transaction
        </a>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha512-PMjWzHVtwxdq7m7GIxBot5vdxUY+5aKP9wpKtvnNBZrVv1srI8tU6xvFMzG8crLNcMj/8Xl/WWmo/oAP/40p1g==" crossorigin="anonymous" />
    <style>
       .bootstrap-datetimepicker-widget {
            list-style: none;
        }
        .bootstrap-datetimepicker-widget.dropdown-menu {
            margin: 2px 0;
            padding: 4px;
            width: 21em;
        }

        .my-alert{
            position: relative;
            /* padding: 0.75rem 1.25rem; */
            /* margin-bottom: 1rem; */
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }

        .my-alert.alert-danger {
            background: none !important;
            color: rgb(238, 16, 16) !important;
        }

        #durasi_sewa_box::after{
            content: 'Hour';
            padding: 9px 0 0 10px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat membuat transaksi baru
                </div>
            </div>
        </div>
    </div>
    @include('layouts.notification')

    <form action="{{route('transaction.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="m-portlet__head-caption" style="padding-top:15px">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text">
                        Customer Info
                        </h4>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Nama Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Nama Customer"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="text" name="nama_customer" id="nama_customer" class="form-control" value="{{ old('nama_customer') }}" required>
                            </div>
                            @error('nama_customer')
                                <div class="my-alert alert-danger">! {{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    No. Telepon Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="No. Telp."></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="no_hp_customer" id="no_hp_customer" autocomplete="off" value="{{ old('no_hp_customer') }}" required>
                                </div>
                                @error('no_hp_customer')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Alamat Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Alamat Customer"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <textarea name="alamat_customer" id="alamat_customer" cols="30" rows="10" class="form-control">{{old('alamat_customer')}}</textarea>
                                @error('alamat_customer')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="m-portlet__head-caption" style="padding-top:15px">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text">
                        Transaction Info
                        </h4>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-8">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Tipe Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Tipe Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="tipe_armada" id="tipe_armada" data-current-price = '0' required>
                                    <option value="">Pilih Tipe Armada</option>
                                    @foreach ($tipe_armada as $key => $item)
                                        <option value="{{ $item['tipe'] }}" @if(old('tipe_armada') && old('tipe_armada') == $item['tipe']) selected @endif data-price="{{$item['price']}}" data-index={{$key}}>{{ ucfirst($item['tipe']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-armada">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="id_armada" id="armada" required disabled>
                                    {{-- generate armada --}}
                                </select>
                                @error('id_armada')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-durasi-sewa">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Durasi Sewa <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Durasi Sewa (jam)"></i>
                                </div>
                            </label>
                            <div class="col-4">
                                <div class="input-group" id="durasi_sewa_box">
                                    <div class="input-group-prepend">
                                        <a class="btn btn-danger" type="button" style="color: white; font-weight:bolder" id="sub_durasi_sewa">-</a>
                                    </div>
                                    <input class="form-control" type="text" name="durasi_sewa" id="durasi_sewa" autocomplete="off" value="{{ old('durasi_sewa') ?? 12 }}" required disabled style="max-width:43px">
                                    <div class="input-group-prepend">
                                        <a class="btn btn-primary" type="button" style="color: white; font-weight:bolder" id="add_durasi_sewa">+</a>
                                    </div>
                                </div>
                                @error('durasi_sewa')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-pickup-date">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Pickup Date <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Pickup Date"></i>
                                </div>
                            </label>
                            <div class="col-8">
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
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-status-lepas-kunci">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Lepas Kunci <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Lepas Kunci"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select name="status_lepas_kunci" id="status_lepas_kunci" class="form-control" data-current-tambahan = '{{ old('status_lepas_kunci') && old('status_lepas_kunci') == 'shipped off key' ? $price_lepas_kunci_dikirim :  0}}' disabled>
                                    <option value="">Pilih Status Lepas Kunci</option>
                                    @foreach ($status_lepas_kunci as $item)
                                        <option value="{{$item}}" @if(old('status_lepas_kunci') == $item) selected @endif>
                                            @if ($item == 'off key')
                                                Lepas Kunci Ambil di tempat
                                            @else
                                                Lepas Kunci Dikirimkan
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('status_lepas_kunci')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-status-pengambilan">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Pengambilan <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Pengambilan"></i>
                                </div>
                            </label>
                            <div class="col-8">
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
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-grand-total">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Grand Total <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Grand Total"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="text" min="0" class="form-control" name="grand_total" id="grand_total" data-total="{{ old('grand_total') ? str_replace([' ', 'Rp', 'Rp.', '.', ','], '', old('grand_total')) : 0 }}" value="{{ old('grand_total') ?? 'Rp 0' }}" readonly disabled>
                                @error('grand_total')
                                    <div class="my-alert alert-danger">! {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="pull-right">
                    <button class="btn btn-primary btn-sm">
                        <i class="flaticon2-send-1"></i> Create
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
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
            $('#durasi_sewa').prop('readonly', false)
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
            $('#durasi_sewa').prop('readonly', true)
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
            var index = $('#tipe_armada option:selected').data('index');
            var value = $('#tipe_armada option:selected').val();
            var current_price = $(this).data('current-price')
            var current_grand_total = $('#grand_total').data('total')
            var price = $('#tipe_armada option:selected').data('price');
            var total = (parseInt(current_grand_total) + parseInt(price)) - parseInt(current_price)

            if(value != ''){

                var data = @json($tipe_armada);
                var old_tipe_armada = {!! old('tipe_armada') !!}

                // dari armada
                $(this).data('current-price', price)
                $('#grand_total').val('Rp '+number_format(total,0,',','.'))
                $('#grand_total').data('total',total)

                // origin
                $('#form-group-armada').slideDown(200);
                $('#armada').prop('disabled', false)
                $('#armada').html('')
                $('#armada').append('<option value="">Pilih Armada</option>')

                $.each(data[index]['armada'], function(index, value){
                    $('#armada').append("<option value="+value['id']+">"+value['kode_armada']+"</option>")
                });

            }else{
                disabledCertainInput();

                $('#form-group-armada').slideUp(200);
                $('#armada').prop('disabled', true);
            }
        })

        $('#armada').on('change', function(e){
            var value = $('#armada option:selected').val()

            if(value != ''){
                enabledCertainInput();

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

        // $('#durasi_sewa').on('keyup', function(e){
        //     var hours = $(this).val()
        //     var current_price = $('#armada').data('current-price')
        //     var current_tambahan_lepas_kunci = $('#status_lepas_kunci').data('current-tambahan')
        //     var current_tambahan_pengambilan = $('#status_pengambilan').data('current-tambahan')

        //     var total = (parseInt(hours) * parseInt(current_price)) + (parseInt(current_tambahan_lepas_kunci) + parseInt(current_tambahan_pengambilan))

        //     $('#grand_total').val('Rp '+number_format(total,0,',','.'))
        //     $('#grand_total').data('total', total)

        //     $(this).val(parseInt(hours) + 11)

        // })

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

    </script>
@endsection
