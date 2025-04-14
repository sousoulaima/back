<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategorieAbonnementRequest extends FormRequest
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
            'designationcateg' => 'required|string|max:255',
            'observations' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'designationcateg.required' => 'La désignation de la catégorie est obligatoire',
            'designationcateg.string' => 'La désignation de la catégorie doit être une chaîne de caractères',
            'designationcateg.max' => 'La désignation de la catégorie ne doit pas dépasser 255 caractères'
        ];
    }
}
