<?php

use App\Models\Bagian;
use Illuminate\Database\Eloquent\Relations\HasMany;

test('bagian model has correct fillable attributes', function () {
    $bagian = new Bagian();
    
    expect($bagian->getFillable())->toBe(['nama_bagian']);
});

test('bagian has many penerimaan', function () {
    $bagian = new Bagian();
    
    expect($bagian->penerimaan())->toBeInstanceOf(HasMany::class);
});

test('bagian has many targets', function () {
    $bagian = new Bagian();
    
    expect($bagian->targets())->toBeInstanceOf(HasMany::class);
});
