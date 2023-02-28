<!-- Nama Suket Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_suket', 'Nama Suket:') !!}
    {!! Form::text('nama_suket', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- No Suket Field -->
<div class="form-group col-sm-6">
    {!! Form::label('no_suket', 'No Suket:') !!}
    {!! Form::number('no_suket', null, ['class' => 'form-control']) !!}
</div>