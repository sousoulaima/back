<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\AdherentController;
use App\Http\Controllers\TypeAbonnementController;
use App\Http\Controllers\CategorieAbonnementController;
use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\ReglementController;
use App\Http\Controllers\ModaliteRegController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\SalleFormationController;
use App\Http\Controllers\ReservationSalleFormationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned the "api" middleware group. Make something great!
|
*/

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

// Protected Routes (Require Authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout']);

    // Get Authenticated User
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // User Resource Routes
    Route::apiResource('users', UserController::class);
});

// Public Resource Routes (No Authentication Required)
Route::apiResource('societes', SocieteController::class);
Route::apiResource('adherents', AdherentController::class);
Route::apiResource('type-abonnements', TypeAbonnementController::class);
Route::apiResource('categorie-abonnements', CategorieAbonnementController::class);
Route::apiResource('abonnements', AbonnementController::class);
Route::apiResource('reglements', ReglementController::class);
Route::apiResource('modalite-regs', ModaliteRegController::class);
Route::apiResource('formateurs', FormateurController::class);
Route::apiResource('salle-formations', SalleFormationController::class);
Route::apiResource('reservation-salle-formations', ReservationSalleFormationController::class);