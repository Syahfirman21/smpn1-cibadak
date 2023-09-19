@extends("themes.ppdb.layout") 
@section("header")
<div class="header-content text-center">
    <div class="header-text">
        @if ($registrant == false || $registrant->status == 0 || ($registrant->type=="2" && $now<$openReguler))
            <p style="color:#FFF">Hasil PPDB</p>
            <p>
                <a href="javascript:history.back(-1)" class="btn btn-primary">Kembali</a>
            </p>
        @else
        <h3 style="color:#FFF">Hasil PPDB SMP Negeri 1 Cibadak</h3>
        <p>
            <a href="#surat-kelulusan" class="btn btn-primary">Download Surat Keterangan Lulus/Tidak Lulus</a>
            <a href="{{ $pendaftaran }}" target="_blank" class="btn btn-primary">Lihat Formulir pendftaran</a>
        </p>
        @endif
    </div>
    <div class="clear"></div>
</div>
<section>
    <div class="wizard col-md-offset-1 col-md-10">
        @if ($registrant == false)
            <h3 class="error text-danger">Terdapat Kesalahan</h3>
            <p>Mohon maaf data yang anda masukkan salah, silakan cek kembali NISN dan Nomor Pendaftaran anda. Jika terdapat kesulitan silakan hubungi kami di Jalan Siliwangi No. 123 Telp. (0266) 531333 Cibadak Kab. Sukabumi</p>
        @elseif ($registrant->type=="2" && $now<$openReguler)
            <h3 class="error text-danger">Pengumuman Belum dibuka</h3>
            <p>Mohon maaf, saat ini admin masih melakukan verifikasi dan sorting data. Silakan hubungi pihak SMPN 1 Cibadak untuk keterangan lebih lanjut</p>
        @elseif ($registrant->status == 0)
            <h3 class="error text-danger">Menunggu Konfirmasi</h3>
            <p>Mohon maaf, saat ini admin masih melakukan verifikasi dan sorting data. Silakan hubungi pihak SMPN 1 Cibadak untuk keterangan lebih lanjut</p>
        @else
        <div id="surat-kelulusan">
            <div class="header flex flex-center">
                <div class="col-md-2">
                    <img src="{{ asset('asset/img/jabar.jpg') }}" width="100px" class="img-responsive" alt=""/>
                </div>
                <div class="col-md-8 text-center">
                    <h3>PEMERINTAH KABUPATEN SUKABUMI 
                    <br />DINAS PENDIDIKAN
                    <br />SMP NEGERI 1 CIBADAK</h3>
                    <p>Jalan Siliwangi No. 123 Telp. (0266) 531333 Cibadak Kab. Sukabumi <br /><i>Website://smpn1cibadak.sch.id  e-mail:info@smpn1cibadak.sch.id</i></p>
                </div>
                <div class="col-md-2">
                    <img src="{{ asset('asset/img/logo-sekolah.jpg') }}" width="100px" class="img-responsive" alt=""/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="line"></div>
            <div class="content">
                <p>&nbsp;</p>
                <h3 class="text-center">SURAT KETERANGAN TANDA {{ $registrant->status=="1" ? "LULUS" : "TIDAK LULUS" }}</h3>
                <p>&nbsp;</p>
                <p>
                    Yang bertanda tangan di bawah ini panitia Penerimaan Peserta didik baru SMP Negeri 1 Cibadak Kabupaten Sukabumi menerangkan :
                </p>
                <table class="table table-borderless table-biodata">
                    <tbody>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>: {{ $registrant->full_name }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Jalur</td>
                            <td>: {{ $jalur[$registrant->jalur] }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Nomor Peserta</td>
                            <td>: {{ $registrant->register_number }}</td>
                        </tr>
                        <tr>
                            <td>Sekolah Asal</td>
                            <td>: {{ $registrant->school_name }}</td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>: {{ $registrant->nisn }}</td>
                        </tr>
                    </tbody>
                </table>
                <p>Sesuai dengan hasil seleksi  penerimaan peserta didik baru tahun pelajaran 2021-2022 dinyatakan :
                </p>
                <h3 class="text-center">{{ $registrant->status=="1" ? "LULUS" : "TIDAK LULUS" }}</h3>
                <p>Demikian Surat  Tanda {{ $registrant->status=="1" ? "Lulus" : "Tidak Lulus" }} ini di buat dengan sebenar-benarnya.</p>
                <table class="table table-borderless table-biodata" style="margin-top:5px">
                    <tbody>
                        <tr>
                            <td align="center" width="50%"></td>
                            <td align="center" style="position:relative; height:200px">
                                <div style="position:absolute; top:0; left:99;"><img src="{{asset('asset/img/cap.png')}}" alt="" style="z-index:9"></div>
                                <div style="position:absolute; z-index:999">
                                    <p>&nbsp;</p>
                                    <p style="margin-left:120px">Cibadak, {{ str_replace("Jul","Juli",Carbon\Carbon::now()->format("d M Y")) }}</p>
                                    <br><br><br>
                                    <p style="margin-left:120px">Panitia PPDB</p>
                                    <p>&nbsp;</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @if ($registrant->status=="1")
                <div style="border:solid 1px #DDD; padding:10px 15px">
                    <h5 style="font-weight:bold">PENGUMUMAN PENTING</h5>
                    <ol style="column-count: 2">
                        <li>Daftar Ulang tanggal 13 Juli (Nomer Peserta 01-80)
                            <ul>
                                <li>jam 08.00 s.d 10.00 no peserta 001 - 040</li>
                                <li>jam 10.00 sd 12.00 no peserta 041 - 080</li>
                            </ul>
                        </li>
                        <li>Daftar Ulang tanggal 14 Juli (Nomer Peserta 81-160)
                            <ul>
                                <li>jam 08.00 sd 10.00 no peserta 081 - 120</li>
                                <li>jam 10.00 sd 12.00 no peserta 121 - 160</li>
                            </ul>
                        </li>
                        <li>Daftar Ulang tanggal 15 Juli (Nomer Peserta 161-240)
                            <ul>
                                <li>jam 08.00 sd 10.00 no peserta 161 - 200</li>
                                <li>jam 10.00 sd 12.00 no peserta 201 - 240</li>
                            </ul>
                        </li>
                        <li>Daftar Ulang tanggal 16 Juli (Nomer Peserta 241-320)
                            <ul>
                                <li>jam 08.00 sd 10.00 no peserta 241 - 280</li>
                                <li>jam 10.00 sd 12.00 no peserta 281 - selesai</li>
                            </ul>
                        </li>
                        <li>Membawa pas foto 3x4 berwarna sebanyak 3 lembar</li>
                        <li>Membawa printout surat bukti pendaftaran</li>
                        <li>Membawa printout surat bukti kelulusan</li>
                        <li>Daftar ulang dilakukan org tua, tanpa membawa siswa</li>
                    </ol>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>
@stop
@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.5.1/jQuery.print.min.js"></script>
<script>
    (function($){
        $(document).on("click","[href=\"#surat-kelulusan\"]", function() {
            $("#surat-kelulusan").print({
                noPrintSelector : ".no-print",
            });
        });
    })(jQuery);
</script>
@stop