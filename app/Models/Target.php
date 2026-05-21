<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $fillable = [
        'bagian_id',
        'tahun',
        'target_uang'
    ];

    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
}
