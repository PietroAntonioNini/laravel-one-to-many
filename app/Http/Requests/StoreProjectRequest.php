<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => 'unique:projects,name|required|max:50',
            'description' => 'required',
            'cover_image' => 'file|max:1024|nullable|mimes:jpg,bmp,png',
            'technologies_used' => 'required|max:50',
            'github_link' => 'required',
        ];
    }

    public function messages(): array 
    {
        return [
            'name.unique' => 'Esiste già un progetto con questo Nome',
            'name.required' => 'Inserisci un Titolo',
            'description.required' => 'Inserisci una Descrizione',
            'technologies_used.required' => 'Inserisci almeno un linguaggio di programmazione usato',
            'github_link.required' => 'Inserisci il link alla repo di GitHub',

            'name.max' => 'Il campo Titolo deve avere massimo :max caratteri',
            'technologies_used.max' => 'Il campo linguaggi usati deve avere massimo :max caratteri',
            'cover_image.max' => "L'immagine deve essere grande al massimo :max kilobyte",
        ];
    }
}
