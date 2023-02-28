<!-- Nama Field -->
<div class="col-sm-12">
    {!! Form::label('nama', 'Nama:') !!}
    <p>{{ $rekomendasiBiayaPerawatan->nama }}</p>
</div>

<!-- No Kk Field -->
<div class="col-sm-12">
    {!! Form::label('no_kk', 'No Kk:') !!}
    <p>{{ $rekomendasiBiayaPerawatan->no_kk }}</p>
</div>

<!-- Nik Field -->
<div class="col-sm-12">
    {!! Form::label('nik', 'Nik:') !!}
    <p>{{ $rekomendasiBiayaPerawatan->nik }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $rekomendasiBiayaPerawatan->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $rekomendasiBiayaPerawatan->updated_at }}</p>
</div>

