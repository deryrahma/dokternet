<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use Session;
use App\Http\Requests\DoctorAdminRequest;

class DoctorAdminController extends Controller
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
            $data['content'] = \App\Doctor::where('city_id', $city_id)->where('specialization_id', $specialization_id)->where('verified', $verified)->get();
            $data['province_id'] = $province_id;
            $data['city_id'] = $city_id;
            $data['specialization_id'] = $specialization_id;
            $data['verified'] = $verified;
        } 

        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        return view('pages.admin.doctor.index')->with('data',$data);
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
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        
        return view('pages.admin.doctor.create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = array();
        
        $data['user_id'] = 2;
        $data['city_id'] = $request->get('city_id');
        $data['name'] = $request->get('name');
        $data['address'] = $request->get('address');
        $data['latitude'] = $request->get('latitude');
        $data['longitude'] = $request->get('longitude');
        $data['password'] = $request->get('password');
        $data['email'] = $request->get('email');
        $data['telephone'] = $request->get('telephone');
        $data['registration_number'] = $request->get('registration_number');
        $data['registration_year'] = $request->get('registration_year');
        $data['description'] = $request->get('description');
        
        $hasil = \App\Doctor::create($data);
        Session::flash('success', "Data dokter berhasil ditambahkan");
        return redirect()->route('admin.doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['content'] = \App\Doctor::find($id);
        return view('pages.admin.doctor.show', compact('data'));
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
        $data['content'] = \App\Doctor::find($id);
        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        return view('pages.admin.doctor.edit')->with('data',$data);
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
        $data = array();
        
        $data['user_id'] = 2;
        $data['city_id'] = $request->get('city_id');
        $data['name'] = $request->get('name');
        $data['address'] = $request->get('address');
        $data['latitude'] = $request->get('latitude');
        $data['longitude'] = $request->get('longitude');
        $data['password'] = $request->get('password');
        $data['email'] = $request->get('email');
        $data['telephone'] = $request->get('telephone');
        $data['registration_number'] = $request->get('registration_number');
        $data['registration_year'] = $request->get('registration_year');
        $data['description'] = $request->get('description');
        
        $hasil = \App\Doctor::find($id);
        $hasil->update($data);
        Session::flash('success', "Data dokter berhasil diperbarui");
        return redirect()->route('admin.doctor.index');
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
        $data = \App\Doctor::find($id);
        //$data->users()->detach();
        $data->delete();
        Session::flash('success', "Data dokter berhasil dihapus");
        return redirect()->route('admin.doctor.index');
    }

    public function education($id)
    {
        $doctor = \App\Doctor::find($id);
        return view('pages.admin.doctor.education', compact('doctor'));
    }
    
    public function educationStore(Request $request, $id)
    {
        \App\DoctorEducation::create([
            'doctor_id' => $id,
            'year' => $request->input('year'),
            'name' => $request->input('name')
            ]);
        Session::flash('success', "Data pendidikan berhasil ditambahkan.");
        return redirect()->route('admin.doctor.show', [$id]);
    }
    public function educationDestroy($id)
    {
        $data = \App\DoctorEducation::find($id);
        $doctor_id = $data->doctor_id;
        $data->delete();
        Session::flash('success', "Data pendidikan berhasil dihapus.");
        return redirect()->route('admin.doctor.show', [$doctor_id]);
    }
    public function experience($id)
    {
        $doctor = \App\Doctor::find($id);
        return view('pages.admin.doctor.experience', compact('doctor'));
    }
    public function experienceStore(Request $request, $id)
    {
        \App\DoctorExperience::create([
            'doctor_id' => $id,
            'name' => $request->input('name')
            ]);
        Session::flash('success', "Data pengalaman berhasil ditambahkan.");
        return redirect()->route('admin.doctor.show', [$id]);
    }
    public function experienceDestroy($id)
    {
        $data = \App\DoctorExperience::find($id);
        $doctor_id = $data->doctor_id;
        $data->delete();
        Session::flash('success', "Data pengalaman berhasil dihapus.");
        return redirect()->route('admin.doctor.show', [$doctor_id]);
    }
}
