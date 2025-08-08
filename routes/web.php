<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Exports\LoanTemplateExport;
use App\Http\Controllers\UploadController;
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

Route::get('/', function () {
    return view('master');
});

Route::get('/roles',[RoleController::class,'index'])->name('roles.index');
Route::get('/roles/create',[RoleController::class,'create'])->name('roles.create');
Route::post('/roles',[RoleController::class,'store'])->name('roles.store');
Route::get('/roles/{id}', [RoleController::class, 'show'])->name('roles.show');

Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');

// Permission
// Route::resources('permissions',PermissionController::class);

Route::resource('permission',PermissionController::class);


Route::get('/loan/template', function () {
    return Excel::download(new LoanTemplateExport, 'loan_template.xlsx');
})->name('loan.template');
Route::get('/loan/upload', [UploadController::class, 'showUploadForm'])->name('loan.upload');
Route::post('/loan/import', [UploadController::class, 'import'])->name('loan.import');

Route::get('/lenders', [UploadController::class, 'index'])->name('lenders.index');
Route::post('/lenders/store', [UploadController::class, 'storeLender'])->name('lenders.store');
Route::post('/mappings/store', [UploadController::class, 'storeMappings'])->name('mappings.store');

