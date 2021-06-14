<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Evo Transport | @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('/') }}">

    {{-- begin::Fonts --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">
    {{-- end::Fonts --}}

    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>


    {{-- begin::Global Theme Styles(used by all pages) --}}
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/custom_switch_button.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {{-- end::Global Theme Styles --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('custom_style/home.css')}}">
    @yield('styles')

    <style>
        select:focus > option:hover {
            background: #FF5C00 !important;
        }
    </style>
</head>
<!-- begin::Body -->

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('home')}}">
            <img src="{{asset('assets/img/web-icon.png')}}" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('home')}}#about-us" data-scroll="" data-options="easing: easeOutQuart">Tentang Kami <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{route('katalog')}}" data-scroll="" data-options="easing: easeOutQuart">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('kontak')}}" data-scroll="" data-options="easing: easeOutQuart">Contact</a>
                </lai>
                <li class="nav-item separator">
                    <a class="nav-link" href="#">|</a>
                </li>
                <li class="nav-item phone-number">
                    {{-- <a class="nav-link" href="#" style="color:#D44911 !important"><i class="la la-phone"
                            style="color:#D44911; font-size:1.3em"></i> &nbsp;&nbsp;(+62) 822 6189 9199</a> --}}
                        <a class="btn-booking" href="{{route('booking')}}" role="button">Booking</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 15%; padding-left:10%; padding-right:10%">
        <h3 style="color: #000000; font-family:Poppins; font-size:30px; font-weight:bold; text-align:center">Selamat, Anda Berhasil Melakukan Booking Dengan No. Faktur <span style="color: #FF4D00;">{{$no_faktur}}</span></h3>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="color: black">
                    <div class="card-body">
                        @php echo html_entity_decode($prasyarat) @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer style="padding: 3% 15% 2% 15%; text-align:center" id="contact">
        <img src="{{asset('image/full-logo.png')}}" alt="">
        <p style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; margin-top:2%">Jl. Bangau Gang Merak Plemburan Sariharjo Ngaglik, Sleman, Yogyakarta, 55581</p>
        <p>
            <span><img src="{{asset('image/insta.png')}}" alt="instagram"></span>
            <span style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; vertical-align:middle; margin-left:1%">0812 2638 5760</span>

            <span style="margin-left:3%"><img src="{{asset('image/wa.png')}}" alt="instagram"></span>
            <span style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; vertical-align:middle; margin-left:1%; margin-right:3%">EVO_TRANSPORT</span>

            <span><img src="{{asset('image/loc.png')}}" alt="instagram"></span>
            <span style="font-family:'Roboto'; font-size:16px; line-height:25px;font-weight:400; color:#fff; vertical-align:middle; margin-left:1%">EVO_TRANSPORT</span>
        </p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        $(function(){
            AOS.init({
                easing: 'ease',
                duration: 1000,
            });
        })
    </script>

</body>

</html>
