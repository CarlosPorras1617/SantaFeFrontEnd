<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Clientes;
use App\Http\Livewire\PedimentosA1;
use App\Http\Livewire\PedimentosRt;
use App\Http\Livewire\ActualizarTramite;
use App\Http\Livewire\Tramites;
use App\Http\Livewire\Home;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', Home::class);

Route::get('/clientes', Clientes::class);
Route::get('/pedimentosA1', PedimentosA1::class);
Route::get('/pedimentosRt', PedimentosRt::class);
Route::get('/tramites', Tramites::class);
Route::get('/tramite/{id}', ActualizarTramite::class);
