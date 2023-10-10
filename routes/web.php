<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdmnDashboard;
use App\Models\Role; // Adjust the namespace as needed
use Illuminate\Database\Eloquent\Model;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [AdmnDashboard::class,'dashboard'])->name('dashboard');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified','role:user'
])->group(function () {
    Route::get('/home', function () {
        return Inertia::render('Dashboard');
;    })->name('user.dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 'role:admin'
])->group(function () {
    Route::get('admin/dashboard', function () {
        
       return view('admin.dashboard');
     // return Inertia::render('Dashboard');
    })->name('admin.dashboard');
 
    Route::get('admin/dashboard/home',[AdmnDashboard::class,'Homeadmin'])->name('homeadmin');
});




