<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';     public $timestamps = false;

    protected $fillable = ['user', 'pass', 'status'];

    public function getAuthPassword()
    {
        return $this->pass;
    }
}
