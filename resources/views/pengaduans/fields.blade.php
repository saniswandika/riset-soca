{{-- lokasi --}}
<div form-group row>
    <h4><b>LOKASI</b></h4>
</div>
<br>
@foreach ($wilayah as $item)
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Provinsi</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" value="{{ $item->name_prov }}" name="id_provinsi">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kab/Kota</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control" value="{{ $item->name_cities }}" name="id_kabkot">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kecamatan</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control"  value="{{ $item->name_districts }}" name="id_kecamatan">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kelurahan</label>
        <div class="col-sm-5">
            <input type="text" readonly class="form-control"  value="{{ $item->name_village }}" name="id_kelurahan">
        </div>
    </div>
    <br>
@endforeach
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
                        name="jenis_pelaporan" required>
                    <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Orang Lain"
                        name="jenis_pelaporan" required>
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
                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Ya"
                        name="memiliki_nik" required>
                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Tidak"
                        name="memiliki_nik" required>
                    <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">NIK</label>
    <div class="col-sm-5">
        <input type="number" class="form-control"  name="nik">
        <small id="nikhelper" class="form-text text-muted">
            Harus angka, 16 digit
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label"></label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <button class="btn btn-outline-primary">Cek DTKS</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-sm-2 col-form-label">
        <label class="form-check-label" for="inlineCheckbox1">No DTKS</label>
    </div>
    <div class="col-sm-5">
        <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" aria-label="Checkbox for following text input">
              </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with checkbox" name="no_dtks">
          </div>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No. KK</label>
    <div class="col-sm-5">
        <input type="number" class="form-control" name="no_kk">
        <small id="kkhelper" class="form-text text-muted">
            Harus angka, 16 digit
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No. KIS</label>
    <div class="col-sm-5">
        <input type="number" class="form-control" name="no_kis">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="nama" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control" name="tempat_lahir" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="date" class="form-control" name="tempat_lahir" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alamat <span class="text-danger">*</label>
    <div class="col-sm-5">
        <textarea class="form-control" name="alamat" required></textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Telpon <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="tel" class="form-control" name="telpon" required>
        <small id="nikhelper" class="form-text text-muted">
            Harus angka, max 13 digit
        </small>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-5">
        <input type="text" class="form-control"  name="email">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Hubungan dengan terlapor</label>
    <div class="col-sm-5">
        <input type="text" class="form-control"  name="hubungan_terlapor">
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
        <input type="text" class="form-control"  name="kepesertaan_program">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Peserta <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control"  name="no_peserta" required>
    </div>
</div>
<div class="form-group row">
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
</div>

{{-- Pengaduan Program --}}

<div form-group row>
    <h4><b>PENGADUAN PROGRAM</b></h4>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Program</label>
    <div class="col-sm-5">
        <select class="custom-select" id="inputGroupSelect01" name="Progam_pengaduan">
            <option selected>Pilih...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Kategori Pengaduan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Kepesertaan Program"
                        name="kategori_pengaduan" required>
                    <label class="form-check-label" for="inlineCheckbox1">Kepesertaan Program</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Kebutuhan Program"
                        name="kategori_pengaduan" required>
                    <label class="form-check-label" for="inlineCheckbox2">Kebutuhan Program</label>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Level Program</label>
    <div class="col-sm-5">
        <select class="custom-select" id="inputGroupSelect01" name="level_program">
            <option selected>Pilih...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Sektor Program</label>
    <div class="col-sm-5">
        <select class="custom-select" id="inputGroupSelect01" name="sektor_progam">
            <option selected>Pilih...</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">No Kartu Program</label>
    <div class="col-sm-5">
        <input type="text" class="form-control"  name="no_kartu_progam">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Ringkasan Pengaduan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <input type="text" class="form-control"  name="ringkasan_pengaduan" required>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Detail Pengaduan <span class="text-danger">*</label>
    <div class="col-sm-5">
        <textarea class="form-control" name="detail_pengaduan" required></textarea>
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">File Penunjang</label>
    <div class="col-sm-5">
        <input type="file"  name="file_penunjang">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-2 col-form-label">Teruskan Ke <span class="text-danger">*</label>
    <div class="col-sm-5">
        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Kepesertaan Program"
                        name="teruskan" required>
                    <label class="form-check-label" for="inlineCheckbox1">BO Kelurahan</label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Kebutuhan Program"
                        name="teruskan" required>
                    <label class="form-check-label" for="inlineCheckbox2">Supervisor</label>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>