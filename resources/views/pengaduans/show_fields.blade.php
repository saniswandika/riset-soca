<div class="form-group row">
    <label class="col-sm-2 col-form-label">Provinsi</label>
    <div class="col-sm-5">
        <input type="text" readonly class="form-control" value="{{ $pengaduan->id_provinsi }}" name="id_provinsi">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kab/Kota</label>
    <div class="col-sm-5">
        <input type="text" readonly class="form-control" value="{{ $pengaduan->id_kabkot }}" name="id_kabkot"
            id="id_kabkot">

    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kecamatan</label>
    <div class="col-sm-5">
        <input type="text" readonly class="form-control" value="{{ $pengaduan->id_kecamatan }}" name="kecamatan">
        <input type="hidden" value="{{ $pengaduan->id_kecamatan }}" name="id_kecamatan" id="id_kecamatan">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kelurahan</label>
    <div class="col-sm-5">
        <input type="text" readonly class="form-control" value="{{ $pengaduan->id_kelurahan }}" name="name_kelurahan">
        <input type="hidden" value="{{ $pengaduan->id_kelurahan }}" name="id_kelurahan" id="id_kabkot">
    </div>
</div>
<br>
{{-- terlapor --}}
<div form-group row>
    <h4><b>TERLAPOR</b></h4>
</div>
<br>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis Pelaporan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Diri Sendiri"
                        name="jenis_pelapor" disabled {{ ($pengaduan->jenis_pelapor == "Diri Sendiri") ? "checked" : "" }}>
                    <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Orang Lain"
                        name="jenis_pelapor" disabled {{ ($pengaduan->jenis_pelapor == "Orang Lain") ? "checked" : "" }}>
                    <label class="form-check-label" for="inlineCheckbox2">Orang Lain</label>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Apa Pelapor Memiliki NIK <span class="text-danger">*</label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="memiliki_nik" value="1" disabled {{ ($pengaduan->ada_nik == "1") ? "checked" : "" }}>
                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" name="memiliki_nik" value="0" disabled {{ ($pengaduan->ada_nik == "0") ? "checked" : "" }}>
                    <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-5">
        <input type="number" id="id-input-nik" value="{{ $pengaduan->nik }}" class="form-control" name="nik" readonly>
        <small id="nikhelper" class="form-text text-muted">
            Harus angka, 16 digit
        </small>
    </div>
</div>
{{-- <div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <button  class="btn btn-info" id="btn-check-id">Cek Data</button>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="form-group row">
    {{-- <div class="col-sm-2 col-form-label"> --}}
        <label class="col-sm-2 col-form-label"   for="inlineCheckbox1">No DTKS</label>
   
    <div class="col-sm-5">
        <div class="input-group">
            {{-- <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" aria-label="Checkbox for following text input">
              </div>
            </div> --}}
            <input type="text" id="name-input" class="form-control" aria-label="Text input with checkbox" id="nodtks" value="{{ $pengaduan->no_dtks }}" name="no_dtks" readonly>
          </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No. KK</label>
    <div class="col-sm-5">
        <input type="number" class="form-control" value="{{ $pengaduan->no_kk }}" name="no_kk" readonly>
        <small id="kkhelper" class="form-text text-muted">
            Harus angka, 16 digit
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No. KIS</label>
    <div class="col-sm-5">
        <input type="number" class="form-control" value="{{ $pengaduan->no_kis }}" name="no_kis" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->nama }}" name="nama" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->tempat_lahir }}" name="tempat_lahir" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="date" class="form-control" value="{{ $birthdate->format('Y-m-d') }}" name="tgl_lahir" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alamat <span class="text-danger">*</label>
    <div class="col-sm-5">
        <textarea class="form-control"  name="alamat" readonly>{{ $pengaduan->alamat }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Telpon <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="tel" class="form-control" value="{{ $pengaduan->telp }}" name="telpon" readonly>
        <small id="nikhelper" class="form-text text-muted">
            Harus angka, max 13 digit
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->email }}" name="email" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Hubungan dengan terlapor</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->hubungan_terlapor }}" name="hubungan_terlapor" readonly>
    </div>
