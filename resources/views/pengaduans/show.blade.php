@extends('layouts.masterTemplate')

@section('title', 'Detail Pengaduan')

@section('content')
<?php
    use Carbon\Carbon;
    
    $birthdatestring = $pengaduan->tgl_lahir;
    $birthdatestring = substr($birthdatestring, 0, 10);
    $birthdate = Carbon::parse($birthdatestring);
    ?>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="card-header col-sm-6">
                        <h3>Detail Pengaduan</h3>
                      </div>
                      <div class="card-header col-sm-6">
                        <a class="btn btn-primary" style="float: right"
                           href="{{ route('pengaduans.index') }}">
                                                        @lang('Kembali')
                                                </a>
                    </div>
                    <div class="card-body">
                    @include('pengaduans.show_fields')
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary"
                           href="{{ route('pengaduans.index') }}">
                                                        @lang('kembali')
                                                </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
