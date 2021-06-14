@extends('layouts.app')

@section('title', 'driver Management')
@section('driver', 'kt-menu__item--open')

@section('breadcrumb')
    <h3 class="kt-subheader__title">
        Driver Management
    </h3>
    <span class="kt-subheader__separator kt-hidden"></span>
    <div class="kt-subheader__breadcrumbs">
        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
        <a href="{{route('driver.list')}}" class="kt-subheader__breadcrumbs-link">
            List Driver
        </a>
    </div>

@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    {{-- Body Path --}}
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            @include('layouts.notification')
            <div class="row">
                <div class="col-md-2">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#adddriver"><i class="la la-plus"></i></a>
                </div>
            </div>
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
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

    <!-- Modal Store -->
    <form action="{{ route('driver.store') }}" method="POST">
        @csrf
        <div class="modal fade" id="adddriver" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Driver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Driver" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Phone</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="phone" class="form-control" placeholder="Masukkan No. Telepon Driver" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Update -->
    @foreach ($driver as $item)
    <form action="{{ route('driver.update', [encSlug($item['id'])] ) }}" method="POST">
        @csrf
        <div class="modal fade" id="updatedriver{{$item['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update  driver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Name</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Driver " value="{{ $item['name'] }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Phone</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="phone" class="form-control" placeholder="Masukkan No. Telepon Driver " value="{{ $item['phone'] }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="scheduleDriver{{$item['id']}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Driver's Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="kt-scroll ps ps--active-y" data-scroll="true" data-height="380" data-mobile-height="300" style="height: 380px; overflow: hidden;">
                        <!--Begin::Timeline 3 -->
                        <div class="kt-timeline-v2">
                            <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                                @foreach ($item['transaction'] as $key => $transaction)
                                    <div class="kt-timeline-v2__item">
                                        @php
                                            $mydate = explode(' ',tgl_indo(date('Y-m-d', strtotime($transaction['pickup_date']))));
                                        @endphp
                                        <span class="kt-timeline-v2__item-time" style="font-size: 1.2rem">{{ $mydate[0].' '.substr($mydate[1],0,3) }}</span>
                                        <div class="kt-timeline-v2__item-cricle">
                                            <i class="fa fa-genderless @if($transaction['status_transaksi'] == 'pending') kt-font-warning @else kt-font-primary @endif"></i>
                                        </div>
                                        <div class="kt-timeline-v2__item-text  kt-padding-top-5">
                                            {{ tgl_indo(date('Y-m-d', strtotime($transaction['pickup_date']))) }}<b> &nbsp;&nbsp;s.d.&nbsp;&nbsp; </b>{{ tgl_indo(date('Y-m-d', strtotime($transaction['return_date']))) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!--End::Timeline 3 -->
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>

                        <div class="ps__rail-y" style="top: 0px; height: 380px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
            responsive: true,
            processing: true,
            serverSide: true,
            stateSave: true,
            "bFilter": false,
            "lengthChange": false,
            ajax: "{{ route('driver.table') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'id', searchable: false, orderable: false},
                {data: 'name', name: 'name'},
                {data: 'phone', name: 'phone'},
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
@endsection
