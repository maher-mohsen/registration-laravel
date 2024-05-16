<?php

use App\Http\Controllers\LocalizationController;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\RegistrationController;

Route::get('/register', [RegistrationController::class, 'showForm'])->name('register.form');

Route::post('/register', [RegistrationController::class, 'register'])->name('register.submit');

Route::get('/locale/{lang}', [LocalizationController::class, 'setLocale']);


