<?php

use App\Http\Controllers\BancaController;
use App\Http\Controllers\cargaliveController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    //
    Route::get('/', 'PagesController@index')->name('pages.index');
    //Route::get('/dashboard', 'PagesController@index')->name('pages.index');

    Route::get('/about', 'PagesController@about')->name('pages.about');
    Route::get('/contact', 'PagesController@contact')->name('pages.contact');
    // Route::get('/welcome', 'PagesController@welcome')->name('pages.welcome');
    // Route::get('/master', 'PagesController@master')->name('pages.master');
    // Route::get('/pruebas', 'PagesController@pruebas')->name('pages.pruebas');

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
Route::controller(BancaController::class)->group(function () {
    Route::get('banca', 'index')->name('banca.index');
    Route::get('banca-export', 'export')->name('banca.export');
    Route::post('banca-import', 'import')->name('banca.import');
    Route::get('banca-archivado', 'archivado')->name('banca.archivado');
    Route::get('banca-relacion_mov', 'relacion_mov')->name('banca.relacion_mov');
});
