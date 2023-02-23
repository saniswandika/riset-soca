<!-- Nama Acara Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Nama_Acara', 'Nama Acara:') !!}
    {!! Form::text('Nama_Acara', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Jenis Acara Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_acara', 'Jenis Acara:') !!}
    {!! Form::text('jenis_acara', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Acara Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal_acara', 'Tanggal Acara:') !!}
    {!! Form::date('tanggal_acara', null, ['class' => 'form-control','id'=>'tanggal_acara']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#tanggal_acara').datepicker()
    </script>
@endpush

<!-- Lokasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lokasi', 'Lokasi:') !!}
    {!! Form::text('lokasi', null, ['class' => 'form-control']) !!}
</div>