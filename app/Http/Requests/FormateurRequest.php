<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormateurRequest extends FormRequest
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
            'nomfor' => 'required|string|max:255',
            'prenomfor' => 'required|string|max:255',
            'telfor' => 'required|string|max:20',
            'emailfor' => 'required|email|max:255',
            'adrfor' => 'required|string|max:255',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'nomfor.required' => 'Le nom du formateur est obligatoire',
            'nomfor.string' => 'Le nom du formateur doit être une chaîne de caractères',
            'nomfor.max' => 'Le nom du formateur ne doit pas dépasser 255 caractères',
            'prenomfor.required' => 'Le prénom du formateur est obligatoire',
            'prenomfor.string' => 'Le prénom du formateur doit être une chaîne de caractères',
            'prenomfor.max' => 'Le prénom du formateur ne doit pas dépasser 255 caractères',
            'telfor.required' => 'Le téléphone du formateur est obligatoire',
            'telfor.string' => 'Le téléphone du formateur doit être une chaîne de caractères',
            'telfor.max' => 'Le téléphone du formateur ne doit pas dépasser 20 caractères',
            'emailfor.required' => 'L\'email du formateur est obligatoire',
            'emailfor.email' => 'L\'email du formateur doit être une adresse email valide',
            'emailfor.max' => 'L\'email du formateur ne doit pas dépasser 255 caractères',
            'adrfor.required' => 'L\'adresse du formateur est obligatoire',
            'adrfor.string' => 'L\'adresse du formateur doit être une chaîne de caractères',
            'adrfor.max' => 'L\'adresse du formateur ne doit pas dépasser 255 caractères'
        ];
    }
}
