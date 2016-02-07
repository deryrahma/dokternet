<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use Session;
use App\Http\Requests\DoctorAtClinicAdminRequest;

class DoctorAtClinicAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $province_id = Input::get('province_id');

        $city_id = Input::get('city_id');

        $specialization_id = Input::get('specialization_id');
        
        $verified = Input::get('verified');

        $data = array();

        if(empty($province_id) && empty($city_id) && empty($specialization_id) && empty($verified))
        {
            //menampilkan semua gender
            $data['content'] = \App\Doctor::all();
            $data['province_id'] = null;
            $data['city_id'] = null;
            $data['specialization_id'] = null;
            $data['verified'] = null;
        } else
        {
            $data['content'] = //bingung
            $data['province_id'] = $province_id;
            $data['city_id'] = $city_id;
            $data['specialization_id'] = $specialization_id;
            $data['verified'] = $verified;
        } 

        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        return view('pages.admin.clinic.doctor.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //kosongan
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store ke doctor_clinic
        $data = array();
        $data['clinic_id'] = $request->get('clinic_id');
        $data['doctor_id'] = $request->get('doctor_id');
        
        $hasil = \App\DoctorClinic::create($data);
        Session::flash('success', "Dokter berhasil ditambahkan ke Klinik");
        return redirect()->route('admin.clinic.doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //masih belum ada gambaran
    }
}
