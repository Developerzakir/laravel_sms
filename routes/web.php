<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\FeeAmountController;
use App\Http\Controllers\FeeCategoryController;
use App\Http\Controllers\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\StudentShiftController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\SchoolSubjectController;
use App\Http\Controllers\Backend\ProfileController;


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

      Route::controller(StudentYearController::class)->group(function () {         
        Route::get("/student/year/view", 'yearView')->name("student.year.view");
        Route::get("/student/year/add", 'yearAdd')->name("student.year.add");
        Route::post("/student/year/store", 'yearStore')->name("store.student.year");
        Route::get("/student/year/edit/{id}", 'yearEdit')->name("student.year.edit");
        Route::post("/student/year/update/{id}", 'yearUpdate')->name("update.student.year");
        Route::get("/student/year/delete/{id}", 'yearDestroy')->name("student.year.delete");
     });


       Route::controller(StudentGroupController::class)->group(function () {         
        Route::get("/student/group/view", 'groupView')->name("student.group.view");
        Route::get("/student/group/add", 'groupAdd')->name("student.group.add");
        Route::post("/student/group/store", 'groupStore')->name("store.student.group");
        Route::get("/student/group/edit/{id}", 'groupEdit')->name("student.group.edit");
        Route::post("/student/group/update/{id}", 'groupUpdate')->name("update.student.group");
        Route::get("/student/group/delete/{id}", 'groupDestroy')->name("student.group.delete");
      });

       Route::controller(StudentShiftController::class)->group(function () {         
        Route::get("/student/shift/view", 'shiftView')->name("student.shift.view");
        Route::get("/student/shift/add", 'shiftAdd')->name("student.shift.add");
        Route::post("/student/shift/store", 'shiftStore')->name("store.student.shift");
        Route::get("/student/shift/edit/{id}", 'shiftEdit')->name("student.shift.edit");
        Route::post("/student/shift/update/{id}", 'shiftUpdate')->name("update.student.shift");
        Route::get("/student/shift/delete/{id}", 'shiftDestroy')->name("student.shift.delete");
      });
      
       Route::controller(FeeCategoryController::class)->group(function () {         
        Route::get("/fee/category/view", 'index')->name("fee.category.view");
        Route::get("/fee/category/add", 'create')->name("fee.category.add");
        Route::post("/fee/category/store", 'store')->name("fee.category.store");
        Route::get("/fee/category/edit/{id}", 'edit')->name("fee.category.edit");
        Route::post("/fee/category/update/{id}", 'update')->name("fee.category.update");
        Route::get("/fee/category/delete/{id}", 'destroy')->name("fee.category.delete");
      });

       Route::controller(FeeAmountController::class)->group(function () {         
        Route::get("/fee/amount/view", 'index')->name("fee.amount.view");
        Route::get("/fee/amount/add", 'create')->name("fee.amount.add");
        Route::post("/fee/amount/store", 'store')->name("fee.amount.store");
        Route::get("/fee/amount/edit/{id}", 'edit')->name("fee.amount.edit");
        Route::post("/fee/amount/update/{id}", 'update')->name("fee.amount.update");
        Route::get('fee/amount/details/{id}', 'detailsFeeAmount')->name('fee.amount.details');
      });


       Route::controller(ExamTypeController::class)->group(function () {         
            Route::get('exam/type/view', 'ViewExamType')->name('exam.type.view');
            Route::get('exam/type/add', 'ExamTypeAdd')->name('exam.type.add');
            Route::post('exam/type/store',  'ExamTypeStore')->name('store.exam.type');
            Route::get('exam/type/edit/{id}',  'ExamTypeEdit')->name('exam.type.edit');
            Route::post('exam/type/update/{id}',  'ExamTypeUpdate')->name('update.exam.type');
            Route::get('exam/type/delete/{id}',  'ExamTypeDelete')->name('exam.type.delete');
      });

       Route::controller(SchoolSubjectController::class)->group(function () {         
            Route::get('school/subject/view','ViewSubject')->name('school.subject.view');
            Route::get('school/subject/add',  'SubjectAdd')->name('school.subject.add');
            Route::post('school/subject/store',  'SubjectStore')->name('store.school.subject');
            Route::get('school/subject/edit/{id}','SubjectEdit')->name('school.subject.edit');
            Route::post('school/subject/update/{id}',  'SubjectUpdate')->name('update.school.subject');
            Route::get('school/subject/delete/{id}', 'SubjectDelete')->name('school.subject.delete');
      });

       Route::controller(AssignSubjectController::class)->group(function () {         
           Route::get('assign/subject/view', 'ViewAssignSubject')->name('assign.subject.view');
           Route::get('assign/subject/add', 'AddAssignSubject')->name('assign.subject.add');
           Route::post('assign/subject/store',  'StoreAssignSubject')->name('store.assign.subject');
           Route::get('assign/subject/edit/{class_id}', 'EditAssignSubject')->name('assign.subject.edit');
           Route::post('assign/subject/update/{class_id}',  'UpdateAssignSubject')->name('update.assign.subject');
           Route::get('assign/subject/details/{class_id}',  'DetailsAssignSubject')->name('assign.subject.details');
      });
      
});



