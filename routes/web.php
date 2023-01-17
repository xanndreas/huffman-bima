<?php

use App\Http\Controllers\Auth\ApprovalController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\Admin\EmailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', '/login');

Auth::routes();

Route::get('email/approval', [ApprovalController::class, 'show'])->name('approval.notice');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'approved']], function () {
    Route::get('/', [EmailController::class, 'index'])->name('home');

    Route::post('adapters/{folder}', [EmailController::class, 'adapters'])->name('adapters');

    Route::post('compose/sends', [EmailController::class, 'composeSend'])->name('compose.sends');

    Route::post('compose/drafts', [EmailController::class, 'composeDraft'])->name('compose.drafts');

    Route::post('compose/delete', [EmailController::class, 'composeDelete'])->name('compose.delete');

    Route::post('encoders', [EmailController::class, 'encoders'])->name('encoders');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    if (file_exists(app_path('Http/Controllers/Auth/UserProfileController.php'))) {
        Route::get('/', [UserProfileController::class, 'show'])->name('show');
    }
});

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
