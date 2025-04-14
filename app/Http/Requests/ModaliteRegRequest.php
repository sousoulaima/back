<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModaliteRegRequest extends FormRequest
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
            'designationmod' => 'required|string|max:255',
            'reglement_codereg' => 'required|exists:reglements,codereg',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'designationmod.required' => 'La désignation de la modalité est obligatoire',
            'designationmod.string' => 'La désignation de la modalité doit être une chaîne de caractères',
            'designationmod.max' => 'La désignation de la modalité ne doit pas dépasser 255 caractères',
            'reglement_codereg.required' => 'Le règlement est obligatoire',
            'reglement_codereg.exists' => 'Le règlement sélectionné n\'existe pas'
        ];
    }
}
