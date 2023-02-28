<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rekomendasi_admin_kependudukan extends Model
{
    public $table = 'rekomendasi_admin_kependudukans';

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
