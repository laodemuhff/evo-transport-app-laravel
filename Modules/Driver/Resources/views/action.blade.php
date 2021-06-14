<a href='#' data-toggle='modal' data-target='#updatedriver{{$data['id']}}' class='btn btn-warning btn-sm' style='color: white'>
    <i class='flaticon-edit'></i>
    Update
</a> &nbsp;

<a href='{{ route('driver.delete',[encSlug($data['id'])]) }}' class='btn btn-danger btn-sm btn-delete' title='delete {{$data['name']}}'>
    <i class='flaticon2-trash'></i>
    Delete
</a>
&nbsp;
<a href='#' data-toggle='modal' data-target='#scheduleDriver{{$data['id']}}' class='btn btn-info btn-sm' style='color: white'>
    <i class='flaticon-clock'></i>
    Schedule
</a> &nbsp;
