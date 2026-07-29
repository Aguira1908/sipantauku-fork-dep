<?php

use App\Models\Penerimaan;
use App\Models\Bagian;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

test('penerimaan model has correct fillable attributes', function () {
    $penerimaan = new Penerimaan();
    
    expect($penerimaan->getFillable())->toBe([
        'bagian_id',
        'jenis_input',
        'jumlah_uang',
        'tanggal',
        'keterangan'
    ]);
});

test('penerimaan belongs to bagian', function () {
    $penerimaan = new Penerimaan();
    
    expect($penerimaan->bagian())->toBeInstanceOf(BelongsTo::class);
});
