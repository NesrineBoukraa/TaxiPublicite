<?php

use App\Http\Controllers\Admin\AnnonceurController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DossierAnnonceController;
use App\Http\Controllers\Admin\PublicationController;
use App\Http\Controllers\Admin\StatutValidationController;
use App\Http\Controllers\Admin\PanneauPublicitaireController;
use App\Http\Controllers\Admin\TimeSheetController;
use App\Http\Controllers\Admin\ServicePublicitaireController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
}) ;

Route::resources([
    'annonceur'=> AnnonceurController::class,
    'dossierannonce'=> DossierAnnonceController::class,
    'servicepublicitaire'=> ServicePublicitaireController::class,
    'publication'=> PublicationController::class,
     'timesheet'=> TimeSheetController::class,
      'panneaupublicitaire'=> PanneauPublicitaireController::class,
       'statutvalidation'=> StatutValidationController::class,

]);
Route::get('panneaupublicitaire/disponibles', 
    [PanneauPublicitaireController::class, 'disponibles']
)->name('panneaupublicitaire.disponibles');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
