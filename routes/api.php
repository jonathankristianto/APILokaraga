<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\roleController;
use App\Http\Controllers\userController;
use App\Http\Controllers\promoController;
use App\Http\Controllers\jadwalController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\pesananController;
use App\Http\Controllers\lapanganController;
use App\Http\Resources\jenisolahragaResource;
use App\Http\Controllers\jenismemberController;
use App\Http\Controllers\jenisolahragaController;
use App\Http\Controllers\authenticationController;
use App\Http\Resources\memberResource;

Route::post('/login', [authenticationController::class, 'login']);
Route::get('/logout', [authenticationController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/profile', [authenticationController::class, 'profile'])->middleware(['auth:sanctum']);

Route::get('/lapangan',[lapanganController::class, 'index'])->middleware(['auth:sanctum']); /*list semua data*/
Route::get('/lapangan/{id}',[lapanganController::class, 'show'])->middleware(['auth:sanctum']); /*detail data*/
Route::post('/Createlapangan', [lapanganController::class, 'store'])->middleware(['auth:sanctum']); /*simpan data*/
Route::put('/Updatelapangan/{id}', [lapanganController::class, 'update'])->middleware(['auth:sanctum', 'pemilik-lapangan']);
Route::delete('/Deletelapangan/{id}', [lapanganController::class, 'destroy'])->middleware(['auth:sanctum', 'pemilik-lapangan']);

Route::get('/pesanan',[pesananController::class, 'index']);
Route::get('/pesanan/{id}',[pesananController::class, 'show']);

Route::get('/role',[roleController::class, 'index']);
Route::get('/role/{id}',[roleController::class, 'show']);
Route::post('/Createrole', [roleController::class, 'store']);

Route::get('/user',[userController::class, 'index']);
Route::get('/user/{id}',[userController::class, 'show']);
Route::post('/Createuser', [userController::class, 'store']); 
Route::put('/Updateuser/{id}', [userController::class, 'update'])->middleware(['auth:sanctum', 'pemilik-user']);
Route::delete('/Deleteuser/{id}', [userController::class, 'destroy'])->middleware(['auth:sanctum', 'pemilik-user']);


Route::get('/member',[memberController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/member/{id}',[memberController::class, 'show'])->middleware(['auth:sanctum']);
Route::post('/Createmember', [memberController::class, 'store'])->middleware(['auth:sanctum']); 

Route::get('/jenisolahraga',[jenisolahragaController::class, 'index']);
Route::get('/jenisolahraga/{id}',[jenisolahragaController::class, 'show']);
Route::post('/Createjenisolahraga',[jenisolahragaController::class, 'store'])->middleware(['auth:sanctum']);

Route::get('/jenismember',[jenismemberController::class, 'index']);
Route::get('/jenismember/{id}',[jenismemberController::class, 'show']);
Route::post('/Createjenismember',[jenismemberController::class, 'store'])->middleware(['auth:sanctum']);
Route::put('/Updatejenismember/{id}', [jenismemberController::class, 'update'])->middleware(['auth:sanctum', 'pemilik-jenismember']);
Route::delete('/Deletejenismember/{id}', [jenismemberController::class, 'destroy'])->middleware(['auth:sanctum', 'pemilik-jenismember']);

Route::get('/jadwal',[jadwalController::class, 'index']);
Route::get('/jadwal/{id}',[jadwalController::class, 'show']);
Route::post('/Createjadwal',[jadwalController::class, 'store'])->middleware(['auth:sanctum']);