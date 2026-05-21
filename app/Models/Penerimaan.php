<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    protected $fillable = [
        'bagian_id',
        'jenis_input',
        'jumlah_uang',
        'tanggal',
        'keterangan'
    ];

    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
}
