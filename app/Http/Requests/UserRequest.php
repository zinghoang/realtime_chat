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
            'name' => 'required|min:2|max:32|unique:users',
            'email' => 'required|email|min:10|max:200|unique:users',
            'password' => 'required|min:6|max:32|confirmed',
            'fullname' => 'required|min:2|max:100',
            'level' => 'required|numeric|integer|between:0,2'
        ];
    }
}
