<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="rekomendasi_pengangkatan_anaks-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>No Kk</th>
                <th>Nik</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rekomendasiPengangkatanAnaks as $rekomendasiPengangkatanAnak)
                <tr>
                    <td>{{ $rekomendasiPengangkatanAnak->nama }}</td>
                    <td>{{ $rekomendasiPengangkatanAnak->no_kk }}</td>
                    <td>{{ $rekomendasiPengangkatanAnak->nik }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['rekomendasi_pengangkatan_anaks.destroy', $rekomendasiPengangkatanAnak->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rekomendasi_pengangkatan_anaks.show', [$rekomendasiPengangkatanAnak->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('rekomendasi_pengangkatan_anaks.edit', [$rekomendasiPengangkatanAnak->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $rekomendasiPengangkatanAnaks])
        </div>
    </div>
</div>
