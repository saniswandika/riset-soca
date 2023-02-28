<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="rekomendasi_admin_kependudukans-table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>No Kk</th>
                <th>Nik</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rekomendasiAdminKependudukans as $rekomendasiAdminKependudukan)
                <tr>
                    <td>{{ $rekomendasiAdminKependudukan->nama }}</td>
                    <td>{{ $rekomendasiAdminKependudukan->no_kk }}</td>
                    <td>{{ $rekomendasiAdminKependudukan->nik }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['rekomendasi_admin_kependudukans.destroy', $rekomendasiAdminKependudukan->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rekomendasi_admin_kependudukans.show', [$rekomendasiAdminKependudukan->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('rekomendasi_admin_kependudukans.edit', [$rekomendasiAdminKependudukan->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $rekomendasiAdminKependudukans])
        </div>
    </div>
</div>
