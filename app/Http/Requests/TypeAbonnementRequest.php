<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeAbonnementRequest extends FormRequest
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
            'designation' => 'required|string|max:255',
            'nbmois' => 'required|integer|min:0',
            'nbjours' => 'required|integer|min:0',
            'acceslibre' => 'required|boolean',
            'forfait' => 'required|numeric|min:0',
            'nbseancesemaine' => 'required|integer|min:0',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'designation.required' => 'La désignation est obligatoire',
            'nbmois.required' => 'Le nombre de mois est obligatoire',
            'nbmois.integer' => 'Le nombre de mois doit être un nombre entier',
            'nbmois.min' => 'Le nombre de mois doit être positif',
            'nbjours.required' => 'Le nombre de jours est obligatoire',
            'nbjours.integer' => 'Le nombre de jours doit être un nombre entier',
            'nbjours.min' => 'Le nombre de jours doit être positif',
            'acceslibre.required' => 'L\'accès libre est obligatoire',
            'acceslibre.boolean' => 'L\'accès libre doit être vrai ou faux',
            'forfait.required' => 'Le forfait est obligatoire',
            'forfait.numeric' => 'Le forfait doit être un nombre',
            'forfait.min' => 'Le forfait doit être positif',
            'nbseancesemaine.required' => 'Le nombre de séances par semaine est obligatoire',
            'nbseancesemaine.integer' => 'Le nombre de séances par semaine doit être un nombre entier',
            'nbseancesemaine.min' => 'Le nombre de séances par semaine doit être positif'
        ];
    }
}
