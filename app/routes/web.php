<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestRequestController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\DB;
use App\Models\User;









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
    return view('admin.index');
});


Route::get('/login', function() {
    return view('login');
})->name('login');

//Google

Route::get('login2', [GoogleController::class, 'loginWithGoogle'])->name('google_login');
Route::get('google/callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');

Route::get('dashboad', function() {
    $skills = DB::table('skills')->get();
    return view('admin.pages.home', compact('skills'));
})->name('login-success');

Route::get('logout', function() {
    Auth::logout();
    return redirect()->route('login');
});

Route::resource('/skill', SkillController::class);


Route::get('lkn-n', function() {
    $user = User::find(1);
    $user->skill()->attach(1);
});

Route::put('/update',[SkillController::class,'updateSkill']);

Route::resource('/user', UserController::class);
