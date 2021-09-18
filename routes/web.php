<?php

use App\Http\Controllers\AdminControlls\AdminCurrentProjectsController;
use App\Http\Controllers\AdminControlls\AdminLoginController;
use App\Http\Controllers\AdminControlls\AdminProjectsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// Route::get('/', function () {
//     return view('masterDashboard');
// });
Route::get('/pages', function () {
    return view('pages.table');
});
Route::get('/profile', function () {
    return view('pages.profile');
});
// Route::get('/', function () {
//     return view('pages.login');
// });
Route::view('/', 'pages.login');

//route section to handle the logins of admin
Route::post('/', [AdminLoginController::class, 'login'])->name('admin.login');
Route::prefix('admin')->middleware('is_admin')->group(function () {
    Route::view('dashboard', 'masterDashboard')->name('admin.dashboard');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::resource('projects', AdminProjectsController::class);
    Route::resource('Currentprojects', AdminCurrentProjectsController::class);
});