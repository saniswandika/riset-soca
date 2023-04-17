@extends('layouts.masterTemplate')

@section('title', 'ubah rekomendasiTerdaftarYayasan')
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
    <?php
    use Carbon\Carbon;
    
    $birthdatestring = $rekomendasiTerdaftarYayasan->tgl_lahir;
    $birthdatestring = substr($birthdatestring, 0, 10);
    $birthdate = Carbon::parse($birthdatestring);
    ?>
    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header pb-0">
                <h2>
                    Ubah Rekomendasi Yayasan
                </h2>
                <a href="{{ route('rekomendasi_terdaftar_yayasans.index') }}" class="btn btn-primary ml-2">Kembali</a>
            </div>

            {!! Form::model($rekomendasiTerdaftarYayasan, [
                'route' => ['rekomendasi_terdaftar_yayasans.update', $rekomendasiTerdaftarYayasan->id],
                'method' => 'patch',
            ]) !!}
            <div class="card-body">
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
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_laporan"
                                        value="1"
                                        {{ $rekomendasiTerdaftarYayasan->jenis_pelapor == 'Diri_Sendiri' ? 'checked' : '' }}
                                        checked disabled>
                                    <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_laporan"
                                        value="0"
                                        {{ $rekomendasiTerdaftarYayasan->jenis_pelapor == 'Orang Lain' ? 'checked' : '' }}
                                        disabled>
                                    <label class="form-check-label" for="inlineCheckbox2">Orang Lain</label>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->nama_ter }}"
                            name="nama_ter" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-5">
                        <input type="number" id="id-input-nik" value="{{ $rekomendasiTerdaftarYayasan->nik_ter }}"
                            class="form-control" name="nik_ter" readonly>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, 16 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->tempat_lahir }}"
                            name="tempat_lahir" readonly>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" value="{{ $birthdate->format('Y-m-d') }}"
                            name="tgl_lahir" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_kelamin"
                                        value="1"
                                        {{ $rekomendasiTerdaftarYayasan->jenis_pelapor == 'Laki-Laki' ? 'checked' : '' }}
                                        checked disabled>
                                    <label class="form-check-label" for="inlineCheckbox1">Laki - Laki</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_kelamin"
                                        value="0"
                                        {{ $rekomendasiTerdaftarYayasan->jenis_pelapor == 'Perempuan' ? 'checked' : '' }}
                                        disabled>
                                    <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->telp }}"
                            name="telp" required readonly>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, max 13 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->alamat }}"
                            name="alamat" readonly>
                    </div>
                </div>
                <div form-group row>
                    <h5><b>PELAPOR</b></h5>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->nama_pel }}"
                            name="nama_pel" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-5">
                        <input type="number" id="id-input-nik" value="{{ $rekomendasiTerdaftarYayasan->nik_pel }}"
                            class="form-control" name="nik_pel" readonly>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, 16 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->tempat_lahirpel }}"
                            name="tempat_lahirpel" readonly>
                    </div>
                </div>
               
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" value="{{ $birthdate->format('Y-m-d') }}"
                            name="tgl_lahirpel" required readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Kelamin <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_kelaminpel"
                                        value="1"
                                        {{ $rekomendasiTerdaftarYayasan->jenis_pelapor == 'Laki-Laki' ? 'checked' : '' }}
                                        checked disabled>
                                    <label class="form-check-label" for="inlineCheckbox1">Laki - Laki</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_kelaminpel"
                                        value="0"
                                        {{ $rekomendasiTerdaftarYayasan->jenis_pelapor == 'Perempuan' ? 'checked' : '' }}
                                        disabled>
                                    <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telepon<span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->telp_pel }}"
                            name="telp_pel" required readonly>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, max 13 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $rekomendasiTerdaftarYayasan->alamat_pel }}"
                            name="alamat_pel" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Lembaga</label>
                    <div class="col-sm-5">
                        <input type="text" id="id-input-nik" value="{{$rekomendasiTerdaftarYayasan->nama_lembaga}}" class="form-control" name="nama_lembaga">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->alamat_lembaga}}" name="alamat_lembaga">
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Akta Notaris</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->akta_notaris}}"name="akta_notaris" required>
                    </div>
                </div>  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No Akta</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->no_akta}}" name="no_akta" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Penyelenggaraan Kesos</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->jenis_kesos}}" name="jenis_kesos" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Ketua</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->nama_ketua}}" name="nama_ketua" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Penyelenggaraan Kesos<span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->jenis_kesos}} "name="jenis_kesos" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" value="{{$rekomendasiTerdaftarYayasan->status}}" name="status" required>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, max 13 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lingkup Wilayah Kerja</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->wil_kerja}}" name="wil_kerja">
                    </div>
                </div>
    
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tipe</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{$rekomendasiTerdaftarYayasan->tipe}}" name="tipe">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Masa Berlaku</label>
                    <div class="col-sm-5">
                        <label>Dari tanggal:</label>
                        <input type="date" class="form-control" value="{{$rekomendasiTerdaftarYayasan->tgl_mulai}}" name="tgl_mulai">
    
                        <label>Sampai tanggal:</label>
                        <input type="date" class="form-control" value="{{$rekomendasiTerdaftarYayasan->tgl_selesai}}"   name="tgl_selesai">
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
                        <textarea class="form-control" name="detail_rekomendasiTerdaftarYayasan">{{ $rekomendasiTerdaftarYayasan->catatan }}</textarea>
                    </div>
                </div>
              
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Aksi</label>
                    <div class="col-sm-5">
                        <select class="form-control form-control-lg" name="status_aksi" required>
                            <option selected value="{{ $rekomendasiTerdaftarYayasan->status_aksi }}">
                              Pilih...  {{ $rekomendasiTerdaftarYayasan->status_aksi }}</option>
                            @foreach ($alur as $a)
                                <option value="{{ $a->id_alur }}">{{ $a->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tujuan</label>
                    <div class="col-sm-5">
                        <select class="form-control form-control-lg" name="tujuan" id="tujuan">
                            <option selected>Pilih...</option>
                            @foreach ($roleid as $idrole)
                                <option value={{ $idrole->id }}>{{ $idrole->name_roles }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Petugas <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <select class="form-control form-control-lg" name="petugas" id="petugas">
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('rekomendasi_terdaftar_yayasans.index') }}" class="btn btn-default"> Batal </a>
                <button class="btn btn-primary" id="btn-submit" type="submit">Kirim</button>
            </div>




            {!! Form::close() !!}

        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#tujuan').on('change', function() {
                    var tujuan = $(this).val();
                    var route = '{{ route('getPetugas','temp') }}';
                    var url = route.replace('temp',tujuan); 
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
                                        '">'+ value.name + '</option>');
                                });
                            }
                        });
                    } else {
                       
                        $('#petugas').empty();
                        $('#petugas').append('<option value="">Pilih...</option>');
                    } 
                });
            });
            window.onload = function() {
                const yesRadio = document.querySelector('input[name="memiliki_nik"][value="1"]');
                const noRadio = document.querySelector('input[name="memiliki_nik"][value="0"]');
                const inputField = document.getElementById("id-input-nik");
                if (yesRadio.checked) {
                    inputField.readOnly = false;
                    $('#draft').prop('disabled', true);
                    $('#btn-submit').prop('disabled', false);
                } else if (noRadio.checked) {
                    inputField.readOnly = true;
                    $('#btn-submit').prop('disabled', true);
                    $('#draft').prop('disabled', false);
                }

            };
            // tambahkan event listener untuk semua radio button dengan nama "options"
            $('input[type=radio][name=memiliki_nik]').change(function() {
                // periksa nilai radio button yang dipilih
                if ($(this).val() == '0') {
                    // jika nilai radio button adalah 0, nonaktifkan tombol "Submit"
                    $('#btn-submit').prop('disabled', true);
                    $('#draft').prop('disabled', false);
                    $('#id-input-nik').prop('disabled', true);
                    $("#id-input-nik").prop("value", "");
                } else {
                    // jika nilai radio button bukan 0, aktifkan tombol "Submit"
                    $('#draft').prop('disabled', true);
                    $('#id-input-nik').prop('readOnly', false);
                    $('#id-input-nik').prop('disabled', false);
                    $('#btn-submit').prop('disabled', false);
                }
            });
            $('#btn-check-id').click(function() {
                var Nik = $('#id-input-nik').val();
                console.log(Nik); // Ambil nilai ID dari input HTML
                $.ajax({
                    url: '/cek-id/' +
                        Nik, // URL endpoint di mana Anda menangani permintaan ini di server Anda, dengan menyertakan ID yang dikirim melalui URL
                    method: 'GET',
                    success: function(data) {

                        // Tampilkan pesan berdasarkan hasil dari permintaan
                        if (data.found == true) {
                            $('#name-input').val(data
                                .Id_DTKS
                            ); // Set nilai input kedua ke nama yang diambil dari server jika ID ditemukan
                            alert(' telah ditemukan di tabel DTKS. Dengan NO_DTKS: ' + data
                                .Id_DTKS);
                        } else {
                            $('#name-input').val(
                                ''
                            ); // Set nilai input kedua kembali ke kosong jika ID tidak ditemukan
                            alert('ID tidak ditemukan di tabel lain.');
                        }
                    },
                    error: function() {
                        $('#name-input').val('');
                        alert('nodtks tidak ada  dan data akan di tambahkan ke prelist dtks');
                    }
                });
            });
        </script>
    @endsection
