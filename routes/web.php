<?php

use App\Http\Controllers\Form1Controller;
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
    return Redirect::route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/admin/users', function () {
        return view('admin.users');
    })->name('admin-user');

    Route::get('/admin/work-orders', function () {
        return view('admin.work-orders');
    })->name('admin-wo');
    

    Route::get('/admin/pelanggaran', function () {
        return view('admin.pelanggaran');
    })->name('admin-pelanggaran');
    

    Route::get('/user/work-orders', function () {
        return view('user.work-orders');
    })->name('user-wo');

    Route::get('admin/form1/', [Form1Controller::class, 'index']);
    Route::get('admin/form2/', [Form2Controller::class, 'index']);
});
