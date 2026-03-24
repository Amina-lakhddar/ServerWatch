<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServeurController;
use App\Http\Controllers\MetricController;
use App\Http\Controllers\AlertController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Serveurs
Route::resource('serveurs', ServeurController::class);

// Métriques
Route::get('/metrics', [MetricController::class, 'index'])->name('metrics.index');
Route::post('/metrics/collect', [MetricController::class, 'collect'])->name('metrics.collect');

// Alertes
Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
Route::post('/alerts', [AlertController::class, 'store'])->name('alerts.store');
Route::patch('/alerts/{alert}/read', [AlertController::class, 'markAsRead'])->name('alerts.read');
Route::delete('/alerts/{alert}', [AlertController::class, 'destroy'])->name('alerts.destroy');