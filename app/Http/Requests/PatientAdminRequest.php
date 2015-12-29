<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PatientAdminRequest extends Request
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
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'birth_date' => 'required',
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
            'first_name.required' => 'Nama Depan wajib diisi.',
            'last_name.required' => 'Nama Belakang wajib diisi.',
            'gender.required' => 'Jenis kelamin wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'mobile.required' => 'No. HP wajib diisi.',
            'telephone.required' => 'No. Telepon wajib diisi.'
        ];
    }
}
