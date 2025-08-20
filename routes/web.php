<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\ProfitController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\ExamFeeController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\FeeAmountController;
use App\Http\Controllers\MarkSheetController;
use App\Http\Controllers\OtherCostController;
use App\Http\Controllers\MonthlyFeeController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\StudentRegController;
use App\Http\Controllers\AttenReportController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeRegController;
use App\Http\Controllers\FeeCategoryController;
use App\Http\Controllers\StudentRollController;
use App\Http\Controllers\StudentYearController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\ResultReportController;
use App\Http\Controllers\StudentClassController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\StudentShiftController;
use App\Http\Controllers\AccountSalaryController;
use App\Http\Controllers\AssignSubjectController;
use App\Http\Controllers\EmployeeLeaveController;
use App\Http\Controllers\MonthlySalaryController;
use App\Http\Controllers\SchoolSubjectController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\RegistrationFeeController;
use App\Http\Controllers\EmployeeAttendanceController;


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
      
       Route::controller(DesignationController::class)->group(function () {         
            Route::get('designation/view','ViewDesignation')->name('designation.view');
            Route::get('designation/add', 'DesignationAdd')->name('designation.add');
            Route::post('designation/store', 'DesignationStore')->name('store.designation');
            Route::get('designation/edit/{id}', 'DesignationEdit')->name('designation.edit');
            Route::post('designation/update/{id}', 'DesignationUpdate')->name('update.designation');
            Route::get('designation/delete/{id}', 'DesignationDelete')->name('designation.delete');
      });
});



/// Student Registration Routes  
Route::prefix('students')->group(function(){

    //Student Registration  routes
     Route::controller(StudentRegController::class)->group(function () {  
            Route::get('/reg/view','StudentRegView')->name('student.registration.view');
            Route::get('/reg/Add',  'StudentRegAdd')->name('student.registration.add');
            Route::post('/reg/store',  'StudentRegStore')->name('store.student.registration');
            Route::get('/year/class/wise',  'StudentClassYearWise')->name('student.year.class.wise');
            Route::get('/reg/edit/{student_id}', 'StudentRegEdit')->name('student.registration.edit');
            Route::post('/reg/update/{student_id}',  'StudentRegUpdate')->name('update.student.registration');
            Route::get('/reg/promotion/{student_id}', 'StudentRegPromotion')->name('student.registration.promotion');
            Route::post('/reg/update/promotion/{student_id}', 'StudentUpdatePromotion')->name('promotion.student.registration');
            Route::get('/reg/details/{student_id}', 'StudentRegDetails')->name('student.registration.details');
    });
    
    //Student role generate routes
     Route::controller(StudentRollController::class)->group(function () {  
        Route::get('/roll/generate/view', 'StudentRollView')->name('roll.generate.view');
        Route::get('/reg/getstudents', 'GetStudents')->name('student.registration.getstudents');
        Route::post('/roll/generate/store',  'StudentRollStore')->name('roll.generate.store');
    });


    //Student Registration fee routes
     Route::controller(RegistrationFeeController::class)->group(function () {  
         Route::get('/reg/fee/view', 'RegFeeView')->name('registration.fee.view');
         Route::get('/reg/fee/classwisedata',  'RegFeeClassData')->name('student.registration.fee.classwise.get');
         Route::get('/reg/fee/payslip', 'RegFeePayslip')->name('student.registration.fee.payslip');
    });

    //Student Registration fee routes
     Route::controller(MonthlyFeeController::class)->group(function () {  
        Route::get('/monthly/fee/view', 'MonthlyFeeView')->name('monthly.fee.view');
        Route::get('/monthly/fee/classwisedata', 'MonthlyFeeClassData')->name('student.monthly.fee.classwise.get');
        Route::get('/monthly/fee/payslip', 'MonthlyFeePayslip')->name('student.monthly.fee.payslip');
    });

    //Student Exam fee routes
     Route::controller(ExamFeeController::class)->group(function () {  
        Route::get('/exam/fee/view', 'ExamFeeView')->name('exam.fee.view');
        Route::get('/exam/fee/classwisedata', 'ExamFeeClassData')->name('student.exam.fee.classwise.get');
        Route::get('/exam/fee/payslip', 'ExamFeePayslip')->name('student.exam.fee.payslip');
    });
});



