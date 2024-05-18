<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function() {

   // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/registro_entradas', [App\Http\Controllers\EntradaController::class, 'index'])->name('entradas');
   
    Route::post('/registrar_asistencia',[App\Http\Controllers\EntradaController::class,'marcar_asistencia'])->name('registro_asistencia');
    
    Route::post('/registrar_cobro',[App\Http\Controllers\EntradaController::class,'registrar_cobro'])->name('registro_cobro');

    Route::get('/profile/view',['uses' => 'App\Http\Controllers\Profile\ProfileController@view','as' => 'profile.view']);

    Route::get('/profile/setting',['uses' => 'App\Http\Controllers\Profile\ProfileController@setting','as' => 'profile.setting']);
    
    Route::post('/profile/updateSetting',['uses' => 'App\Http\Controllers\Profile\ProfileController@updateSetting', 'as' => 'profile.updateSetting' ]);
    
    Route::get('/profile/password',['uses' => 'App\Http\Controllers\Profile\ProfileController@password', 'as' => 'profile.password' ]);

    Route::post('/profile/updatePassword',[ 'uses' => 'App\Http\Controllers\Profile\ProfileController@updatePassword', 'as' => 'profile.updatePassword' ]);
    

    Route::resources([
        'users' => App\Http\Controllers\UserController::class,
    ]);

});


