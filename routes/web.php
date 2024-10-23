<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/phpinfo', function () {
    return phpinfo();
})->name('phpinfo');

/* 
Route::get('/dashboard', function () {
    return view('manage-dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); 
*/

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['auth','verified']);  

/*
Route::get('/types', 'TypesController@index', function () {
    return view('manage-types');
})->name('types.index')->middleware(['auth', 'verified']);

//等同下面七条路由
Route::resource('types', 'TypesController');

//七条资源路由
Route::get('/types/{id}', 'TypesController@show')->name('types.show')->middleware(['auth', 'verified']); 
Route::get('/types/create', 'TypesController@create')->name('types.create')->middleware(['auth', 'verified']); 
Route::post('/types', 'TypesController@store')->name('types.store')->middleware(['auth', 'verified']); 
Route::get('/types/{id}/edit', 'TypesController@edit')->name('types.edit')->middleware(['auth', 'verified']); 
Route::patch('/types/{id}', 'TypesController@update')->name('types.update')->middleware(['auth', 'verified']); 
Route::delete('/types/{id}', 'TypesController@destroy')->name('types.destroy')->middleware(['auth', 'verified']);
*/

//文章管理
Route::get('/articles/softindex', [ArticlesController::class, 'softindex'])->name('articles.softindex')->middleware(['auth','verified']);  
Route::delete('/articles/{article}/softdelete', [ArticlesController::class, 'softDelete'])->name('articles.softdelete')->middleware(['auth','verified']);  
Route::delete('/articles/{article}/forcedelete', [ArticlesController::class, 'forceDelete'])->name('articles.forcedelete')->middleware(['auth','verified']);
Route::resource('articles', ArticlesController::class)->middleware(['auth','verified']);

//分类管理
Route::resource('types', TypesController::class)->middleware(['auth','verified']);
Route::prefix('types')->middleware(['auth', 'verified'])->group(function () {  
    //Route::get('/category/{category}', [TypesController::class, 'index'])->name('types.category.index');  
});




//个人资料
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
    Route::patch('/user/profile', [ProfileController::class, 'update'])->name('user.profile.update');
    Route::delete('/user/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');
    //个人头像
    Route::get('/user/avatar', [ProfileController::class, 'avatar'])->name('user.avatar.edit');
    Route::put('/user/avatar', [ProfileController::class, 'avatarUpdate'])->name('user.avatar.update');
    //登录日志
    Route::get('/user/loginlog', [LoginLogController::class, 'index'])->name('user.loginlog.index')->middleware(['auth', 'verified']); 
    Route::delete('/user/loginlog/{loginlog}', [LoginLogController::class, 'destroy'])->name('user.loginlog.destroy')->middleware(['auth', 'verified']);
});

require __DIR__.'/auth.php';