<?php

use App\Models\Target;
use App\Models\Bagian;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

uses(TestCase::class);

test('target model has correct fillable attributes', function () {
    $target = new Target();
    
    expect($target->getFillable())->toBe([
        'bagian_id',
        'tahun',
        'target_uang'
    ]);
});

test('target belongs to bagian', function () {
    $target = new Target();
    
    expect($target->bagian())->toBeInstanceOf(BelongsTo::class);
});
