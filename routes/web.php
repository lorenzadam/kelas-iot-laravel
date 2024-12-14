<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $name = request()->query('name', 'Tidak ada');
    echo $name;
    echo "<br />";
    if ($name === 'Asep') {
        echo "Welcome Asep";
    } else {
        echo "Welcome gatau namanya";
    }
});

Route::get('/test', function () {
    $data = ["Apel", "Pisang", "Mangga"];
    dd($data);
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::get('/devices', [DeviceController::class, 'index']);
Route::get('/devices/create', [DeviceController::class, 'create']);
Route::post('/devices/store', [DeviceController::class, 'store']);
Route::get('/devices/edit/{id}', [DeviceController::class, 'edit']);
Route::put('/devices/update/{id}', [DeviceController::class, 'update']);
Route::delete('/devices/delete/{id}', [DeviceController::class, 'delete']);
