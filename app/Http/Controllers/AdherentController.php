<?php

namespace App\Http\Controllers;

use App\Models\Adherent;
use App\Http\Requests\AdherentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AdherentController extends Controller
{
    /**
     * Afficher la liste des adhérents
     */
    public function index(): JsonResponse
    {
        $adherents = Adherent::with('societe')->get();
        return response()->json($adherents);
    }

    /**
     * Enregistrer un nouvel adhérent
     */
    public function store(AdherentRequest $request): JsonResponse
    {
        $adherent = Adherent::create($request->validated());
        return response()->json($adherent, Response::HTTP_CREATED);
    }

    /**
     * Afficher un adhérent spécifique
     */
    public function show(Adherent $adherent): JsonResponse
    {
        return response()->json($adherent->load('societe', 'abonnements'));
    }

    /**
     * Mettre à jour un adhérent
     */
    public function update(AdherentRequest $request, Adherent $adherent): JsonResponse
    {
        $adherent->update($request->validated());
        return response()->json($adherent);
    }

    /**
     * Supprimer un adhérent
     */
    public function destroy(Adherent $adherent): JsonResponse
    {
        $adherent->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
