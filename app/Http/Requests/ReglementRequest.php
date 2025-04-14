<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReglementRequest extends FormRequest
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
            'datereg' => 'required|date',
            'mtreg' => 'required|numeric|min:0',
            'numchq' => 'nullable|string|max:50',
            'numtraite' => 'nullable|string|max:50',
            'commentaire' => 'nullable|string',
            'abonnement_codeabo' => 'required|exists:abonnements,codeabo',
            'mode_paiement' => 'required|string|max:50',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'datereg.required' => 'La date de règlement est obligatoire',
            'datereg.date' => 'La date de règlement doit être une date valide',
            'mtreg.required' => 'Le montant du règlement est obligatoire',
            'mtreg.numeric' => 'Le montant du règlement doit être un nombre',
            'mtreg.min' => 'Le montant du règlement doit être positif',
            'numchq.max' => 'Le numéro de chèque ne doit pas dépasser 50 caractères',
            'numtraite.max' => 'Le numéro de traite ne doit pas dépasser 50 caractères',
            'abonnement_codeabo.required' => 'L\'abonnement est obligatoire',
            'abonnement_codeabo.exists' => 'L\'abonnement sélectionné n\'existe pas'
        ];
    }
}
