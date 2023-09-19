@extends("themes.ppdb.layout") 
@section("header")
<div class="header-content text-center">
    <div class="header-text">
        <p>Pendaftaran berhasil</p>
        <p>
            <a href="#formulir" class="btn btn-primary">Download Formulir pendftaran</a>
            <a href="#kartu" class="btn btn-default">Download Kartu Peserta</a>
        </p>
    </div>
    <div class="clear"></div>
    <div class="col-md-offset-1 col-md-10 text-left" style="border:solid 1px #FFF; margin-top:10px; margin-bottom:10px; background:#FFF; border-radius:4px; color:#000">
        <h3 class="font-weight-bold">Jadwal Untuk penyerahan berkas ke panitia PPDB SMP 1 CIBADAK</h3>
        <ul>
            <li>Senin, tgl 5 Juli no peserta 142 sd 200 
            <li>Selasa, tgl 6 Juli no peserta 201 sd 250
            <li>Rabu, tgl 7 Juli no peserta 251 sd 300
            <li>Kamis, tgl 8 Juli no peserta 301 sd 350
            <li>Jumat, tgl 9 Juli no peserta 351 sd selesai
        </ul>
        <h3 class="font-weight-bold">Berkas Yang harus dibawa pada saat pengumpulan berkas</h3>
        <ol>
            {{-- <li>SKHUN Asli dan fotocopi nya 1 lembar yang dilegalisasi oleh sekolah yang bersangkutan</li>
            <li>FC Akta kelahiran</li>
            <li>FC Kartu keluarga dan aslinya di bawa</li>
            <li>FC KTP Orangtua dan aslinya dibawa</li>
            <li>Surat Keterangan Kelulusan</li>
            <li>Ijasah Madrasan Diniyah atau surat keterangan</li> --}}
            <li>Print Kartu Peserta, dan formulir pendaftaran berikut Surat Pernyataan (klik 2 buah tombol diatas)</li>
            <li>Fotokopi Akta kelahiran dan aslinya sebanyak 2 lembar</li>
            <li>Fotokopi Raport bagi jalur Prestasi Akademik</li>
            <li>Fotokopi Piagam bagi jalur Prestasi Non Akademik/Kejuaran</li>
            <li>Fotokopi KIP/PKH/JKS bagi jalur Afirmasi</li>
            <li>Fotokopi SK Perpindahan Tugas bagi jalur pindah tugas orangtua/guru</li>
        </ol>
    </div>
    <div class="clear"></div>
