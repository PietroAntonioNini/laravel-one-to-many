<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        // Ottieni l'ID del progetto attualmente in fase di aggiornamento
        $projectId = $this->route('project') ? $this->route('project')->id : null;

        return [
            'name' => [
                'required',
                'max:50',
                Rule::unique('projects')->ignore($projectId),
            ],
            'description' => 'required',
            'cover_image' => 'nullable|file|max:2048|mimes:jpg,bmp,png',
            'technologies_used' => 'required|max:50',
            'github_link' => 'required',
            'type_id' => 'nullable|exists:types,id'
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
