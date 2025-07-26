<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\StudentClassController;
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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get("admin/logout", [AdminController::class, "Logout"])->name("admin.logout");

// User managements all routes

Route::prefix('users')->group(function(){

    Route::controller(UserController::class)->group(function () {         
        Route::get("/view", 'userView')->name("user.view");
        Route::get("/add", 'userAdd')->name("users.add");
        Route::post("/store", 'userStore')->name("users.store");  
        Route::get('/edit/{id}', 'UserEdit')->name('users.edit');
        Route::post('/update/{id}',  'UserUpdate')->name('users.update');
        Route::get('/delete/{id}', 'UserDelete')->name('users.delete'); 
    });
      
});

Route::prefix('profile')->group(function(){

    Route::controller(ProfileController::class)->group(function () {         
        Route::get("/view", 'profileView')->name("profile.view");
        Route::get('/edit', 'ProfileEdit')->name('profile.edit');
        Route::post('/store', 'ProfileStore')->name('profile.store');
        Route::get('/password/view', 'PasswordView')->name('password.view');
        Route::post('/password/update', 'PasswordUpdate')->name('password.update');
       
    });
      
});


Route::prefix('setups')->group(function(){

    Route::controller(StudentClassController::class)->group(function () {         
        Route::get("/student/class/view", 'classView')->name("student.class.view");
        Route::get("/student/class/add", 'classAdd')->name("student.class.add");
        Route::post("/student/class/store", 'classStore')->name("store.student.class");
        Route::get("/student/class/edit/{id}", 'classEdit')->name("student.class.edit");
        Route::post("/student/class/update/{id}", 'classUpdate')->name("update.student.class");
        Route::get("/student/class/delete/{id}", 'classDestroy')->name("student.class.delete");
       
    });
      
});



