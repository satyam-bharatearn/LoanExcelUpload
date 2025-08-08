<?php

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

Route::get('/loan/template', function () {
    return Excel::download(new LoanTemplateExport, 'loan_template.xlsx');
})->name('loan.template');
Route::get('/loan/upload', [UploadController::class, 'showUploadForm'])->name('loan.upload');
Route::post('/loan/import', [UploadController::class, 'import'])->name('loan.import');

Route::get('/lenders', [UploadController::class, 'index'])->name('lenders.index');
Route::post('/lenders/store', [UploadController::class, 'storeLender'])->name('lenders.store');
Route::post('/mappings/store', [UploadController::class, 'storeMappings'])->name('mappings.store');