</div>

{{-- layanan --}}
{{-- <div form-group row>
    <h4><b>LAYANAN</b></h4>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis Layanan Pengaduan</label>
    <div class="col-sm-5">
        <select class="custom-select" id="inputGroupSelect01" name="jenis_layanan">
            <option selected>Pilih...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
    </div>
</div> --}}

{{-- kepesertaan --}}
<div form-group row>
    <h4><b>PENCATATAN KEPESERTAAN</b></h4>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kepesertaan Program</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->kepesertaan_program }}" name="kepesertaan_program" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Peserta <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->no_peserta }}" name="no_peserta" readonly >
    </div>
</div>
{{-- <div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <button class="btn btn-outline-primary">Tambah Kepesertaan</button>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- Pengaduan Program --}}

<div form-group row>
    <h4><b>PENGADUAN PROGRAM</b></h4>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Program</label>
    <div class="col-sm-5">
        <select class="form-control form-control-lg"  name="keluhan_tipe" disabled>
            <option selected>Pilih...</option>
            <option {{ ($pengaduan->keluhan_tipe == "Large select") ? "selected" : "" }}>Large select</option>
          </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kategori Pengaduan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="{{ $pengaduan->kategori_pengaduan }}" id="inlineCheckbox1" value="Kepesertaan Program"
                        name="kategori_pengaduan" disabled>
                    <label class="form-check-label"  for="inlineCheckbox1">Kepesertaan Program</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" value="{{ $pengaduan->kategori_pengaduan }}" id="inlineCheckbox2" value="Kebutuhan Program"
                        name="kategori_pengaduan" disabled>
                    <label class="form-check-label" for="inlineCheckbox2">Kebutuhan Program</label>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Level Program</label>
    <div class="col-sm-5">
        <select class="form-control form-control-lg" value="{{ $pengaduan->keluhan_id_program }}" name="keluhan_id_program" disabled>
            <option selected>Pilih...</option>
            <option {{ ($pengaduan->keluhan_id_program == "1") ? "selected" : "" }}>1</option>
            <option {{ ($pengaduan->keluhan_id_program == "2") ? "selected" : "" }}>2</option>
          </select>
        {{-- <select class="custom-select" id="inputGroupSelect01" name="level_program">
            <option selected>Pilih...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select> --}}
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Sektor Program</label>
    <div class="col-sm-5">
        <select class="form-control form-control-lg"  name="keluhan_sektor_program" disabled>
            <option selected>Pilih...</option>
            <option {{ ($pengaduan->keluhan_id_program == "1") ? "selected" : "" }}>1</option>
            <option {{ ($pengaduan->keluhan_id_program == "2") ? "selected" : "" }}>2</option>
          </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Kartu Program</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->no_kartu_progam }}" name="no_kartu_progam" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Ringkasan Pengaduan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $pengaduan->keluhan_detail }}" name="keluhan_detail" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Detail Pengaduan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <textarea class="form-control" name="detail_pengaduan" disabled>{{ $pengaduan->detail_pengaduan }}</textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">File Penunjang</label>
    <div class="col-sm-5">
        <input type="file"  name="file_penunjang" disabled>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Teruskan Ke <span class="text-danger">*</label>
     
        <div class="col-sm-5">
            <div class="row">
                @foreach ($roleid as $r)
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox1" value="{{ $r->id }}"
                            name="diteruskan" disabled {{ ($pengaduan->diteruskan == "$r->id") ? "checked" : "" }}>
                        <label class="form-check-label" for="inlineCheckbox1">{{ $r->name }}</label>
                    
                    
                    </div>
                </div>
                @endforeach
                {{-- <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Supervisor"
                            name="diteruskan" required>
                        <label class="form-check-label" for="inlineCheckbox2">Supervisor</label>
                    </div>
                </div> --}}
            </div>
        </div>
   
</div>