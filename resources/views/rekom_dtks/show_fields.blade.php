<!-- Nama Rekom Field -->
<div class="col-sm-12">
    {!! Form::label('nama_Rekom', 'Nama Rekom:') !!}
    <p>{{ $rekomDtks->nama_Rekom }}</p>
</div>

<!-- Keterangan Field -->
<div class="col-sm-12">
    {!! Form::label('Keterangan', 'Keterangan:') !!}
    <p>{{ $rekomDtks->Keterangan }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $rekomDtks->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $rekomDtks->updated_at }}</p>
</div>

