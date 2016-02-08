<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use Session;
use App\Http\Requests\ClinicAdminRequest;


class ClinicAdminController extends Controller
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

        $data = array();

        if(empty($province_id) && empty($city_id))
        {
            //menampilkan semua klinik
            $data['content'] = \App\Clinic::all();
            $data['province_id'] = null;
            $data['city_id'] = null;
            
        } else
        {
            $data['content'] = \App\Clinic::where('city_id', $city_id)->get();
            $data['province_id'] = $province_id;
            $data['city_id'] = $city_id;
        } 

        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        return view('pages.admin.clinic.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = array();
        $data['content'] = null;

        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        
        return view('pages.admin.clinic.create')->with('data',$data);
    }

    public function create_doctor()
    {
        //
        $data = array();
        $data['content'] = null;

        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        
        return view('pages.admin.doctor.create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClinicAdminRequest $request)
    {
        //
        $data = array();
        
        $data['user_id'] = 4;
        $data['city_id'] = $request->get('city_id');
        $data['name'] = $request->get('name');
        $data['address'] = $request->get('address');
        $data['latitude'] = $request->get('latitude');
        $data['longitude'] = $request->get('longitude');
        $data['telephone'] = $request->get('telephone');
        $data['email'] = $request->get('email');
        $data['password'] = Hash::make($request->get('password'));
        
        $hasil = \App\Clinic::create($data);
        Session::flash('success', "Data berhasil ditambahkan");
        return redirect()->route('admin.clinic.index');
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

        $province_id = Input::get('province_id');

        $city_id = Input::get('city_id');

        $specialization_id = Input::get('specialization_id');
        
        $verified = Input::get('verified');

        $data = array();

        $data['content'] = \App\Clinic::find($id);


        if(empty($province_id) && empty($city_id) && empty($specialization_id) && empty($verified))
        {
            
            $data['content_doctor'] = \App\Doctor::whereHas('doctor_clinic', function($q) use($id)
            {
                $q->where('clinic_id', $id);

            })->get();

            $data['province_id'] = null;
            $data['city_id'] = null;
            $data['specialization_id'] = null;
            $data['verified'] = null;
        } else
        {

            $data['content_doctor'] = \App\Doctor::where('city_id', $city_id)->where('specialization_id', $specialization_id)->where('verified', $verified)->whereHas('doctor_clinic', function($q) use($id)
            {
                $q-$q->where('clinic_id', $id);
            })->get();

            $data['province_id'] = $province_id;
            $data['city_id'] = $city_id;
            $data['specialization_id'] = $specialization_id;
            $data['verified'] = $verified;
        }

        
        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        return view('pages.admin.clinic.show', compact('data'));
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
        $data = array();
        $data['content'] = \App\Clinic::find($id);
        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        return view('pages.admin.clinic.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClinicAdminRequest $request, $id)
    {
        //
        $data = array();
        
        $data['user_id'] = 4;
        $data['city_id'] = $request->get('city_id');
        $data['name'] = $request->get('name');
        $data['address'] = $request->get('address');
        $data['latitude'] = $request->get('latitude');
        $data['longitude'] = $request->get('longitude');
        $data['telephone'] = $request->get('telephone');
        $data['email'] = $request->get('email');
        $data['password'] = Hash::make($request->get('password'));
        
        $hasil = \App\Clinic::find($id);
        $hasil->update($data);
        Session::flash('success', "Data berhasil diperbarui");
        return redirect()->route('admin.clinic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = \App\Clinic::find($id);
        //$data->users()->detach();
        $data->delete();
        Session::flash('success', "Data berhasil dihapus");
        return redirect()->route('admin.clinic.index');
    }
}
