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

// Route publique
Route::get('/', [FrontController::class, 'index'])->name('home');

// Groupe de routes nécessitant d'être connecté
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---------------------------------------------------------
    // 1. ROUTES RÉSERVÉES À L'ADMIN (Gestion système)
    // ---------------------------------------------------------
    Route::middleware('can:access-admin')->group(function () {
        Route::resource('annonceur', AnnonceurController::class);
        Route::resource('statutvalidation', StatutValidationController::class);
        Route::resource('panneaupublicitaire', PanneauPublicitaireController::class);
        Route::resource('servicepublicitaire',ServicePublicitaireController::class);

        Route::get('panneaupublicitaire/disponibles',
            [PanneauPublicitaireController::class, 'disponibles']
        )->name('panneaupublicitaire.disponibles');
    });

    // ---------------------------------------------------------
    // 2. ROUTES RÉSERVÉES À L'ANNONCEUR (Gestion client)
    // ---------------------------------------------------------
    Route::middleware('can:access-annonceur')->group(function () {
        Route::get('mesServices',
            [ServicePublicitaireController::class, 'mesServices']
        )->name('mesServices');
    });

    // ---------------------------------------------------------
    // 3. ROUTES COMMUNES (Accessibles aux deux rôles)
    // ---------------------------------------------------------
    Route::resources([
        'dossierannonce'     => DossierAnnonceController::class,
        'timesheet'          => TimeSheetController::class,
        'publication'=> PublicationController::class,

    ]);

    // Gestion du profil (Commun)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
