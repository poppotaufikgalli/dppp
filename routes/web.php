<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\DinasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MenuController;

use App\Http\Middleware\LogVisits;
use App\Http\Middleware\RoleCheck;

/*Route::get('/', function () {
    return view('test');
});*/

$tipe_hal = (new MainController)->getHal();
// unset($tipe_hal['kf']);
$key_hal = array_values($tipe_hal);

Route::get('/', [DinasController::class, 'view'])->name('main')->middleware(LogVisits::class);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::match(['get', 'post'],'/bukutamu', [DinasController::class, 'bukutamu'])->name('bukutamu')->middleware(LogVisits::class);

Route::get('/unauthorize', function(){
    return view('admin.unauthorize');
});

Route::group(['middleware' => ['auth']], function() use($tipe_hal) {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DinasController::class, 'dashboard'])->name('dashboard');
    Route::get('/profil', [DinasController::class, 'login'])->name('profil');

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user')->middleware(RoleCheck::class);
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store')->middleware(RoleCheck::class);
        Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update', [UserController::class, 'update'])->name('user.update')->middleware(RoleCheck::class);
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy')->middleware(RoleCheck::class);

        Route::post('/resetPassword', [UserController::class, 'resetPassword'])->name('user.reset.password');
    });

    Route::prefix('group')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('group')->middleware(RoleCheck::class);
        Route::get('/create', [GroupController::class, 'create'])->name('group.create');
        Route::post('/store', [GroupController::class, 'store'])->name('group.store')->middleware(RoleCheck::class);
        Route::get('/show/{id}', [GroupController::class, 'show'])->name('group.show');
        Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
        Route::post('/update', [GroupController::class, 'update'])->name('group.update')->middleware(RoleCheck::class);
        Route::delete('/destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy')->middleware(RoleCheck::class);
    });

    Route::prefix('menu')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('menu')->middleware(RoleCheck::class);
        Route::get('/create/{ref}', [MenuController::class, 'create'])->name('menu.create');
        Route::post('/store', [MenuController::class, 'store'])->name('menu.store')->middleware(RoleCheck::class);
        Route::get('/show/{id}', [MenuController::class, 'show'])->name('menu.show');
        Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
        Route::post('/update', [MenuController::class, 'update'])->name('menu.update')->middleware(RoleCheck::class);
        Route::delete('/destroy/{id}', [MenuController::class, 'destroy'])->name('menu.destroy')->middleware(RoleCheck::class);
    });

    foreach($tipe_hal as $key => $value){
        Route::prefix($key)->group(function () use($key) {
            Route::get('{publish}/', [KontenController::class, 'index'])->name($key)->whereIn('publish', ['A', 'Y', 'N'])->middleware(RoleCheck::class);
            Route::get('/create', [KontenController::class, 'create'])->name($key.'.create');
            Route::post('/store', [KontenController::class, 'store'])->name($key.'.store')->middleware(RoleCheck::class);
            Route::get('/show/{id}', [KontenController::class, 'show'])->name($key.'.show');
            Route::get('/edit/{id}', [KontenController::class, 'edit'])->name($key.'.edit');
            Route::post('/update', [KontenController::class, 'update'])->name($key.'.update')->middleware(RoleCheck::class);
            Route::delete('/destroy/{id}', [KontenController::class, 'destroy'])->name($key.'.destroy')->middleware(RoleCheck::class);

            Route::prefix('galeri/{id}')->group(function () use($key) {
                Route::get('/', [KontenController::class, 'galeri'])->name($key.'.galeri');    
                Route::post('/store', [KontenController::class, 'galeri_store'])->name($key.'.galeri.store');    
                //Route::delete('/destroy/{id}', [KontenController::class, 'galeri_destroy'])->name($key.'.galeri.destroy');    
            });

            Route::post('/publikasi/{id}', [KontenController::class, 'publikasi'])->name($key.'.publikasi')->middleware(RoleCheck::class);
        });
    }
});

Route::get('/{page}/{slug?}', [DinasController::class, 'page'])->name('page')->whereIn('page', $key_hal)->middleware(LogVisits::class);
