<!-- Nama Suket Field -->
<div class="col-sm-12">
    {!! Form::label('nama_suket', 'Nama Suket:') !!}
    <p>{{ $suketDtks->nama_suket }}</p>
</div>

<!-- No Suket Field -->
<div class="col-sm-12">
    {!! Form::label('no_suket', 'No Suket:') !!}
    <p>{{ $suketDtks->no_suket }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $suketDtks->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $suketDtks->updated_at }}</p>
</div>

