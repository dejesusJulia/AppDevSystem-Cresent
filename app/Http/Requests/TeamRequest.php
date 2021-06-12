<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'team_name' => 'required|max:50|unique:teams,team_name,{$this->team->id}',
            'team_vision' => 'required|max:255', 
            'team_objectives' => 'required|max:255',
        ];
    }

    public function messages(){
        return [
            'team_name.required' => 'Please type in a team name', 
            'team_vision.required' => 'Please type in a team vision',
            'team_objectives.required' => 'Please type in your team objectives'
        ];
    }
}