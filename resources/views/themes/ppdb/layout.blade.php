<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="theme-color" content="#21AFDE">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PSB</title>

    <!-- Bootstrap -->
    <link href="{{ asset('ppdb_asset/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ asset('ppdb_asset/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">
    <!----- font ---->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
    <!---- particel css ---->
    <link rel="stylesheet" type="text/css" href="{{ asset('ppdb_asset/css/particel.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
    <!-- Style -->
    @yield("css")
    <link rel="stylesheet" href="{{ asset('ppdb_asset/css/style.css') }}">
    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
    <link href="{{ asset('ppdb_asset/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="{{ asset('ppdb_asset/js/ie-emulation-modes-warning.js') }}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="particles-js"></div>
    <div id="header">
        <div class="container">
            <nav class="navbar flex flex-center">
                <div class="logo col-md-5">
                    <a href="{{ url('/ppdb') }}">
                        <img src="{{ asset('ppdb_asset/img/logo.png') }}">
                    </a>
                </div>
                <div class="menu col-md-7 text-right">
                    <ul>
                        <li>
                            <a target="_blank" href="http://smpn1cibadak.sch.id/download/SURAT PEMBERITAHUAN PPDB 2021.pdf">Surat Pemberitahuan PPDB</a>
                        </li>
                        <li>
                            <a target="_blank" href="http://smpn1cibadak.sch.id/download/SURAT EDARAN KE SD.pdf">Surat Edaran untuk semua SD</a>
                        </li>
                        <li>
                            <a href="{{ url('ppdb/result') }}" class="btn">Cek hasil PPDB</a>
                        </li>
                    </ul>
                </div>
                <div class="clear"></div>
            </nav>
            @section('header')
            <div class="header-content text-center">
                <div class="header-text">
                    <p>Selamat datang calon peserta didik baru SMPN 1 CIBADAK</p>
                    <div class="type-wrap">
                        <div id="typed-strings">
                            <p>Cerdas Beretika</p>
                            <p>Ayo Raih Prestasi Kamu</p>
                            <p>Dalam Bakat Akademik Maupun Non-akademik</p>
                        </div>
                        <span id="typed" style=""></span>
                    </div>
                    <p>Tahun Pelajaran 2021-2022</p>
                </div>
                <div>
                    <a href="{{ url('ppdb/daftar') }}" class="btn btn-primary">Daftar Sekarang</a>
                </div>
                <div class="clear"></div>
            </div>
            <div style="color:#FFF; border:solid 1px #FFF; margin-top:30px; padding:20px">
                <h3>Catatan :</h3>
                <p>Sebagai informasi, Pendaftaran untuk periode 2021-2022 untuk jalur Afirmasi, Perpindahan Orangtua/Wali, dan Prestasi akan dibuka pada tanggal 28 Juni s.d 2 Juli 2021, sedangkan untuk jalur Zonasi akan dibuka pada tanggal 5 Juli – 9 Juli 2021</p>

                <p>Simulasi pendaftaran sudah dibuka, namun diluar tanggal yang disebutkan diatas, akan dihapus kembali</p>

                <p><br>Terima Kasih <br><br>Admin PPDB SMPN 1 Cibadak</p>
            </div>
            @show
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('ppdb_asset/js/bootstrap.min.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('ppdb_asset/js/ie10-viewport-bug-workaround.js') }}"></script>
    <!----- typed js ---->
    <script src="{{ asset('ppdb_asset/js/typed.js') }}" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            Typed.new("#typed", {
                stringsElement: document.getElementById('typed-strings'),
                typeSpeed: 30,
                backDelay: 700,
                loop: true,
                contentType: 'html', // or text
                // defaults to null for infinite loop
                loopCount: null,
                callback: function () {
                    foo();
                },
                resetCallback: function () {
                    newTyped();
                }
            });

            var resetElement = document.querySelector('.reset');
            if (resetElement) {
                resetElement.addEventListener('click', function () {
                    document.getElementById('typed')._typed.reset();
                });
            }

        });

        function newTyped() { /* A new typed object */ }

        function foo() {
            console.log("Callback");
        }
    </script>
    @yield("js")
</body>

</html>