<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'nickname' => ['required', 'string', 'min:1', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users', 'min:3'],
            'code' => ['required', 'min:5', 'max:5']
        ];
    }
}
