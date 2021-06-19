@component('mail::message')

<div class="container-fluid" style="padding-top: 5%; padding-left:5%; padding-right:5%">
    <h3 style="color: #000000; font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; text-align:center">Selamat, Anda Berhasil Melakukan Booking Dengan No. Faktur <span style="color: #FF4D00;">{{$transaction['nomor_faktur']}}</span></h3>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="color: black">
                <div class="card-body" style="border:1px dotted; padding:15px">
                    @php echo html_entity_decode($prasyarat) @endphp
                </div>
            </div>
        </div>
    </div>
</div>

@component('mail::table')

| Transaction Info   | Value                                                                    |
|--------------------|--------------------------------------------------------------------------|
| Pickup Date        | {{ tgl_indo($transaction['pickup_date'], 'datetime') }}                  |
| Return Date        | {{ tgl_indo($transaction['return_date'], 'datetime') }}                  |
| Alamat             | {{$transaction['alamat_customer']}}                                      |
| Armada             | {{$transaction['tipe_armada']}}                                          |
| Durasi Sewa        | {{$transaction['durasi_sewa']}} Jam                                      |
| Status Lepas Kunci | {{$transaction['status_lepas_kunci']}}                                   |
| Status Pengambilan | {{$transaction['status_pengambilan']}}                                   |
| <b>Total Bayar</b> | <b>{{ 'Rp. '.number_format($transaction['grand_total'],0,',','.') }} </b>|
@endcomponent

@endcomponent
