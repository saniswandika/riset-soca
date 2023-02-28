<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rekomendasi_terdaftar_dtks extends Model
{
    public $table = 'rekomendasi_terdaftar_dtks';

    public $fillable = [
        'nama',
        'no_kk',
        'nik'
    ];

    protected $casts = [
        'nama' => 'string',
        'no_kk' => 'integer',
        'nik' => 'integer'
    ];

    public static array $rules = [
        'nama' => 'required',
        'no_kk' => 'required',
        'nik' => 'required'
    ];

    
}
