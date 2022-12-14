<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CoAdmin\CoAdminController;
use App\Http\Controllers\RoleCheckerController;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function() {
    //RoleChecker
    Route::get('/dashboard', [RoleCheckerController::class, 'roleCheck']);

    //Admin Routes
    Route::group(['middleware' => ['role:Admin']], function () {

        Route::prefix('/admin')->group(function(){
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('/dogs', [AdminController::class, 'manageDogs'])->name('dogs.index');
            Route::get('/dogs/create', [AdminController::class, 'dogsCreate'])->name('dogs.create');
            Route::get('/dog/edit/{dog}', [AdminController::class, 'show'])->name('dog.edit');
            Route::get('user/create', [AdminController::class, 'createUsers'])->name('user.create');
            Route::get('/manage/users', [AdminController::class, 'manageUsers'])->name('users.index');
            Route::get('/user/edit/{user}', [AdminController::class, 'editUser'])->name('user.edit');
            Route::get('/profile', [AdminController::class, 'userProfile'])->name('user.profile');

        });
    });

    //CoAdmin Routes
    Route::group(['middleware' => ['role:CoAdmin']], function () {

        Route::prefix('co-admin')->group(function(){
            Route::get('/dashboard', [CoAdminController::class, 'dashboard'])->name('coAdminDashboard');
            Route::get('/dogs', [CoAdminController::class, 'manageDogs'])->name('coAdminDogs.index');
            Route::get('/dogs/create', [CoAdminController::class, 'dogsCreate'])->name('coAdminDogs.create');
            Route::get('/dog/edit/{dog}', [CoAdminController::class, 'show'])->name('coAdminDogs.edit');
            Route::get('/profile', [CoAdminController::class, 'coAdminUserProfile'])->name('co-admin-user.profile');
        });
    });

});

require __DIR__.'/auth.php';
