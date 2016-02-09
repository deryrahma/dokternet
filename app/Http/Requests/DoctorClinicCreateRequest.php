<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DoctorClinicCreateRequest extends Request
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
            'registration_number' => 'required|min:3',
            'registration_year' => 'required',
            'photo' => 'image',
            'name' => 'required|min:5',
            'email' => 'required|email',
            'gender' => 'required',
            'mobile' => 'required',
            'address' => 'required|min:5'
        ];
    }
}
