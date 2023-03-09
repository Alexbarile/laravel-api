<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// INSERIRE RULE
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=> ['required', Rule::unique('posts')->ignore($this->post), 'max:150'],
            'content'=> ['nullable'],
            'type_id'=> ['nullable', 'exists:types,id'],
            'technologies'=> ['exists:technologies,id'],
            'cover_image' => ['nullable', 'image'],
        ];
    }

    public function messages()
    {
        return [
            'title.required'=> 'Il titolo è obbligatorio',
            'title.unique'=> 'Il titolo è già presente',
            'title.max'=> 'Il titolo non può superare :max caratteri',
            'type_id'=> 'Categoria non è valida',
            'technologies.exists'=> 'Tag non valido',
            'cover_image.image' => 'Inserire formato valido',
        ];
    }
}
