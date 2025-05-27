<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TranslationRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => 'Hello World!']);
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/error', function () { return view('error'); });

    //Услуги
Route::get('/services', function () {
    return view('services');
});

    //Админская часть ---------------------------------------------------------------
Route::middleware(['auth', 'admin'])->group(function () {
    //группа для заявлений админка
    Route::get('/admin/forms', [AdminController::class, 'allForms'])->name('admin.forms');
    Route::post('/admin/forms/{id}/upload', [AdminController::class, 'uploadFile']);
    Route::delete('/admin/forms/{id}', [AdminController::class, 'destroy'])->name('admin.forms.destroy');
    Route::put('/admin/forms/{id}/status', [AdminController::class, 'updateStatus']);

    //группа для переводов админка
    Route::get('/admin/translations', [TranslationRequestController::class, 'index'])->name('admin.translations');
    Route::post('/admin/translations/{id}/upload', [TranslationRequestController::class, 'uploadTranslation']);
    Route::post('/admin/translations/{id}/status', [TranslationRequestController::class, 'updateStatus']);

    //Удаление пользователей админская часть
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
    //Список пользователей
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users.index');

    Route::get('/admin/users/{id}', [AdminController::class, 'showUserDetails'])->name('admin.users.show');
});
//---------------------------------------------------------------
// Регистрация Пользователя
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/resend', [RegisterController::class, 'resendVerificationEmail'])
    ->middleware('auth')
    ->name('verification.resend');

//маршрут для подтверждения
Route::get('/verify-email/{id}/{hash}', [RegisterController::class, 'verifyEmail'])->name('verification.verify');

Route::middleware(['auth', 'verified.custom'])->group(function () {
    Route::post('/apply', [ApplicationController::class, 'store']);
    Route::get('/apply', [ApplicationController::class, 'create']);
    // Личный кабинет

    //переводы
    Route::get('/translations/create', [TranslationRequestController::class, 'create']);
    Route::post('/translations', [TranslationRequestController::class, 'store']);

});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
