<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocieteRequest extends FormRequest
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
            'raisonsoc' => 'required|string|max:255',
            'codetva' => 'required|string|max:50',
            'adrsoc' => 'required|string|max:255',
            'telsoc' => 'required|string|max:20',
            'faxsoc' => 'required|string|max:20',
            'mgsoc' => 'required|string|max:20',
            'observations' => 'nullable|string'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'raisonsoc.required' => 'La raison sociale est obligatoire',
            'raisonsoc.string' => 'La raison sociale doit être une chaîne de caractères',
            'raisonsoc.max' => 'La raison sociale ne doit pas dépasser 255 caractères',
            'codetva.required' => 'Le code TVA est obligatoire',
            'codetva.string' => 'Le code TVA doit être une chaîne de caractères',
            'codetva.max' => 'Le code TVA ne doit pas dépasser 50 caractères',
            'adrsoc.required' => 'L\'adresse est obligatoire',
            'adrsoc.string' => 'L\'adresse doit être une chaîne de caractères',
            'adrsoc.max' => 'L\'adresse ne doit pas dépasser 255 caractères',
            'telsoc.required' => 'Le téléphone est obligatoire',
            'telsoc.string' => 'Le téléphone doit être une chaîne de caractères',
            'telsoc.max' => 'Le téléphone ne doit pas dépasser 20 caractères',
            'faxsoc.required' => 'Le fax est obligatoire',
            'faxsoc.string' => 'Le fax doit être une chaîne de caractères',
            'faxsoc.max' => 'Le fax ne doit pas dépasser 20 caractères',
            'mgsoc.required' => 'Le MG est obligatoire',
            'mgsoc.string' => 'Le MG doit être une chaîne de caractères',
            'mgsoc.max' => 'Le MG ne doit pas dépasser 20 caractères'
        ];
    }
}
