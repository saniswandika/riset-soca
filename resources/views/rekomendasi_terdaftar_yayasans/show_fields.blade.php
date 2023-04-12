<div>
    <h3>Detail Data Rekomendasi Yayasan</h3>
</div>
<div form-group row>
    <h4><b>Pendaftaran</b></h4>
</div>
<br>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Pendaftaran</label>
    <div class="col-sm-5">
        <input type="number" id="id-input-nik" value="{{ $rekomendasiTerdaftarYayasan->no_pendaftaran }}" class="form-control"
            name="nik_ter" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal Pendaftaran</label>
    <div class="col-sm-5">
        <input type="number" id="id-input-nik" value="{{ $rekomendasiTerdaftarYayasan->created_at }}" class="form-control"
            name="nik_ter" readonly>
    </div>
</div>
<div form-group row>
    <h4><b>Lokasi</b></h4>
</div>
@foreach ($wilayah as $item)
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Provinsi</label>
    <div class="col-sm-5">
        {{-- <input type="text" required class="form-control" value="{{ $item->name_prov }}"
            name="nama_provinsi" readonly>
        <input type="hidden" value="{{ $item->province_id }}" name="id_provinsi"> --}}
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kab/Kota</label>
    <div class="col-sm-5">
        {{-- <input type="text" required class="form-control" value="{{ $item->name_cities }}"
            name="id_kabkot" readonly>
        <input type="hidden" value="{{ $item->kota_id }}" name="id_kabkot" id="id_kabkot"> --}}

    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kecamatan</label>
    <div class="col-sm-5">
        {{-- <input type="text" required class="form-control" value="{{ $item->name_districts }}"
            name="name_kecamatan" readonly>
        <input type="hidden" value="{{ $item->kecamatan_id }}" name="id_kecamatan" id="id_kecamatan"> --}}
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kelurahan</label>
    <div class="col-sm-5">
        {{-- <input type="text" required class="form-control" value="{{ $item->name_village }}"
            name="name_kelurahan" readonly>
        <input type="hidden" value="{{ $item->kelurahan_id }}" name="id_kelurahan" id="id_kabkot"> --}}
    </div>
</div>
@endforeach
<div form-group row>
    <h4><b>Terlapor</b></h4>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis Laporan</label>
    <div class="col-sm-5">
        <input type="number" id="id-input-nik" value="{{ $rekomendasiTerdaftarYayasan->jenis_laporan }}" class="form-control"
            name="nik_ter" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama<span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->nama_ter }}" name="nama_ter"
            readonly>
    </div>  
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-5">
        <input type="number" id="id-input-nik" value="{{ $rekomendasiTerdaftarYayasan->nik_ter }}" class="form-control"
            name="nik_ter" readonly>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->tempat_lahir }}"
            name="tempat_lahir" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="date" class="form-control" value="{{ $birthdate->format('Y-m-d') }}" name="tgl_lahir" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Telpon <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="tel" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->telp }}" name="telpon"
            readonly>
        <small id="nikhelper" class="form-text text-muted">
            Harus angka, max 13 digit
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->alamat }}" name="alamat"
            readonly>
    </div>
</div>
<br>    
<div form-group row>
    <h4><b>Permohonan</b></h4>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama Lembaga</label>
    <div class="col-sm-5">
        <input type="text" id="id-input-nik" class="form-control"
            value="{{ $rekomendasiTerdaftarYayasan->nama_lembaga }}" name="nama_lembaga" readonly>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->alamat_lembaga }}" name="alamat_lembaga"
            readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Akta Notaris</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->akta_notaris }}" name="akta_notaris"
            readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Akta</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->no_akta }}" name="no_akta"
            readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis Penyelenggaraan Kesos</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->jenis_kesos }}" name="jenis_kesos"
            readonly>
    </div>
</div>>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="tel" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->status }}"
            name="status" readonly>
        <small id="nikhelper" class="form-text text-muted">
            Harus angka, max 13 digit
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Lingkup Wilayah Kerja</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->wil_kerja }}"
            name="wil_kerja" readonly>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tipe</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->tipe }}" name="tipe"
            readonly>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Masa Berlaku</label>
    <div class="col-sm-5">
        <input type="date" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->masa_berlaku }}"
            name="masa_berlaku" readonly>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"> Formulir Kelengkapan Berkas</label>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kelengkapan Berkas</label>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Permohonan Kebutuhan</label>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Catatan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <textarea class="form-control" name="detail_rekomendasiTerdaftarYayasan">{{ $rekomendasiTerdaftarYayasan->catatan }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Status Aksi</label>
    <div class="col-sm-5">
        <select class="form-control form-control-lg" name="status_aksi" disabled>
            <option selected value="{{ $rekomendasiTerdaftarYayasan->status_alur}}">
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tujuan</label>
    <div class="col-sm-5">
        <select class="form-control form-control-lg" name="tujuan" id="tujuan" disabled>
            <option selected>Pilih...</option>
                <option value={{ $rekomendasiTerdaftarYayasan->id }}>{{ $rekomendasiTerdaftarYayasan->tujuan }}</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Petugas <span class="text-danger">*</label>
    <div class="col-sm-5">
        <select class="form-control form-control-lg" name="petugas" id="petugas">
            <option value="{{ $rekomendasiTerdaftarYayasan->id }}>{{ $rekomendasiTerdaftarYayasan->petugas }}"></option>
        </select>
    </div>
</div>
</div>
</div>
