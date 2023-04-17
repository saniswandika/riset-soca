@extends('layouts.masterTemplate')

@section('title', 'ubah pengaduan')

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
                    Ubah Pengaduan
                </h1>
            </div>

            {!! Form::model($pengaduan, ['route' => ['pengaduans.update', $pengaduan->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
            <div class="card-body ">
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
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_pelapor"
                                        value="1" {{ $pengaduan->jenis_pelapor == 'Diri Sendiri' ? 'checked' : '' }}
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach > 
                                    <label class="form-check-label" for="inlineCheckbox1">Diri Sendiri</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="option1" name="jenis_pelapor"
                                        value="0" {{ $pengaduan->jenis_pelapor == 'Orang Lain' ? 'checked' : '' }} 
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
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
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach >
                                    <label class="form-check-label" for="inlineCheckbox1">Ya</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="memiliki_nik" value="0"
                                        {{ $pengaduan->ada_nik == '0' ? 'checked' : '' }} 
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
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
                            name="nik" 
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, 16 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    {{-- <div class="col-sm-2 col-form-label"> --}}
                    <label class="col-sm-2 col-form-label" for="inlineCheckbox1">Status DTKS</label>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks"
                                        value="1" {{ $pengaduan->status_dtks == 'Terdaftar' ? 'checked' : '' }}
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                                    <label class="form-check-label" for="inlineCheckbox1">Terdaftar</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="status_dtks" id="status_dtks"
                                        value="0" {{ $pengaduan->status_dtks == 'Tidak Terdaftar' ? 'checked' : '' }}
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
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
                                    @foreach ($checkroles2 as $item)
                                        @if ($item->name_roles == 'Back Ofiice kelurahan')
                                        disabled
                                        @endif
                                    @endforeach><i class="fa fa-database"></i> Cek DTKS</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. KK</label>
                    <div class="col-sm-5">
                        <input type="number" class="form-control" value="{{ $pengaduan->no_kk }}" name="no_kk" 
                       @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                        <small id="kkhelper" class="form-text text-muted">
                            Harus angka, 16 digit
                        </small>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->nama }}" name="nama"
                       @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tempat Lahir <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->tempat_lahir }}"
                            name="tempat_lahir" 
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal Lahir <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="date" class="form-control" value="{{ $birthdate->format('Y-m-d') }}"
                            name="tgl_lahir" 
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Telpon <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="tel" class="form-control" value="{{ $pengaduan->telp }}" name="telpon" 
                       @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                        <small id="nikhelper" class="form-text text-muted">
                            Harus angka, max 13 digit
                        </small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->email }}" name="email" 
                       @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hubungan dengan terlapor</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->hubungan_terlapor }}"
                            name="hubungan_terlapor" 
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
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
                @php
                    // $data = explode(',', $pengaduan->id_program_sosial); // Membuat array dari data yang dipisahkan dengan koma
                    $id_program_sosial = json_decode($pengaduan->id_program_sosial);
                    $no_peserta = json_decode($pengaduan->no_peserta);
                    // dd($no_peserta);
                    // dd($array1);
                @endphp
                @foreach ($id_program_sosial as $item)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Program</label>
                        <div class="col-sm-5">
                        
                                <input type="text" class="form-control" value="{{ $item }}"
                                name="id_program_sosial" 
                                    @foreach ($checkroles2 as $item)
                                        @if ($item->status_aksi == 'Teruskan')
                                        disabled
                                        @endif
                                    @endforeach>
                          
                        
                        </div>
                    </div>
                @endforeach
                @foreach ($no_peserta as $item)
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Program</label>
                        <div class="col-sm-5">
                        
                                <input type="text" class="form-control" value="{{ $item }}"
                                name="no_peserta" 
                                    @foreach ($checkroles2 as $item)
                                        @if ($item->status_aksi == 'Teruskan')
                                        disabled
                                        @endif
                                    @endforeach>
                        
                        
                        </div>
                    </div>
                @endforeach
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-info" id="btn-check-id"    
                                @foreach ($checkroles2 as $item)
                                    @if ($item->name_roles == 'Back Ofiice kelurahan')
                                    disabled
                                    @endif
                                @endforeach><i class="fa fa-file"></i>  Tambah Kepesertaan</button>
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
                        <input type="text" class="form-control" name="kepesertaan_program"
                            value="{{ $pengaduan->kepesertaan_program }}"    
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Kategori Pengaduan <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox2" value="Kepesertaan Program"
                                        name="kategori_pengaduan" {{ $pengaduan->kategori_pengaduan == 'Kepesertaan Program' ? 'checked' : '' }}
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                                    <label class="form-check-label" for="inlineCheckbox2">kepesertaan program</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="inlineCheckbox2"
                                        value="{{ $pengaduan->kategori_pengaduan }}" name="kategori_pengaduan"
                                        {{ $pengaduan->kategori_pengaduan == 'Kebutuhan program ' ? 'checked' : '' }} 
                                        @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
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
                            name="level_program" 
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                            <option selected value="{{ $pengaduan->level_program }}">{{ $pengaduan->level_program }}.
                            </option>
                            <option selected value="1">asdad</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Sektor Program</label>
                    <div class="col-sm-5">
                        <select class="form-control form-control-lg" name="sektor_program" 
                       @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
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
                            name="no_kartu_program" 
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ringkasan Pengaduan <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" value="{{ $pengaduan->ringkasan_pengaduan }}"
                            name="ringkasan_pengaduan"    
                           @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Detail Pengaduan <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="detail_pengaduan"    
                       @foreach ($checkroles2 as $item)
                                            @if ($item->status_aksi == 'Teruskan')
                                            disabled
                                            @endif
                                        @endforeach>{{ $pengaduan->detail_pengaduan }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">File Penunjang</label>
                    <div class="col-sm-5">
                        <input type="file" name="tl_file">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Catatan Pengaduan <span class="text-danger">*</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" name="tl_catatan"
                      >{{ $pengaduan->tl_catatan }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Alur</label>
                    <div class="col-sm-5">
                        <select class="form-control form-control-lg" name="status_aksi" required>
                            @foreach ($alur as $a)
                                <option value="{{ $a->name }}">{{ $a->name }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tujuan</label>
                    <div class="col-sm-5">
                        <select class="form-control form-control-lg" name="tujuan"  id="tujuan" >
                           
                            @foreach ($checkroles as $item)
                            {{-- @php
                            dd($item);
                            @endphp --}}
                                @if ($item->name_roles == 'Front Office kota')
                                    @foreach ($createdby as $c)
                                        <option value='{{ $c->role_id }}'>{{ $c->name_roles }}</option>
                                    @endforeach
                                    @foreach ($roleid as $idrole)
                                        <option value={{ $idrole->role_id }}>{{ $idrole->name_roles }}</option>
                                     @endforeach
                                @elseif ($item->name_roles == 'Front Office Kelurahan')
                                    @foreach ($createdby as $c)
                                        <option value='{{ $c->role_id }}'>{{ $c->name_roles }} </option>
                                    @endforeach
                                    {{-- @foreach ($roleid as $idrole)
                                        <option value={{ $idrole->role_id }}>{{ $idrole->name_roles }}</option>
                                    @endforeach --}}
                                @elseif ($item->name_roles == 'Back Ofiice kelurahan')
                                    @foreach ($createdby as $c)
                                        <option value='{{ $c->role_id }}'>{{ $c->name_roles }}</option>
                                    @endforeach
                                    @foreach ($roleid as $idrole)
                                        <option value={{ $idrole->model_id }}>{{ $idrole->name }}</option>
                                        {{-- <option value="Teruskan">Large select</option> --}}
                                    @endforeach
                                    @foreach ($createdby as $idrole)
                                        <option value={{ $idrole->role_id }}>{{ $idrole->name_roles }}</option>
                                     @endforeach
                                @elseif ($item->name_roles == 'Back Ofiice Kota')
                                     @foreach ($createdby as $c)
                                         <option value='{{ $c->role_id }}'>{{ $c->name_roles }}</option>
                                     @endforeach
                                     @foreach ($roleid as $idrole)
                                         <option value={{ $idrole->role_id }}>{{ $idrole->name_roles }}</option>
                               @endforeach
                                @elseif ($item->name_roles == 'supervisor')
                                    @foreach ($roleid as $c)
                                        <option value='{{ $c->role_id }}'>{{ $c->name_roles}}</option>
                                    @endforeach
                                    @foreach ($createdby as $idrole)
                                        <option value={{ $idrole->role_id }}>{{ $idrole->name_roles }}</option>
                                    @endforeach'
                                @elseif ($item->name_roles == 'kepala bidang')
                                    @foreach ($roleid as $c)
                                        <option value='{{ $c->role_id }}'>{{ $c->name_roles}}</option>
                                    @endforeach
                                    @foreach ($createdby as $idrole)
                                        <option value={{ $idrole->role_id }}>{{ $idrole->name_roles }}</option>
                                    @endforeach
                                @else
                                    @foreach ($createdby as $c)
                                        <option value='{{ $c->role_id }}'>{{ $c->name_roles }}</option>
                                    @endforeach
                                    @foreach ($roleid as $idrole)
                                        <option value={{ $idrole->role_id }}>{{ $idrole->name }}</option>
                                    @endforeach
                                @endif
                            @endforeach
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
            </div>
            {{-- @include('pengaduans.fields') --}}
            <div class="card-footer">
                <a href="{{ route('pengaduans.index') }}" class="btn btn-default"> Batal </a>
                <button class="btn btn-primary" id="Teruskan" type="submit">simpan ke Teruskan</button>
                <button class="btn btn-primary" id="btn-submit" type="submit">kirim</button>
            </div>




            {!! Form::close() !!}

        </div>
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
            window.onload = function() {
                const yesRadio = document.querySelector('input[name="memiliki_nik"][value="1"]');
                const noRadio = document.querySelector('input[name="memiliki_nik"][value="0"]');
                const inputField = document.getElementById("id-input-nik");
                if (yesRadio.checked) {
                    inputField.readOnly = false;
                    $('#Teruskan').prop('disabled', true);
                    $('#btn-submit').prop('disabled', false);
                } else if (noRadio.checked) {
                    inputField.readOnly = true;
                    $('#btn-submit').prop('disabled', true);
                    $('#Teruskan').prop('disabled', false);
                }

            };
            // tambahkan event listener untuk semua radio button dengan nama "options"
            $('input[type=radio][name=memiliki_nik]').change(function() {
                // periksa nilai radio button yang dipilih
                if ($(this).val() == '0') {
                    // jika nilai radio button adalah 0, nonaktifkan tombol "Submit"
                    $('#btn-submit').prop('disabled', true);
                    $('#Teruskan').prop('disabled', false);
                    $('#id-input-nik').prop('disabled', true);
                    $("#id-input-nik").prop("value", "");
                } else {
                    // jika nilai radio button bukan 0, aktifkan tombol "Submit"
                    $('#Teruskan').prop('disabled', true);
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
