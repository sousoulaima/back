<?php

namespace App\Http\Controllers;

use App\Models\SalleFormation;
use App\Http\Requests\SalleFormationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SalleFormationController extends Controller
{
    /**
     * Afficher la liste des salles de formation
     */
    public function index(): JsonResponse
    {
        try {
            $salleFormations = SalleFormation::with('reservationSalleFormations')->get();
            return response()->json($salleFormations);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des salles de formation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des salles de formation'], 500);
        }
    }

    /**
     * Enregistrer une nouvelle salle de formation
     */
    public function store(SalleFormationRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            Log::info('Données validées pour création salle de formation:', $validated);

            $salleFormation = SalleFormation::create($validated);
            
            DB::commit();
            
            return response()->json($salleFormation, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de la salle de formation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la création de la salle de formation'], 500);
        }
    }

    /**
     * Afficher une salle de formation spécifique
     */
    public function show(SalleFormation $salleFormation): JsonResponse
    {
        try {
            return response()->json($salleFormation->load('reservationSalleFormations'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération de la salle de formation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération de la salle de formation'], 500);
        }
    }

    /**
     * Mettre à jour une salle de formation
     */
    public function update(SalleFormationRequest $request, SalleFormation $salleFormation): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            Log::info('Données validées pour mise à jour salle de formation:', $validated);

            $salleFormation->update($validated);
            
            DB::commit();
            
            return response()->json($salleFormation);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour de la salle de formation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour de la salle de formation'], 500);
        }
    }

    /**
     * Supprimer une salle de formation
     */
    public function destroy(SalleFormation $salleFormation): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            // Supprimer d'abord les réservations associées
            $salleFormation->reservationSalleFormations()->delete();
            
            // Ensuite supprimer la salle
            $salleFormation->delete();
            
            DB::commit();
            
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression de la salle de formation: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression de la salle de formation'], 500);
        }
    }
}
