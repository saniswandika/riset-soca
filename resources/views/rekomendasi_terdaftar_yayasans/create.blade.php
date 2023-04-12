@extends('layouts.masterTemplate')

@section('title', 'Buat Rekomendasi Bantuan Yayasan')

<style>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
    }

    .card-header a {
        margin-left: 10px;
    }
</style>

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h3>
                Tambah Data Rekomendasi Yayasan
            </h3>
            <a href="{{ route('rekomendasi_terdaftar_yayasans.index') }}" class="btn btn-primary ml-2">Kembali</a>
        </div>

        {!! Form::open(['route' => 'rekomendasi_terdaftar_yayasans.store', 'method' => 'POST']) !!}

        <div class="card-body shadow-lg">
            @foreach ($wilayah as $item)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-5">
                        <input type="text" required class="form-control" value="{{ $item->name_prov }}"
                            name="nama_provinsi" readonly>
                        <input type="hidden" value="{{ $item->province_id }}" name="id_provinsi">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kab/Kota</label>
                    <div class="col-sm-5">
                        <input type="text" required class="form-control" value="{{ $item->name_cities }}"
                            name="id_kabkot" readonly>
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
                        <input type="text" required class="form-control" value="{{ $item->name_village }}"
                            name="name_kelurahan" readonly>
                        <input type="hidden" value="{{ $item->kelurahan_id }}" name="id_kelurahan" id="id_kabkot">
                    </div>
                </div>
            @endforeach
            {{-- terlapor --}}
            <div form-group row>
                <h5><b>TERLAPOR</b></h5>
            </div>
            <br>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Pelaporan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Diri_Sendiri"
                                    name="jenis_pelapor" required>
                                <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Orang Lain"
                                    name="jenis_pelapor" required>
                                <label class="form-check-label" for="inlineCheckbox2">Orang Lain</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-5">
                    <input type="text" id="id-input-nik" class="form-control" name="nama_ter">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="nik_ter">
                    <small id="kkhelper" class="form-text text-muted">
                        Harus angka, 16 digit
                    </small>
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
                    <input type="date" class="form-control" name="tgl_lahir" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Laki-Laki"
                                    name="jenis_kelamin" required>
                                <label class="form-check-label" for="inlineCheckbox1">Laki-Laki</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Perempuan"
                                    name="jenis_kelamin" required>
                                <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telepon <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="tel" class="form-control" name="telp" required>
                    <small id="nikhelper" class="form-text text-muted">
                        Harus angka, max 13 digit
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="alamat">
                </div>
            </div>

            <div form-group row>
                <h5><b>PELAPOR</b></h5>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-5">
                    <input type="text" id="id-input-nik" class="form-control" name="nama_pel">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-5">
                    <input type="number" class="form-control" name="nik_pel">
                    <small id="kkhelper" class="form-text text-muted">
                        Harus angka, 16 digit
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="tempat_lahirpel" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="tgl_lahirpel" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Laki-Laki"
                                    name="jenis_kelaminpel" required>
                                <label class="form-check-label" for="inlineCheckbox1">Laki-Laki</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Perempuan"
                                    name="jenis_kelaminpel" required>
                                <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telepon <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="tel" class="form-control" name="telp_pel" required>
                    <small id="nikhelper" class="form-text text-muted">
                        Harus angka, max 13 digit
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="alamat_pel">
                </div>
            </div>

            <div form-group row>
                <h5><b>PERMOHONAN</b></h5>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lembaga</label>
                <div class="col-sm-5">
                    <input type="text" id="id-input-nik" class="form-control" name="nama_lembaga">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="alamat_lembaga">
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Akta Notaris</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="akta_notaris" required>
                </div>
            </div>  <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Akta</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="no_akta" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Penyelenggaraan Kesos</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="jenis_kesos" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Ketua</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama_ketua" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Penyelenggaraan Kesos<span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="jenis_kesos" required>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="tel" class="form-control" name="status" required>
                    <small id="nikhelper" class="form-text text-muted">
                        Harus angka, max 13 digit
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lingkup Wilayah Kerja</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="wil_kerja">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tipe</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="tipe">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Masa Berlaku</label>
                <div class="col-sm-5">
                    <label>Dari tanggal:</label>
                    <input type="date" class="form-control" name="tgl_mulai">

                    <label>Sampai tanggal:</label>
                    <input type="date" class="form-control" name="tgl_selesai">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Akta Notaris Pendirian</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Anggaran Dasar/Rumah Tangga </label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Struktur Organisasi Lembaga</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nomor Pokok Wajib Pajak</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Data Penerima Layanan</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kelengkapan Sarana Prasarana</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Formulir Kelengkapan Berkas</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Draft Permohonan Kebutuhan</label>
                <div class="col-sm-5">
                    <a href="{{ url('draft/Draft_Rekomendasi') }}" download>Download File</a>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload File Permohonan Kebutuhan</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="file_permohonan">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Catatan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="catatan" required></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Aksi</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="status_alur">
                        <option selected>Pilih...</option>
                        @foreach ($alur as $a)
                            <option value="{{ $a->name }}">{{ $a->name }}</option>
                            {{-- <option value="{{ $a->id_alur }}">{{ $a->name }}</option> --}}
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tujuan</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="tujuan" id="tujuan">
                        <option selected>Pilih...</option>
                        @foreach ($roleid as $role)
                            <option value="{{ $role->id }}">{{ $role->name_roles }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Petugas <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="petugas" id="petugas">
                        {{-- <option selected value="{{ $rekomendasiTerdaftarYayasan->tujuan }}">{{ $rekomendasiTerdaftarYayasan->tujuan }}</option> --}}

                    </select>
                </div>
            </div>



            {{-- @include('pengaduans.fields') --}}
            <div class="card-footer">
                <a href="{{ route('rekomendasi_terdaftar_yayasans.index') }}" class="btn btn-default"> Batal </a>
                <button class="btn btn-primary" id="btn-submit" type="submit">Kirim</button>
            </div>


            {!! Form::close() !!}

        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tujuan').on('change', function() {
                var tujuan = $(this).val();
                var route = '{{ route('getPetugas', 'temp') }}';
                var url = route.replace('temp', tujuan);
                if (tujuan) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#petugas').empty();
                            $('#petugas').append(
                                '<option value="">Pilih...</option>');

                            $.each(data, function(key, value) {
                                $('#petugas').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {

                    $('#petugas').empty();
                    $('#petugas').append('<option value="">Pilih...</option>');
                }
            });
        });
    </script>
@endsection
