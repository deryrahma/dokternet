<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class PatientUpdateRequest extends Request
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
            
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'gender' => 'required',
            'birth_date' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'mobile' => 'required',
            'telephone' => 'required',
            'address' => 'required',
        ];
    }
}
