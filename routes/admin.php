<?php

use App\Http\Controllers\Admin\ExaminationCenterController;
use App\Http\Controllers\Admin\RegistrationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAccessController;
use App\Http\Controllers\Admin\SettingController;

Route::middleware(['guest:admin'])->group(function () {

    Route::get('login', [AuthController::class, 'viewLogin'])
        ->name('admin.view.login');
    Route::post('login', [AuthController::class, 'handleLogin'])
        ->name('admin.handle.login');

    Route::get('/forgot-password', [AuthController::class, 'viewForgotPassword'])
        ->name('admin.view.forgot.password');
    Route::post('/forgot-password', [AuthController::class, 'handleForgotPassword'])
        ->name('admin.handle.forgot.password');

    Route::get('/reset-password/{token}', [AuthController::class, 'viewResetPassword'])
        ->name('admin.view.reset.password');
    Route::post('/reset-password/{token}', [AuthController::class, 'handleResetPassword'])
        ->name('admin.handle.reset.password');
});

Route::middleware(['auth:admin'])->group(function () {

    Route::post('logout', function () {
        Auth::logout();
        return redirect()->route('admin.view.login');
    })->name('admin.handle.logout');

    Route::get('dashboard', [DashboardController::class, 'viewDashboard'])
        ->name('admin.view.dashboard');

    Route::prefix('admin-access')->controller(AdminAccessController::class)->group(function () {
        Route::get('/', 'viewAdminAccessList')->name('admin.view.admin.access.list');
        Route::get('/create', 'viewAdminAccessCreate')->name('admin.view.admin.access.create');
        Route::get('/update/{id}', 'viewAdminAccessUpdate')->name('admin.view.admin.access.update');
        Route::post('/create', 'handleAdminAccessCreate')->name('admin.handle.admin.access.create');
        Route::post('/update/{id}', 'handleAdminAccessUpdate')->name('admin.handle.admin.access.update');
        Route::put('/status', 'handleToggleAdminAccessStatus')->name('admin.handle.admin.access.status');
        Route::get('/delete/{id}', 'handleAdminAccessDelete')->name('admin.handle.admin.access.delete');
    });

    Route::prefix('examination-center')->controller(ExaminationCenterController::class)->group(function () {
        Route::get('/', 'viewExaminationCenterList')->name('admin.view.examination.center.list');
        Route::get('/create', 'viewExaminationCenterCreate')->name('admin.view.examination.center.create');
        Route::get('/update/{id}', 'viewExaminationCenterUpdate')->name('admin.view.examination.center.update');
        Route::post('/create', 'handleExaminationCenterCreate')->name('admin.handle.examination.center.create');
        Route::post('/update/{id}', 'handleExaminationCenterUpdate')->name('admin.handle.examination.center.update');
        Route::get('/delete/{id}', 'handleExaminationCenterDelete')->name('admin.handle.examination.center.delete');
    });

    Route::prefix('registration')->controller(RegistrationController::class)->group(function () {
        Route::get('/', 'viewRegistrationList')->name('admin.view.registration.list');
        Route::get('/preview/{id}', 'viewRegistrationPreview')->name('admin.view.registration.preview');
        Route::get('/delete/{id}', 'handleRegistrationDelete')->name('admin.handle.registration.delete');
        Route::get('/download/excel', 'handleDownloadRegistrationExcel')->name('admin.handle.registration.excel.download');
        Route::get('/import', 'viewImport')->name('admin.view.registration.import');
        Route::post('/import', 'handleImportExcelData')->name('admin.handle.registration.import');
        Route::get('/test-code', 'handleTestCode')->name('admin.handle.registration.test.code');
        Route::get('/download-admit-card-zip/{center_id}', 'downloadAdmitCardCenterWise')->name('admin.handle.download.admit.card.zip');
        Route::get('/send-test-key', 'handleSendTestKey')->name('admin.handle.send.test.key');
        Route::get('/result/import', 'viewResultImport')->name('admin.view.result.import');
        Route::post('/result/import', 'handleImportResultExcel')->name('admin.handle.result.import');
        Route::get('/send-result', 'handleSendResult')->name('admin.handle.send.result');
    });

    Route::prefix('setting')->controller(SettingController::class)->group(function () {
        Route::get('/', 'viewSetting')->name('admin.view.setting');
        Route::get('/account-information', 'viewAccountSetting')->name('admin.view.setting.account');
        Route::post('/account-information', 'handleAccountSetting')->name('admin.handle.setting.account');
        Route::get('/update-password', 'viewPasswordSetting')->name('admin.view.setting.password');
        Route::post('/update-password', 'handlePasswordSetting')->name('admin.handle.setting.password');

        Route::get('/roles-permissions', 'viewRolePermission')->name('admin.view.setting.role.permission');
        Route::get('/role/create', 'viewRoleCreate')->name('admin.view.setting.role.create');
        Route::post('/role/create', 'handleRoleCreate')->name('admin.handle.setting.role.create');
        Route::get('/role/update/{id}', 'viewRoleUpdate')->name('admin.view.setting.role.update');
        Route::post('/role/update/{id}', 'handleRoleUpdate')->name('admin.handle.setting.role.update');
        Route::get('/role/remove/permission/{role_id}/{permission_id}', 'handleRemovePermission')->name('admin.view.setting.role.remove.permission');
    });

});
