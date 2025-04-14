<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Création d'une société de test
        $societeId = DB::table('societes')->insertGetId([
            'raisonsoc' => 'Société Test',
            'codetva' => 'FR123456789',
            'adrsoc' => '123 Rue Test',
            'telsoc' => '0123456789',
            'faxsoc' => '0123456789',
            'mgsoc' => 'test@societe.com',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création d'un adhérent de test
        $adherentId = DB::table('adherents')->insertGetId([
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'profession' => 'Ingénieur',
            'email' => 'jean.dupont@email.com',
            'adresse' => '456 Avenue République',
            'tel1' => '0623456789',
            'tel2' => '0623456789',
            'datenaissance' => '1990-01-15',
            'cin' => 'AB123456',
            'codetva' => 'FR123456789',
            'raisonsoc' => 'Société Test',
            'idpointage' => 'PT123',
            'societe_code' => $societeId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création d'un type d'abonnement de test
        $typeAbonnementId = DB::table('type_abonnements')->insertGetId([
            'designation' => 'Abonnement Standard',
            'nbmois' => 12,
            'nbjours' => 365,
            'acceslibre' => true,
            'forfait' => 1000.00,
            'nbseancesemaine' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création d'une catégorie d'abonnement de test
        $categorieId = DB::table('categorie_abonnements')->insertGetId([
            'designationcateg' => 'Catégorie Standard',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création d'un abonnement de test
        $abonnementId = DB::table('abonnements')->insertGetId([
            'dateabo' => '2024-02-21',
            'datedeb' => '2024-02-21',
            'datefin' => '2024-12-31',
            'totalhtabo' => 1000.00,
            'totalremise' => 0.00,
            'totalht' => 1000.00,
            'totalttc' => 1200.00,
            'solde' => false,
            'restepaye' => 1200.00,
            'mtpaye' => 0.00,
            'adherent_code' => $adherentId,
            'type_abonnement_code' => $typeAbonnementId,
            'categorie_abonnement_codecateg' => $categorieId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création d'un règlement de test
        $reglementId = DB::table('reglements')->insertGetId([
            'datereg' => '2024-02-21',
            'mtreg' => 500.00,
            'numchq' => 'CHQ123456',
            'numtraite' => 'TR123456',
            'commentaire' => 'Premier paiement',
            'abonnement_codeabo' => $abonnementId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création de formateurs de test
        $formateurId1 = DB::table('formateurs')->insertGetId([
            'nomfor' => 'Martin',
            'prenomfor' => 'Sophie',
            'telfor' => '0612345678',
            'emailfor' => 'sophie.martin@email.com',
            'adrfor' => '789 Rue des Sports',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $formateurId2 = DB::table('formateurs')->insertGetId([
            'nomfor' => 'Bernard',
            'prenomfor' => 'Pierre',
            'telfor' => '0687654321',
            'emailfor' => 'pierre.bernard@email.com',
            'adrfor' => '321 Avenue du Sport',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création de salles de formation de test
        $salleId1 = DB::table('salle_formations')->insertGetId([
            'designationsalle' => 'Salle Yoga',
            'capacitesalle' => 20,
            'prives_n' => true,
            'prives_j' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $salleId2 = DB::table('salle_formations')->insertGetId([
            'designationsalle' => 'Salle Musculation',
            'capacitesalle' => 30,
            'prives_n' => false,
            'prives_j' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Création de réservations de salles de test
        $reservationId1 = DB::table('reservation_salle_formations')->insertGetId([
            'datereservation' => '2024-03-01',
            'montantreservation' => 100.00,
            'salle_formation_codesalle' => $salleId1,
            'formateur_codefor' => $formateurId1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $reservationId2 = DB::table('reservation_salle_formations')->insertGetId([
            'datereservation' => '2024-03-02',
            'montantreservation' => 150.00,
            'salle_formation_codesalle' => $salleId2,
            'formateur_codefor' => $formateurId2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Afficher les IDs créés
        $this->command->info('Société ID: ' . $societeId);
        $this->command->info('Adhérent ID: ' . $adherentId);
        $this->command->info('Type Abonnement ID: ' . $typeAbonnementId);
        $this->command->info('Catégorie Abonnement ID: ' . $categorieId);
        $this->command->info('Abonnement ID: ' . $abonnementId);
        $this->command->info('Règlement ID: ' . $reglementId);
        $this->command->info('Formateur 1 ID: ' . $formateurId1);
        $this->command->info('Formateur 2 ID: ' . $formateurId2);
        $this->command->info('Salle 1 ID: ' . $salleId1);
        $this->command->info('Salle 2 ID: ' . $salleId2);
        $this->command->info('Réservation 1 ID: ' . $reservationId1);
        $this->command->info('Réservation 2 ID: ' . $reservationId2);
    }
} 