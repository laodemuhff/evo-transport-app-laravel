@extends('layouts.app')

@section('title', 'Transaction Management')
@section('transaction', 'kt-menu__item--open')
@section('transaction_list', 'kt-menu__item--open')
@section('transaction_list_'.$status, 'kt-menu__item--active')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Transaction Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('transaction.list', $status)}}" class="kt-subheader__breadcrumbs-link">
            List Transaction {{ ucfirst($status) }}
        </a>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        html.modal-open {
            /* All of this stops the page from scrolling in the background, especially important on mobile devices. */
            -ms-overflow-style: scrollbar;
            overflow: hidden;
            height: 100%;
        }

        body.modal-open {

            /* This is the crucial rule to get rid of the page shift when opening a modal */
            overflow: auto !important;

            /* You may want to explore toggling this, depending on your circumstances (page length and/or presence of page scroll bars) */
            height: 100%;

        }

        .detal-trx{
            margin-bottom:0.8rem;
        }
    </style>
@endsection
@section('content')
    {{-- Search Path --}}
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="m-portlet__head-caption" style="padding-top:15px">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <a href="#" id="filter-btn-show"><i class="la la-angle-double-down" style="font-size: 1.2em"></i></a>
                        <a href="#" id="filter-btn-hide" style="display: none"><i class="la la-angle-double-up" style="font-size: 1.2em"></i></a>
                    </h3>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body" style="padding-bottom: 0; display: none" id="filter-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Nama Customer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nama_customer" id="nama_customer" placeholder="E.g : Umam Maulana ">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Alamat Customer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="alamat_customer" id="alamat_customer" placeholder="E.g : Kec. Ngemplak ">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Nomor Telpon Customer</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="no_hp_customer" id="no_hp_customer" placeholder="E.g : 087777xxxxxx ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Nomor Faktur</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nomor_faktur" id="nomor_faktur" placeholder="E.g : FAK-ABCD-1 ">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Tipe Armada</label>
                        <div class="input-group">
                            <select class="form-control" name="tipe_armada" id="tipe_armada">
                                <option value="{{null}}">All</option>
                                @foreach ($tipe_armada as $item)
                                    <option value="{{ $item['tipe'] }}">{{ ucfirst($item['tipe']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Durasi Sewa</label>
                        <div class="input-group">
                            <input type="number" min="0" class="form-control" name="durasi_sewa" id="durasi_sewa">
                            <div class="input-group-append">
                                <span class="input-group-text">Jam</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Pickup Date</label>
                        <div class="input-group">
                            <input type="date" class="form-control" name="pickup_date" id="pickup_date">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Status Lepas Kunci</label>
                        <div class="input-group">
                            <select class="form-control" name="status_lepas_kunci" id="status_lepas_kunci">
                                <option value="{{null}}">All</option>
                                <option value="none">None</option>
                                @foreach ($status_lepas_kunci as $item)
                                    <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        <label>Status Pengambilan</label>
                        <div class="input-group">
                            <select class="form-control" name="status_pengambilan" id="status_pengambilan">
                                <option value="{{null}}">All</option>
                                <option value="none">None</option>
                                @foreach ($status_pengambilan as $item)
                                    <option value="{{ $item }}">{{ ucfirst($item) }}</option>
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
            <input id="url" type="hidden" value="{{ url('/') }}">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>No Faktur</th>
                        <th>Nama Customer</th>
                        <th>No HP Customer</th>
                        <th>Tipe Armada</th>
                        <th>Kode Armada</th>
                        {{-- <th>Pickup Date</th> --}}
                        {{-- <th>Pickup Time</th> --}}
                        <th>Durasi Sewa</th>
                        <th>Grand Total</th>
                        <th>Alamat Customer</th>
                        <th>Status Lepas Kunci</th>
                        <th>Status Pengambilan</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            {{-- <div class="kt-separator kt-separator--dashed"></div> --}}
        </div>
    </div>

    <!-- Modal Update -->
    @foreach ($transaction as $item)
        <div class="modal fade" id="detailTrx{{$item['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="padding:30px">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi {{$item['nomor_faktur']}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="padding:30px">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#general{{$item['id']}}">General</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#schedule{{$item['id']}}">Schedule</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="general{{$item['id']}}" class="tab-pane container active">
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Nomor Faktur</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['nomor_faktur'] }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Nama Customer</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['nama_customer'] }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Alamat Customer</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['alamat_customer'] }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">No. HP Customer</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['no_hp_customer'] }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Kode Armada</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['armada']['kode_armada'] }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Tipe Armada</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['armada']['tipe_armada']['tipe'] }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Durasi Sewa</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['durasi_sewa'] }} Jam</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Status Lepas Kunci</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['status_lepas_kunci'] ?? 'None' }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Status Pengambilan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ $item['status_pengambilan'] ?? 'None' }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Status Transaksi</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($item['status_transaksi'] == 'pending')
                                            <span class="badge badge-warning">
                                                {{ $item['status_transaksi'] }}
                                            </span>
                                        @elseif($item['status_transaksi'] == 'on rent')
                                            <span class="badge badge-primary">
                                                {{ $item['status_transaksi'] }}
                                            </span>
                                        @elseif($item['status_transaksi'] == 'success')
                                            <span class="badge badge-success">
                                                {{ $item['status_transaksi'] }}
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                {{ $item['status_transaksi'] }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if ($item['status_transaksi'] == 'cancelled')
                                    <div class="form-group row detal-trx">
                                        <div class="col-md-4">
                                            <label for="">Cancelled Reason</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ $item['cancelled_reason'] ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group row detal-trx">
                                        <div class="col-md-4">
                                            <label for="">Cancelled By</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ $item['cancelled_by'] ?? '-' }}</p>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Grand Total</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ IDR($item['grand_total']) }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Schedule --}}
                            <div id="schedule{{$item['id']}}" class="tab-pane container fade">
                                @if ($status == 'pending' || $status == 'on_rent')
                                    <div class="form-group row detal-trx">
                                        <div class="col-md-4">
                                            <label for="">Current Time</label>
                                        </div>
                                        <div class="col-md-8" id="clocks{{$item['id']}}" style="color: rgb(36, 36, 187); font-weight:bold"></div>
                                    </div>
                                @endif
                                {{-- <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Created At</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ tgl_indo(explode(' ',$item['created_at'])[0] ?? []).' - '.(explode(' ',$item['created_at'])[1] ?? '') }}</p>
                                    </div>
                                </div> --}}
                                @if ($status == 'pending')
                                    <div class="form-group row detal-trx">
                                        <div class="col-md-4">
                                            <label for="">Expired At</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ tgl_indo(explode(' ',$item['expired_at'])[0] ?? []).' - '.(explode(' ',$item['expired_at'])[1] ?? '') }}</p>
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Pickup Date</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ tgl_indo(explode(' ',$item['pickup_date'])[0] ?? []).' - '.(explode(' ',$item['pickup_date'])[1] ?? '') }}</p>
                                    </div>
                                </div>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Return Date</label>
                                    </div>
                                    <div class="col-md-8">
                                        <p>{{ tgl_indo(explode(' ',$item['return_date'])[0] ?? []).' - '.(explode(' ',$item['return_date'])[1] ?? '')}}</p>
                                    </div>
                                </div>
                                @if ($status == 'success')
                                    <div class="form-group row detal-trx">
                                        <div class="col-md-4">
                                            <label for="">Customer Return Date</label>
                                        </div>
                                        <div class="col-md-8">
                                            <p>{{ tgl_indo(explode(' ',$item['customer_return_date'])[0] ?? []).' - '.(explode(' ',$item['customer_return_date'])[1] ?? '')}}</p>
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <div class="form-group row detal-trx">
                                    <div class="col-md-4">
                                        <label for="">Status</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($item['schedule_status'] == 'waiting confirmation')
                                            <div class="badge badge-warning">
                                                <span>{{ $item['schedule_status'] }}</span>
                                            </div>
                                        @elseif($item['schedule_status'] == 'expired')
                                            <div class="badge badge-danger">
                                                <span>{{ $item['schedule_status'] }}</span>
                                            </div>
                                        @elseif($item['schedule_status'] == 'late return')
                                            <div class="badge badge-danger">
                                                <span>{{ $item['schedule_status'] }}</span>
                                            </div>
                                        @elseif($item['schedule_status'] == 'on progress')
                                            <div class="badge badge-primary">
                                                <span>{{ $item['schedule_status'] }}</span>
                                            </div>
                                        @else
                                            <div class="badge badge-success">
                                                <span>{{ $item['schedule_status'] }}</span>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        @if ($status == 'pending')
                            <button type="button" class="btn btn-danger" id="cancel-button{{$item['id']}}" data-toggle="modal" data-target="#cancel-modal{{$item['id']}}">Cancel Rent</button>
                            <button type="button" class="btn btn-primary" id="confirm-button{{$item['id']}}" data-toggle="modal" data-target="#confirm-modal{{$item['id']}}">Confirm Rent</button>
                        @endif
                        @if ($status == 'on_rent')
                            <button type="button" class="btn btn-success" id="mark-button{{$item['id']}}" data-toggle="modal" data-target="#mark-modal{{$item['id']}}">Mark As Returned</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- cancel modal --}}
        @if ($status == 'pending')
            <div class="modal fade" id="cancel-modal{{$item['id']}}" tabindex="-2" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{route('transaction.cancel')}}" method="POST">
                            @csrf
                            <div class="modal-header" style="padding:30px">
                                <h5 class="modal-title" id="exampleModalLabel">Cancel Transaksi {{$item['nomor_faktur']}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding:30px">
                                <h4>Apakah Anda Yakin Ingin Membatalkan Transaksi ini ??</h4>
                                <input type="hidden" name="id" value="{{$item['id']}}">
                                <div class="form-group">
                                    <label for="">Tulis Alasan Anda Disini</label>
                                    <textarea class="form-control" name="cancelled_reason" cols="20" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="close-cancel-button{{$item['id']}}" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- confirm transaction --}}
            <div class="modal fade" id="confirm-modal{{$item['id']}}" tabindex="-2" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{route('transaction.confirm')}}" method="POST">
                            @csrf
                            <div class="modal-header" style="padding:30px">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Transaksi {{$item['nomor_faktur']}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding:30px">
                                <h4>Apakah Anda Yakin Ingin Mengkonfirmasi Transaksi ini ??</h4>
                                <input type="hidden" name="id" value="{{$item['id']}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="close-confirm-button{{$item['id']}}" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif

        {{-- mark as returned modal --}}
        @if ($status == 'on_rent')
            <div class="modal fade" id="mark-modal{{$item['id']}}" tabindex="-2" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{route('transaction.mark')}}" method="POST">
                            @csrf
                            <div class="modal-header" style="padding:30px">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Success {{$item['nomor_faktur']}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="padding:30px">
                                <h4>Apakah Anda Yakin Transaksi ini telah Sukses ??</h4>
                                <input type="hidden" name="id" value="{{$item['id']}}">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="close-mark-button{{$item['id']}}" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/helper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        // $.fn.dataTable.ext.errMode = 'none';
        $(document).ready( function () {
            var url = $('#url').val();

            $('#datatable').DataTable({
                sScrollX: "100%",
                responsive: true,
                processing: true,
                serverSide: true,
                stateSave: true,
                "bFilter": false,
                "lengthChange": false,
                ajax: "{{ route('transaction.table', $status) }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width: '130'},
                    {data: 'status_transaksi', name: 'status_transaksi', render: function (data, type, full, meta) {
                            if (data == 'pending')
                                return "<span class='badge badge-warning'>"+data+"</span>"
                            else if (data == 'on rent')
                                return "<span class='badge badge-primary'>"+data+"</span>"
                            else if (data == 'success')
                                return "<span class='badge badge-success'>"+data+"</span>"
                            else
                                return "<span class='badge badge-danger'>"+data+"</span>"
                        }
                    },
                    {data: 'nomor_faktur', name: 'nomor_faktur'},
                    {data: 'nama_customer', name: 'nama_customer'},
                    {data: 'no_hp_customer', name: 'no_hp_customer'},
                    {data: 'tipe_armada', name: 'tipe_armada'},
                    {data: 'kode_armada', name: 'kode_armada', responsivePriority: 10001},
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[0];
                    //     }, width: '130px'
                    // },
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[1];
                    //     }, width: '130px'
                    // },
                    {data: 'durasi_sewa', name: 'durasi_sewa', render: function (data, type, full, meta) {
                            return data+' Jam';
                        }
                    },
                    {data: 'grand_total', name: 'grand_total', render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                    },
                    {data: 'alamat_customer', name: 'alamat_customer', responsivePriority: 10005},
                    {data: 'status_lepas_kunci', name: 'status_lepas_kunci', responsivePriority: 10003, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'status_pengambilan', name: 'status_pengambilan', responsivePriority: 10002, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'note', name: 'note', responsivePriority: 10004, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    }
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
            var nama_customer = $('#nama_customer').val();
            var alamat_customer = $('#alamat_customer').val();
            var no_hp_customer = $('#no_hp_customer').val();
            var nomor_faktur = $('#nomor_faktur').val();
            var tipe_armada = $('#tipe_armada').val();
            var durasi_sewa = $('#durasi_sewa').val();
            var pickup_date = $('#pickup_date').val();
            var status_lepas_kunci = $('#status_lepas_kunci').val();
            var status_pengambilan = $('#status_pengambilan').val();

            search(nama_customer, alamat_customer, no_hp_customer, nomor_faktur, tipe_armada, durasi_sewa, pickup_date, status_lepas_kunci, status_pengambilan);
        });

        $(document).on('click', '#reset', function(){
            reset();
            search();
        });

        function search(nama_customer = '', alamat_customer = '', no_hp_customer = '',nomor_faktur = '', tipe_armada = '', durasi_sewa = '', pickup_date = '', status_lepas_kunci = '', status_pengambilan = '') {
            // $.fn.dataTable.ext.errMode = 'none';

            var table = $('#datatable').DataTable({
                sScrollX: "100%",
                responsive: true,
                processing: true,
                serverSide: true,
                destroy: true,
                "bFilter": false,
                "lengthChange": false,
                ajax: {
                    url: "{!! route('transaction.table', $status) !!}",
                    type: 'get',
                    data: function(d) {
                        d.nama_customer = nama_customer;
                        d.alamat_customer = alamat_customer;
                        d.no_hp_customer = no_hp_customer;
                        d.nomor_faktur = nomor_faktur;
                        d.tipe_armada = tipe_armada;
                        d.durasi_sewa = durasi_sewa;
                        d.pickup_date = pickup_date;
                        d.status_lepas_kunci = status_lepas_kunci;
                        d.status_pengambilan = status_pengambilan;
                    }
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                    {data: 'action', name: 'action', searchable: false, orderable: false, width: '130'},
                    {data: 'status_transaksi', name: 'status_transaksi', render: function (data, type, full, meta) {
                            if (data == 'pending')
                                return "<span class='badge badge-warning'>"+data+"</span>"
                            else if (data == 'on rent')
                                return "<span class='badge badge-primary'>"+data+"</span>"
                            else if (data == 'success')
                                return "<span class='badge badge-success'>"+data+"</span>"
                            else
                                return "<span class='badge badge-danger'>"+data+"</span>"
                        }
                    },
                    {data: 'nomor_faktur', name: 'nomor_faktur'},
                    {data: 'nama_customer', name: 'nama_customer'},
                    {data: 'no_hp_customer', name: 'no_hp_customer'},
                    {data: 'tipe_armada', name: 'tipe_armada'},
                    {data: 'kode_armada', name: 'kode_armada', responsivePriority: 10001},
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[0];
                    //     }, width: '130px'
                    // },
                    // {data: 'pickup_date', name: 'pickup_date', render: function (data, type, full, meta) {
                    //         return data.split(' ')[1];
                    //     }, width: '130px'
                    // },
                    {data: 'durasi_sewa', name: 'durasi_sewa', render: function (data, type, full, meta) {
                            return data+' Jam';
                        }
                    },
                    {data: 'harga_sewa', name: 'harga_sewa', render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                    },
                    {data: 'grand_total', name: 'grand_total', render: function (data, type, full, meta) {
                            return 'Rp '+number_format(data, 0, ',', '.');
                        }
                    },
                    {data: 'alamat_customer', name: 'alamat_customer', responsivePriority: 10005},
                    {data: 'status_lepas_kunci', name: 'status_lepas_kunci', responsivePriority: 10003, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'status_pengambilan', name: 'status_pengambilan', responsivePriority: 10002, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    },
                    {data: 'note', name: 'note', responsivePriority: 10004, render: function(data, type,  full, meta){
                            if(data == null)
                                return 'None'
                            else
                                return data
                        }
                    }
                ]
            });
        }

        function reset() {
            $('#nama_customer').val('');
            $('#alamat_customer').val('');
            $('#no_hp_customer').val('');
            $('#nomor_faktur').val('');
            $('#tipe_armada').val('');
            $('#durasi_sewa').val('');
            $('#pickup_date').val('');
            $('#status_lepas_kunci').val('');
            $('#status_pengambilan').val('');
            $('#search').val('').trigger('change');
        }
    </script>
    <script>
        $('#filter-btn-show').on('click', function(e){
            $('#filter-body').slideDown(200);
            $(this).hide();
            $('#filter-btn-hide').show();
        })

        $('#filter-btn-hide').on('click', function(e){
            $('#filter-body').slideUp(200);
            $(this).hide();
            $('#filter-btn-show').show();
        })
    </script>
    <script>
        var transaction = @json($transaction);

        $.each(transaction, function(index, value){
            var id = value['id']

            $(function(){
                startTime();

                $('#detailTrx'+id).on('show.bs.modal', function (e) {
                    $('html').addClass('modal-open');
                })

                $('#detailTrx'+id).on('hide.bs.modal', function (e) {
                    $('html').removeClass('modal-open');
                })
            });


            $('#cancel-button'+id).on('click', function(e){
                // e.stopPropagation();
                $('#detailTrx'+id).modal('hide');
            })

            $('#close-cancel-button'+id).on('click', function(e){
                // e.stopPropagation();
                $('#detailTrx'+id).modal('show');
            })

            $('#confirm-button'+id).on('click', function(e){
                // e.stopPropagation();
                $('#detailTrx'+id).modal('hide');
            })

            $('#close-confirm-button'+id).on('click', function(e){
                // e.stopPropagation();
                $('#detailTrx'+id).modal('show');
            })

            $('#mark-button'+id).on('click', function(e){
                // e.stopPropagation();
                $('#detailTrx'+id).modal('hide');
            })

            $('#close-mark-button'+id).on('click', function(e){
                // e.stopPropagation();
                $('#detailTrx'+id).modal('show');
            })


            function startTime() {
                var today = new Date();

                var Y = today.getFullYear();
                var M = bulan_indo(today.getMonth() + 1);
                var d = today.getDate();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();

                d = checkTime(d);
                h = checkTime(h);
                m = checkTime(m);
                s = checkTime(s);

                $('#clocks'+id).html(d + ' ' + M + ' ' + Y + ' - ' + h + ":" + m + ":" + s);

                var t = setTimeout(startTime, 500);
            }

            function checkTime(i) {
                if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
                return i;
            }

            function bulan_indo(M){
                bulan = {
                    1 : 'Januari',
                    2 : 'Februari',
                    3 : 'Maret',
                    4 : 'April',
                    5 : 'Mei',
                    6 : 'Juni',
                    7 : 'Juli',
                    8 : 'Agustus',
                    9 : 'September',
                    10: 'Oktober',
                    11: 'November',
                    12: 'Desember'
                }

                return bulan[parseInt(M)]
            }

        });
    </script>
@endsection
