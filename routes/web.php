<?php

use App\Mail\phpmail;
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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/jobs', [App\Http\Controllers\JobsController::class, 'index'])
->middleware('auth', 'verified')
->name('jobs');
Route::get('/jobs/create', [App\Http\Controllers\JobsController::class, 'create'])->name('jobsCreate');
Route::post('/jobs/post', [App\Http\Controllers\JobsController::class, 'store'])->name('jobsPost');
Route::get('/jobs/detail/{id}', [App\Http\Controllers\JobsController::class, 'show'])->name('jobsView');
Route::get('/jobs/edit/{id}', [App\Http\Controllers\JobsController::class, 'edit'])->name('jobsEdit');
Route::patch('/jobs/update/{id}', [App\Http\Controllers\JobsController::class, 'update'])->name('jobsUpdate');
Route::post('/jobs/delete/{id}', [App\Http\Controllers\JobsController::class, 'destroy'])->name('jobsDestroy');
