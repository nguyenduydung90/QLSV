<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'gender'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'image'=>'required',
            'birthday'=>'required',
            'MaLH'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Không được để trống',
            'address.required'=>'Không được để trống',
            'image.required'=>'Không được để trống',
            'gender.required'=>'Không được để trống',
            'birthday.required'=>'Không được để trống',
            'phone.required'=>'Không được để trống',
            'MaLH.required'=>'Không được để trống',
            
        ];
    }
}
