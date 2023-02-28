<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rekomendasi_rekativasi_pbi_jk extends Model
{
    public $table = 'rekomendasi_rekativasi_pbi_jks';

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
