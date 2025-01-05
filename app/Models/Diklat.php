<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    protected $table = 'tb_diklat';
    protected $primaryKey = 'id_diklat';

    public $timestamps = false;

    protected $attributes = [
        'status' => 1,
        'pengumuman' => 1,
        'quiz' => 0,
        'komunitas' => 0,
        'link' => '',
    ];

    protected $fillable = [
        'nama_diklat',
        'tgl_mulai',
        'tgl_selesai',
        'kuota',
        'syarat',
        'status',
        'surat',
        'pengumuman',
        'quiz',
        'foto',
        'komunitas',
        'link'
    ];

    protected $dates = [
        'tgl_mulai',
        'tgl_selesai'
    ];

    protected $casts = [
        'status' => 'boolean',
        'tgl_mulai' => 'date',
        'tgl_selesai' => 'date',
        'kuota' => 'integer'
    ];

    public function pesertaDiklat()
    {
        return $this->hasMany(PesertaDiklat::class, 'id_diklat', 'id_diklat');
    }

    public function pesertaLolos()
    {
        return $this->pesertaDiklat()->where('status', 'lolos');
    }

    public function pesertaMendaftar()
    {
        return $this->pesertaDiklat()->where('status', 'mendaftar');
    }

    public function scopeDibuka($query)
{
    return $query->where('status', 1);
}

}
