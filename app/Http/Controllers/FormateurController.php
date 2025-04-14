<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Http\Requests\FormateurRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class FormateurController extends Controller
{
    /**
     * Afficher la liste des formateurs
     */
    public function index(): JsonResponse
    {
        try {
            $formateurs = Formateur::all();
            return response()->json($formateurs);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des formateurs: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des formateurs'], 500);
        }
    }

    /**
     * Enregistrer un nouveau formateur
     */
    public function store(FormateurRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            Log::info('Tentative de création d\'un formateur avec les données:', $request->validated());

            // Création du formateur
            $formateur = Formateur::create($request->validated());

            DB::commit();

            return response()->json($formateur, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création du formateur: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la création du formateur'], 500);
        }
    }

    /**
     * Afficher un formateur spécifique
     */
    public function show(string $id): JsonResponse
    {
        try {
            $formateur = Formateur::findOrFail($id);
            return response()->json($formateur);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération du formateur: ' . $e->getMessage());
            return response()->json(['message' => 'Formateur non trouvé'], 404);
        }
    }

    /**
     * Mettre à jour un formateur
     */
    public function update(FormateurRequest $request, string $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $formateur = Formateur::findOrFail($id);
            Log::info('Tentative de mise à jour du formateur #' . $id . ' avec les données:', $request->validated());

            $formateur->update($request->validated());

            DB::commit();

            return response()->json($formateur);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour du formateur: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour du formateur'], 500);
        }
    }

    /**
     * Supprimer un formateur
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $formateur = Formateur::findOrFail($id);
            Log::info('Tentative de suppression du formateur #' . $id);

            $formateur->delete();

            DB::commit();

            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression du formateur: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression du formateur'], 500);
        }
    }
}
