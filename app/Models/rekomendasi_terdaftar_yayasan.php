<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rekomendasi_terdaftar_yayasan extends Model
{
    public $table = 'rekomendasi_terdaftar_yayasans';
    protected $fillable = [
        'id_alur',
        'no_pendaftaran',
        'id_provinsi',
        'id_kabkot',
        'id_kecamatan',
        'id_kelurahan',
        'jenis_pelapor',
        'ada_nik',
        'nik',
        'no_kk',
        'nama',
        'tgl_lahir',
        'telp',
        'alamat',
        'filektp',
        'filekk',
        'suket',
        'draftfrom',
        'catatan',
        'status_alur',
        'tujuan',
        'petugas',
        'createdby',
        'updatedby'

    ];
    protected $casts = [
        'id_alur'=> 'string',
        'no_pendaftaran'=> 'string',
        'id_provinsi'=> 'string',
        'id_kabkot'=> 'string',
        'id_kecamatan'=> 'string',
        'id_kelurahan'=> 'string',
        'jenis_pelapor'=> 'string',
        'ada_nik'=> 'string',
        'nik'=> 'string',
        'no_kk'=> 'string',
        'nama'=> 'string',
        'tgl_lahir'=> 'string',
        'telp'=> 'string',
        'alamat'=> 'string',
        'filektp'=> 'string',
        'filekk'=> 'string',
        'suket'=> 'string',
        'draftfrom'=> 'string',
        'catatan'=> 'string',
        'status_alur'=> 'string',
        'tujuan'=> 'string',
        'petugas'=> 'string',
        'createdby'=> 'string',
        'updatedby'=> 'string'
    ];

    public static array $rules = [
        'id_alur' => 'required',
        'no_pendaftaran' => 'required',
        'id_provinsi' => 'required',
        'id_kabkot' => 'required',
        'id_kecamatan' => 'required',
        'id_kelurahan' => 'required',
        'jenis_pelapor' => 'required',
        'ada_nik' => 'required',
        'nik' => 'required',
        'no_kk' => 'required',
        'nama' => 'required',
        'tgl_lahir' => 'required',
        'telp' => 'required',
        'alamat' => 'required',
        'filektp' => 'required',
        'filekk' => 'required',
        'suket' => 'required',
        'draftfrom' => 'required',
        'catatan' => 'required',
        'status_alur' => 'required',
        'tujuan' => 'required',
        'petugas' => 'required',
        'createdby' => 'required',
        'updatedby' => 'required'
    ];
}