</div>
<section>
    <div class="wizard col-md-offset-1 col-md-10">
        <div id="formulir-pendaftaran">
            <div class="header flex flex-center">
                <div class="col-md-2">
                    <img src="{{ asset('asset/img/jabar.jpg') }}" width="100px" class="img-responsive" alt=""/>
                </div>
                <div class="col-md-8 text-center">
                    <h4>PEMERINTAH KABUPATEN SUKABUMI 
                    <br />DINAS PENDIDIKAN
                    <br />SMP NEGERI 1 CIBADAK</h4>
                    <p>Jalan Siliwangi No. 123 Telp. (0266) 531333 Cibadak Kab. Sukabumi <br /><i>Website://smpn1cibadak.sch.id  e-mail:info@smpn1cibadak.sch.id</i></p>
                </div>
                <div class="col-md-2">
                    <img src="{{ asset('asset/img/logo-sekolah.jpg') }}" width="100px" class="img-responsive" alt=""/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="line"></div>
            <div class="content">
                <h4 class="text-center">FORMULIR PENERIMAAN PESERTA DIDIK BARU (PPDB) <br />SMP NEGERI 1 CIBADAK TAHUN PELAJARAN 2021/2022</h4>
                <table class="table table-borderless table-biodata">
                    <tbody>
                        <tr>
                            <td colspan="2"><h4>1). Data Peserta Didik</h4><hr></td>
                        </tr>
                        <tr>
                            <td width="25%">Jalur PPDB</td>
                            <td>: {{ $jalur[$registrant->jalur] }}</td>
                        </tr>
                        @if ($registrant->jalur == 3)
                        <tr>
                            <td width="25%">Nama Kejuaraan</td>
                            <td>: {{ $registrant->awards }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Peringkat</td>
                            <td>: {{ $registrant->rank_awards }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Level</td>
                            <td>: {{ $registrant->level_awards }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Nomor Pendaftaran</td>
                            <td>: {{ $registrant->register_number }}</td>
                        </tr>
                        <tr class="no-print">
                            <td>Tanggal Pendaftaran</td>
                            <td>: {{ Carbon\Carbon::parse($registrant->regiter_date)->format("d-M-Y") }}</td>
                        </tr>
                        <tr>
                            <td>Sekolah Asal</td>
                            <td>: {{ $registrant->school_name }}</td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>: {{ $registrant->nisn }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>: {{ $registrant->full_name }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal lahir</td>
                            <td>: {{ $registrant->birth_place }}, {{ Carbon\Carbon::parse($registrant->birth_date)->format("d-M-Y") }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>: {{ $registrant->gender == "L" ? "Laki-laki" : "Perempuan" }}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>: {{ $registrant->religion }}</td>
                        </tr>
                        <tr>
                            <td>Gol. Darah</td>
                            <td>: {{ $registrant->blood_type }}</td>
                        </tr>
                        <tr>
                            <td>Status dalam keluarga</td>
                            <td>: {{ $registrant->family_status }}</td>
                        </tr>
                        <tr>
                            <td>Anak Ke</td>
                            <td>: {{ $registrant->child_sequence }}</td>
                        </tr>
                        <tr class="no-print">
                            <td>Alamat</td>
                            <td>: {{ $registrant->address }}</td>
                        </tr>
                        <tr>
                            <td>No. Telepon/HP</td>
                            <td>: {{ $registrant->phone }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>: {{ $registrant->email }}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr><h4>2). Data Orangtua</h4><hr></td>
                        </tr>
                        <tr>
                            <td >Nama Ayah</td>
                            <td>: {{ $parents->father_name }}</td>
                        </tr>
                        <tr>
                            <td >Nama Ibu</td>
                            <td>: {{ $parents->mother_name }}</td>
                        </tr>
                        <tr>
                            <td >Alamat Orangtua</td>
                            <td>: {{ $parents->parent_address }}</td>
                        </tr>
                        <tr>
                            <td >Nomor Telepon/HP</td>
                            <td>: {{ $parents->parent_phone }}</td>
                        </tr>
                        <tr>
                            <td >Pekerjaan Ayah</td>
                            <td>: {{ $parents->father_jobs }}</td>
                        </tr>
                        <tr>
                            <td >Pekerjaan Ibu</td>
                            <td>: {{ $parents->mother_jobs }}</td>
                        </tr>
                        <tr>
                            <td >Pendidikan Terakhir Ayah</td>
                            <td>: {{ $parents->father_education }}</td>
                        </tr>
                        <tr>
                            <td >Pendidikan Terakhir Ibu</td>
                            <td>: {{ $parents->mother_education }}</td>
                        </tr>
                        @if ($wali)
                            <tr>
                                <td colspan="2"><hr><h4>3). Data Wali</h4><hr></td>
                            </tr>
                            <tr>
                                <td >Nama Wali</td>
                                <td>: {{ $wali->pg_name }}</td>
                            </tr>
                            <tr>
                                <td >Alamat Wali</td>
                                <td>: {{ $wali->pg_address }}</td>
                            </tr>
                            <tr>
                                <td >Nomor Telepon/HP</td>
                                <td>: {{ $wali->pg_phone }}</td>
                            </tr>
                            <tr>
                                <td >Pekerjaan Wali</td>
                                <td>: {{ $wali->pg_jobs }}</td>
                            </tr>
                            <tr>
                                <td >Pendidikan Terakhir Wali</td>
                                <td>: {{ $wali->pg_education }}</td>
                            </tr>
                            <tr>
                                <td >Hubungan dengan Wali</td>
                                <td>: {{ $wali->pg_relation }}</td>
                            </tr>
                        @endif
                        <tr class="no-print">
                            <td colspan="2"><h4>*). Lampiran dan Persyaratan khusus</h4></td>
                        </tr>
                        <tr class="no-print">
                            <td colspan="2">
                                @foreach($attachments as $attach)
                                    <a href="{{route('ppdb.attachments',["nisn"=>$attach->nisn,"filename"=>$attach->atachment]) }}" class="btn btn-primary">{{ $attach->atachment }}</a>
                                @endforeach
                            </td>
                        </tr>
                        @if ($registrant->jalur == 2) 
                        <tr>
                            <td colspan="2">
                                <table class="table table-bordered" style="margin-top:15px">
                                    <tbody>
                                        <tr>
                                            <td colspan="8"><h4>**). Nilai Rapor</h4></td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2" width="30px">No</td>
                                            <td rowspan="2">Mata Pelajaran</td>
                                            <td colspan="2">Kelas 4</td>
                                            <td colspan="2">Kelas 5</td>
                                            <td rowspan="2">Kelas 6</td>
                                            <td rowspan="2">Rata-rata</td>
                                        </tr>
                                        <tr>
                                            <td>Semester 1</td>
                                            <td>Semester 2</td>
                                            <td>Semester 1</td>
                                            <td>Semester 2</td>
                                        </tr>
                                        @php
                                        $x=1; 
                                        $total_row = count($raportArr);
                                        $sum_4_1=0; 
                                        $sum_4_2=0; 
                                        $sum_5_1=0; 
                                        $sum_5_2=0; 
                                        $sum_6_1=0;
                                        @endphp
                                        @foreach ($raportArr as $nilai)
                                            @php 
                                                $rata_rata = number_format(($nilai->nilai_4_1+$nilai->nilai_4_2+$nilai->nilai_5_1+$nilai->nilai_5_2+$nilai->nilai_6_1)/5,2);
                                                $sum_4_1 += $nilai->nilai_4_1;
                                                $sum_4_2 += $nilai->nilai_4_2;
                                                $sum_5_1 += $nilai->nilai_5_1;
                                                $sum_5_2 += $nilai->nilai_5_2;
                                                $sum_6_1 += $nilai->nilai_6_1;
                                            @endphp
                                            <tr>
                                                <td>{{ $x++}}</td>
                                                <td width="150px">{{ $nilai->matapel }}</td>
                                                <td>{{ $nilai->nilai_4_1 }}</td>
                                                <td>{{ $nilai->nilai_4_2 }}</td>
                                                <td>{{ $nilai->nilai_5_1 }}</td>
                                                <td>{{ $nilai->nilai_5_2 }}</td>
                                                <td>{{ $nilai->nilai_6_1 }}</td>
                                                <td>{{ $rata_rata }}</td>
                                            </tr>
                                        @endforeach
                                        @php 
                                            $rata_4_1 = number_format($sum_4_1/$total_row,2);
                                            $rata_4_2 = number_format($sum_4_2/$total_row,2);
                                            $rata_5_1 = number_format($sum_5_1/$total_row,2);
                                            $rata_5_2 = number_format($sum_5_2/$total_row,2);
                                            $rata_6_1 = number_format($sum_6_1/$total_row,2);
                                            $ratatotal = number_format(($rata_4_1+$rata_4_2+$rata_5_1+$rata_5_2+$rata_6_1)/5,2);
                                        @endphp
                                        <tr>
                                            <td>{{ $x++}}</td>
                                            <td>Rata-rata</td>
                                            <td>{{ $rata_4_1 }}</td>
                                            <td>{{ $rata_4_2 }}</td>
                                            <td>{{ $rata_5_1 }}</td>
                                            <td>{{ $rata_5_2 }}</td>
                                            <td>{{ $rata_6_1 }}</td>
                                            <td>{{ $ratatotal }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Peringkat Kelas</td>
                                            <td>{{ $registrant->rank_4_1 }}</td>
                                            <td>{{ $registrant->rank_4_2 }}</td>
                                            <td>{{ $registrant->rank_5_1 }}</td>
                                            <td>{{ $registrant->rank_5_2 }}</td>
                                            <td>{{ $registrant->rank_6_1 }}</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endif
                        <tr>
                            <td>Koordinat</td>
                            <td>: {{ $registrant->lattitudes.",".$registrant->longitudes}}</td>
                        </tr>
                        <tr>
                            <td>Estimasi Jarak Rumah ke Sekolah</td>
                            <td>: {{ $registrant->distance_in_km." Km" }}</td>
                        </tr>
                        <tr class="no-print">
                            <td colspan="2">
                                <div id="map" style="width: 100%; min-height: 300px;"></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div style="border:solid 1px #CCC; padding:15px; margin-bottom:30px">
                <p>SAYA ORANG TUA/WALI DARI <span class="nama_siswa">{{ strtoupper($registrant->full_name) }}</span> MENYATAKAN
                <ol>
                <li>Bahwa seluruh data/informasi yang diberikan dalam formulir pendaftaran persyaratan PPDB ini adalah benar dan dapat dipertanggungjawabkan.
                <li>Bahwa seluruh dokumen pendukung baik dokumen persyaratan umum maupun khusus PPDB adalah sesuai aslinya.
                <li>Bahwa saya tidak akan melakukan tindakan memaksakan kehendak, suap menyuap dan / atau perbuatan yang melawan aturan dalam pelaksanaan PPDB ini.
                </ol>
                <p><p>Apabila di kemudian hari terbukti pernyataan saya tersebut tidak benar, maka saya bersedia dikenakan sanksi/hukuman berupa pembatalan penerimaan peserta didik baru atau sanksi lain menurut ketentuan peraturan perundang-undangan yang berlaku.
                Demikian pernyataan ini saya buat dalam keadaan sadar, tanpa paksaan, dan dibuat dengan sebenar-benarnya.
                
                <p>SAYA ORANG TUA/WALI DARI <span class="nama_siswa">{{ strtoupper($registrant->full_name) }}</span> setuju dan tunduk pada konsekuensi pernyataan tanggung jawab mutlak tersebut
                </div>
                <table class="table table-borderless table-biodata">
                    <tbody>
                        <tr>
                            <td align="center">
                                <p>Mengetahui Orangtua/Wali</p>
                                <br><br><br><br>
                                ........................................................
                            </td>
                            <td align="center">
                                <p>Cibadak, {{ str_replace("June","Juni",Carbon\Carbon::parse($registrant->regiter_date)->format("d F Y")) }}</p>
                                <br><br><br><br>
                                {{ $registrant->full_name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="wizard col-md-offset-3 col-md-6">
        <div id="kartu-peserta">
            <div class="header flex flex-center">
                <div class="col-md-2">
                    <img src="{{ asset('asset/img/jabar.jpg') }}" width="70px" class="img-responsive" alt=""/>
                </div>
                <div class="col-md-8 text-center">
                    <h5>PEMERINTAH KABUPATEN SUKABUMI 
                    <br />DINAS PENDIDIKAN
                    <br />SMP NEGERI 1 CIBADAK</h5>
                    <p>Jalan Siliwangi No. 123 Telp. (0266) 531333 Cibadak kab. Sukabumi <br /><i>Website:http://smpn1cibadak.sch.id &nbsp;&nbsp;&nbsp;    E-mail:info@smpn1cibadak.sch.id</i></p>
                </div>
                <div class="col-md-2">
                    <img src="{{ asset('asset/img/logo-sekolah.jpg') }}" width="70px" class="img-responsive" alt=""/>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="line"></div>
            <div class="content">
                <h5 class="text-center">KARTU PESERTA SELEKSI PPDB <br />TAHUN PELAJARAN 2021/2022</h5>
                <table class="table table-borderless table-biodata">
                    <tbody>
                        <tr>
                            <td width="25%">Nomor Peserta</td>
                            <td>: {{ $registrant->register_number }}</td>
                        </tr>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>: {{ $registrant->full_name }}</td>
                        </tr>
                        <tr>
                            <td>Sekolah Asal</td>
                            <td>: {{ $registrant->school_name }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-borderless table-biodata">
                    <tbody>
                        <tr>
                            <td align="center" width="50%"></td>
                            <td align="center" style="position:relative; height:155px">
                                <div style="position:absolute; top:0; left:0;"><img src="{{asset('asset/img/cap.png')}}" alt="" style="z-index:9"></div>
                                <div style="position:absolute; z-index:999; margin-left:80px">
                                    <p>Cibadak, {{ str_replace("June","Juni",Carbon\Carbon::parse($registrant->regiter_date)->format("d F Y")) }}
                                    <br> Ketua Panitia PPDB,</p>
                                    <br><br>
                                    <p>Maman, S.Pd, M.M.Pd <br>NIP.196402161989031005</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@stop
@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.5.1/jQuery.print.min.js"></script>
<script>
    (function($){
        $(document).on("click","[href=\"#formulir\"]", function() {
            $("#formulir-pendaftaran").print({
                noPrintSelector : ".no-print",
            });
        });

        $(document).on("click","[href=\"#kartu\"]", function() {
            $("#kartu-peserta").print({
                noPrintSelector : ".no-print",
            });
        });

    })(jQuery);
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfDTwbgh1d1FDEWJwizePMcfOOYBvRW-w&callback=initMap" async
    defer></script>
<script>
	var map;
	function initMap(_lat, _lng, el) {
        //create empty LatLngBounds object
        var bounds = new google.maps.LatLngBounds();

		var mapCanvas = document.getElementById(el ? el : "map");
		var myLatLng = {
			lat: _lat ? _lat : {{ $registrant->lattitudes }},
			lng: _lng ? _lng : {{ $registrant->longitudes }}
		};

		var mapOptions = {
			center: myLatLng,
			zoom: 15,
			draggable: false,
			scrollwheel: false,

		};
		map = new google.maps.Map(mapCanvas, mapOptions);
		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
		});
        bounds.extend(marker.position);

        var marker = new google.maps.Marker({
			position: {lat:-6.8943916,lng:106.7903947},
			map: map,
		});
        bounds.extend(marker.position);

        //now fit the map to the newly inclusive bounds
        map.fitBounds(bounds);
	}
</script>
@stop