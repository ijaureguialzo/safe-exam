<?php

use App\Http\Controllers\SafeExamController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Auth::routes();

    Route::get('/safe_exams/{safe_exam}/config_seb', [SafeExamController::class, 'config_seb'])
        ->name('safe_exams.config_seb');
    Route::get('/classroom/{classroom}', [SafeExamController::class, 'enter_seb'])
        ->name('safe_exams.enter_seb');
    Route::get('/safe_exams/exit_seb/{quit_password_hash}', [SafeExamController::class, 'exit_seb'])
        ->name('safe_exams.exit_seb');

    Route::middleware(['auth'])->group(function () {

        Route::get('/', function () {
            return redirect()->route('safe_exams.index');
        });

        Route::get('/safe_exams', [SafeExamController::class, 'index'])
            ->name('safe_exams.index');
        Route::post('/safe_exams/{safe_exam}/reset_token', [SafeExamController::class, 'reset_token'])
            ->name('safe_exams.reset_token');
        Route::post('/safe_exams/{safe_exam}/reset_quit_password', [SafeExamController::class, 'reset_quit_password'])
            ->name('safe_exams.reset_quit_password');
        Route::delete('/safe_exams/{safe_exam}/delete_token', [SafeExamController::class, 'delete_token'])
            ->name('safe_exams.delete_token');
        Route::delete('/safe_exams/{safe_exam}/delete_quit_password', [SafeExamController::class, 'delete_quit_password'])
            ->name('safe_exams.delete_quit_password');

        Route::get('/safe_exams/create', [SafeExamController::class, 'create'])
            ->name('safe_exams.create');
        Route::post('/safe_exams', [SafeExamController::class, 'store'])
            ->name('safe_exams.store');
        Route::get('/safe_exams/{safe_exam}/edit', [SafeExamController::class, 'edit'])
            ->name('safe_exams.edit');
        Route::put('/safe_exams/{safe_exam}', [SafeExamController::class, 'update'])
            ->name('safe_exams.update');
        Route::delete('/safe_exams/{safe_exam}', [SafeExamController::class, 'destroy'])
            ->name('safe_exams.destroy');

    });
});
