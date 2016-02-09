<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DoctorClinicUpdateRequest extends Request
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
        $doctor = \App\Doctor::find($this->route()->getParameter('doctor'));
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'registration_number' => 'required|min:3',
                    'registration_year' => 'required',
                    'photo' => 'image',
                    'name' => 'required|min:5',
                    'email'         => 'required|email|unique:users,email,'.$doctor->user_id,
                    'gender' => 'required',
                    'mobile' => 'required',
                    'address' => 'required|min:5'
                ];
            }
            default:break;
        }
    }
}
