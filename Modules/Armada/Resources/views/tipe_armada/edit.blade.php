@extends('layouts.app')

@section('title', 'Tipe Armada Management')
@section('armada', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Tipe Armada Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('tipe_armada.create')}}" class="kt-subheader__breadcrumbs-link">
            Edit Tipe Armada
        </a>
    </div>
@endsection

@section('styles')
    <style>

        #btn-acak:hover{
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="alert alert-light alert-elevate fade show" role="alert">
                <div class="alert-icon"><i class="flaticon-information kt-font-info"></i></div>
                <div class="alert-text">
                    Pada page ini anda dapat mengubah data tipe armada
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <form action="{{route('tipe_armada.update', encSlug($tipe_armada['id']))}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Nama Tipe <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Tipe Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="text" name="tipe" class="form-control" value="{{$tipe_armada['tipe']}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Kapasitas <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Kapasitas"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input type="number" class="form-control" name="kapasitas_penumpang" value="{{$tipe_armada['kapasitas_penumpang']}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Tipe Kemudi <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Tipe Kemudi"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="tipe_kemudi" required>
                                    <option value="">Pilih Tipe Kemudi</option>
                                    @foreach ($tipe_kemudi as $item)
                                        <option value="{{ $item }}" @if($tipe_armada['tipe_kemudi'] == $item) selected @endif>{{ ucfirst($item) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Allow Driver?
                                </div>
                            </label>
                            <div class="col-3">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" name="is_driver_allowed" id="is_driver_allowed" @if($tipe_armada['is_driver_allowed'] == '1') checked="checked" @endif>
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Harga Sewa <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukkan Harga Sewa Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="my-addon">Lepas Kunci</span>
                                    </div>
                                    <input class="form-control" type="text" name="price12" id="price12" placeholder="Tarif 12 Jam" autocomplete="off" min="0" value="Rp {{ number_format($tipe_armada['price12'],0,'.',',') }}">
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8 mt-2">
                                <input type="checkbox" id="price-check" @if(isset($tipe_armada['price'])) checked="checked" @endif> Gunakan Tarif 24 Jam
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8 mt-2">
                                <div class="input-group" id="price-box">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="my-addon">Lepas Kunci</span>
                                    </div>
                                    <input class="form-control" type="text" name="price" id="price" placeholder="Tarif 24 Jam" autocomplete="off" min="0" value="@if(isset($tipe_armada['price'])) Rp {{number_format($tipe_armada['price'],0,'.',',')}} @endif" @if(isset($tipe_armada['price'])) required @else  disabled style="display: none" @endif>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Gambar <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukkan Foto/Gambar Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <input class="form-control" type="file" name="photo" id="photo" accept="image/x-png,image/gif,image/jpeg" autocomplete="off">
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8 mt-3">
                                <img src="{{asset($tipe_armada['photo'])}}" alt="" width="200">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row" style="visibility: hidden">
                            <div class="col-8">
                                <input class="form-control" type="text" name="" id="" placeholder="Tarif 24 Jam" autocomplete="off" min="0" value="{{old('')}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row" style="visibility: hidden">
                            <div class="col-8">
                                <input class="form-control" type="text" name="" id="" placeholder="Tarif 24 Jam" autocomplete="off" min="0" value="{{old('')}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row" style="visibility: hidden">
                            <div class="col-8">
                                <input class="form-control" type="text" name="" id="" placeholder="Tarif 24 Jam" autocomplete="off" min="0" value="{{old('')}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row" style="visibility: hidden">
                            <div class="col-8">
                                <input class="form-control" type="text" name="" id="" placeholder="Tarif 24 Jam" autocomplete="off" min="0" value="{{old('')}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none" id="price_driver12_box">
                            <div class="col-8 mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="my-addon">With Driver</span>
                                    </div>
                                    <input class="form-control" type="text" name="price_driver12" id="price_driver12" placeholder="Tarif 12 Jam dengan Supir" autocomplete="off" min="0" value="Rp {{number_format($tipe_armada['price_driver12'],0,'.',',')}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" style="display: none" id="price_driver_box">
                            <div class="col-8 mt-2">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="my-addon">With Driver</span>
                                    </div>
                                    <input class="form-control" type="text" name="price_driver" id="price_driver" placeholder="Tarif 24 Jam dengan Supir" autocomplete="off" min="0" value="Rp {{number_format($tipe_armada['price_driver'],0,'.',',')}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a type="button" href="{{route('tipe_armada.list')}}" class="btn btn-secondary btn-sm">
                        <i class="flaticon-cancel"></i> Cancel
                    </a>
                    <button class="btn btn-primary btn-sm">
                        <i class="flaticon2-send-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#price-check').trigger('change');
            $('#is_driver_allowed').trigger('change');
        })

        $('#price').on('keyup',function(e){
            $("#price").inputmask({ alias : "currency", prefix: 'Rp ',rightAlign: false, 'digits': '0',autoUnmask: true });
        });

        $('#price12').on('keyup',function(e){
            $("#price12").inputmask({ alias : "currency", prefix: 'Rp ',rightAlign: false, 'digits': '0',autoUnmask: true });
        });

        $('#price_driver').on('keyup',function(e){
            $("#price_driver").inputmask({ alias : "currency", prefix: 'Rp ',rightAlign: false, 'digits': '0',autoUnmask: true });
        });

        $('#price_driver12').on('keyup',function(e){
            $("#price_driver12").inputmask({ alias : "currency", prefix: 'Rp ',rightAlign: false, 'digits': '0',autoUnmask: true });
        });

        $('#price-check').on('click change',function(e){
            if($(this).is(':checked')){
                $("#price").prop('disabled', false);
                $("#price").prop('required', true);
                $("#price-box").slideDown(150);

                if($('#is_driver_allowed').is(':checked')){
                    $('#price_driver').prop('disabled', false)
                    $("#price_driver").prop('required', true);
                    $("#price_driver_box").slideDown(150);
                }
            }else{
                $("#price").prop('disabled', true);
                $("#price").prop('required', false);
                $("#price-box").slideUp(150);

                $('#price_driver').prop('disabled', true)
                $("#price_driver").prop('required', false);
                $("#price_driver_box").slideUp(150);
            }
        });

        $('#is_driver_allowed').change(function(e){
            if($(this).is(':checked')){
                $('#price_driver12_box').slideDown(150)
                $('#price_driver12').prop('required', true)
                $('#price_driver12').prop('disabled', false)

                if($('#price-check').is(":checked")){
                    $('#price').prop('disabled', false)
                    $('#price').prop('required', true)
                    $("#price-box").slideDown(150);

                    $('#price_driver').prop('disabled', false)
                    $('#price_driver').prop('required', true)
                    $('#price_driver_box').slideDown(150)
                }
            }else{
                $('#price_driver12').prop('required', false)
                $('#price_driver12').prop('disabled', true)
                $('#price_driver12_box').slideUp(150)

                $('#price_driver').prop('required', false)
                $('#price_driver').prop('disabled', true)
                $('#price_driver_box').slideUp(150)
            }
        })
    </script>
@endsection
