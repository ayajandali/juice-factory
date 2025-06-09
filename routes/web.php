<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperEmployeeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\DailyWorkStatusController;
use App\Http\Controllers\HrController;
use App\Http\Controllers\RegisteredEmployeeController;
use App\Http\Controllers\HrleaveRequestController;
use App\Http\Controllers\AccountantController;
use App\Http\Controllers\ExportInvoiceController;
use App\Http\Controllers\ImportInvoiceController;
use App\Http\Controllers\Managercontroller;
use App\Http\Controllers\RegisteredMachineController;
use App\Http\Controllers\ManagerDailyWorkStatus;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/juice', function () {
    return view('juice.home');
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dashboards/requests', [LeaveRequestController::class, 'index'])
        ->name('requests');

    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/employee/leave-request', [LeaveRequestController::class, 'store'])
            ->name('employee.leave-request');

});

Route::middleware(['auth', 'checkrole:super-employee'])->group(function() {
    Route::get('super-employee/dashboard', [SuperEmployeeController::class, 'index'])
        ->name('super-employee.dashboard');

    Route::get('/super-employee', [DailyWorkStatusController::class, 'index'])
        ->name('super-employee.index');

    Route::post('/super-employee', [DailyWorkStatusController::class, 'store'])
        ->name('super-employee.store');


});

Route::middleware(['auth', 'checkrole:Employee'])->group(function(){

    Route::get('/employee/dashboards' , [EmployeeController::class, 'index'])
         ->name('employee.dashboard');

});

