<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $fillable = ['nama_bagian'];
    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class);
    }

    public function targets()
    {
        return $this->hasMany(Target::class);
    }
}

