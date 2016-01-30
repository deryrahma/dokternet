<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PatientRegRequest extends Request
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
            // //
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            // 'gender' => 'required',
            // 'birth_date' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'cpassword' => 'required|same:password',
            // 'mobile' => 'required',
            // 'telephone' => 'required'
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
            'required' => ':attribute wajib diisi.',
            'first_name.required' => 'Nama Depan wajib diisi.',
            'first_name.min' => 'Nama Depan minimal 4 karakter.',
            'last_name.required' => 'Nama Belakang wajib diisi.',
            'last_name.min' => 'Nama Belakang minimal 4 karakter.',
            'gender.required' => 'Jenis kelamin wajib diisi.',
            'birth_date.required' => 'Tanggal lahir wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 4 karakter.',
            'cpassword.required' => 'Konfirmasi Password wajib diisi.',
            'cpassword.same' => 'Password tidak sama.',
            'mobile.required' => 'No. HP wajib diisi.',
            'telephone.required' => 'No. Telepon wajib diisi.',
            
        ];
    }
}
