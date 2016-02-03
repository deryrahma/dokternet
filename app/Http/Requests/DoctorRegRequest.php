<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DoctorRegRequest extends Request
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
            //
            'specialization_id' => 'required',
            'city_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => 'required',
            'mobile' => 'required',
            'telephone' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'specialization_id.required' => 'Spesialisasi wajib diisi.',
            'city_id.required' => 'Kota wajib diisi.',
            'name.required' => 'Nama wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'mobile.required' => 'No. HP wajib diisi',
            'telephone.required' => 'No. Telepon wajib diisi'
        ];
    }
}
