<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="rekomendasi_biaya_perawatans-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>No Kk</th>
                <th>Nik</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rekomendasiBiayaPerawatans as $rekomendasiBiayaPerawatan)
                <tr>
                    <td>{{ $rekomendasiBiayaPerawatan->nama }}</td>
                    <td>{{ $rekomendasiBiayaPerawatan->no_kk }}</td>
                    <td>{{ $rekomendasiBiayaPerawatan->nik }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['rekomendasi_biaya_perawatans.destroy', $rekomendasiBiayaPerawatan->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rekomendasi_biaya_perawatans.show', [$rekomendasiBiayaPerawatan->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('rekomendasi_biaya_perawatans.edit', [$rekomendasiBiayaPerawatan->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $rekomendasiBiayaPerawatans])
        </div>
    </div>
</div>
