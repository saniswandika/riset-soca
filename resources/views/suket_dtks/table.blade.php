<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="suket-dtks-table">
            <thead>
            <tr>
                <th>Nama Suket</th>
                <th>No Suket</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($suketDtks as $suketDtks)
                <tr>
                    <td>{{ $suketDtks->nama_suket }}</td>
                    <td>{{ $suketDtks->no_suket }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['suketDtks.destroy', $suketDtks->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('suketDtks.show', [$suketDtks->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('suketDtks.edit', [$suketDtks->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $suketDtks])
        </div>
    </div>
</div>
