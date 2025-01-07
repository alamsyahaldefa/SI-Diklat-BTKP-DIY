<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaDiklat extends Model
{
    protected $table = 'tb_peserta_diklat';
    protected $primaryKey = 'id_peserta';
    public $timestamps = false; // karena tidak ada kolom timestamps

    protected $fillable = [
        'nik',
        'status',
        'sertifikat',
        'id_diklat',
        'tgl'
    ];

    // Relasi ke data diri peserta
    public function user()
    {
        return $this->belongsTo(Diri::class, 'nik', 'nik');
    }

    // Relasi ke diklat
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat', 'id_diklat');
    }
}