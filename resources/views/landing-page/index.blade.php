<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <title>PARKIRKAN</title>

<!-- Lava Landing Page https://templatemo.com/tm-540-lava-landing-page-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/assets/css/font-awesome.css">

    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/templatemo-lava.css">

    <link rel="stylesheet" href="{{ asset('template') }}/assets/css/owl-carousel.css">

</head>

@php
    $aboutParkirkan = App\Models\About::orderBy('id', 'desc')->first();
    $solusiParkirkan = App\Models\Solusi::orderBy('id', 'asc')->get();
    $manfaatParkirkan = App\Models\Manfaat::orderBy('id', 'asc')->get();
    $fiturParkirkan = App\Models\Fitur::orderBy('id', 'asc')->get();
    
@endphp

<body>

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <img src="{{ asset('template') }}/assets/images/logo.png" class="logo">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="#welcome" class="menu-item">Tentang</a></li>
                            <li><a href="#manfaat" class="menu-item">Manfaat</a></li>
                            </li>
                            <li class="submenu">
                                <a href="javascript:;">Fitur</a>
                                <ul>
                                    <li><a href="" class="menu-item">Scan Plat Nomor Kendaraan</a></li>
                                    <li><a href="" class="menu-item">Slot Penitipan Barang</a></li>
                                    <li><a href="" class="menu-item">Cetak Tiket Parkir dengan QR Code</a></li>
                                    <li><a href="" class="menu-item">Metode Pembayaran Non Tunai</a></li>
                                    <li><a href="" class="menu-item">Pengaturan Umum Parkiran</a></li>
                                    <li><a href="" class="menu-item">Pengaturan Petugas Parkir</a></li>
                                    <li><a href="" class="menu-item">Pengaturan Tarif</a></li>
                                    <li><a href="" class="menu-item">Laporan</a></li>
                                </ul>
                            </li>
                            <li><a href="#kontak" class="menu-item">Kontak</a></li>
                        </ul>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->
    <section class="section" id="welcome">
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-content col-lg-6 rounded mx-auto d-block mt-5">
                        <h1>{{ $aboutParkirkan->judul }} <em>{{ $aboutParkirkan->subjudul }}</em></h1>
                        <p>{{ $aboutParkirkan->deskripsi }}</p>
                    </div>
                    <div class="left-image col-lg-5 rounded mx-auto d-block">
                        <img src="{{ asset('storage/landingpage/tentang/' . $aboutParkirkan->image) }}"
                            class="rounded img-fluid d-block mx-auto" alt="App">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** SOLUSI START ***** -->
    {{-- <section class="section" id="solusi">
        <div class="container">
            <div class="row">
                <div class="left-content col-lg-6">
                    <h2>{{ $solusiParkirkan->judul }} <em> {{ $solusiParkirkan->subjudul }}</em></h2>
                </div>
            </div>
            <div class="row">
                <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{{ asset('storage/landingpage/solusi/' . $solusiParkirkan->image) }}"
                        class="rounded img-fluid d-block mx-auto" alt="App">
                </div>
                <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                    <ul>
                        @foreach ($solusiParkirkan as $item)
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <img src="{{ asset('template') }}/assets/images/about-icon-01.png" alt="">
                            <div class="text">
                                <h4>{{ $item->solusi}}</h4>
                                <p>{{ $item->desk_solusi}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="section" id="solusi">
        <div class="container">
            <div class="row">
                <div class="left-content col-lg-6">
                    @if ($solusiParkirkan->count() > 0)
                        @php
                            $firstItem = $solusiParkirkan->first();
                        @endphp
                        <h2>{{ $firstItem->judul }} <em> {{ $firstItem->subjudul }}</em></h2>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    @if ($solusiParkirkan->count() > 0)
                        @php
                            $firstItem = $solusiParkirkan->first();
                        @endphp
                        <img src="{{ asset('storage/landingpage/solusi/' . $firstItem->image) }}"
                            class="rounded img-fluid d-block mx-auto" alt="App">
                    @endif
                </div>
                <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                    <ul>
                        @foreach ($solusiParkirkan as $item)
                            <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                                <img src="{{ asset('template') }}/assets/images/about-icon-01.png" alt="">
                                <div class="text">
                                    <h4>{{ $item->solusi }}</h4>
                                    <p>{{ $item->desk_solusi }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** SOLUSI END ***** -->


    <!-- ***** MANFAAT START ***** -->
    {{-- <section class="section mt-5" id="manfaat">
        <div class="container">
            <div class="row">
                <div class="left-content col-lg-6">
                    <h2><em>MANFAAT</em> UNTUK PENGELOLA PARKIR</h2>
                </div>
            </div>

            <div class="row">
                <div class="left-image col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <img src="{{ asset('template') }}/assets/images/manfaat.png"
                        class="rounded img-fluid d-block mx-auto" alt="App">
                </div>

                <div class="right-text offset-lg-1 col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix">
                    <ul>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <div class="text">
                                <p>Tidak memerlukan barrier gate.</p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <div class="text">
                                <p>Waktu masuk dan keluar tercatat by system.</p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <div class="text">
                                <p>Manajemen Inventory / kapasitas slot parkir.</p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <div class="text">
                                <p>Metode pembayaran Tunai / Non Tunai</p>
                            </div>
                        </li>
                        <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                            <div class="text">
                                <p>Model tarif yang sangat fleksibel.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="section mt-5" id="manfaat">
        <div class="container">
            <div class="row">
                <div class="left-content col-lg-6">
                    @if ($manfaatParkirkan->count() > 0)
                        @php
                            $firstItem = $manfaatParkirkan->first();
                        @endphp
                        <h2>APA <em>{{ $firstItem->judul }}</em> {{ $firstItem->subjudul }} </h2>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="left-image col-lg-5 col-md-12 col-sm-12 mobile-bottom-fix-big"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    @if ($manfaatParkirkan->count() > 0)
                        @php
                            $firstItem = $manfaatParkirkan->first();
                        @endphp
                        <img src="{{ asset('storage/landingpage/manfaat/' . $firstItem->image) }}"
                            class="rounded img-fluid d-block mx-auto" alt="App">
                    @endif
                </div>
                <div class="right-text offset-lg-1 col-lg-6 col-md-12 col-sm-12 mobile-bottom-fix">
                    <ul>
                        @foreach ($manfaatParkirkan as $item)
                            <li data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                                <img src="{{ asset('template') }}/assets/images/icon1.png" alt="">
                                <div class="text">
                                    <p class="mt-2">{{ $item->manfaat }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** MANFAAT END ***** -->

    <!-- ***** FITUR START ***** -->
    <section class="section mt-5" id="fitur">
        <div class="container">
            <div class="row">
                <div class="left-content rounded mx-auto d-block mt-5 mb-5">
                    @if ($fiturParkirkan->count() > 0)
                        @php
                            $firstItem = $fiturParkirkan->first();
                        @endphp
                        <h2>{{ $firstItem->judul }} <em>{{ $firstItem->subjudul }}</em></h2>
                    @endif
                </div>
            </div>
            <div class="row mb-5">
                @foreach ($fiturParkirkan as $item)
                    <div class="col-lg-3 mb-5" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <div class="features-item">
                            <div class="features-icon">
                                <img src="{{ asset('storage/landingpage/fitur/' . $item->image) }}">
                                <h4>{{ $item->fitur }}</h4>
                                <p>{{ $item->desk_fitur }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ***** FITUR END ***** -->

    <!-- ***** footer Starts ***** -->
    <footer class="mt-5 pt-5" id="kontak">
        <div class="section" id="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="row">
                        <div class="right-content text-center">
                            <h2>HUBUNGI KAMI</h2>
                            <p class="mb-5">Kantor : Jl. Krekot Bunder Raya No.26, RW.6, Ps. Baru, Kecamatan Sawah
                                Besar, Kota
                                Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10710</p>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.781427168013!2d106.82960027346665!3d-6.160021260370682!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5c3712ffacb%3A0x1d56b0cef562247d!2sJl.%20Krekot%20Bunder%20Raya%20No.26%2C%20RW.6%2C%20Ps.%20Baru%2C%20Kecamatan%20Sawah%20Besar%2C%20Kota%20Jakarta%20Pusat%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2010710!5e0!3m2!1sid!2sid!4v1690262527280!5m2!1sid!2sid"
                                    width="600" height="450" style="border:0;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <ul class="social rounded mx-auto d-block mb-5">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- ***** Footer End ***** -->


    <!-- jQuery -->
    <script src="assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/scrollreveal.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/imgfix.min.js"></script>

    <!-- Global Init -->
    <script src="assets/js/custom.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".nav .menu-item").on("click", function(e) {
                e.preventDefault();

                var target = $(this).attr("href");
                var offset = $(target).offset().top;

                $("html, body").animate({
                    scrollTop: offset
                }, 1000);
            });
        });
    </script>
</body>

</html>