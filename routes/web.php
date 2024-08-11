<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CoursePayController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\RealEventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdvocateController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CashInHandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CreateAdminController;
use App\Http\Controllers\CustomerApproveController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerInvoiceController;
use App\Http\Controllers\CustomerTransactionController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\DomainHostingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HostingController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestorPayController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PadDesignController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PermissionAssignController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectCreateController;
use App\Http\Controllers\ProjectFeatureController;
use App\Http\Controllers\projectModuleController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubModuleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskUpdateController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;


Route::redirect('/', 'dashboard');
Route::match(['get', 'post'], '/register', [AdminAuthController::class, 'register'])->name('register');
Route::match(['get', 'post'], '/login', [AdminAuthController::class, 'login'])->name('login');
Route::match('get', '/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::match(['get', 'post'], '/my-profile/{id}', [AdminAuthController::class, 'myProfile'])->name('my.profile');
Route::match(['get', 'post'], '/change/password/{id}', [AdminAuthController::class, 'changePassword'])->name('change.password');

Route::group(['middleware' => ['adminAuth']], function () {
  Route::match(['get'], '/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

  //customer
  Route::resource('customer', CustomerController::class);
  //Product & Service
  Route::resource('service', ServiceController::class);
  //Traction
  Route::resource('transaction', TransactionController::class);
  //Invoice
  Route::resource('invoice', InvoiceController::class);
  //employee
  Route::resource('employee', EmployeeController::class);
  //task
  Route::resource('task', TaskController::class);
  //taskUpdate
  Route::resource('taskUdate', TaskUpdateController::class);
  //Project
  // Route::post('/createdCustomer', [ProjectController::class, 'index'])->name('customer.transaction');
  //transaction_customer
  Route::post('/createdCustomer', [CustomerTransactionController::class, 'index'])->name('customer.transaction');
  Route::post('/invoiceCustomer', [CustomerInvoiceController::class, 'invoiceCustomer'])->name('customer.invoice');
  //attendance
  Route::get('/attendance', [AttendanceController::class, 'Attendance'])->name('attendance');
  Route::post('/create/attendance', [AttendanceController::class, 'createAttendance'])->name('create.attendance');
  Route::get('/get/attendance', [AttendanceController::class, 'getAttendance'])->name('get.attendance');
  Route::get('/end/attendance/{id}', [AttendanceController::class, 'endAttendance'])->name('end.attendance');
  Route::post('/update/attendance/{id}', [AttendanceController::class, 'updateAttendance'])->name('update.attendance');
  Route::get('/unblockEmployee', [AttendanceController::class, 'unblockEmployee'])->name('unblockEmployee');
  Route::post('/unblockEmployee', [AttendanceController::class, 'unblockEmployeePost'])->name('unblockEmployeePost');
  Route::get('/delete/unblock{id}', [AttendanceController::class, 'deleteUnblock'])->name('delete.unblock');
  //invoicePdf
  Route::get('/invoicePdf/{id}', [PdfController::class, 'invoicePdf'])->name('invoicePdf');

  //employeePrint
  Route::get('/employeePrint/{id}', [PdfController::class, 'employeePrint'])->name('employeePrint');

  //Task_status
  Route::get('taskStatus/{id}', [TaskController::class, 'taskStatus'])->name('taskStatus');
  //Task_progress_status
  Route::get('taskProgressStatus/{id}', [TaskController::class, 'taskProgressStatus'])->name('taskProgressStatus');
  //maintenanece
  Route::get('maintenance/{id}', [TaskController::class, 'maintenance'])->name('maintenance');
  Route::get('ongoing/{id}', [CustomerController::class, 'ongoing'])->name('ongoing');

  //ajax
  Route::post('/getPrice', [AjaxController::class, 'getPrice']);

  //customerList for dashboard
  Route::get('/customerList', [CustomerController::class, 'customerList'])->name('customerList');
  Route::post('/customerDelete/{id}', [CustomerController::class, 'customerDelete'])->name('customerDelete');
  //customer Approve
  Route::get('/customerApprove', [CustomerApproveController::class, 'customerApprove'])->name('customer.approve');
  Route::get('/allCustomer', [CustomerController::class, 'allCustomerList'])->name('allCustomer.index');

  //receivable Amount for dashboard
  Route::get('/receivableCurrent', [DashboardController::class, 'receivableCurrent'])->name('receivableCurrent');
  //CurrentIncome for dashboard
  Route::get('/currentIncomeList', [DashboardController::class, 'currentIncomeList'])->name('currentIncomeList');
  //totalIncome for dashboard
  Route::get('/totalIncomeList', [DashboardController::class, 'totalIncomeList'])->name('totalIncomeList');
  //activeProjectList for dashboard
  Route::get('/activeProjectList', [DashboardController::class, 'activeProjectList'])->name('activeProjectList');
  //inactiveProjectList for dashboard
  Route::get('/inactiveProjectList', [DashboardController::class, 'inactiveProjectList'])->name('inactiveProjectList');
  //completedProjectList for dashboard
  Route::get('/completedProjectList', [DashboardController::class, 'completedProjectList'])->name('completedProjectList');
  //maintenanceList
  Route::get('/maintenanceList', [DashboardController::class, 'maintenanceList'])->name('maintenanceList');
  // //investor_pay
  Route::match(['get', 'post'], '/investor_pay', [InvestorPayController::class, 'investor_pay'])->name('investor_pay');

  Route::match(['get'], '/payment/list', [InvestorPayController::class, 'paymentList'])->name('payment.list');

  Route::match(['get'], '/investorPay_delete/{id}', [InvestorPayController::class, 'investorPayDelete'])->name('investorPay_delete');
  //maintenance_get
  Route::match(['get', 'post'], '/maintenance_get', [MaintenanceController::class, 'maintenance_get'])->name('maintenance_get');
  //maintenance_list
  Route::match(['get'], '/maintenance_list', [MaintenanceController::class, 'maintenance_list'])->name('maintenance_list');
  Route::match(['get'], '/maintenance_invoice/{id}', [MaintenanceController::class, 'maintenance_invoice'])->name('maintenance_invoice');
  Route::post('/mantenaceDelete/{id}', [MaintenanceController::class, 'mantenaceDelete'])->name('mantenaceDelete');
  Route::match(['get', 'post'], '/maintenancePay', [MaintenanceController::class, 'maintenancePay'])->name('maintenancePay');
  //maintenanceDue
  Route::match(['get'], '/maintenanceDue', [MaintenanceController::class, 'maintenanceDue'])->name('maintenanceDue');
  //maintenancePaid
  Route::match(['get'], '/maintenancePaid', [MaintenanceController::class, 'maintenancePaid'])->name('maintenancePaid');
  Route::match(['get'], '/maintenanceReciept/{id}', [MaintenanceController::class, 'maintenanceReciept'])->name('maintenance.reciept');

  //estimate.create
  Route::match(['get', 'post'], '/estimate/create', [EstimateController::class, 'estimate_create'])->name('estimate.create');
  Route::match(['get'], '/estimate/list', [EstimateController::class, 'estimateList'])->name('estimateList');
  Route::match(['post'], '/estimateDestroy/{id}', [EstimateController::class, 'estimateDestroy'])->name('estimateDestroy');
  Route::match(['get'], '/estimateView/{id}', [EstimateController::class, 'estimateView'])->name('estimateView');
  Route::match(['get'], '/estimatePdf/{id}', [PdfController::class, 'estimatePdf'])->name('estimatePdf');


  //purchase order.create
  Route::match(['get', 'post'], '/purchaseOrder/create', [PurchaseOrderController::class, 'purchaseOrder_create'])->name('purchaseOrder.create');
  Route::match(['get'], '/purchaseOrder/list', [PurchaseOrderController::class, 'purchaseOrderList'])->name('purchaseOrderList');
  Route::match(['post'], '/purchaseOrderDestroy/{id}', [PurchaseOrderController::class, 'purchaseOrdereDestroy'])->name('purchaseOrderDestroy');
  Route::match(['get'], '/purchaseOrderView/{id}', [PurchaseOrderController::class, 'purchaseOrderView'])->name('purchaseOrderView');
  Route::match(['get'], '/purchaseOrderPdf/{id}', [PdfController::class, 'purchaseOrderPdf'])->name('purchaseOrderPdf');

  // //Task
  Route::match(['get'], '/getName', [AjaxController::class, 'getName'])->name('getName');
  Route::match(['get'], '/getMaintenanceAmount', [AjaxController::class, 'getMaintenanceAmount'])->name('getMaintenanceAmount');

  Route::post('/get-Amount', [AjaxController::class, 'getAmount'])->name('getAmount');

  // //investorPay_print
  Route::match(['get'], '/investorPay_print/{id}', [PdfController::class, 'investorPay_print'])->name('investorPay_print');

  // //bookingInvoice
  Route::match(['get'], '/bookingInvoice/{id}', [PdfController::class, 'bookingInvoice'])->name('bookingInvoice');
  //investorPay_View
  Route::match(['get'], '/investorPay_View/{id}', [InvestorPayController::class, 'investorPay_View'])->name('investorPay_View');
  //category.index
  Route::match(['get', 'post'], '/category/list', [CategoryController::class, 'category_index'])->name('category.index');
  Route::match(['post'], '/category/delete/{id}', [CategoryController::class, 'category_delete'])->name('category_delete');
  Route::match(['get'], '/expense/list', [ExpenseController::class, 'expenselist'])->name('expenselist');
  Route::match(['get'], '/expensePost/list', [ExpenseController::class, 'expensePost'])->name('expensePost');
  Route::match(['get', 'post'], '/expense/create', [ExpenseController::class, 'expenseCreate'])->name('expenseCreate');
  Route::match(['get', 'post'], '/expense/edit/{id}', [ExpenseController::class, 'expenseEdit'])->name('expense.edit');

  Route::match(['post'], '/expense/delete/{id}', [ExpenseController::class, 'expenseDestroy'])->name('expenseDestroy');
  //application.index
  Route::match(['get'], '/application/index', [ApplicationController::class, 'application_index'])->name('application.index');
  Route::match(['get', 'post'], '/application/create', [ApplicationController::class, 'application_create'])->name('application.create');
  Route::match(['get'], '/application/show/{id}', [ApplicationController::class, 'application_show'])->name('application_show');
  Route::match(['post'], '/applicationDestroy/{id}', [ApplicationController::class, 'applicationDestroy'])->name('applicationDestroy');
  Route::match(['get'], '/approveList', [ApplicationController::class, 'approveList'])->name('approveList');
  Route::get('applicationStatus/{id}', [ApplicationController::class, 'applicationStatus'])->name('applicationStatus');


  // Role Management
  Route::get('/module', [ModuleController::class, 'module'])->name('module');
  Route::get('/add-module', [ModuleController::class, 'addModule'])->name('add.module');
  Route::post('/store-module', [ModuleController::class, 'storeModule'])->name('store.module');
  Route::get('/edit-module/{id}', [ModuleController::class, 'editModule'])->name('edit.module');
  Route::post('/update-module', [ModuleController::class, 'updateModule'])->name('update.module');
  Route::get('/delete-module/{id}', [ModuleController::class, 'deleteModule'])->name('delete.module');
  // sub Module route
  Route::get('/subModule', [SubModuleController::class, 'subModule'])->name('subModule');
  Route::get('/add-subModule', [SubModuleController::class, 'addSubModule'])->name('add.subModule');
  Route::post('/store-subModule', [SubModuleController::class, 'storeSubModule'])->name('store.subModule');
  Route::get('/edit-subModule/{id}', [SubModuleController::class, 'editSubModule'])->name('edit.subModule');
  Route::post('/update-subModule', [SubModuleController::class, 'updateSubModule'])->name('update.subModule');
  Route::get('/delete-subModule/{id}', [SubModuleController::class, 'deleteSubModule'])->name('delete.subModule');
  Route::get('/role', [RoleController::class, 'role'])->name('role');
  Route::get('/add-role', [RoleController::class, 'addRole'])->name('add.role');
  Route::post('/store-role', [RoleController::class, 'storeRole'])->name('store.role');
  Route::get('/edit-role/{id}', [RoleController::class, 'editRole'])->name('edit.role');
  Route::post('/update-role', [RoleController::class, 'updateRole'])->name('update.role');
  Route::get('/delete-role/{id}', [RoleController::class, 'deleteRole'])->name('delete.role');

  //creating admin
  Route::get('/admin-list', [CreateAdminController::class, 'adminList'])->name('adminList');
  Route::post('/admin-list', [CreateAdminController::class, 'list'])->name('list');

  Route::get('/create-admin', [CreateAdminController::class, 'createAdmin'])->name('create-admin');
  Route::post('/create-admin', [CreateAdminController::class, 'adminCreate'])->name('adminCreate');

  Route::get('/edit-admin/{id}', [CreateAdminController::class, 'showEditAdmin'])->name('showEditAdmin');
  Route::post('/edit-admin/{id}', [CreateAdminController::class, 'editAdmin'])->name('editAdmin');

  Route::get('/delete-admin/{id}', [CreateAdminController::class, 'deleteAdmin'])->name('deleteAdmin');

  // Permission Route
  Route::get('/permission', [RolePermissionController::class, 'permission'])->name('permission');
  Route::get('/add-permission', [RolePermissionController::class, 'addPermission'])->name('add-permission');
  Route::post('/store-permission', [RolePermissionController::class, 'storePermission'])->name('store.permission');
  Route::get('/edit-permission/{id}', [RolePermissionController::class, 'editPermission'])->name('edit.permission');
  Route::post('/update-permission', [RolePermissionController::class, 'updatePermission'])->name('update.permission');
  Route::get('/delete-permission/{id}', [RolePermissionController::class, 'deletePermission'])->name('delete.permission');

  //access-control
  Route::get('/access-control', [PermissionAssignController::class, 'showAccessControl'])->name('access-control');
  Route::post('/access-control', [PermissionAssignController::class, 'accessControl'])->name('accessControl');
  Route::get('/add-assign-permission', [PermissionAssignController::class, 'addAssignPermission'])->name('add-assign-permission');
  Route::get('/edit-assign-permission/{id}', [PermissionAssignController::class, 'showEditAssignPermission'])->name('showEdit-assign-permission');
  Route::post('/edit-assign-permission', [PermissionAssignController::class, 'editAssignPermission'])->name('edit-assign-permission');
  Route::get('/delete-assign-permission/{id}', [PermissionAssignController::class, 'deleteAssignPermission'])->name('delete-assign-permission');
  Route::post('/get-permission', [AjaxController::class, 'getPermission'])->name('get-permission');
  Route::get('/getDue', [AjaxController::class, 'getDue'])->name('get-due');
  // ajax
  Route::post('/cashInHand', [CashInHandController::class, 'cashHand'])->name('cashInHand');
  //notice route
  Route::resource('notice', NoticeController::class);
  Route::resource('domain', DomainController::class);
  Route::resource('hosting', HostingController::class);
  Route::resource('domainHosting', DomainHostingController::class);
  Route::match(['get', 'post'], '/salary', [SalaryController::class, 'salary'])->name('salary');
  Route::match(['get'], '/salaryUpdate/{id}', [SalaryController::class, 'salaryUpdate'])->name('salaryUpdate');
  Route::get('salarySheet', [SalaryController::class, 'salarySheet'])->name('salarySheet');
  Route::get('employeeSalary', [SalaryController::class, 'employeeSalary'])->name('employeeSalary');
  /*============================
      Start Project Management Route
      ===========================*/
  Route::prefix('padDesign')->controller(PadDesignController::class)->group(function () {
    Route::get('/', 'padDesign')->name('pad.design');
    Route::get('/create', 'createPad')->name('create.pad');
    Route::post('/store', 'storePad')->name('store.pad');
    Route::get('/pdf/{id}', 'padPdf')->name('pad.pdf');
    Route::get('/edit/{id}', 'padDesignEdit')->name('padDesign.edit');
    Route::get('/delete/{id}', 'padDesignDelete')->name('padDesign.delete');
    Route::post('/update/pad/{id}', 'padDesignUpdate')->name('update.pad');

  });
  //   End Project Management Route

  /*===========Project Module Route==========*/
  Route::resource('projectModule',projectModuleController::class);
  /*======Project  Route=========*/
  Route::resource('projectCreate',ProjectCreateController::class);
  /*======Project Managerment  Route=========*/
  Route::resource('project',ProjectController::class);
  Route::get('getModule',[AjaxController::class,'getModule'])->name('getModule');
  Route::get('getFeatures',[AjaxController::class,'getFeatures'])->name('getFeatures');
  //projectDetasils
  Route::get('projectDetails/{id}', [ProjectFeatureController::class, 'projectDetails'])->name('projectDetails');
  Route::post('projectDetails/store/{id}', [ProjectFeatureController::class, 'storeProjectDetails'])->name('projectDetails.store');
  Route::get('showProjectDetails/{id}', [ProjectFeatureController::class, 'showProjectDetails'])->name('showProjectDetails');
});
