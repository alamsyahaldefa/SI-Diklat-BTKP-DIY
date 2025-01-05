<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaDiklat extends Model
{
    use HasFactory;

    protected $table = 'tb_peserta_diklat';

    protected $primaryKey = 'id_peserta';

    protected $fillable = [
        'nik',
        'status',
        'sertifikat',
        'id_diklat',
        'tgl'
    ];

    // Cast tipe data
    protected $casts = [
        'status' => 'boolean',
        'sertifikat' => 'boolean',
        'tgl' => 'datetime'
    ];

    // Relasi ke model Diklat
    public function diklat()
    {
        return $this->belongsTo(Diklat::class, 'id_diklat', 'id_diklat');
    }

}