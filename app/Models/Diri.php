<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diri extends Model
{
    protected $table = 'tb_diri';
    protected $primaryKey = 'id_diri';
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'identitas',
        'nip',
        'nuptk',
        'pangkat',
        'golongan',
        'telp',
        'email',
        'sekolah',
        'jabatan',
        'jenjang',
        'kab',  // Make sure this is included
        'batal'
    ];

    protected $dates = ['tgl_lahir'];
}