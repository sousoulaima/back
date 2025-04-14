<?php

namespace App\Http\Controllers;

use App\Models\Reglement;
use App\Http\Requests\ReglementRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ReglementController extends Controller
{
    /**
     * Afficher la liste des règlements
     */
    public function index(): JsonResponse
    {
        try {
            $reglements = Reglement::with(['abonnement', 'modaliteRegs'])->get();
            return response()->json($reglements);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des règlements: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des règlements'], 500);
        }
    }

    /**
     * Enregistrer un nouveau règlement
     */
    public function store(ReglementRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            Log::info('Données validées pour création règlement:', $validated);

            $reglement = Reglement::create($validated);
            
            DB::commit();
            
            return response()->json($reglement->load(['abonnement', 'modaliteRegs']), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création du règlement: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la création du règlement'], 500);
        }
    }

    /**
     * Afficher un règlement spécifique
     */
    public function show(Reglement $reglement): JsonResponse
    {
        try {
            return response()->json($reglement->load(['abonnement', 'modaliteRegs']));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération du règlement: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération du règlement'], 500);
        }
    }

    /**
     * Mettre à jour un règlement
     */
    public function update(ReglementRequest $request, Reglement $reglement): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            Log::info('Données validées pour mise à jour règlement:', $validated);

            $reglement->update($validated);
            
            DB::commit();
            
            return response()->json($reglement->load(['abonnement', 'modaliteRegs']));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour du règlement: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour du règlement'], 500);
        }
    }

    /**
     * Supprimer un règlement
     */
    public function destroy(Reglement $reglement): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            // Supprimer d'abord les modalités de règlement associées
            $reglement->modaliteRegs()->delete();
            
            // Ensuite supprimer le règlement
            $reglement->delete();
            
            DB::commit();
            
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression du règlement: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression du règlement'], 500);
        }
    }
}
