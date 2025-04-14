<?php

namespace App\Http\Controllers;

use App\Models\ReservationSalleFormation;
use App\Http\Requests\ReservationSalleFormationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReservationSalleFormationController extends Controller
{
    /**
     * Afficher la liste des réservations de salles de formation
     */
    public function index(): JsonResponse
    {
        try {
            $reservations = ReservationSalleFormation::with(['salleFormation', 'formateur'])->get();
            return response()->json($reservations);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des réservations: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des réservations'], 500);
        }
    }

    /**
     * Enregistrer une nouvelle réservation de salle de formation
     */
    public function store(ReservationSalleFormationRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            Log::info('Données validées pour création réservation:', $validated);

            $reservation = ReservationSalleFormation::create($validated);
            
            DB::commit();
            
            return response()->json($reservation->load(['salleFormation', 'formateur']), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de la réservation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la création de la réservation'], 500);
        }
    }

    /**
     * Afficher une réservation spécifique
     */
    public function show(ReservationSalleFormation $reservationSalleFormation): JsonResponse
    {
        try {
            return response()->json($reservationSalleFormation->load(['salleFormation', 'formateur']));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération de la réservation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération de la réservation'], 500);
        }
    }

    /**
     * Mettre à jour une réservation
     */
    public function update(ReservationSalleFormationRequest $request, ReservationSalleFormation $reservationSalleFormation): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            Log::info('Données validées pour mise à jour réservation:', $validated);

            $reservationSalleFormation->update($validated);
            
            DB::commit();
            
            return response()->json($reservationSalleFormation->load(['salleFormation', 'formateur']));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour de la réservation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour de la réservation'], 500);
        }
    }

    /**
     * Supprimer une réservation
     */
    public function destroy(ReservationSalleFormation $reservationSalleFormation): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $reservationSalleFormation->delete();
            
            DB::commit();
            
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression de la réservation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression de la réservation'], 500);
        }
    }
}
