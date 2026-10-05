<?php

use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuoteController::class, 'index']);

Route::get('/produk/1', function () {
    return response()->json([
        'id' => 1,
        'nama' => 'Buku Kado Terbaik',
        'harga' => 89000,
        'stok' => 8,
        'ketersediaan' => true
    ]);
});
Route::get('/produk/2', function () {
    return response()->json([
        'id' => 2,
        'nama' => 'Buku 7 Dosa Besar Soeharto',
        'harga' => 149000,
        'stok' => 0,
        'ketersediaan' => false
    ]);
});
Route::get('/produk/3', function () {
    return response()->json([
        'id' => 3,
        'nama' => 'Buku Laut Bercerita',
        'harga' => 89000,
        'stok' => 8,
        'ketersediaan' => true
    ]);
});
Route::get('/produk/4', function () {
    return response()->json([
        'id' => 4,
        'nama' => 'Buku Rumah Kaca',
        'harga' => 149000,
        'stok' => 8,
        'ketersediaan' => false
    ]);
});
Route::get('/produk/5', function () {
    return response()->json([
        'id' => 5,
        'nama' => 'Buku Bumi Manusia',
        'harga' => 149000,
        'stok' => 8,
        'ketersediaan' => false
    ]);
});

Route::get('/produk', function () {
    return response()->json([
        [
            'id' => 1,
            'nama' => 'Buku Kado Terbaik',
            'harga' => 89000,
            'stok' => 8,
            'ketersediaan' => true
        ],
        [
            'id' => 2,
            'nama' => 'Buku 7 Dosa Besar Soeharto',
            'harga' => 149000,
            'stok' => 0,
            'ketersediaan' => false
        ],
        [
            'id' => 3,
            'nama' => 'Buku Laut Bercerita',
            'harga' => 89000,
            'stok' => 8,
            'ketersediaan' => true
        ],
        [
            'id' => 4,
            'nama' => 'Buku Rumah Kaca',
            'harga' => 149000,
            'stok' => 8,
            'ketersediaan' => false
        ],
        [
            'id' => 5,
            'nama' => 'Buku Bumi Manusia',
            'harga' => 149000,
            'stok' => 8,
            'ketersediaan' => false
        ]
    ]);
});

Route::get('/quotes', QuoteController::class . '@index');