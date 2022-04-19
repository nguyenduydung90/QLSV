<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'email|required',
            'address' => 'required',
            'image' => 'image',
            'gender' => 'required',
            'birthday' => 'required',
            'phone' => 'required|min:10',
            'password' => 'required',
            'passwordconfirm' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'email.required' => 'Không được để trống',
            'address.required' => 'Không được để trống',
            'image.image' => 'File ảnh phải đúng định dạng: jpg, jpeg, png, bmp, gif, svg',
            'gender.required' => 'Không được để trống',
            'birthday.required' => 'Không được để trống',
            'phone.required' => 'Không được để trống',
            'password.required' => 'Không được để trống',
            'passwordconfirm.required' => 'Không được để trống',
            'email.email' => 'Email phải đúng định dạng',
            // 'email.unique'=>'Email đã được sử dụng',
            'phone.min' => 'Số điện thoại có ít nhất là 10 chữ số',
            'passwordconfirm.same' => 'Nhập lại mật khẩu chưa đúng'
        ];
    }
}
