<?php

namespace App\Http\Requests\Layouts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLayoutRequest extends FormRequest
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
            'name' => 'required|string',
            'orientation' => 'nullable|string',
            'backgroundType' => 'nullable|string',
            'backgroundColor' => 'nullable|string',
            'backgroundImage' => 'nullable|string',
            'backgroundSize' => 'nullable|string',
            'media' => 'nullable|array'
        ];
    }
}
