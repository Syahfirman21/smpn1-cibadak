<div class="tab-pane active" role="tabpanel" id="step1">
    <div class="form-group">
        <div class="col-sm-4">
            <label for="jalur">Jalur</label>
        </div>
        <div class="col-sm-8">
            <select name="jalur" id="jalur" class="form-control">
                <option>Pilih Salah Satu</option>
                {{-- <option value="1">EKTM/Afirmasi</option>
                <option value="2">Prestasi akademik </option>
                <option value="3">Prestasi non akademik/Kejuaraan </option>
                <option value="4">Pindah tugas orangtua/guru </option> --}}
                <option value="5" selected>Zonasi</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="school_name">Sekolah Asal</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="school_name" id="school_name" class="form-control" placeholder="Sekolah Asal">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="nisn">NISN</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="nisn" id="nisn" class="form-control required" placeholder="NISN" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="full_name">Nama Calon Peserta Didik</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Nama Calon Peserta Didik" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4 col-xs-12">
            <label for="birth_place">Tempat, Tanggal Lahir</label>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6 col-xs-6">
                    <input name="birth_place" id="birth_place" type="text" class="form-control" placeholder="Sukabumi">
                </div>
                <div class="no-padding-left col-sm-6 col-xs-6">
                    <input name="birth_date" id="birth_date" type="text" class="datepicker form-control" placeholder="2002-01-28">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="gender">Jenis Kelamin</label>
        </div>
        <div class="col-sm-8">
            <div class="radio">
                <label><input type="radio" name="gender" value="L"> Laki-laki &nbsp;&nbsp;&nbsp;</label>
                <label><input type="radio" name="gender" value="P"> Perempuan &nbsp;&nbsp;&nbsp;</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="religion">Agama</label>
        </div>
        <div class="col-sm-8">
            <select name="religion" id="religion" class="form-control">
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="blood_type">Gol. Darah</label>
        </div>
        <div class="col-sm-8">
            <label><input type="radio" name="blood_type" value="A"> A&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <label><input type="radio" name="blood_type" value="B"> B&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <label><input type="radio" name="blood_type" value="O"> O&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <label><input type="radio" name="blood_type" value="AB"> AB&nbsp;&nbsp;&nbsp;&nbsp;</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="family_status">Status dalam Keluarga</label>
        </div>
        <div class="col-sm-8">
            <select name="family_status" id="family_status" class="form-control">
                <option value="Anak Kandung">Anak Kandung</option>
                <option value="Anak Angkat">Anak Angkat</option>
                <option value="Anak Tiri">Anak Tiri</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="child_sequence">Anak Ke</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="child_sequence" id="child_sequence" class="form-control" placeholder="1/2/3/dst"
            />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="address">Alamat</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="address" id="address" class="form-control" placeholder="Alamat" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="phone">Nomer Telepon</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="phone" id="phone" class="form-control" placeholder="0817272722XX" />
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-4">
            <label for="koordinat">Koordinat</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="koordinat" id="koordinat" class="form-control" placeholder="-6.9014728,106.8348" />
        </div>
    </div>
    <div class="col-sm-12">
        <div class="map-area">
            <div id="map" style="width: 100%; min-height: 300px;"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="form-group" style="margin-top:15px">
        <div class="col-sm-4">
            <label for="email">Email</label>
        </div>
        <div class="col-sm-8">
            <input type="text" name="email" id="email" class="form-control" placeholder="contact.nugraha@gmail.com" />
        </div>
    </div>
    <div class="col-sm-12">
        <ul class="list-inline pull-right">
            <li>
                <button type="button" class="btn btn-primary next-step">Simpan dan lanjutkan</button>
            </li>
        </ul>
    </div>
</div>