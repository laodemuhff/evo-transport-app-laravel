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
                                    Email Customer <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Email Customer"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="email" name="email_customer" id="email_customer" class="form-control" value="{{ old('email_customer') }}" required>
                            </div>
                            @error('email_customer')
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
                                <select class="form-control" name="tipe_armada" id="tipe_armada"  required>
                                    <option value="">Pilih Tipe Armada</option>
                                    @foreach ($tipe_armada as $key => $item)
                                        <option value="{{ $item['id'] }}" @if(old('tipe_armada') && old('tipe_armada') == $item['id']) selected @endif data-index={{$key}} data-is-driver-allowed="{{$item['is_driver_allowed']}}">{{ ucfirst($item['tipe']) }}</option>
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
                                <select name="status_lepas_kunci" id="status_lepas_kunci" class="form-control" disabled>
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
                        </div>
                        <div class="form-group row" style="display: none" id="form-group-status-pengambilan">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Pengambilan <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Pengambilan"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select name="status_pengambilan" id="status_pengambilan" class="form-control" disabled>
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
                        </div>
                        <div class="form-group row" id="cek-harga-sewa-btn-form" style="display: none">
                            <label class="col-4 col-form-label">

                            </label>
                            <div class="col-8">
                                <a href="#" type="button" data-toggle="modal" data-target="#cek-grand-total" class="btn btn-primary" id="cek-harga-sewa-btn"><i class="flaticon-price-tag"></i>Cek Harga Sewa</a>
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

                var data = @json($tipe_armada);
                var is_driver_allowed =$('#tipe_armada option:selected').data('is-driver-allowed');
                var status_lepas_kunci = {!! json_encode($status_lepas_kunci) !!};

                // origin
                $('#form-group-armada').slideDown(200);
                $('#armada').prop('disabled', false)
                $('#armada').html('')
                $('#armada').append('<option value="">Pilih Armada</option>')

                $.each(data[index]['armada'], function(index, value){
                    var old_id_armada = "{!! old('id_armada') !!}"

                    if(old_id_armada !== undefined && old_id_armada == value['id'])
                        $('#armada').append("<option value="+value['id']+" selected>"+value['kode_armada']+"</option>")
                    else
                        $('#armada').append("<option value="+value['id']+" >"+value['kode_armada']+"</option>")
                });

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
@endsection
