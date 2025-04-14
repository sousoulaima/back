<?php

namespace App\Http\Controllers;

use App\Models\CategorieAbonnement;
use App\Http\Requests\CategorieAbonnementRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategorieAbonnementController extends Controller
{
    /**
     * Afficher la liste des catégories d'abonnement
     */
    public function index(): JsonResponse
    {
        $categorieAbonnements = CategorieAbonnement::all();
        return response()->json($categorieAbonnements);
    }

    /**
     * Enregistrer une nouvelle catégorie d'abonnement
     */
    public function store(CategorieAbonnementRequest $request): JsonResponse
    {
        $categorieAbonnement = CategorieAbonnement::create($request->validated());
        return response()->json($categorieAbonnement, Response::HTTP_CREATED);
    }

    /**
     * Afficher une catégorie d'abonnement spécifique
     */
    public function show(CategorieAbonnement $categorieAbonnement): JsonResponse
    {
        return response()->json($categorieAbonnement->load('abonnements'));
    }

    /**
     * Mettre à jour une catégorie d'abonnement
     */
    public function update(CategorieAbonnementRequest $request, CategorieAbonnement $categorieAbonnement): JsonResponse
    {
        $categorieAbonnement->update($request->validated());
        return response()->json($categorieAbonnement);
    }

    /**
     * Supprimer une catégorie d'abonnement
     */
    public function destroy(CategorieAbonnement $categorieAbonnement): JsonResponse
    {
        $categorieAbonnement->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
