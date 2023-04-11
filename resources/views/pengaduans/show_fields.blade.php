@foreach ($wilayah as $item)
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Provinsi</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" value="{{ $item->name_prov }}" name="nama_provinsi"
                readonly>
            <input type="hidden" value="{{ $item->province_id }}" name="id_provinsi">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kab/Kota</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" value="{{ $item->name_cities }}" name="id_kabkot"
                readonly>
            <input type="hidden" value="{{ $item->kota_id }}" name="id_kabkot" id="id_kabkot">

        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kecamatan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" value="{{ $item->name_districts }}"
                name="name_kecamatan" readonly>
            <input type="hidden" value="{{ $item->kecamatan_id }}" name="id_kecamatan" id="id_kecamatan">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kelurahan</label>
        <div class="col-sm-5">
            <input type="text" required class="form-control" value="{{ $item->name_village }}" name="name_kelurahan"
                readonly>
            <input type="hidden" value="{{ $item->kelurahan_id }}" name="id_kelurahan" id="id_kabkot">
        </div>
    </div>
@endforeach
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
                            name="jenis_pelapor" disabled
                            {{ $pengaduan->jenis_pelapor == 'Diri_Sendiri' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Orang Lain"
                            name="jenis_pelapor" disabled
                            {{ $pengaduan->jenis_pelapor == 'Orang Lain' ? 'checked' : '' }}>
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
                        <input type="radio" class="form-check-input" name="memiliki_nik" value="1" disabled
                            {{ $pengaduan->ada_nik == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="memiliki_nik" value="0" disabled
                            {{ $pengaduan->ada_nik == '0' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">NIK</label>
        <div class="col-sm-5">
            <input type="number" id="id-input-nik" value="{{ $pengaduan->nik }}" class="form-control" name="nik"
                readonly>
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
        <label class="col-sm-2 col-form-label" for="inlineCheckbox1">Status DTKS</label>

        <div class="col-sm-5">
            <div class="row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks"
                            value="1" disabled {{ $pengaduan->no_dtks ? 'checked' : ''}}>
                        <label class="form-check-label" for="inlineCheckbox1">Terdaftar</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks"
                            value="0" disabled {{ !$pengaduan->no_dtks ? 'checked' : ''}}>
                        <label class="form-check-label" for="inlineCheckbox2">Tidak Terdaftar</label>
                    </div>
                </div>
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
        <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" value="{{ $pengaduan->nama }}" name="nama" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" value="{{ $pengaduan->tempat_lahir }}" name="tempat_lahir"
                readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
        <div class="col-sm-5">
            <input type="date" class="form-control" value="{{ $birthdate->format('Y-m-d') }}" name="tgl_lahir"
                readonly>
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
            <input type="text" class="form-control" value="{{ $pengaduan->hubungan_terlapor }}"
                name="hubungan_terlapor" readonly>
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
        <h4><b>Catatan Kepesertaan</b></h4>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Program</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" value="{{ $pengaduan->id_program_sosial }}"
                name="id_program_sosial" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Peserta</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" value="{{ $pengaduan->no_peserta }}"
                name="no_peserta" readonly>
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
            <input type="text" class="form-control" name="kepesertaan_program"
                value="{{ $pengaduan->kepesertaan_program }}" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kategori Pengaduan <span class="text-danger">*</label>
        <div class="col-sm-5">
            <div class="row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox2" value="1"
                            name="jenis_pelapor" {{ $pengaduan->kategori_pengaduan == '1' ? 'checked' : '' }}
                            disabled>
                        <label class="form-check-label" for="inlineCheckbox2">kepesertaan program</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox2"
                            value="{{ $pengaduan->kategori_pengaduan }}" name="jenis_pelapor"
                            {{ $pengaduan->kategori_pengaduan == '2' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="inlineCheckbox2">Kebutuhan program</label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Level Program</label>
        <div class="col-sm-5">
            <select class="form-control form-control-lg" value="{{ $pengaduan->level_program }}"
                name="level_program" disabled>
                <option selected value="{{ $pengaduan->level_program }}">{{ $pengaduan->level_program }}.
                </option>
                <option selected value="1">asdad</option>
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
            <select class="form-control form-control-lg" name="sektor_program" disabled>
                <option selected value="{{ $pengaduan->sektor_program }}">{{ $pengaduan->sektor_program }}
                </option>
                <option></option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">No Kartu Program</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" value="{{ $pengaduan->no_kartu_program }}"
                name="no_kartu_program" disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Ringkasan Pengaduan <span class="text-danger">*</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" value="{{ $pengaduan->ringkasan_pengaduan }}"
                name="ringkasan_pengaduan" required disabled>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Detail Pengaduan <span class="text-danger">*</label>
        <div class="col-sm-5">
            <textarea class="form-control" name="detail_pengaduan" readonly>{{ $pengaduan->detail_pengaduan }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">File Penunjang</label>
        <div class="col-sm-5">
            <input type="file" name="file_penunjang">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Status Alur</label>
        <div class="col-sm-5">
            <select class="form-control form-control-lg" name="status_aksi" required disabled>
                <option selected value="{{ $pengaduan->status_aksi }}">{{ $pengaduan->status_aksi }}</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Tujuan <span class="text-danger">*</label>
        <div class="col-sm-5">
            <select class="form-control form-control-lg" name="tujuan" disabled>
                {{-- data sebelumnya --}}
                @foreach ($checkroles as $item)
                    @if ($item->id == $pengaduan->tujuan)
                        <option selected value="{{ $pengaduan->tujuan }}">{{ $item->name_roles }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Petugas <span class="text-danger">*</label>
        <div class="col-sm-5">
            <select class="form-control form-control-lg" name="Petugas" disabled>
                {{-- data sebelumnya --}}
                @foreach ($checkroles as $item)
                    @if ($item->id == $pengaduan->tujuan)
                        <option selected value="{{ $pengaduan->tujuan }}">{{ $item->name_roles }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
</div>
