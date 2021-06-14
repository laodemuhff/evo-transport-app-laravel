@if($data['status_lepas_kunci'] == 'with driver')
    <a href='{{route('transaction.delete',[encSlug($data['id'])])}}' class='btn btn-danger btn-sm btn-delete' title='hapus {{$data['nomor_faktur']}}' style='width:35px; padding: 8px !important'>
        <i class='la la-trash'></i>
    </a>

    <a href='#' class='btn btn-info btn-sm' style='color: white; width:35px; padding: 8px !important' data-toggle='modal' data-target='#detailTrx{{$data['id']}}' title='detail {{$data['nomor_faktur']}}'>
        <i class='la la-eye'></i>
    </a>

    @if (isset($data['id_driver']))
        <a href='#' class='btn btn-success btn-sm' title='driver already assigned' data-toggle="modal" data-target="#assignDriverModal_{{$data['nomor_faktur']}}" style='width:35px; padding: 8px !important'>
            <i class='la la-user'></i>
        </a>
    @else
        <a href='#' class='btn btn-secondary btn-sm' title='assign to driver' data-toggle="modal" data-target="#assignDriverModal_{{$data['nomor_faktur']}}" style='width:35px; padding: 8px !important'>
            <i class='la la-user'></i>
        </a>
    @endif
@else
    <a href='{{route('transaction.delete',[encSlug($data['id'])])}}' class='btn btn-danger btn-sm btn-delete' title='hapus {{$data['nomor_faktur']}}' style='width:35px; padding: 8px !important'>
        <i class='la la-trash'></i>
    </a>

    <a href='#' class='btn btn-info btn-sm' style='color: white; width:35px; padding: 8px !important' data-toggle='modal' data-target='#detailTrx{{$data['id']}}' title='detail {{$data['nomor_faktur']}}'>
        <i class='la la-eye'></i>
    </a>
@endif
