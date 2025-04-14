<?php

namespace App\Http\Controllers;

use App\Models\Abonnement;
use App\Http\Requests\AbonnementRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AbonnementController extends Controller
{
    /**
     * Afficher la liste des abonnements
     */
    public function index(): JsonResponse
    {
        try {
            $abonnements = Abonnement::with(['adherent', 'typeAbonnement', 'categorieAbonnement'])->get();
            return response()->json($abonnements);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des abonnements: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération des abonnements'], 500);
        }
    }

    /**
     * Enregistrer un nouvel abonnement
     */
    public function store(AbonnementRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            // Validation et logging des données reçues
            $validated = $request->validated();
            Log::info('Données reçues pour création abonnement:', $request->all());

            // Vérification de la connexion à la base de données
            try {
                DB::connection()->getPdo();
            } catch (\Exception $e) {
                Log::error('Erreur de connexion à la base de données: ' . $e->getMessage());
                throw new \Exception('Impossible de se connecter à la base de données');
            }

            // Vérification des clés étrangères
            $adherent = DB::table('adherents')->where('code', $validated['adherent_code'])->first();
            if (!$adherent) {
                throw new \Exception('L\'adhérent avec le code ' . $validated['adherent_code'] . ' n\'existe pas');
            }

            $typeAbonnement = DB::table('type_abonnements')->where('code', $validated['type_abonnement_code'])->first();
            if (!$typeAbonnement) {
                throw new \Exception('Le type d\'abonnement avec le code ' . $validated['type_abonnement_code'] . ' n\'existe pas');
            }

            $categorieAbonnement = DB::table('categorie_abonnements')->where('codecateg', $validated['categorie_abonnement_codecateg'])->first();
            if (!$categorieAbonnement) {
                throw new \Exception('La catégorie d\'abonnement avec le code ' . $validated['categorie_abonnement_codecateg'] . ' n\'existe pas');
            }

            // Création de l'abonnement avec DB::table
            $codeabo = DB::table('abonnements')->insertGetId([
                'dateabo' => $validated['dateabo'],
                'datedeb' => $validated['datedeb'],
                'datefin' => $validated['datefin'],
                'totalhtabo' => $validated['totalhtabo'],
                'totalremise' => $validated['totalremise'],
                'totalht' => $validated['totalht'],
                'totalttc' => $validated['totalttc'],
                'solde' => $validated['solde'],
                'restepaye' => $validated['restepaye'],
                'mtpaye' => $validated['mtpaye'],
                'adherent_code' => $validated['adherent_code'],
                'type_abonnement_code' => $validated['type_abonnement_code'],
                'categorie_abonnement_codecateg' => $validated['categorie_abonnement_codecateg'],
                'created_at' => now(),
                'updated_at' => now()
            ]);

            if (!$codeabo) {
                throw new \Exception('Échec de l\'insertion dans la base de données');
            }

            // Vérification que l'enregistrement existe
            $abonnement = DB::table('abonnements')->where('codeabo', $codeabo)->first();
            if (!$abonnement) {
                throw new \Exception('L\'abonnement n\'a pas été trouvé après l\'insertion');
            }

            // Conversion en modèle Eloquent pour les relations
            $abonnementModel = Abonnement::with(['adherent', 'typeAbonnement', 'categorieAbonnement'])->find($codeabo);
            if (!$abonnementModel) {
                throw new \Exception('Impossible de charger le modèle d\'abonnement');
            }

            DB::commit();
            Log::info('Abonnement créé avec succès. ID: ' . $codeabo);
            
            return response()->json([
                'message' => 'Abonnement créé avec succès',
                'data' => $abonnementModel
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la création de l\'abonnement: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'message' => 'Erreur lors de la création de l\'abonnement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Afficher un abonnement spécifique
     */
    public function show(Abonnement $abonnement): JsonResponse
    {
        try {
            return response()->json($abonnement->load(['adherent', 'typeAbonnement', 'categorieAbonnement', 'reglements']));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération de l\'abonnement: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la récupération de l\'abonnement'], 500);
        }
    }

    /**
     * Mettre à jour un abonnement
     */
    public function update(AbonnementRequest $request, Abonnement $abonnement): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $validated = $request->validated();
            Log::info('Données validées pour mise à jour abonnement:', $validated);

            $abonnement->update($validated);
            
            DB::commit();
            
            return response()->json($abonnement->load(['adherent', 'typeAbonnement', 'categorieAbonnement']));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la mise à jour de l\'abonnement: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la mise à jour de l\'abonnement'], 500);
        }
    }

    /**
     * Supprimer un abonnement
     */
    public function destroy(Abonnement $abonnement): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            // Supprimer d'abord les règlements associés
            $abonnement->reglements()->delete();
            
            // Ensuite supprimer l'abonnement
            $abonnement->delete();
            
            DB::commit();
            
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erreur lors de la suppression de l\'abonnement: ' . $e->getMessage());
            return response()->json(['message' => 'Erreur lors de la suppression de l\'abonnement'], 500);
        }
    }
}
