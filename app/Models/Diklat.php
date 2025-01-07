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

    // Relasi utama ke peserta diklat
    public function peserta()
    {
        return $this->hasMany(PesertaDiklat::class, 'id_diklat', 'id_diklat');
    }

    // Relasi untuk peserta yang lolos (status = 1)
    public function pesertaLolos()
    {
        return $this->hasMany(PesertaDiklat::class, 'id_diklat', 'id_diklat')
                    ->where('status', 1);
    }

    // Relasi untuk peserta yang mendaftar (status = 0)
    public function pesertaMendaftar()
    {
        return $this->hasMany(PesertaDiklat::class, 'id_diklat', 'id_diklat')
                    ->where('status', 0);
    }

    public function scopeDibuka($query)
    {
        return $query->where('status', 1);
    }

    public function diklatAktif()
    {
        // Ambil data diklat yang statusnya aktif (1) dan urutkan berdasarkan tanggal mulai
        $diklatAktif = Diklat::where('status', 1)
            ->orderBy('tgl_mulai', 'asc')
            ->paginate(10);

        return view('diklat-aktif', compact('diklatAktif'));
    }
}