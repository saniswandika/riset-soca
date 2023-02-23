<!-- Nama Acara Field -->
<div class="col-sm-12">
    {!! Form::label('Nama_Acara', 'Nama Acara:') !!}
    <p>{{ $jadwal->Nama_Acara }}</p>
</div>

<!-- Jenis Acara Field -->
<div class="col-sm-12">
    {!! Form::label('jenis_acara', 'Jenis Acara:') !!}
    <p>{{ $jadwal->jenis_acara }}</p>
</div>

<!-- Tanggal Acara Field -->
<div class="col-sm-12">
    {!! Form::label('tanggal_acara', 'Tanggal Acara:') !!}
    <p>{{ $jadwal->tanggal_acara }}</p>
</div>

<!-- Lokasi Field -->
<div class="col-sm-12">
    {!! Form::label('lokasi', 'Lokasi:') !!}
    <p>{{ $jadwal->lokasi }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $jadwal->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $jadwal->updated_at }}</p>
</div>

