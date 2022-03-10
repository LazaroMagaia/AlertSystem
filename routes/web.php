<?php

use App\Http\Controllers\DomainController;
use App\Http\Controllers\DomainRoutes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",[DomainRoutes::class,"index"])->name("index");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post("/domain",[DomainController::class,"index"])->name("domain.index");

Route::prefix('admin')->middleware(["auth"])->group(function () {
    Route::get('/alert',[DomainRoutes::class,"alert_Index"])->name("alert.index");
    Route::post("/alert",[DomainController::class,"store"])->name("alert.store");
    Route::get("/alert/edit/{id}",[DomainRoutes::class,"alert_edit"])->name("alert.edit");
    Route::put("/alert/edit/{id}",[DomainController::class,"alert_update"])->name("alert.update");
    Route::get("/alert/show/{id}",[DomainRoutes::class,"alert_show"])->name("alert.show");
    Route::delete("/alert/delete/{id}",[DomainController::class,"destroy"])->name("alert.delete");
});
