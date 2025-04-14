<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbonnementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'adherent_code' => 'required|exists:adherents,code',
            'type_abonnement_code' => 'required|exists:type_abonnements,code',
            'categorie_abonnement_codecateg' => 'required|exists:categorie_abonnements,codecateg',
            'dateabo' => 'required|date',
            'datedeb' => 'required|date',
            'datefin' => 'required|date|after:datedeb',
            'totalhtabo' => 'required|numeric|min:0',
            'totalremise' => 'required|numeric|min:0',
            'totalht' => 'required|numeric|min:0',
            'totalttc' => 'required|numeric|min:0',
            'solde' => 'required|boolean',
            'restepaye' => 'required|numeric|min:0',
            'mtpaye' => 'required|numeric|min:0',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'dateabo.required' => 'La date d\'abonnement est obligatoire',
            'dateabo.date' => 'La date d\'abonnement doit être une date valide',
            'totalhtabo.required' => 'Le total HT est obligatoire',
            'totalhtabo.numeric' => 'Le total HT doit être un nombre',
            'totalhtabo.min' => 'Le total HT doit être positif',
            'totalremise.required' => 'La remise totale est obligatoire',
            'totalremise.numeric' => 'La remise totale doit être un nombre',
            'totalremise.min' => 'La remise totale doit être positive',
            'totalht.required' => 'Le total HT est obligatoire',
            'totalht.numeric' => 'Le total HT doit être un nombre',
            'totalht.min' => 'Le total HT doit être positif',
            'totalttc.required' => 'Le total TTC est obligatoire',
            'totalttc.numeric' => 'Le total TTC doit être un nombre',
            'totalttc.min' => 'Le total TTC doit être positif',
            'solde.required' => 'Le statut de solde est obligatoire',
            'solde.boolean' => 'Le statut de solde doit être vrai ou faux',
            'restepaye.required' => 'Le reste à payer est obligatoire',
            'restepaye.numeric' => 'Le reste à payer doit être un nombre',
            'restepaye.min' => 'Le reste à payer doit être positif',
            'mtpaye.required' => 'Le montant payé est obligatoire',
            'mtpaye.numeric' => 'Le montant payé doit être un nombre',
            'mtpaye.min' => 'Le montant payé doit être positif',
            'datedeb.required' => 'La date de début est obligatoire',
            'datedeb.date' => 'La date de début doit être une date valide',
            'datefin.required' => 'La date de fin est obligatoire',
            'datefin.date' => 'La date de fin doit être une date valide',
            'datefin.after' => 'La date de fin doit être postérieure à la date de début',
            'adherent_code.required' => 'L\'adhérent est obligatoire',
            'adherent_code.exists' => 'L\'adhérent sélectionné n\'existe pas',
            'type_abonnement_code.required' => 'Le type d\'abonnement est obligatoire',
            'type_abonnement_code.exists' => 'Le type d\'abonnement sélectionné n\'existe pas',
            'categorie_abonnement_codecateg.required' => 'La catégorie d\'abonnement est obligatoire',
            'categorie_abonnement_codecateg.exists' => 'La catégorie d\'abonnement sélectionnée n\'existe pas'
        ];
    }
}
