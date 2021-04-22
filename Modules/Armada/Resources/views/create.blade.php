@extends('layouts.app')

@section('title', 'Armada Management')
@section('armada', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Armada Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('armada.create')}}" class="kt-subheader__breadcrumbs-link">
            Create Armada
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
                    Pada page ini anda dapat menambahkan data armada
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <form action="{{route('armada.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    {{-- Input field --}}
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Tipe Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Tipe Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="id_tipe_armada" id="id_tipe_armada" required>
                                    <option value="">Pilih Tipe Armada</option>
                                    @foreach ($tipe_armada as $item)
                                        <option value="{{ $item['id'] }}" @if(old('id_tipe_armada') !== null && old('id_tipe_armada') == $item['id']) selected @endif>{{ ucfirst($item['tipe']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Kode Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Masukkan Kode Armada, atau Anda dapat mengacak kode secara random"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <div class="input-group">
                                    <input class="form-control" type="text" name="kode_armada" id="kode_armada" placeholder="E.g: AVANZA4000cc" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <a class="btn btn-secondary" id="btn-acak" data-url={{url('/')}}>#Acak Kode</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-form-label">
                                <div class="pull-right">
                                    Status Armada <span style="color:red;">*</span> <i class="flaticon-info" data-toggle="kt-tooltip" data-placement="top" data-original-title="Status Armada"></i>
                                </div>
                            </label>
                            <div class="col-8">
                                <select class="form-control" name="status_armada" required>
                                    <option value="">Pilih Status Armada</option>
                                    @foreach ($status_armada as $item)
                                        <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a type="button" href="{{route('armada.list')}}" class="btn btn-secondary btn-sm">
                        <i class="flaticon-cancel"></i> Cancel
                    </a>
                    <button class="btn btn-primary btn-sm">
                        <i class="flaticon2-send-1"></i> Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#btn-acak').on('click', function(e){
            var url = $(this).data('url') +'/armada/generate-random-code?id=' + $('#id_tipe_armada option:selected').text()

            $.ajax({
                'type' : 'GET',
                'dataType' : 'json',
                'url' : url
            }).done(function(result){
                console.log(result.code)
                $('#kode_armada').val(result.code)

            }).fail(function(jqXHR, textStatus){
                console.log(textStatus)
            })
        })
    </script>
@endsection
