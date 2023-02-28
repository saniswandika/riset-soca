<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="pengaduans-table">
            <thead>
            <tr>
                <th>No Pendaftaran</th>
                <th>Id Alur</th>
                <th>Id Provinsi</th>
                <th>Id Kabkot</th>
                <th>Id Kecamatan</th>
                <th>Id Kelurahan</th>
                <th>Jenis Pelapor</th>
                <th>Ada Nik</th>
                <th>Nik</th>
                <th>No Kk</th>
                <th>No Kis</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Alamat</th>
                <th>Telp</th>
                <th>Email</th>
                <th>Hubungan Terlapor</th>
                <th>File Penunjang</th>
                <th>Keluhan Tipe</th>
                <th>Keluhan Id Program</th>
                <th>Keluhan Detail</th>
                <th>Keluhan Foto</th>
                <th>Tl Catatan</th>
                <th>Tl File</th>
                <th>Createdby</th>
                <th>Updatedby</th>
                <th>Ada Dtks</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pengaduans as $pengaduan)
                <tr>
                    <td>{{ $pengaduan->no_pendaftaran }}</td>
                    <td>{{ $pengaduan->id_alur }}</td>
                    <td>{{ $pengaduan->id_provinsi }}</td>
                    <td>{{ $pengaduan->id_kabkot }}</td>
                    <td>{{ $pengaduan->id_kecamatan }}</td>
                    <td>{{ $pengaduan->id_kelurahan }}</td>
                    <td>{{ $pengaduan->jenis_pelapor }}</td>
                    <td>{{ $pengaduan->ada_nik }}</td>
                    <td>{{ $pengaduan->nik }}</td>
                    <td>{{ $pengaduan->no_kk }}</td>
                    <td>{{ $pengaduan->no_kis }}</td>
                    <td>{{ $pengaduan->nama }}</td>
                    <td>{{ $pengaduan->tgl_lahir }}</td>
                    <td>{{ $pengaduan->alamat }}</td>
                    <td>{{ $pengaduan->telp }}</td>
                    <td>{{ $pengaduan->email }}</td>
                    <td>{{ $pengaduan->hubungan_terlapor }}</td>
                    <td>{{ $pengaduan->file_penunjang }}</td>
                    <td>{{ $pengaduan->keluhan_tipe }}</td>
                    <td>{{ $pengaduan->keluhan_id_program }}</td>
                    <td>{{ $pengaduan->keluhan_detail }}</td>
                    <td>{{ $pengaduan->keluhan_foto }}</td>
                    <td>{{ $pengaduan->tl_catatan }}</td>
                    <td>{{ $pengaduan->tl_file }}</td>
                    <td>{{ $pengaduan->createdby }}</td>
                    <td>{{ $pengaduan->updatedby }}</td>
                    <td>{{ $pengaduan->ada_dtks }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['pengaduans.destroy', $pengaduan->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('pengaduans.show', [$pengaduan->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('pengaduans.edit', [$pengaduan->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $pengaduans])
        </div>
    </div>
</div>
