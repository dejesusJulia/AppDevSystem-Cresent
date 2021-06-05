<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
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
            'name' => 'required|max:255', 
            'email' => 'required|email:rfc,dns', 
            'avatar' => 'mimes:jpg,png,jpeg',
            'portfolio' => 'mimes:pdf', 
            'website' => 'required', 
            'about' => 'required|max:200', 
            'position_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Your full name is required',
            'email.required' => 'Your email is required',
            'avatar.required' => 'Please upload an image of yourself',
            'portfolio.required' => 'Please upload a pdf copy of your resume', 
            'website.required' => 'Please put the link to your personal website or social media here', 
            'about.max' => 'This must not exceed 200 characters',
            'position_id.required' => 'Choose a role'
        ];
    }
}
