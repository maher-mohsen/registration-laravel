<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'birthdate' => 'required|date|before:-18 years',
            'phone' => ['required', 'regex:/^(?:\d{2}([-.])\d{3}\1\d{3}\1\d{3}|\d{11})$/'],
            'address' => 'required|string|max:255',
           'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
        
    }
}

