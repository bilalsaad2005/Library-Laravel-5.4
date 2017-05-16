<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeSectionRequest extends FormRequest
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
            //
        'section_name'=>'required|unique:sections,section_name|min:3|max:30',
        'image'=>'required|image|max:1024'
        ];
    }
}
