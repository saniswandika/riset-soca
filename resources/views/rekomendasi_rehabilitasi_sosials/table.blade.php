<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="rekomendasi_rehabilitasi_sosials-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>No Kk</th>
                <th>Nik</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rekomendasiRehabilitasiSosials as $rekomendasiRehabilitasiSosial)
                <tr>
                    <td>{{ $rekomendasiRehabilitasiSosial->nama }}</td>
                    <td>{{ $rekomendasiRehabilitasiSosial->no_kk }}</td>
                    <td>{{ $rekomendasiRehabilitasiSosial->nik }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['rekomendasi_rehabilitasi_sosials.destroy', $rekomendasiRehabilitasiSosial->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rekomendasi_rehabilitasi_sosials.show', [$rekomendasiRehabilitasiSosial->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('rekomendasi_rehabilitasi_sosials.edit', [$rekomendasiRehabilitasiSosial->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $rekomendasiRehabilitasiSosials])
        </div>
    </div>
</div>
