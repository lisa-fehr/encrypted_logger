<?php

use App\Http\Controllers\ConcernController;
use App\Http\Controllers\ConcernTagController;
use App\Http\Controllers\ObservationController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['verified', 'auth']);

Route::middleware(['verified', 'auth'])
    ->name('admin.tag.')
    ->prefix('admin/tags/')
    ->controller(TagController::class)
    ->group(function () {
        Route::get('{tag}', 'show')->name('show');
        Route::post('', 'store')->name('store');
        Route::patch('{tag}', 'update')->name('update');
        Route::delete('{tag}', 'delete')->name('delete');
    });
Route::middleware(['verified', 'auth'])
    ->name('admin.concern.tag.')
    ->prefix('admin/concerns/')
    ->controller(ConcernTagController::class)
    ->group(function () {
        Route::patch('tag', 'store')->name('store');
    });
Route::middleware(['verified', 'auth'])
    ->name('admin.concern.')
    ->prefix('admin/concerns/')
    ->controller(ConcernController::class)
    ->group(function () {
        Route::get('{concern}', 'show')->name('show');
        Route::post('', 'store')->name('store');
        Route::patch('{concern}', 'update')->name('update');
        Route::delete('{concern}', 'delete')->name('delete');
    });
Route::middleware(['verified', 'auth'])
    ->name('admin.concern.tag.')
    ->prefix('admin/concerns/{concern}/tag/{tag}')
    ->controller(ConcernTagController::class)
    ->group(function () {
        Route::patch('/', 'store')->name('associate');
        Route::delete('/', 'delete')->name('delete');
    });
Route::middleware(['verified', 'auth'])
    ->name('admin.observation.')
    ->prefix('admin/observations/')
    ->controller(ObservationController::class)
    ->group(function () {
        Route::get('{observation}', 'show')->name('show');
        Route::post('', 'store')->name('store');
        Route::patch('{observation}', 'update')->name('update');
        Route::delete('{observation}', 'delete')->name('delete');
    });
Route::middleware(['verified', 'auth'])
    ->name('admin.photos.')
    ->prefix('admin/photos/')
    ->controller(PhotoController::class)
    ->group(function () {
        Route::get('{photo}', 'show')->name('show');
    });
