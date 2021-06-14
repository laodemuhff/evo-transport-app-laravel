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
</head>
<!-- begin::Body -->

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="{{asset('assets/img/web-icon.png')}}" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#about-us" data-scroll="" data-options="easing: easeOutQuart">Tentang Kami <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('katalog')}}" data-scroll="" data-options="easing: easeOutQuart">Katalog</a>
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

    <div class="jumbotron">
        <h1 class="display-4"><span class="orange-color">Evo Transport</span> Rent Car Find Your <span class="orange-color">Best</span> Experience</h1>
        <img src="{{asset('assets/img/hero.png')}}" alt="">
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{route('booking')}}" role="button">Rental Sekarang</a>
        </p>
    </div>

    <span id="about-us"></span>

    <img class="spiral-bg" src="{{asset('assets/img/spiral-bg.png')}}" alt="">
    <div class="container-fluid about-us">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 about-car-container" data-aos="fade-right">
                <img class="about-car" src="{{asset('assets/img/about-car.png')}}" alt="">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 about-content-container">
                <div class="row section-title-container">
                    <h3 class="section-title">Keuntungan Memilih Kami</h3>
                </div>
                <div class="row">
                    <hr class="section-title-underline">
                </div>
                <div class="row">
                    <p class="section-title-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim varius.</p>
                </div>
                <div data-aos="fade-right">
                    <div class="row about-list">
                        <div class="col-md-2 box-icon-container">
                            <div class="box-icon">
                                <img src="{{asset('assets/img/earth-icon.svg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="section-subtitle">Jaminan transaksi</h3>
                            <p class="section-subtitle-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim varius.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim.</p>
                        </div>
                    </div>
                    <div class="row about-list">
                        <div class="col-md-2 box-icon-container">
                            <div class="box-icon">
                                <img src="{{asset('assets/img/atm.svg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="section-subtitle">Jaminan transaksi</h3>
                            <p class="section-subtitle-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim varius.  consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim varius.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="row about-list">
                        <div class="col-md-2 box-icon-container">
                            <div class="box-icon">
                                <img src="{{asset('assets/img/24hour.svg')}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <h3 class="section-subtitle">Jaminan transaksi</h3>
                            <p class="section-subtitle-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim varius.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <span id="catalog"></span>

    <div class="container-fluid catalog">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="row section-title-container">
                    <h3 class="section-title center" style="display: block">Tiga mobil yang sering dirental</h3>
                </div>
                <div class="row" style="padding-left:47.15%; padding-right:47.15%">
                    <hr class="section-title-underline">
                </div>
                <div class="row">
                    <p class="section-title-description center" style="padding-left:20%; padding-right:20%">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim varius.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card col-md-3" style="margin:1%; flex:0 0 31.25%; max-width:31.25%; padding:0" data-aos="fade-right">
                <div class="card-header" style="padding: 0">
                    <img src="{{asset('image/armada/catalog1.png')}}" alt="Catalog 1" width="100%">
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star2.svg')}}" alt=""></span>
                    </h5>
                    <p class="card-text" style="font-family: 'Roboto'; font-weight:700; font-size:20px; line-height:25px; color:
                    black">Grand New Avanza
                    </p>
                    <p>
                        <div style="float: left">
                            <span><img src="{{asset('image/manual.svg')}}" alt=""></span>
                            <span style="font-family:'Roboto'; font-size:14px">Automatic/Manual</span>
                        </div>
                        <div style="float: right">
                            <span><img src="{{asset('image/capacity.svg')}}" alt=""></span>
                            <span style="font-family:'Roboto'; font-size:14px">7 Orang</span>
                        </div>
                    </p>
                </div>
                <div class="card-footer" style="background: white; border:none">
                    <div style="float: left;">
                        <span style="font-family: 'Roboto'; font-size:12px; color:#909090">Start from</span>
                        <br>
                        <span style="font-family: 'Roboto'; font-size:20px; color:#000; font-weight:700">225.000</span>
                    </div>
                    <div style="float: right;">
                        <button class="booking-btn">BOOK</button>
                    </div>
                </div>
            </div>
            <div class="card hightlight col-md-3" style="margin:1%; flex:0 0 31.25%; max-width:31.25%; padding:0" data-aos="fade-down">
                <div class="card-header" style="padding: 0">
                    <img src="{{asset('image/armada/catalog2.png')}}" alt="Catalog 2" width="100%">
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star2.svg')}}" alt=""></span>
                    </h5>
                    <p class="card-text" style="font-family: 'Roboto'; font-weight:700; font-size:20px; line-height:25px; color:
                    black">
                        Grand New Avanza
                    </p>
                    <p>
                        <div style="float: left">
                            <span><img src="{{asset('image/manual.svg')}}" alt=""></span>
                            <span style="font-family:'Roboto'; font-size:14px">Automatic/Manual</span>
                        </div>
                        <div style="float: right">
                            <span><img src="{{asset('image/capacity.svg')}}" alt=""></span>
                            <span style="font-family:'Roboto'; font-size:14px">7 Orang</span>
                        </div>
                    </p>
                </div>
                <div class="card-footer" style="background: white; border:none">
                    <div style="float: left;">
                        <span style="font-family: 'Roboto'; font-size:12px; color:#909090">Start from</span>
                        <br>
                        <span style="font-family: 'Roboto'; font-size:20px; color:#000; font-weight:700">225.000</span>
                    </div>
                    <div style="float: right;">
                        <button class="booking-btn">BOOK</button>
                    </div>
                </div>
            </div>
            <div class="card col-md-3" style="margin:1%; flex:0 0 31.25%; max-width:31.25%; padding:0" data-aos="fade-left">
                <div class="card-header" style="padding: 0">
                    <img src="{{asset('image/armada/catalog3.png')}}" alt="Catalog 3" width="100%">
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star1.svg')}}" alt=""></span>
                        <span><img src="{{asset('image/star2.svg')}}" alt=""></span>
                    </h5>
                    <p class="card-text" style="font-family: 'Roboto'; font-weight:700; font-size:20px; line-height:25px; color:
                    black">Grand New Avanza
                    </p>
                     <p>
                        <div style="float: left">
                            <span><img src="{{asset('image/manual.svg')}}" alt=""></span>
                            <span style="font-family:'Roboto'; font-size:14px">Automatic/Manual</span>
                        </div>
                        <div style="float: right">
                            <span><img src="{{asset('image/capacity.svg')}}" alt=""></span>
                            <span style="font-family:'Roboto'; font-size:14px">7 Orang</span>
                        </div>
                    </p>
                </div>
                <div class="card-footer" style="background: white; border:none">
                    <div style="float: left;">
                        <span style="font-family: 'Roboto'; font-size:12px; color:#909090">Start from</span>
                        <br>
                        <span style="font-family: 'Roboto'; font-size:20px; color:#000; font-weight:700">225.000</span>
                    </div>
                    <div style="float: right;">
                        <button class="booking-btn">BOOK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="container-fluid testimoni">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="row section-title-container" style="text-align: center">
                    <h3 class="section-title center" style="display: block">Kata Mereka Tentang Rent Car</h3>
                </div>
                <div class="row" style="padding-left:47.15%; padding-right:47.15%">
                    <hr class="section-title-underline">
                </div>
                <div class="row">
                    <p class="section-title-description center" style="padding-left:20%; padding-right:20%">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras morbi euismod orci sed vitae enim varius.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card hightlight2 col-md-3" style="margin:1%; flex:0 0 31.25%; max-width:31.25%; padding:0" data-aos="fade-right">
                <div class="card-header" style="background: white; border:none; margin-top:5%">
                    <div><img src="{{asset('image/user/user1.png')}}" alt=""></div>
                    <div style="font-family: 'Poppins'; font-size:16px; line-height:24px; color:#25282B; font-weight:600; margin-top:3%">Shinta</div>
                </div>
                <div class="card-body" style="padding-top: 0">
                    <p class="card-text" style="font-family: 'Roboto'; font-size:16px; line-height:25px; color:
                    #747474">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam nihil esse molestiae id dicta? Repellendus ipsa explicabo consequatur a nobis quae? Ipsum qui veritatis dolore sunt velit natus accusantium quibusdam?
                    </p>
                </div>
                <div class="card-footer" style="background: white; border:none">
                    <span><img src="{{asset('image/clock.svg')}}" alt=""></span>
                    <span style="font-family: 'Roboto'; font-size:12px; line-height:14px; color: #909090">1 Minggu lalu</span>
                </div>
            </div>
            <div class="card hightlight2 col-md-3" style="margin:1%; flex:0 0 31.25%; max-width:31.25%; padding:0" data-aos="fade-up">
                <div class="card-header" style="background: white; border:none;margin-top:5%">
                    <div><img src="{{asset('image/user/user2.png')}}" alt=""></div>
                    <div style="font-family: 'Poppins'; font-size:16px; line-height:24px; color:#25282B; font-weight:600; margin-top:3%">Umam</div>
                </div>
                <div class="card-body" style="padding-top: 0">
                    <p class="card-text" style="font-family: 'Roboto'; font-size:16px; line-height:25px; color:
                    #747474">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti, in commodi eaque dolor sit incidunt iusto! Provident, totam earum, repudiandae reiciendis incidunt asperiores sint assumenda quidem repellendus molestias, hic iusto!
                    </p>
                </div>
                <div class="card-footer" style="background: white; border:none">
                    <span><img src="{{asset('image/clock.svg')}}" alt=""></span>
                    <span style="font-family: 'Roboto'; font-size:12px; line-height:14px; color: #909090">1 Minggu lalu</span>
                </div>
            </div>
            <div class="card hightlight2 col-md-3" style="margin:1%; flex:0 0 31.25%; max-width:31.25%; padding:0" data-aos="fade-left">
                <div class="card-header" style="background: white; border:none;margin-top:5%">
                    <div><img src="{{asset('image/user/user3.png')}}" alt=""></div>
                    <div style="font-family: 'Poppins'; font-size:16px; line-height:24px; color:#25282B; font-weight:600; margin-top:3%">Jojo</div>
                </div>
                <div class="card-body" style="padding-top: 0">
                    <p class="card-text" style="font-family: 'Roboto'; font-size:16px; line-height:25px; color:
                    #747474">
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corrupti, in commodi eaque dolor sit incidunt iusto! Provident, totam earum, repudiandae reiciendis incidunt asperiores sint assumenda quidem repellendus molestias, hic iusto!
                    </p>
                </div>
                <div class="card-footer" style="background: white; border:none">
                    <span><img src="{{asset('image/clock.svg')}}" alt=""></span>
                    <span style="font-family: 'Roboto'; font-size:12px; line-height:14px; color: #909090">1 Minggu lalu</span>
                </div>
            </div>
        </div>
        <div class="row" style="padding-left:47.4%; padding-right:47.4%; padding-top:3%">
            <span class="short-point"></span>&nbsp;
            <span class="long-point"></span>&nbsp;
            <span class="short-point"></span>
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
