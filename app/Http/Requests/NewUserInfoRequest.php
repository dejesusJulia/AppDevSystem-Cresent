<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserInfoRequest extends FormRequest
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
            'avatar' => 'required|mimes:jpg,png,jpeg',
            'portfolio' => 'required|mimes:pdf', 
            'website' => 'required', 
            'about' => 'required|max:500', 
            'position_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => 'Please upload an image of yourself',
            'portfolio.required' => 'Please upload a pdf copy of your resume', 
            'website.required' => 'Please put the link to your personal website or social media here', 
            'about.max' => 'This must not exceed 500 characters',
            'position_id.required' => 'Choose a role'
        ];
    }
}