/// Employee Registration Routes
Route::prefix('employees')->group(function(){

    Route::controller(EmployeeRegController::class)->group(function () { 
        Route::get('reg/employee/view', 'EmployeeView')->name('employee.registration.view');
        Route::get('reg/employee/add', 'EmployeeAdd')->name('employee.registration.add');
        Route::post('reg/employee/store',  'EmployeeStore')->name('store.employee.registration');
        Route::get('reg/employee/edit/{id}',  'EmployeeEdit')->name('employee.registration.edit');
        Route::post('reg/employee/update/{id}',  'EmployeeUpdate')->name('update.employee.registration');
        Route::get('reg/employee/details/{id}',  'EmployeeDetails')->name('employee.registration.details'); 
    });


    // Employee Salary All Routes 
    Route::controller(EmployeeSalaryController::class)->group(function () {   
        Route::get('salary/employee/view', 'SalaryView')->name('employee.sallary.view');
        Route::get('salary/employee/increment/{id}',  'SalaryIncrement')->name('employee.salary.increment');
        Route::post('salary/employee/store/{id}', 'SalaryStore')->name('update.increment.store');
        Route::get('salary/employee/details/{id}', 'SalaryDetails')->name('employee.salary.details');
    });

     // Employee Leave All Routes 
    Route::controller(EmployeeLeaveController::class)->group(function () {   
        Route::get('leave/employee/view', 'LeaveView')->name('employee.leave.view');
        Route::get('leave/employee/add', 'LeaveAdd')->name('employee.leave.add');
        Route::post('leave/employee/store', 'LeaveStore')->name('store.employee.leave');
        Route::get('leave/employee/edit/{id}', 'LeaveEdit')->name('employee.leave.edit');
        Route::post('leave/employee/update/{id}','LeaveUpdate')->name('update.employee.leave');
        Route::get('leave/employee/delete/{id}', 'LeaveDelete')->name('employee.leave.delete');
    });

     // Employee Attendence All Routes 
    Route::controller(EmployeeAttendanceController::class)->group(function () {   
        Route::get('attendance/employee/view', 'AttendanceView')->name('employee.attendance.view');
        Route::get('attendance/employee/add', 'AttendanceAdd')->name('employee.attendance.add');
        Route::post('attendance/employee/store', 'AttendanceStore')->name('store.employee.attendance');
        Route::get('attendance/employee/edit/{date}', 'AttendanceEdit')->name('employee.attendance.edit');
        Route::get('attendance/employee/details/{date}', 'AttendanceDetails')->name('employee.attendance.details');
    });


     // Employee Attendence All Routes 
    Route::controller(MonthlySalaryController::class)->group(function () {   
        Route::get('monthly/salary/view','MonthlySalaryView')->name('employee.monthly.salary');
        Route::get('monthly/salary/get', 'MonthlySalaryGet')->name('employee.monthly.salary.get');
        Route::get('monthly/salary/payslip/{employee_id}','MonthlySalaryPayslip')->name('employee.monthly.salary.payslip');
    });

});


/// Marks Management Routes  
Route::prefix('employees')->group(function(){

    // mark entry All Routes 
    Route::controller(MarksController::class)->group(function () {   
        Route::get('marks/entry/add','MarksAdd')->name('marks.entry.add');
        Route::post('marks/entry/store','MarksStore')->name('marks.entry.store'); 
        Route::get('marks/entry/edit', 'MarksEdit')->name('marks.entry.edit'); 
        Route::get('marks/getstudents/edit',  'MarksEditGetStudents')->name('student.edit.getstudents');
        Route::post('marks/entry/update', 'MarksUpdate')->name('marks.entry.update');  
    });

    // mark entry All Routes 
    Route::controller(GradeController::class)->group(function () {   
       Route::get('marks/grade/view', 'MarksGradeView')->name('marks.entry.grade');
       Route::get('marks/grade/add', 'MarksGradeAdd')->name('marks.grade.add');
       Route::post('marks/grade/store', 'MarksGradeStore')->name('store.marks.grade');
       Route::get('marks/grade/edit/{id}','MarksGradeEdit')->name('marks.grade.edit');
       Route::post('marks/grade/update/{id}', 'MarksGradeUpdate')->name('update.marks.grade');
    });

});

