@extends('layouts.masterTemplate')
@foreach ($checkroles as $item)
    @if ($item->name == 'Back Ofiice kelurahan')
        @section('title', 'Proses Pengaduan')
    @else
        @section('title', 'Ubah Pengaduan')
    @endif
@endforeach
@section('content')
    <?php
    use Carbon\Carbon;
    
    $birthdatestring = $pengaduan->tgl_lahir;
    $birthdatestring = substr($birthdatestring, 0, 10);
    $birthdate = Carbon::parse($birthdatestring);
    ?>
    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">
            <div class="card-header pb-0">
                <h1>
                    @foreach ($checkroles as $item)
                        @if ($item->name == 'Back Ofiice kelurahan')
                            Proses Pengaduan
                        @else
                        Ubah Pengaduan
                    @endif
                @endforeach
            </h1>
        </div>

        {!! Form::model($pengaduan, ['route' => ['pengaduans.update', $pengaduan->id], 'method' => 'patch']) !!}
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
            @foreach ($checkroles as $item)
            @if ($item->name == 'Back Ofiice kelurahan')
            <input type="hidden" value="proses" name="aksi">
            @endif
            <input type="hidden" value="{{ $pengaduan->id }}" name="id_pengaduan">
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
                                    <input type="radio" class="form-check-input" id="option1" name="status"
                                        value="Diri_Sendiri"
                                        @if ($pengaduan->jenis_pelapor == 'Diri_Sendiri')
                                        checked
                                        @endif
                                        @if ($item->name == 'Back Ofiice kelurahan')
                                        disabled
                                        @endif
                                    >
                                    <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="option1" name="status"
                                        value="Orang Lain"
                                        @if ($pengaduan->jenis_pelapor == 'Orang Lain')
                                        checked
                                        @endif
                                        @if ($item->name == 'Back Ofiice kelurahan')
                                        disabled
                                        @endif>
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
                                    <input type="radio" class="form-check-input" name="memiliki_nik" value="1"
                                        {{ $pengaduan->ada_nik == '1' ? 'checked' : '' }}
                                        {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="memiliki_nik" value="0"
                                        {{ $pengaduan->ada_nik == '0' ? 'checked' : '' }}
                                        {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox2">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">NIK</label>
                    <div class="col-sm-5">
                        <input type="number" id="id-input-nik" value="{{ $pengaduan->nik }}" class="form-control"
                            name="nik" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, 16 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    {{-- <div class="col-sm-2 col-form-label"> --}}
                    <label class="col-sm-2 col-form-label" for="inlineCheckbox1">Status DTKS</label>
                    <input type="text" id="name-input" class="form-control" aria-label="Text input with checkbox"
                        id="nodtks" value="{{ $pengaduan->no_dtks }}" name="no_dtks" readonly hidden>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status_dtks"
                                        id="status_dtks" value="1" disabled
                                        {{ $pengaduan->no_dtks ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineCheckbox1">Terdaftar</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status_dtks"
                                        id="status_dtks" value="0" disabled
                                        {{ !$pengaduan->no_dtks ? 'checked' : '' }}>
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
                                <div class="form-check form-check-inline">
                                    <button class="btn btn-info" id="btn-check-id"
                                        {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}><i
                                            class="fa fa-database"></i> Cek DTKS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. KK</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" value="{{ $pengaduan->no_kk }}" name="no_kk" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                        <small id="kkhelper" class="form-text text-muted">
                            Harus angka, 16 digit
                        </small>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->nama }}" name="nama"
                            required {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->tempat_lahir }}"
                            name="tempat_lahir" required {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" value="{{ $birthdate->format('Y-m-d') }}"
                            name="tgl_lahir" required {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telpon <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" value="{{ $pengaduan->telp }}" name="telpon"
                            required {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, max 13 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->email }}" name="email" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hubungan dengan terlapor</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->hubungan_terlapor }}"
                            name="hubungan_terlapor" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
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
                    <input type="text" class="form-control" value="{{ $pengaduan->id_program_sosial }}" {{ $item->name == 'Back Ofiice kelurahan' ? 'readonly' : '' }}
                        name="id_program_sosial">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Peserta</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" value="{{ $pengaduan->no_peserta }}" {{ $item->name == 'Back Ofiice kelurahan' ? 'readonly' : '' }}
                        name="no_peserta">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-5">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-info" id="btn-check-id" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}><i class="fa fa-file"></i> Tambah
                                Kepesertaan</button>
                        </div>
                    </div>
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
                        value="{{ $pengaduan->kepesertaan_program }}" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
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
                                    required {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                                <label class="form-check-label" for="inlineCheckbox2">kepesertaan program</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="inlineCheckbox2"
                                    value="{{ $pengaduan->kategori_pengaduan }}" name="jenis_pelapor"
                                    {{ $pengaduan->kategori_pengaduan == '2' ? 'checked' : '' }} required {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
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
                        name="level_program" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
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
                    <select class="form-control form-control-lg" name="sektor_program" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
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
                        name="no_kartu_program" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ringkasan Pengaduan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" value="{{ $pengaduan->ringkasan_pengaduan }}"
                        name="ringkasan_pengaduan" required {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Detail Pengaduan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <textarea class="form-control" name="detail_pengaduan" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>{{ $pengaduan->detail_pengaduan }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" >File Penunjang</label>
                <div class="col-sm-5">
                    <input type="file" name="file_penunjang" {{ $item->name == 'Back Ofiice kelurahan' ? 'disabled' : '' }}>
                </div>
            </div>

            {{-- percabangan fasilitator atau bukan --}}

            @if ($item->name == 'Back Ofiice kelurahan')

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Catatan Tindak Lanjut</label>
                <div class="col-sm-5">
                    <textarea name="ctl" class="form-control" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" >File Penunjang Lebih Lanjut</label>
                <div class="col-sm-5">
                    <input type="file" name="file_penunjang_lanjut">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Alur</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="status_aksi" required>
                        <option selected value="">Pilih....</option>

                        @foreach ($alur as $a)
                            <option value="{{ $a->name }}">{{ $a->name }}</option>
                            {{-- <option value="{{ $a->id_alur }}">{{ $a->name }}</option> --}}
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tujuan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="tujuan" required>
                                <option selected value="">Pilih</option>
                        @foreach ($checkroles as $item)
                            {{-- {{ $item->name }} --}}
                            @if ($item->name == 'Front Office kota')
                                @foreach ($rolebackoffice as $backoffice)
                                    <option 
                                        value="{{ $backoffice->id }}">{{ $backoffice->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @else
                                @foreach ($roleid as $idrole)
                                    <option
                                        value="{{ $idrole->id }}">{{ $idrole->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Petugas <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="tujuan">
                        <option selected value="">Pilih</option>
                        {{-- <option selected value="{{ $pengaduan->tujuan }}">{{ $pengaduan->tujuan }}</option> --}}
                        @foreach ($checkroles as $item)
                            {{-- {{ $item->name }} --}}
                            @if ($item->name == 'Front Office kota')
                                @foreach ($rolebackoffice as $backoffice)
                                    <option value="{{ $backoffice->id }}">{{ $backoffice->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @else
                                @foreach ($roleid as $idrole)
                                    <option value="{{ $idrole->id }}">{{ $idrole->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
            @else
                
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Status Alur</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="status_aksi" required>
                        <option selected value="{{ $pengaduan->status_aksi }}">{{ $pengaduan->status_aksi }}</option>

                        @foreach ($alur as $a)
                            <option value="{{ $a->name }}">{{ $a->name }}</option>
                            {{-- <option value="{{ $a->id_alur }}">{{ $a->name }}</option> --}}
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tujuan <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="tujuan" required>
                        {{-- data sebelumnya --}}
                        @foreach ($checkroles as $item)
                            @if ($item->id == $pengaduan->tujuan)
                                <option selected value="{{ $pengaduan->tujuan }}">{{ $item->name }} </option>
                            @endif
                            {{-- data selanjutnya --}}
                        @endforeach
                        @foreach ($checkroles as $item)
                            {{-- {{ $item->name }} --}}
                            @if ($item->name == 'Front Office kota')
                                @foreach ($rolebackoffice as $backoffice)
                                    <option {{ $pengaduan->tujuan == $backoffice->id ? 'selected' : '' }}
                                        value="{{ $backoffice->id }}">{{ $backoffice->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @else
                                @foreach ($roleid as $idrole)
                                    <option {{ $pengaduan->tujuan == $idrole->id ? 'selected' : '' }}
                                        value="{{ $idrole->id }}">{{ $idrole->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Petugas <span class="text-danger">*</label>
                <div class="col-sm-5">
                    <select class="form-control form-control-lg" name="tujuan">
                        {{-- <option selected value="{{ $pengaduan->tujuan }}">{{ $pengaduan->tujuan }}</option> --}}
                        @foreach ($checkroles as $item)
                            {{-- {{ $item->name }} --}}
                            @if ($item->name == 'Front Office kota')
                                @foreach ($rolebackoffice as $backoffice)
                                    <option value="{{ $backoffice->id }}">{{ $backoffice->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @else
                                @foreach ($roleid as $idrole)
                                    <option value="{{ $idrole->id }}">{{ $idrole->name }}</option>
                                    {{-- <option value="Teruskan">Large select</option> --}}
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        {{-- @include('pengaduans.fields') --}}
        <div class="card-footer">
            <a href="{{ route('pengaduans.index') }}" class="btn btn-default"> Batal </a>
            <button class="btn btn-primary" id="draft" type="submit">simpan ke draft</button>
            <button class="btn btn-primary" id="btn-submit" type="submit">kirim</button>
        </div>




        {!! Form::close() !!}

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
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
