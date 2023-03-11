<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserManageController;
use App\Http\Controllers\Admin\AffiliateManageController;



use App\Http\Controllers\Affiliate\Auth\AffiliateAuthenticatedSessionController;
use App\Http\Controllers\Affiliate\AffiliateController;
use App\Http\Controllers\Affiliate\SubAffiliateManageController;




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
    // dd('hello');
    return view('welcome');
});


Route::get('/search_program', function () {
    // dd('hello1');
    return view('welcome');
});

Route::get('/home', [FrontEndController::class, 'index'])->name('home');

Route::post('/promo_code_validate', [FrontEndController::class, 'validePromoCode'])->name('validate.promo');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');

Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/filter', [HomeController::class, 'filter'])->name('admin.search.filter');

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

    Route::post('/admin/filter_ajax', [HomeController::class, 'filterPost'])->name('admin.search.post');

    

});





/*
|--------------------------------------------------------------------------
| Normal User
|--------------------------------------------------------------------------
*/




Route::group(['middleware' => 'auth'], function() {

    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');

    Route::get('/user/search/list', [UserController::class, 'list'])->name('user.search_list');
    Route::get('/user/search', [UserController::class, 'create'])->name('user.search');
    Route::post('/user/search', [UserController::class, 'store']);
    

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
