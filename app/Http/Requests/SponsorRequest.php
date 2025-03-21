<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SponsorRequest extends FormRequest
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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Messages de validation personnalisés.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le nom du sponsor est obligatoire.',
            'logo.required' => 'Le logo du sponsor est obligatoire.',
            'logo.image' => 'Le fichier doit être une image.',
            'logo.mimes' => 'Le logo doit être de type : jpeg, png, jpg, gif ou svg.',
            'logo.max' => 'Le logo ne doit pas dépasser 2 Mo.',
        ];
    }
}
