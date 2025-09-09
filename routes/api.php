<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LicenseVerificationController;

Route::prefix('license')->group(function () {
    Route::get('/verify', [LicenseVerificationController::class, 'verifyLicense']);
    Route::get('/restrictions', [LicenseVerificationController::class, 'checkRegionalRestrictions']);
    Route::get('/age', [LicenseVerificationController::class, 'validateAgeRating']);
    Route::get('/regions', [LicenseVerificationController::class, 'getAvailableRegions']);
});
