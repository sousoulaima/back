<?php

namespace App\Http\Controllers;

use App\Models\TypeAbonnement;
use App\Http\Requests\TypeAbonnementRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TypeAbonnementController extends Controller
{
    /**
     * Afficher la liste des types d'abonnement
     */
    public function index(): JsonResponse
    {
        $typeAbonnements = TypeAbonnement::all();
        return response()->json($typeAbonnements);
    }

    /**
     * Enregistrer un nouveau type d'abonnement
     */
    public function store(TypeAbonnementRequest $request): JsonResponse
    {
        $typeAbonnement = TypeAbonnement::create($request->validated());
        return response()->json($typeAbonnement, Response::HTTP_CREATED);
    }

    /**
     * Afficher un type d'abonnement spécifique
     */
    public function show(TypeAbonnement $typeAbonnement): JsonResponse
    {
        return response()->json($typeAbonnement->load('abonnements'));
    }

    /**
     * Mettre à jour un type d'abonnement
     */
    public function update(TypeAbonnementRequest $request, TypeAbonnement $typeAbonnement): JsonResponse
    {
        $typeAbonnement->update($request->validated());
        return response()->json($typeAbonnement);
    }

    /**
     * Supprimer un type d'abonnement
     */
    public function destroy(TypeAbonnement $typeAbonnement): JsonResponse
    {
        $typeAbonnement->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
