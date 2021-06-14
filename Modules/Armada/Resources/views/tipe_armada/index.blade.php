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
        <a href="{{route('armada.list')}}" class="kt-subheader__breadcrumbs-link">
            List Tipe Armada
        </a>
    </div>

@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
      {{-- Search Path --}}
      <div class="kt-portlet">
        <div class="kt-portlet__body" style="padding-bottom: 0">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Nama Tipe</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="tipe" id="tipe" placeholder="e.g:Avanza">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Kapasitas</label>
                        <div class="input-group">
                            <select class="form-control" name="kapasitas_penumpang" id="kapasitas_penumpang">
                                <option value="">All</option>
                                <option value="<= 5"><= 5</option>
                                <option value="> 5">> 5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Tipe Kemudi</label>
                        <div class="input-group">
                            <select class="form-control" name="tipe_kemudi" id="tipe_kemudi">
                                <option value="">All</option>
                                @foreach ($tipe_kemudi as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer col-md-12">
                <div class="pull-right">
                    <button id="reset" class="btn btn-secondary btn-sm">
                        <i class="flaticon2-refresh-button"></i> Reset
                    </button>
                    <button id="search" class="btn btn-info btn-sm">
                        <i class="flaticon-search"></i> Search
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Body Path --}}
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('tipe_armada.create')}}" class="btn btn-primary btn-sm"><i class="la la-plus"></i> Add Tipe Armada</a>
                </div>
            </div>
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <td>Gambar</td>
                        <th>Tipe Armada</th>
                        <th>Kapasitas</th>
                        <th>Tipe Kemudi</th>
                        <th>Tarif 24 Jam</th>
                        <th>Tarif 12 Jam</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            {{-- <div class="kt-separator kt-separator--dashed"></div> --}}
        </div>
    </div>
    <!-- Button trigger modal -->
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/helper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        // $.fn.dataTable.ext.errMode = 'none';
        $(document).ready( function () {
            var url = $('#url').val();

            $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            "bFilter": false,
            "lengthChange": false,
            ajax: "{{ route('tipe_armada.table') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                {data: 'photo', name: 'photo',
                    render: function (data, type, full, meta) {
                        return "<img src=\"{{url('')}}/"+ data +"\" height=\"50\"/>";
                    },
                },
                {data: 'tipe', name: 'tipe_armada'},
                {data: 'kapasitas_penumpang', name: 'kapasitas_penumpang'},
                {data: 'tipe_kemudi', name: 'tipe_kemudi'},
                {data: 'price', name: 'price',
                    render: function (data, type, full, meta) {
                        return 'Rp '+number_format(data, 0, ',', '.');
                    },
                },
                {data: 'price12', name: 'price12',
                    render: function (data, type, full, meta) {
                        if(data != undefined){
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                        return '-';
                    },
                },
                {data: 'action', name: 'action', searchable: false, orderable: false}
            ]
        });
        } );
    </script>
    <script>
        $('body').on('click', '.btn-delete', function (event) {
            event.preventDefault();

            var me = $(this),
                url = me.attr('href'),
                title = me.attr('title'),
                csrf_token = $('meta[name="csrf-token"]').attr('content');

            swal.fire({
                title: 'Are you sure want to delete ' + title + ' ?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $('#loading').show();
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': csrf_token,
                        },
                        success: function (response) {
                            // $('#loading').hide();
                            console.log(response)
                            if (response) {
                                swal.fire({
                                    type: 'success',
                                    title: 'Success!',
                                    text: 'Data has been deleted!'
                                });
                                location.reload();
                            }else{
                                swal.fire({
                                    type: 'error',
                                    title: 'Oops...',
                                    text: response.messages
                                });
                            }
                        },
                        error: function (xhr) {
                            // $('#loading').hide();
                            swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '#search', function() {
            var tipe    = $('#tipe').val();
            var kapasitas_penumpang   = $('#kapasitas_penumpang').val();
            var tipe_kemudi   = $('#tipe_kemudi').val();

            console.log(tipe+ ' ' + kapasitas_penumpang + ' ' +tipe_kemudi)

            search(tipe, kapasitas_penumpang, tipe_kemudi);
        });

        $(document).on('click', '#reset', function(){
            reset();
            search();
        });

        function search(tipe = '', kapasitas_penumpang = '', tipe_kemudi = '') {
            // $.fn.dataTable.ext.errMode = 'none';

            var table = $('#datatable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                "bFilter": false,
                "lengthChange": false,
                ajax: {
                    url: "{{ route('tipe_armada.table') }}",
                    type: 'get',
                    data: function(d) {
                        d.tipe = tipe;
                        d.kapasitas_penumpang = kapasitas_penumpang;
                        d.tipe_kemudi = tipe_kemudi;
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'photo', name: 'photo',
                        render: function (data, type, full, meta) {
                            return "<img src=\"{{url('')}}/"+ data +"\" height=\"50\"/>";
                        },
                    },
                    {data: 'tipe', name: 'tipe_armada'},
                    {data: 'kapasitas_penumpang', name: 'kapasitas_penumpang'},
                    {data: 'tipe_kemudi', name: 'tipe_kemudi'},
                    {data: 'price', name: 'price',
                        render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        },
                    },
                    {data: 'price12', name: 'price12',
                        render: function (data, type, full, meta) {
                            if(data != undefined){
                                return 'Rp '+number_format(data, 0, ',', '.');
                            }
                            return '-';
                        },
                    },
                    {data: 'action', name: 'action', searchable: false, orderable: false}
                ]
            });
        }

        function reset() {
            $('#tipe').val('');
            $('#kapasitas_penumpang').val('');
            $('#tipe_kemudi').val('');
            $('#search').val('').trigger('change');
        }
    </script>
@endsection
