<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use App\Http\Requests\SocieteRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SocieteController extends Controller
{
    /**
     * Afficher la liste des sociétés
     */
    public function index(): JsonResponse
    {
        $societes = Societe::all();
        return response()->json($societes);
    }

    /**
     * Enregistrer une nouvelle société
     */
    public function store(SocieteRequest $request): JsonResponse
    {
        $societe = Societe::create($request->validated());
        return response()->json($societe, Response::HTTP_CREATED);
    }

    /**
     * Afficher une société spécifique
     */
    public function show(Societe $societe): JsonResponse
    {
        return response()->json($societe);
    }

    /**
     * Mettre à jour une société
     */
    public function update(SocieteRequest $request, Societe $societe): JsonResponse
    {
        $societe->update($request->validated());
        return response()->json($societe);
    }

    /**
     * Supprimer une société
     */
    public function destroy(Societe $societe): JsonResponse
    {
        $societe->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
