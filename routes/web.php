<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GeneratePinController;
use App\Http\Controllers\Admin\InstrumenController;
use App\Http\Controllers\Client\HomepageController;
use App\Http\Controllers\Client\ScreeningController;
use App\Http\Controllers\Client\MandiriController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'noCache'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/generate', [GeneratePinController::class, 'store'])->name('generatePin');
    Route::post('/update-pin-status', [GeneratePinController::class, 'updatePinStatus'])->name('updatePinStatus');
    
    Route::get('/sdq', [DashboardController::class, 'sdq'])->name('sdq');
    Route::get('/sdq/first', [DashboardController::class, 'sdqFirst'])->name('sdqFirst');
    Route::post('/sdq/first', [InstrumenController::class, 'storeSDQFirst'])->name('storeSDQFirst');
    Route::get('/sdq/first/{id}', [InstrumenController::class, 'viewSDQFirst'])->name('viewSDQFirst');
    Route::post('/sdq/first/{id}/edit', [InstrumenController::class, 'editSDQFirst'])->name('editSDQFirst');
    Route::get('/sdq/first/{id}/delete', [InstrumenController::class, 'deleteSDQFirst'])->name('deleteSDQFirst');

    Route::get('/sdq/second', [DashboardController::class, 'sdqSecond'])->name('sdqSecond');
    Route::post('/sdq/second', [InstrumenController::class, 'storeSDQSecond'])->name('storeSDQSecond');
    Route::get('/sdq/second/{id}', [InstrumenController::class, 'viewSDQSecond'])->name('viewSDQSecond');
    Route::post('/sdq/second/{id}/edit', [InstrumenController::class, 'editSDQSecond'])->name('editSDQSecond');
    Route::get('/sdq/second/{id}/delete', [InstrumenController::class, 'deleteSDQSecond'])->name('deleteSDQSecond');
    
    Route::get('/srq', [DashboardController::class, 'srq'])->name('srq');
    Route::post('/srq', [InstrumenController::class, 'storeSRQ'])->name('storeSRQ');
    Route::get('/srq/{id}', [InstrumenController::class, 'viewSRQ'])->name('viewSRQ');
    Route::post('/srq/{id}/edit', [InstrumenController::class, 'editSRQ'])->name('editSRQ');
    Route::get('/srq/{id}/delete', [InstrumenController::class, 'deleteSRQ'])->name('deleteSRQ');

    Route::get('/report', [DashboardController::class, 'report'])->name('report');
    Route::get('/report/download/sdq', [DashboardController::class, 'sdqDownloadExcel'])->name('sdqDownloadExcel');
    Route::get('/report/download/srq', [DashboardController::class, 'srqDownloadExcel'])->name('srqDownloadExcel');
    Route::get('/feedback', [DashboardController::class, 'feedback'])->name('viewFeedback');
});

Route::prefix('/')->group( function () {
    Route::get('/', [HomepageController::class, 'index'])->name('homepage');
    Route::get('/feedback', [HomepageController::class, 'feedback'])->name('feedback');
    Route::post('/feedback', [HomepageController::class, 'submitFeedback'])->name('submitFeedback');
    Route::prefix('/screening-test')->group( function () {
        Route::get('/panduan', [HomepageController::class, 'screening'])->name('screening');
        Route::get('/pin', [ScreeningController::class, 'inputPin'])->name('pinScreening');
        Route::post('/pin', [ScreeningController::class, 'checkPin'])->name('checkPin');
        Route::middleware(['isCorrectPin'])->group( function () {
            Route::get('/form-data', [ScreeningController::class, 'formData'])->name('formData');
            Route::post('/form-data', [ScreeningController::class, 'inputData'])->name('inputData');
        });
        Route::middleware(['isTestQuestions'])->group( function () {
            Route::get('/test', [ScreeningController::class, 'questions'])->name('screeningQuestions')->middleware(['noCache']);
            Route::post('/test/sdq', [ScreeningController::class, 'sdqResponse'])->name('submitScreeningSDQ');
            Route::post('/test/srq', [ScreeningController::class, 'srqResponse'])->name('submitScreeningSRQ');
        });
        Route::get('/result', [ScreeningController::class, 'result'])->name('result');
    });
    
    Route::prefix('/mandiri-test')->group( function () {
        Route::get('/', [HomepageController::class, 'forbidden'])->name('forbidden');
        // Route::get('/panduan', [HomepageController::class, 'mandiri'])->name('mandiri');
        // Route::get('/usia', [MandiriController::class, 'inputUsia'])->name('inputUsia');
        // Route::post('/usia', [MandiriController::class, 'checkUsia'])->name('checkUsia');
        // Route::get('/test', [MandiriController::class, 'questions'])->name('mandiriQuestions')->middleware(['noCache']);
        // Route::post('/result/sdq', [MandiriController::class, 'response'])->name('submitMandiriSDQ');
        // Route::post('/result/srq', [MandiriController::class, 'response'])->name('submitMandiriSRQ');
        // Route::get('/result/sdq', [MandiriController::class, 'response']);
        // Route::get('/result/srq', [MandiriController::class, 'response']);
    });
    Route::get('lang/{lang}', function($lang){
        app()->setLocale($lang);
        session()->put('locale', $lang);
        return redirect()->back();
    })->name('changeLang');
});

require __DIR__.'/auth.php';

