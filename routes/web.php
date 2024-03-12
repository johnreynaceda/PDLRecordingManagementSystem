<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    if (auth()->user()->user_type == 'superadmin') {
        return redirect()->route('superadmin.dashboard');
    } elseif (auth()->user()->user_type == 'admin') {
        return redirect()->route('admin.dashboard');
    } else {
        dd('record section');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

//superadmin Routes
Route::prefix('superadmin')->group(function () {
    Route::get('/dashboard', function () {
        return view('superadmin.index');
    })->name('superadmin.dashboard');
    Route::get('/accounts', function () {
        return view('superadmin.accounts');
    })->name('superadmin.accounts');
    Route::get('/jails', function () {
        return view('superadmin.jails');
    })->name('superadmin.jails');
    Route::get('/pdl-records', function () {
        return view('superadmin.pdl');
    })->name('superadmin.pdl');

    Route::get('/hearings', function () {
        return view('superadmin.hearings');
    })->name('superadmin.hearings');
    Route::get('/remands', function () {
        return view('superadmin.remands');
    })->name('superadmin.remands');
    Route::get('/releases', function () {
        return view('superadmin.releases');
    })->name('superadmin.releases');
    Route::get('/cases', function () {
        return view('superadmin.cases');
    })->name('superadmin.cases');
    Route::get('/regions', function () {
        return view('superadmin.regions');
    })->name('superadmin.regions');

});

//administator route
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('admin.dashboard');
    Route::get('/commits', function () {
        return view('admin.commits');
    })->name('admin.commits');
    Route::get('/commits/pdl/{id}', function () {
        return view('admin.commits.view');
    })->name('admin.commits.view');
    Route::get('/commits/add', function () {
        return view('admin.commits.add');
    })->name('admin.commits.add');
    Route::get('/hearings', function () {
        return view('admin.hearings');
    })->name('admin.hearings');
    Route::get('/remands', function () {
        return view('admin.remands');
    })->name('admin.remands');
    Route::get('/releases', function () {
        return view('admin.releases');
    })->name('admin.releases');

    Route::get('/report', function () {
        return view('admin.report');
    })->name('admin.report');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
