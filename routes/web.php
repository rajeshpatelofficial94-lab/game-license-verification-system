<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('home');

// Route::get('dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    return Inertia::render('LicenseVerification/Index');
});
Route::get('/available-regions', function () {
    return Inertia::render('LicenseVerification/AvailableRegions');
});
Route::get('/check-restrictions', function () {
    return Inertia::render('LicenseVerification/CheckRestrictions');
});
Route::get('/validate-age', function () {
    return Inertia::render('LicenseVerification/ValidateAge');
});
Route::get('/verify-license', function () {
    return Inertia::render('LicenseVerification/VerifyLicense');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
