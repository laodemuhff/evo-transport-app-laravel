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

<div style="background-color: rgb(62, 185, 226); border-radius: 10px; border: dashed 1px #333; font-size:0.85rem; padding:30px 15px 30px 15px; margin-top:50px; color:rgb(59, 62, 63)">
    Anda dapat langsung melakukan pembayaran dan mengirimkan kwitansi pembayaran sebelum batas waktu yang ditentukan yaitu pada <b style="color: black">{{tgl_indo($transaction['expired_at'])}}</b> <br><br>
    Berikut Nomor Rekening Penerima : <b style="color: black">{{$no_rek}}</b> <br><br>
    Jika anda sudah melakukan pembayaran, harap upload kwitansi pembayaran dengan mengklik link berikut ini : <a href="{{route('upload.kwitansi')}}?token={{evo_encrypt($transaction['nomor_faktur'])}}" style="text-decoration: none; color:rgb(211, 13, 13)"><b>Form Upload Kwitansi</b></a>
</div>

@endcomponent