Route::get('marks/getsubject', [DefaultController::class, 'GetSubject'])->name('marks.getsubject');

Route::get('student/marks/getstudents', [DefaultController::class, 'GetStudents'])->name('student.marks.getstudents');


/// Marks Management Routes  
Route::prefix('accounts')->group(function(){
      // student fee 
    Route::controller(StudentFeeController::class)->group(function () {   
     Route::get('student/fee/view', 'StudentFeeView')->name('student.fee.view');
     Route::get('student/fee/add', 'StudentFeeAdd')->name('student.fee.add');
     Route::get('student/fee/getstudent', 'StudentFeeGetStudent')->name('account.fee.getstudent'); 
     Route::post('student/fee/store', 'StudentFeeStore')->name('account.fee.store'); 
    });

    //employee salary route
    Route::controller(AccountSalaryController::class)->group(function () {   
       Route::get('account/salary/view', 'AccountSalaryView')->name('account.salary.view');
       Route::get('account/salary/add', 'AccountSalaryAdd')->name('account.salary.add');
       Route::get('account/salary/getemployee', 'AccountSalaryGetEmployee')->name('account.salary.getemployee');
       Route::post('account/salary/store','AccountSalaryStore')->name('account.salary.store');
    });

    //others cost route
    Route::controller(OtherCostController::class)->group(function () {     
        Route::get('other/cost/view', 'OtherCostView')->name('other.cost.view');
        Route::get('other/cost/add', 'OtherCostAdd')->name('other.cost.add');
        Route::post('other/cost/store', 'OtherCostStore')->name('store.other.cost');
        Route::get('other/cost/edit/{id}', 'OtherCostEdit')->name('edit.other.cost');
        Route::post('other/cost/update/{id}', 'OtherCostUpdate')->name('update.other.cost');
    });
});



/// Report Management All Routes  
Route::prefix('reports')->group(function(){

      Route::controller(ProfitController::class)->group(function () {     
       Route::get('monthly/profit/view', 'MonthlyProfitView')->name('monthly.profit.view');
       Route::get('monthly/profit/datewais', 'MonthlyProfitDatewais')->name('report.profit.datewais.get');
       Route::get('monthly/profit/pdf', 'MonthlyProfitPdf')->name('report.profit.pdf');
      });

      // MarkSheet Generate Routes 
        Route::get('marksheet/generate/view', [MarkSheetController::class, 'MarkSheetView'])->name('marksheet.generate.view');
        Route::get('marksheet/generate/get', [MarkSheetController::class, 'MarkSheetGet'])->name('report.marksheet.get');

        // Attendance Report Routes 
        Route::get('attendance/report/view', [AttenReportController::class, 'AttenReportView'])->name('attendance.report.view');
        Route::get('report/attendance/get', [AttenReportController::class, 'AttenReportGet'])->name('report.attendance.get');

        // Student Result Report Routes 
        Route::get('student/result/view', [ResultReportController::class, 'ResultView'])->name('student.result.view');
        Route::get('student/result/get', [ResultReportController::class, 'ResultGet'])->name('report.student.result.get');

        // Student ID Card Routes 
        Route::get('student/idcard/view', [ResultReportController::class, 'IdcardView'])->name('student.idcard.view');
        Route::get('student/idcard/get', [ResultReportController::class, 'IdcardGet'])->name('report.student.idcard.get');

});



