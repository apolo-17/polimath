<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'authenticate']);

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('user', [UserController::class, 'getAuthenticatedUser']);

    /* Route::get('get-companies', [CompanyController::class, 'index'])->name('company.index');
    Route::post('store-company', [CompanyController::class, 'store'])->name('company.store');
    Route::get('get-company/{company}', [CompanyController::class, 'show'])->name('company.show'); */
    Route::resource('company', CompanyController::class)->except('update');
    Route::post('company-update/{company}', [CompanyController::class, 'update'])->name('company.update');
    //Route::delete('delete-company', [CompanyController::class, 'delete'])->name('company.delete');
    Route::resource('employee', EmployeeController::class);
});
