@extends('layouts.masterTemplate')

@section('title', 'Buat Rekomendasi Bantuan Yayasan')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h3>
                Tambah Data Rekomendasi Bantuan Pendidikan
            </h3>
        </div>

        {!! Form::open(['route' => 'rekomendasi_terdaftar_yayasans.store', 'method' => 'POST']) !!}

        <div class="card-body shadow-lg">
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
                <label class="col-sm-2 col-form-label">Apa Pelapor Memiliki NIK <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="memiliki_nik" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="memiliki_nik" value="0">
                                <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-5">
                    <input type="number" id="id-input-nik" class="form-control" name="nik">
                </div>
            </div>
            <div class="form-group row">
                {{-- <div class="col-sm-2 col-form-label"> --}}
                <label class="col-sm-2 col-form-label" for="inlineCheckbox1">Status DTKS</label>

                <div class="col-sm-5">
                    <div class="row">
                        <input type="text" id="name-input" class="form-control"
                                aria-label="Text input with checkbox" id="nodtks"
                                name="no_dtks" readonly hidden>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks" value="1" disabled>
                                <label class="form-check-label" for="inlineCheckbox1">Terdaftar</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks" value="0" disabled checked>
                                <label class="form-check-label" for="inlineCheckbox2">Tidak Terdaftar</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-info" id="btn-check-id"><i class="fa fa-database"></i> Cek DTKS</button>
                        </div>
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
                <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="nama" required>
                </div>
            </div>
            {{-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="tempat_lahir" required>
                </div>
            </div> --}}
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="tgl_lahir" required>
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
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="alamat">
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
                <h5><b>Permohonan</b></h5>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload KTP</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="filektp">
                </div>
            </div>
            @if(isset($data['filektp']))
                <div>File KTP: {{ $data['filektp'] }}</div>
            @endif
            
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload KK</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="filekk">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload File Surat Keterangan Terdaftar DTKS/Kurang Mampu</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="suket">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Download Draft Formulir Kebutuhan Layanan</label>
                <div class="col-sm-5">
                    <a href="{{ url('draft/Draft_Rekomendasi') }}" download>Download File</a>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Upload Draft Formulir Kebutuhan Layanan</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="draftfrom">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Catatan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="catatan" required></textarea>
                </div>
            </div>
            {{-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">File Penunjang</label>
                <div class="col-sm-5">
                    <input type="file" id="file-upload" name="file">
                </div>
            </div> --}}
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
                    <select class="form-control form-control-lg" name="tujuan">
                        <option selected>Pilih...</option>
                        @foreach ($checkroles as $item)
                            {{-- {{ $item->name }} --}}
                            @if ($item->name == 'Front Office kota')
                                @foreach ($rolebackoffice as $backoffice)
                                    <option value='{{ $backoffice->id }}'>{{ $backoffice->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @else
                                @foreach ($roleid as $idrole)
                                    <option value={{ $idrole->id }}>{{ $idrole->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Petugas</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="petugas">
                        <option selected>Pilih...</option>
                        @foreach ($checkroles as $item)
                            {{-- {{ $item->name }} --}}
                            @if ($item->name == 'Front Office kota')
                                @foreach ($rolebackoffice as $backoffice)
                                    <option value='{{ $backoffice->id }}'>{{ $backoffice->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @else
                                @foreach ($roleid as $idrole)
                                    <option value={{ $idrole->id }}>{{ $idrole->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- @include('pengaduans.fields') --}}
            <div class="card-footer">
                <a href="{{ route('rekomendasi_terdaftar_yayasans.index') }}" class="btn btn-default"> Batal </a>
                <button class="btn btn-primary" id="draft" type="submit" disabled>simpan ke draft</button>
                <button class="btn btn-primary" id="btn-submit" type="submit" disabled>Kirim</button>
            </div>


            {!! Form::close() !!}

        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        // tambahkan event listener untuk semua radio button dengan nama "options"
        $('input[type=radio][name=memiliki_nik]').change(function() {
            // periksa nilai radio button yang dipilih
            if ($(this).val() == '0') {
                // jika nilai radio button adalah 0, nonaktifkan tombol "Submit"
                $('#btn-submit').prop('disabled', true);
                $('#draft').prop('disabled', false);
                $('#id-input-nik').prop('disabled', true);
            } else {
                // jika nilai radio button bukan 0, aktifkan tombol "Submit"
                $('#draft').prop('disabled', true);
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
                        alert(' telah ditemukan di tabel DTKS. Dengan NO_DTKS: ' + data.Id_DTKS);
                    } else {
                        $('#name-input').val(
                            ''); // Set nilai input kedua kembali ke kosong jika ID tidak ditemukan
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
