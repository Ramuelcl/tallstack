<?php

use App\Http\Controllers\cargaliveController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    //
    Route::get('/', 'PagesController@index')->name('pages.index');
    Route::get('/dashboard', 'PagesController@index')->name('pages.index');
    //
    Route::get('/about', 'PagesController@about')->name('pages.about');
    Route::get('/contact ', 'PagesController@contact')->name('pages.contact');
    Route::get('/welcome', 'PagesController@welcome')->name('pages.welcome');
    Route::get('/master', 'PagesController@master')->name('pages.master');

    Route::get('/linkstorage', function () {
        $targetFolder = base_path() . '/storage/app/public';
        $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
        dump($targetFolder, $linkFolder);
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/users', [cargaliveController::class, 'usersIndex'])->name('users.usersIndex');
    Route::get('/roles', [UserController::class, 'rolesIndex'])->name('users.rolesIndex');
    Route::get('/permissions', [UserController::class, 'permissionsIndex'])->name('users.permissionsIndex');
});
