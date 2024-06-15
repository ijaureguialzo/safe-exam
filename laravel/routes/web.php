<?php

use App\Http\Controllers\AllowedAppController;
use App\Http\Controllers\AllowedUrlController;
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
    Auth::routes([
        'reset' => config('auth.password_reset_enabled'),
        'verify' => config('auth.email_verification_enabled') ? 'yes' : 'no',
    ]);

    Auth::routes(['reset' => config('safe_exam.password_reset_enabled'), 'verify' => config('safe_exam.email_verification_enabled')]);

    Route::get('/safe_exams/{safe_exam}/config_seb', [SafeExamController::class, 'config_seb'])
        ->name('safe_exams.config_seb');
    Route::get('/classroom/{classroom}', [SafeExamController::class, 'enter_seb'])
        ->name('safe_exams.enter_seb');
    Route::get('/safe_exams/exit_seb/{quit_password_hash}', [SafeExamController::class, 'exit_seb'])
        ->name('safe_exams.exit_seb');

    $auth_middlewares = config('safe_exam.email_verification_enabled') ? ['auth', 'verified'] : ['auth'];
    Route::middleware($auth_middlewares)->group(function () {

        Route::get('/', function () {
            return redirect()->route('safe_exams.index');
        })->name('home');

        Route::get('/safe_exams', [SafeExamController::class, 'index'])
            ->name('safe_exams.index');
        Route::post('/safe_exams/{safe_exam}/reset_token', [SafeExamController::class, 'reset_token'])
            ->name('safe_exams.reset_token');
        Route::post('/safe_exams/{safe_exam}/reset_quit_password', [SafeExamController::class, 'reset_quit_password'])
            ->name('safe_exams.reset_quit_password');

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
        Route::post('/safe_exams/{safe_exam}/duplicate', [SafeExamController::class, 'duplicate'])
            ->name('safe_exams.duplicate');

        Route::get('/safe_exams/{safe_exam}/allowed', [SafeExamController::class, 'allowed'])
            ->name('safe_exams.allowed');

        Route::get('/allowed_apps/{safe_exam}/create', [AllowedAppController::class, 'create'])
            ->name('allowed_apps.create');
        Route::post('/allowed_apps', [AllowedAppController::class, 'store'])
            ->name('allowed_apps.store');
        Route::get('/allowed_apps/{allowed_app}/edit', [AllowedAppController::class, 'edit'])
            ->name('allowed_apps.edit');
        Route::put('/allowed_apps/{allowed_app}', [AllowedAppController::class, 'update'])
            ->name('allowed_apps.update');
        Route::delete('/allowed_apps/{allowed_app}', [AllowedAppController::class, 'destroy'])
            ->name('allowed_apps.destroy');
        Route::post('/allowed_apps/{allowed_app}/duplicate', [AllowedAppController::class, 'duplicate'])
            ->name('allowed_apps.duplicate');

        Route::get('/allowed_urls/{safe_exam}/create', [AllowedUrlController::class, 'create'])
            ->name('allowed_urls.create');
        Route::post('/allowed_urls', [AllowedUrlController::class, 'store'])
            ->name('allowed_urls.store');
        Route::get('/allowed_urls/{allowed_url}/edit', [AllowedUrlController::class, 'edit'])
            ->name('allowed_urls.edit');
        Route::put('/allowed_urls/{allowed_url}', [AllowedUrlController::class, 'update'])
            ->name('allowed_urls.update');
        Route::delete('/allowed_urls/{allowed_url}', [AllowedUrlController::class, 'destroy'])
            ->name('allowed_urls.destroy');
        Route::post('/allowed_urls/{allowed_url}/duplicate', [AllowedUrlController::class, 'duplicate'])
            ->name('allowed_urls.duplicate');
    });
});
