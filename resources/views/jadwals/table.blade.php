<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="jadwals-table">
            <thead>
            <tr>
                <th>Nama Acara</th>
                <th>Jenis Acara</th>
                <th>Tanggal Acara</th>
                <th>Lokasi</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jadwals as $jadwal)
                <tr>
                    <td>{{ $jadwal->Nama_Acara }}</td>
                    <td>{{ $jadwal->jenis_acara }}</td>
                    <td>{{ $jadwal->tanggal_acara }}</td>
                    <td>{{ $jadwal->lokasi }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['jadwals.destroy', $jadwal->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('jadwals.show', [$jadwal->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('jadwals.edit', [$jadwal->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $jadwals])
        </div>
    </div>
</div>
