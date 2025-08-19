<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Exports\LoanTemplateExport;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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
// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Redirect root to login
Route::redirect('/', '/login');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Dashboard route showing master UI
    Route::get('/dashboard', function () {
        return view('master');
    })->name('dashboard');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');

    // Permission
    Route::resource('permission', PermissionController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/change-password', [UserController::class, 'changePassword'])->name('users.change-password');

    Route::get('/loan/template', function () {
        return Excel::download(new LoanTemplateExport, 'loan_template.xlsx');
    })->name('loan.template');
    Route::get('/loan/upload', [UploadController::class, 'showUploadForm'])->name('loan.upload');
    Route::post('/loan/import', [UploadController::class, 'import'])->name('loan.import');

    Route::get('/lenders', [UploadController::class, 'index'])->name('lenders.index');
    Route::post('/lenders/store', [UploadController::class, 'storeLender'])->name('lenders.store');
    Route::post('/mappings/store', [UploadController::class, 'storeMappings'])->name('mappings.store');

    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/login');
    })->name('logout');
});
