<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumentasiFoto extends Model
{
    protected $table = 'tb_diklat';
    protected $primaryKey = 'id_diklat';
    public $timestamps = false;

    protected $fillable = [
        'nama_diklat',
        'tgl_mulai',
        'tgl_selesai', 
        'foto'
    ];

    protected $dates = [
        'tgl_mulai',
        'tgl_selesai'
    ];
}