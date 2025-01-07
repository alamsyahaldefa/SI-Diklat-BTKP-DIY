<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'pengumuman' => 'boolean',
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
        $diklatAktif = Diklat::where('status', 1)
            ->orderBy('id_diklat', 'desc')  // Changed from tgl_mulai to id_diklat
            ->paginate(10)
            ->withQueryString();  // Add this to preserve query parameters

        return view('diklat-aktif', compact('diklatAktif'));
    }

    public function getFotoUrlAttribute()
    {
        // Default image URL
        $defaultImage = 'https://storage.googleapis.com/a1aa/image/uVuHkkWH0yKVAxK6BeGXk2M21UMFgjDfUpPk5HNo3TSYtD6TA.jpg';

        if (empty($this->foto)) {
            // Return default image if no photo exists
            return $defaultImage;
        }

        // Check if the photo contains a timestamp (new format)
        if (strpos($this->foto, '_') !== false) {
            // Check if file exists in new location
            if (Storage::exists('public/foto_diklat/' . $this->foto)) {
                return Storage::url('foto_diklat/' . $this->foto);
            }
        }

        // Check if old format file exists
        if (Storage::exists('public/assets/img/diklat/' . $this->foto)) {
            return asset('storage/assets/img/diklat/' . $this->foto);
        }

        // If no photo is found, return default image
        return $defaultImage;
    }
}