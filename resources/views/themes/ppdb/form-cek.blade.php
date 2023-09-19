@extends("themes.ppdb.layout") @section("header")
<section>
    <h4 class="title text-center">Cek Hasil Kelulusan<br />Jalur Pendaftaran : Semua Jalur<br />Tahun 2021 - 2022</h4>
    @php
    $now = Carbon\Carbon::today();
    $openDateReguler = Carbon\Carbon::createFromDate(null, 07, 10);
    @endphp
    <div class="wizard col-md-offset-2 col-md-8">
        <div class="row">
        <form role="form" method="post" action="{{ route("ppdb.result") }}" id="pendaftaran-siswa-baru" class="form-jfx">
            <div class="col-md-12">
            <h4>Catatan</h4>
                <ol>
                    <li>Nomor peserta harus di isi sesuai dengan nomor yang berada di kartu peserta</li>
                    <li>Sekolah Asal diisi dengan MI/SD sekolah asal</li>
                    <li>NISN diinput sesuai dengan NISN yang terdaftar pada kartu peserta, atau boleh menggunakan tanggal lahir, dengan format DDMMYYYY. Contoh 13091989</li>
                    <li>Nama Calon Peserta didik diisi dengan nama peserta</li>
                </ol>
            </div>
            <div class="clearfix"></div>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="step1">
                    {{ csrf_field() }}
                    <input type="hidden" name="type" value="{{ request()->segment(2)== "reguler" ? "2" : "1" }}"/>
                    <div class="form-group{{ $errors->has('register_number') ? ' has-error' : '' }}">
                        <div class="col-sm-4">
                            <label for="register_number">Nomer Pesera</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="register_number" id="register_number" class="form-control" placeholder="P1819001" value="{{ old('register_number') }}">
                            @if ($errors->has('register_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('register_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
                        <div class="col-sm-4">
                            <label for="school_name">Sekolah Asal</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="school_name" id="school_name" class="form-control" placeholder="Sekolah Asal" value="{{ old('school_name') }}">
                            @if ($errors->has('school_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('school_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('nisn') ? ' has-error' : '' }}">
                        <div class="col-sm-4">
                            <label for="nisn">NISN</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="nisn" value="{{ old('nisn') }}" id="nisn" class="form-control" placeholder="NISN" />
                            @if ($errors->has('nisn'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nisn') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                        <div class="col-sm-4">
                            <label for="full_name">Nama Calon Peserta Didik</label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="full_name" value="{{ old('full_name') }}" id="full_name" class="form-control" placeholder="Nama Calon Peserta Didik" />
                            @if ($errors->has('full_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <ul class="list-inline pull-right">
                            <li>
                                <button type="submit" class="btn btn-primary btn-info-full next-step">Cek Kelulusan</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
        </div>
    </div>
</section>
@stop 
@section("js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
@stop