<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTerrainRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix' => 'required|numeric|min:0',
            'sponsor_id' => 'nullable|exists:sponsors,id',
            'statut' => 'required|in:disponible,indisponible',
            'adresse' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,avif|max:4000',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Le nom du terrain est requis.',
            'name.string' => 'Le nom du terrain doit être une chaîne de caractères.',
            'name.max' => 'Le nom du terrain ne peut pas dépasser 255 caractères.',
            'categorie_id.required' => 'Vous devez sélectionner une catégorie.',
            'categorie_id.exists' => 'La catégorie sélectionnée est invalide.',
            'prix.required' => 'Le prix est requis.',
            'prix.numeric' => 'Le prix doit être un nombre.',
            'prix.min' => 'Le prix ne peut pas être négatif.',
            'sponsor_id.exists' => 'Le sponsor sélectionné est invalide.',
            'statut.required' => 'Le statut est requis.',
            'statut.in' => 'Le statut doit être "disponible" ou "indisponible".',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'L\'image doit être de type jpeg, png, jpg .',
            'photo.max' => 'L\'image ne peut pas depasser 2 Mo.',
            'adresse.required' => 'L\'adresse est requise.',
            'adresse.string' => 'L\'adresse doit être une chaîne de caractères.',
            'adresse.max' => 'L\'adresse ne peut pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}
