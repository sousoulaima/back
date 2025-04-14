<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationSalleFormationRequest extends FormRequest
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
            'datereservation' => 'required|date',
            'montantreservation' => 'required|numeric|min:0',
            'salle_formation_codesalle' => 'required|exists:salle_formations,codesalle',
            'formateur_codefor' => 'required|exists:formateurs,codefor',
            'statut' => 'required|string|in:confirmee,annulee,en_attente',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'datereservation.required' => 'La date de réservation est obligatoire',
            'datereservation.date' => 'La date de réservation doit être une date valide',
            'montantreservation.required' => 'Le montant de la réservation est obligatoire',
            'montantreservation.numeric' => 'Le montant de la réservation doit être un nombre',
            'montantreservation.min' => 'Le montant de la réservation doit être positif',
            'salle_formation_codesalle.required' => 'La salle de formation est obligatoire',
            'salle_formation_codesalle.exists' => 'La salle de formation sélectionnée n\'existe pas',
            'formateur_codefor.required' => 'Le formateur est obligatoire',
            'formateur_codefor.exists' => 'Le formateur sélectionné n\'existe pas',
            'statut.required' => 'Le statut de la réservation est obligatoire',
            'statut.string' => 'Le statut de la réservation doit être une chaîne de caractères',
            'statut.in' => 'Le statut de la réservation doit être l\'une des valeurs suivantes : confirmee, annulee, en_attente',
            'observations.nullable' => 'Les observations peuvent être nulles',
            'observations.string' => 'Les observations doivent être une chaîne de caractères'
        ];
    }
}
