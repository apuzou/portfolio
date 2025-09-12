<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactReplyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillCategoryController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SkillRadarChartController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

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

// 管理画面認証ルート
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.post');
});

// 管理画面（認証が必要）
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // 認証
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ダッシュボード
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // プロフィール管理
    Route::resource('profile', \App\Http\Controllers\Admin\ProfileController::class)
        ->except(['show', 'destroy']);

    // スキル管理
    Route::resource('skill-categories', SkillCategoryController::class);
    Route::resource('skills', SkillController::class);
    Route::resource('skill-radar-chart', SkillRadarChartController::class)
        ->only(['index', 'update'])
        ->parameters(['skill-radar-chart' => 'radarChart']);

    // プロジェクト管理
    Route::resource('project-categories', ProjectCategoryController::class);
    Route::resource('projects', ProjectController::class);

    // お問い合わせ管理
    Route::resource('contacts', ContactController::class)
        ->only(['index', 'show', 'update', 'destroy']);
    Route::resource('contact-replies', ContactReplyController::class)
        ->only(['store']);
});

// ポートフォリオ表示（最後に定義）
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [PortfolioController::class, 'storeContact'])
    ->middleware('throttle:3,1')
    ->name('portfolio.contact.store');
