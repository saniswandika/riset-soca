<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $rekomendasiBantuanPendidikan->nama }}</p>
</div>

<!-- No Kk Field -->
<div class="col-sm-12">
    {!! Form::label('no_kk', 'No Kk:') !!}
    <p>{{ $rekomendasiBantuanPendidikan->no_kk }}</p>
</div>

<!-- Nik Field -->
<div class="col-sm-12">
    {!! Form::label('nik', 'Nik:') !!}
    <p>{{ $rekomendasiBantuanPendidikan->nik }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $rekomendasiBantuanPendidikan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $rekomendasiBantuanPendidikan->updated_at }}</p>
</div>

