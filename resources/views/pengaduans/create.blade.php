@extends('layouts.masterTemplate')

@section('title', 'Buat Pengaduan')

@section('content')
    <div class="card">
        <div class="card-header pb-0">
            <h1>
                Buat Pengaduan
            </h1>
        </div>

        {{-- {!! Form::open(['route' => 'pengaduans.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} --}}
        {!! Form::open(array_merge(['route' => 'pengaduans.store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])) !!}


        <div class="card-body shadow-lg">
            @foreach ($wilayah as $item)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $item->name_prov }}" name="nama_provinsi"
                            readonly>
                        <input type="hidden" value="{{ $item->province_id }}" name="id_provinsi">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kab/Kota</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $item->name_cities }}"
                            name="id_kabkot" readonly>
                        <input type="hidden" value="{{ $item->kota_id }}" name="id_kabkot" id="id_kabkot">

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kecamatan</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $item->name_districts }}"
                            name="name_kecamatan" readonly>
                        <input type="hidden" value="{{ $item->kecamatan_id }}" name="id_kecamatan" id="id_kecamatan">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kelurahan</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $item->name_village }}"
                            name="name_kelurahan" readonly>
                        <input type="hidden" value="{{ $item->kelurahan_id }}" name="id_kelurahan" id="id_kabkot">
                    </div>
                </div>
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
                                <input class="form-check-input" type="radio" id="inlineCheckbox1" value="Diri_Sendiri"
                                    name="jenis_pelapor">
                                <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Orang Lain"
                                    name="jenis_pelapor">
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
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks" value="1" >
                                <label class="form-check-label" for="inlineCheckbox1">Terdaftar</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks" value="0">
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
                            <a class="btn btn-info" id="btn-check-id"><i class="fa fa-database"></i> Cek DTKS</a>
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
                    <input type="text" class="form-control" name="nama">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="tempat_lahir">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="date" class="form-control" name="tgl_lahir">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Telpon <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="tel" class="form-control" name="telpon">
                    <small id="nikhelper" class="form-text text-muted">
                        Harus angka, max 13 digit
                    </small>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Hubungan dengan terlapor</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="hubungan_terlapor">
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
                <h4><b>CATATAN KEPESERTAAN</b></h4>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Program</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="id_program_sosial">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Peserta</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="no_peserta">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-info" id="btn-check-id"><i class="fa fa-file"></i>  Tambah Kepesertaan</button>
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
                    <input type="text" class="form-control" name="kepesertaan_program">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kategori Pengaduan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox1"
                                    value="Kepesertaan Program" name="kategori_pengaduan">
                                <label class="form-check-label" for="inlineCheckbox1">Kepesertaan Program</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox2"
                                    value="Kebutuhan Program" name="kategori_pengaduan">
                                <label class="form-check-label" for="inlineCheckbox2">Kebutuhan Program</label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">level program</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="level_program">
                        <option selected>Pilih...</option>
                        <option>Large select</option>
                      </select>
                </div>
            </div> --}}
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level Program</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="level_program">
                        <option selected>Pilih...</option>
                        <option>Large select</option>
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
                    <select class="form-control form-control-lg" name="sektor_program">
                        <option selected>Pilih...</option>
                        <option value="2">Large select</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Kartu Program</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="no_kartu_program">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ringkasan Pengaduan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" name="ringkasan_pengaduan">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Detail Pengaduan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="detail_pengaduan"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">File Penunjang</label>
                <div class="col-sm-5">
                    <input type="file" name="tl_file">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Alur</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="status_aksi">
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
                        <select class="form-control" name="tujuan" id="tujuan" required>
                            <option>==Pilih Salah Satu==</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->name_roles}}</option>
                            @endforeach
                        </select>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Petugas</label>
                <div class="col-sm-5">
                    <select class="form-control" name="petugas" id="petugas" required>
                        <option>==Pilih Salah Satu==</option>
                    </select>
                </div>
            </div>
            {{-- @include('pengaduans.fields') --}}
            <div class="card-footer">
                <a href="{{ route('pengaduans.index') }}" class="btn btn-default"> Batal </a>
                <button class="btn btn-primary" id="draft" type="submit" disabled>simpan ke draft</button>
                <button class="btn btn-primary" id="btn-submit" type="submit" disabled>kirim</button>
            </div>


            {!! Form::close() !!}

        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tujuan').on('change', function() {
                var role = $(this).val();
                if (role) {
                    $.ajax({
                        url: '/get-users-by-role',
                        type: 'GET',
                        data: { role: role },
                        dataType: 'json',
                        success: function(data) {
                            var html = '<option value="">-- Pilih User --</option>';
                            $.each(data, function(index, user) {
                                html += '<option value="' + user.model_id + '">' + user.name + '</option>';
                            });
                            $('#petugas').html(html);
                        }
                    });
                } else {
                    $('#petugas').empty();
                }
            });
        });
    </script>
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
