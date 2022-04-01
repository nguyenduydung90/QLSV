<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LopHocRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'MAGV'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Không được để trống',
            'MAGV.required'=>'Không được để trống'
        ];
    }
}
