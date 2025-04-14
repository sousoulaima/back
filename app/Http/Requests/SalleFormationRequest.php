<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalleFormationRequest extends FormRequest
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
            'designationsalle' => 'required|string|max:255',
            'capacitesalle' => 'required|integer|min:1',
            'prives_n' => 'required|boolean',
            'prives_j' => 'required|boolean',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'designationsalle.required' => 'La désignation de la salle est obligatoire',
            'designationsalle.string' => 'La désignation de la salle doit être une chaîne de caractères',
            'designationsalle.max' => 'La désignation de la salle ne doit pas dépasser 255 caractères',
            'capacitesalle.required' => 'La capacité de la salle est obligatoire',
            'capacitesalle.integer' => 'La capacité de la salle doit être un nombre entier',
            'capacitesalle.min' => 'La capacité de la salle doit être au moins 1',
            'prives_n.required' => 'Le statut privé nuit est obligatoire',
            'prives_n.boolean' => 'Le statut privé nuit doit être vrai ou faux',
            'prives_j.required' => 'Le statut privé jour est obligatoire',
            'prives_j.boolean' => 'Le statut privé jour doit être vrai ou faux'
        ];
    }
}
