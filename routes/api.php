<?php

use App\Http\Controllers\Bill\BillController;
use App\Http\Controllers\Bill\BillDrugController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Diagnosis\DiagnosisController;
use App\Http\Controllers\Discharge\DischargeController;
use App\Http\Controllers\Drug\DrugBillController;
use App\Http\Controllers\Drug\DrugController;
use App\Http\Controllers\Drug\DrugFormulationController;
use App\Http\Controllers\Formulation\FormulationController;
use App\Http\Controllers\Patient\PatientBillController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Patient\PatientDiagnosisController;
use App\Http\Controllers\Patient\PatientDischargeController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserPatientDiagnosisController;
use App\Http\Controllers\User\UserPatientDischargeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('users/current-user', [UserController::class, 'currentUser'])->name('current-user');
Route::resource('users', UserController::class, ['except' => ['create', 'edit']]);
Route::get('users/verify/{token}', [UserController::class, 'verify'])->name('verify');

Route::resource('users.patients.diagnoses', UserPatientDiagnosisController::class, ['only' => ['store', 'update']]);
Route::resource('users.patients.discharges', UserPatientDischargeController::class, ['only' => ['store', 'update']]);



// patients
Route::resource('patients', PatientController::class, ['except' => ['create', 'edit']]);
Route::resource('patients.diagnoses', PatientDiagnosisController::class, ['only' => ['index']]);
Route::resource('patients.discharges', PatientDischargeController::class, ['only' => ['index']]);
Route::resource('patients.bills', PatientBillController::class, ['only' => ['index', 'store']]);



Route::resource('drugs', DrugController::class, ['except' => ['create', 'edit']]);
Route::resource('drugs.formulations', DrugFormulationController::class, ['only' => ['index','update','destroy']]);
Route::resource('drugs.bills', DrugBillController::class, ['only' => ['index']]);



Route::resource('formulations', FormulationController::class, ['except' => ['create', 'edit', 'show']]);

Route::resource('discharges', DischargeController::class, ['only' => ['index', 'show', 'destroy']]);

Route::resource('diagnoses', DiagnosisController::class, ['only' => ['index', 'show', 'destroy']]);

Route::resource('categories', CategoryController::class, ['except' => ['create', 'edit']]);

Route::resource('bills', BillController::class, ['only' => ['index', 'show', 'destroy']]);
Route::resource('bills.drugs', BillDrugController::class, ['only' => ['index']]);
