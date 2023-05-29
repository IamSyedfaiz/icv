<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/add-user', [HomeController::class, 'add_user'])->name('add.user');
Route::get('/all-user', [HomeController::class, 'all_user'])->name('all.user');
Route::post('/create-user', [UserController::class, 'create_user'])->name('create.user');

// consultant
Route::get('/add-consultant', [HomeController::class, 'add_consultant'])->name('add.consultant');
Route::get('/all-consultant', [HomeController::class, 'all_consultant'])->name('all.consultant');
Route::get('/view-draft-cert', [HomeController::class, 'view_draft_cert'])->name('view.draft.cert');
Route::get('/add-draft-cert/{id}', [HomeController::class, 'add_draft_cert'])->name('add.draft.cert');
Route::get('/edit-draft-cert/{id}', [HomeController::class, 'edit_draft_cert'])->name('edit.draft.cert');
Route::post('/add-draft-cert', [HomeController::class, 'store_draft_cert'])->name('store.draft.cert');
Route::post('/add-final-cert/{id}', [HomeController::class, 'store_final_cert'])->name('store.final.cert');
Route::get('/all-certs', [HomeController::class, 'all_certs'])->name('all.certs');
Route::get('/consultant/{id}', [HomeController::class, 'consultant'])->name('consultant');
Route::get('/report', [HomeController::class, 'report'])->name('report');
Route::post('/filter-report', [HomeController::class, 'filter_report'])->name('filter.report');

Route::post('/changeActive/{id}/{status}', [UserController::class, 'changeActive'])->name('change.active');
Route::post('/create-consultant', [UserController::class, 'create_consultant'])->name('create.consultant');
Route::get('/create-icv/{id}/{scopeSize}/{registeredSize}', [UserController::class, 'create_icv'])->name('create.icv');
Route::get('/create-ici/{id}/{scopeSize}/{registeredSize}', [UserController::class, 'create_ici'])->name('create.ici');
Route::get('/create-star/{id}/{scopeSize}/{registeredSize}', [UserController::class, 'create_star'])->name('create.star');
Route::get('/final-icv/{id}', [UserController::class, 'final_icv'])->name('final.icv');
Route::get('/final-ici/{id}', [UserController::class, 'final_ici'])->name('final.ici');
Route::get('/final-star/{id}', [UserController::class, 'final_star'])->name('final.star');
Route::post('/upload_document', [UserController::class, 'uploadDocument'])->name('upload.document');
Route::get('/delete_document/{id}', [UserController::class, 'deleteDocument'])->name('delete.document');
Route::post('/upload_payment', [UserController::class, 'uploadPayment'])->name('upload.payment');
Route::get('/consultant_payment', [UserController::class, 'consultantPayment'])->name('consultant.payment');




Route::get('/all_payment', [AdminController::class, 'allPayment'])->name('payment');
Route::post('/approved_payment/{id}', [AdminController::class, 'approvedPayment'])->name('approved.payment');
Route::post('/Rejected_payment/{id}', [AdminController::class, 'rejectedPayment'])->name('rejected.payment');
Route::get('/delete_certificate/{id}', [UserController::class, 'deleteCertificate'])->name('delete.certificate');


// document 
Route::get('/document', [AdminController::class, 'document'])->name('document');
Route::post('/approved_document/{id}', [AdminController::class, 'approved_document'])->name('approved.document');
Route::post('/rejected_document/{id}', [AdminController::class, 'rejected_document'])->name('rejected.document');


Route::post('/edit_certificate/{id}', [UserController::class, 'editCertificate'])->name('edit.certificate');
