<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'day' => 'required|date|date_format:l',
            'hour' => 'required|date_format: H:i',
            'subjects_id' => 'required|min:1',
            'classroom_id' => 'required|min:1'
        ];
    }

    public function messages()
    {
        return[
            'day.required' => 'La date est obligatoire',
            'day.date_format' => 'La date doit etre sous le formart Heure:minute'
        ];
    }
}
