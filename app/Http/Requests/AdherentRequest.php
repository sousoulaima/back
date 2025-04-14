<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdherentRequest extends FormRequest
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
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'adresse' => 'required|string|max:255',
            'tel1' => 'required|string|max:20',
            'tel2' => 'nullable|string|max:20',
            'datenaissance' => 'required|date',
            'cin' => 'required|string|max:20',
            'codetva' => 'required|string|max:50',
            'raisonsoc' => 'required|string|max:255',
            'idpointage' => 'required|string|max:50',
            'societe_code' => 'required|exists:societes,code',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'prenom.required' => 'Le prénom est obligatoire',
            'profession.required' => 'La profession est obligatoire',
            'email.required' => 'L\'email est obligatoire',
            'email.email' => 'L\'email doit être une adresse email valide',
            'adresse.required' => 'L\'adresse est obligatoire',
            'tel1.required' => 'Le téléphone 1 est obligatoire',
            'datenaissance.required' => 'La date de naissance est obligatoire',
            'datenaissance.date' => 'La date de naissance doit être une date valide',
            'cin.required' => 'Le CIN est obligatoire',
            'codetva.required' => 'Le code TVA est obligatoire',
            'raisonsoc.required' => 'La raison sociale est obligatoire',
            'idpointage.required' => 'L\'ID pointage est obligatoire',
            'societe_code.required' => 'La société est obligatoire',
            'societe_code.exists' => 'La société sélectionnée n\'existe pas'
        ];
    }
}