Route::middleware(['auth'])->group(function() {
    Route::middleware(['auth', 'checkrole:Employee'])->group(function() {
        Route::get('/employee/dashboards' , [EmployeeController::class, 'index'])
            ->name('employee.dashboard');

        
    });

    Route::middleware(['auth', 'checkrole:Accountant'])->group(function() {
        Route::get('/accountant/dashboards', [AccountantController::class, 'index'])
            ->name('accountant.dashboard');

        Route::get('/accountant/export', [ExportInvoiceController::class, 'index'])
            ->name('accountant.export');

        Route::post('/accountant/export', [ExportInvoiceController::class, 'store'])
            ->name('accountant.export.store');

        Route::get('/accountant/import/salary', [ImportInvoiceController::class, 'indexSalary'])
            ->name('accountant.import.salary');

        Route::get('/accountant/import/rawMaterials', [ImportInvoiceController::class, 'indexRaw'])
            ->name('accountant.import.raw_materials');

        Route::post('/accountant/import/storeSalary', [ImportInvoiceController::class, 'storeSalary'])
            ->name('accountant.import.storeSalary');
            
        Route::post('/accountant/import/storeRaw', [ImportInvoiceController::class, 'storeRaw'])
            ->name('accountant.import.storeRaw');

        Route::get('/accountant/import/allInvoice', [ImportInvoiceController::class, 'show'])
            ->name('import.all.invoice');

        Route::get('/accountant/import/allInvoice/{id}/edit', [ImportInvoiceController::class, 'edit'])
            ->name('import.edit.invoice');

        Route::put('/accountant/import/allInvoice/{id}', [ImportInvoiceController::class, 'update'])
            ->name('import.update.invoice');

        Route::delete('/accountant/import/allInvoice/{id}', [ImportInvoiceController::class, 'destroy'])
            ->name('import.destroy.invoice');

        Route::get('/accountant/export/allInvoice', [ExportInvoiceController::class, 'show'])
            ->name('export.all.invoice');

        Route::get('/invoices/{invoice}/show/details', [ExportInvoiceController::class, 'Detail'])
            ->name('export.show.invoice');

        Route::get('/accountant/export/allInvoice/{id}/edit', [ExportInvoiceController::class, 'edit'])
            ->name('export.edit.invoice');
        
        Route::put('/accountant/export/allInvoice/{id}', [ExportInvoiceController::class, 'update'])
            ->name('export.update.invoice');
        
        Route::delete('/accountant/export/allInvoice/{id}', [ExportInvoiceController::class, 'destroy'])
            ->name('export.destroy.invoice');
    });


    ////////////////////////////////
    
    // HR Routes
    Route::middleware(['auth', 'checkrole:HR'])->group(function() {
        // عرض داش بورد ال hr
        Route::get('/hr/dashboard', [HrController::class, 'index'])
            ->name('hr.dashboard');
        
        // عرض جميع الموظفين الموجودين في المعمل
        Route::get('/hr/employees', [RegisteredEmployeeController::class, 'index'])
            ->name('hr.employees.index');
        
        // انشاء سجل موظف لموظف جديد
        Route::get('/hr/employees/create', [RegisteredEmployeeController::class, 'create'])
            ->name('hr.employees.create');
        
        // حفظ الموظف الجديد
        Route::post('/hr/employees/', [RegisteredEmployeeController::class, 'store'])
            ->name('hr.employees.store');
        
         //عرض فورم الموظف للتعديل
        Route::get('/hr/employees/{employee}/edit', [RegisteredEmployeeController::class, 'edit'])
            ->name('hr.employees.edit');
        
        //تعديل بيانات الموظف
        Route::put('/hr/employees/{employee}', [RegisteredEmployeeController::class, 'update'])
            ->name('hr.employees.update');
        
        // حذف الموظف
        Route::delete('/hr/employees/{employee}', [RegisteredEmployeeController::class, 'destroy'])
            ->name('hr.employees.destroy');
        
        // عرض طلبات الاجازة
        Route::get('/hr/leaverequest/all', [HrleaveRequestController::class, 'index'])
            ->name('hr.leaverequest.index');
        
        // الموافقة على طلب الاجازة
        Route::post('/hr/leave-requests/{id}/approve', [HRLeaveRequestController::class, 'approve'])
            ->name('hr.leaverequest.approve');
        
        // رفض طلب الاجازة
        Route::post('/hr/leaverequests/{id}/reject', [HRLeaveRequestController::class, 'reject'])
            ->name('hr.leaverequest.reject');


        Route::get('/hr/leaverequest/approved', [HrleaveRequestController::class, 'approvedRequests'])
            ->name('hr.leaverequest.approvedRequests');
        
        Route::get('/hr/leaverequest/rejected', [HrleaveRequestController::class, 'rejectedRequests'])
            ->name('hr.leaverequest.rejectedRequests');
    });


    ///////////////////////////

     // Manager Routes
     Route::middleware(['auth', 'checkrole:Manager'])->group(function() {
        //عرض داش بورد المدير 
        Route::get('/Manager/dashboard', [ManagerController::class, 'index'])
            ->name('manager.dashboard');

        // عرض جميع احوال المعمل اليومية 
        Route::get('/Manager/DailyWorkStatus', [ManagerDailyWorkStatus::class, 'index'])
            ->name('manager.dailyworkstatus.index');

        // عرض جميع الموظفين الموجودين في المعمل
        Route::get('/Manager/employees', [RegisteredEmployeeController::class, 'index'])
            ->name('manager.employees.index');


        
        // عرض جميع الالات في المعمل 
        Route::get('/Manager/machine', [RegisteredMachineController::class, 'index'])
        ->name('manager.machine.index');
        // اضافة الالة 
        Route::get('/manager/machine/create', [RegisteredMachineController::class, 'create'])
            ->name('manager.machine.create');
        
        // حفظ الالة 
        Route::post('/manager/machine/store', [RegisteredMachineController::class, 'store'])
            ->name('manager.machine.store');
        
        //عرض فورم التعديل  لالة ما 
        Route::get('/manager/machine/{machine}/edit', [RegisteredMachineController::class, 'edit'])
            ->name('manager.machine.edit');
        
        //حفظ بيانات التعديل للالة 
        Route::put('/manager/machine/{machine}', [RegisteredMachineController::class, 'update'])
            ->name('manager.machine.update');
        
        // حذف الالة 
        Route::delete('/manager/machine/{machine}', [RegisteredMachineController::class, 'destroy'])
            ->name('manager.machine.destroy');

        Route::post('/manager/machine/maintenance' , [RegisteredMachineController::class, 'maintenance'])
            ->name('manager.machine.maintenance');


         //عرض جميع المنتجات في المعمل    
          Route::get('/Manager/product', [ProductController::class, 'index'])
        ->name('manager.product.index');    
        //اضافة منتج 
        Route::get('/manager/product/create', [ProductController::class, 'create'])
            ->name('manager.product.create');
        
        //حفظ المنتج
        Route::post('/manager/product/', [ProductController::class, 'store'])
            ->name('manager.product.store');
        
        //عرض فورم تعديل منتج ما 
        Route::get('/manager/product/{product}/edit', [ProductController::class, 'edit'])
            ->name('manager.product.edit');
        
        //حفظ تعديل منتج ما 
        Route::put('/manager/product/{product}', [ProductController::class, 'update'])
            ->name('manager.product.update');
        
        // حذف المنتج 
        Route::delete('/manager/product/{product}', [ProductController::class, 'destroy'])
            ->name('manager.product.destroy');

        Route::get('/manager/product/available', [ProductController::class, 'available'])
            ->name('manager.product.available');

        Route::get('/manager/rawMaterials/available', [ProductController::class, 'rawMaterial'])
            ->name('manager.rawmaterials.available');
        
    });
});

require __DIR__.'/auth.php';

