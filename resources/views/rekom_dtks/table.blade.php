<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="rekom-dtks-table">
            <thead>
            <tr>
                <th>Nama Rekom</th>
                <th>Keterangan</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($rekomDtks as $rekomDtks)
                <tr>
                    <td>{{ $rekomDtks->nama_Rekom }}</td>
                    <td>{{ $rekomDtks->Keterangan }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['rekom-dtks.destroy', $rekomDtks->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('rekom-dtks.show', [$rekomDtks->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('rekom-dtks.edit', [$rekomDtks->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $rekomDtks])
        </div>
    </div>
</div>
