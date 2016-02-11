<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\DoctorClinicCreateRequest;
use App\Http\Requests\DoctorClinicUpdateRequest;
use App\Http\Controllers\Controller;

use App\Doctor;
use App\DoctorClinic;
use App\ArticleCategory;

use Auth;
use Input;
use Hash;
use Response;
use Session;

class DoctorClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        $data['article'] = ArticleCategory::with( 'articles' )->get();
        $data['content'] = \App\Doctor::whereHas('clinics', function($q){
            $q->where('clinic.id', Auth::user()->clinic->id);
        })->get();

        return view( 'frontend.pages.clinic.doctor', compact( 'data' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();
        $data['content'] = null;

        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        $data['days'] = \App\Day::lists('name','id');

        return view( 'frontend.pages.clinic.doctor-create', compact( 'data' ) );
    }
    public function edit($id)
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();
        $data['content'] = \App\Doctor::find($id);

        $data['list_province'] = \App\Province::lists('name','id');
        $data['list_city'] = \App\City::lists('name','id');
        $data['list_specialization'] = \App\Specialization::lists('name','id');
        $data['days'] = \App\Day::lists('name','id');    
        return view( 'frontend.pages.clinic.doctor-edit', compact( 'data' ) );    
    }
    public function update(DoctorClinicUpdateRequest $request, $id)
    {
        $doctor = \App\Doctor::find($id);
        $user = \App\User::find($doctor->user_id);
        $user->email = $request->input('email');
        $user->save();

        $data['specialization_id'] = $request->get('specialization_id');
        $data['city_id'] = $request->get('city_id');
        $data['name'] = $request->get('name');
        $data['address'] = $request->get('address');
        $data['email'] = $request->get('email');
        $data['telephone'] = $request->get('telephone');
        $data['mobile'] = $request->get('mobile');
        $data['registration_number'] = $request->get('registration_number');
        $data['registration_year'] = $request->get('registration_year');
        $data['description'] = $request->get('description');
        $data['practice_time'] = $request->get('practice_time');
        $data['gender'] = $request->get('gender');

        if($request->hasFile('photo'))
        {
            if(File::exists($this->path.$doctor->photo))
                File::delete($this->path.$doctor->photo);
            $image = $request->file('photo');
            $extension = $image->getClientOriginalExtension();
            $fileName = "doctor_".date('Ymd_Hsi').'.'.$extension;
            $image->move($this->path,$fileName);
            $img = Image::make($this->path.$fileName);
            $img->save($this->path.$fileName, 60);
            $data['photo'] = $fileName;
        }
        
        $doctor->update($data);
        $doctor->day()->detach();
        foreach ($request->practice_day as $key => $value) {
            $doctor->day()->attach($value);
        }
        Session::flash('success', "Data dokter berhasil diperbarui");
        return redirect()->route('clinic.doctor.index');

        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorClinicCreateRequest $request)
    {
        // if ( $request->ajax() ) {
        //     DoctorClinic::create( [
        //         'doctor_id' => Input::get( 'doctor_id' ),
        //         'clinic_id' => Auth::user()->clinic->id,
        //     ] );
        //     return Response::json();
        // }
        $data = array();
        $user = \App\User::create([
            'first_name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> Hash::make('1234')
        ]);
        $user->roles()->attach(2);

        $data['user_id'] = $user->id;
        $data['specialization_id'] = $request->get('specialization_id');
        $data['city_id'] = $request->get('city_id');
        $data['name'] = $request->get('name');
        $data['address'] = $request->get('address');
        // $data['latitude'] = $request->get('latitude');
        // $data['longitude'] = $request->get('longitude');
        // $data['password'] = $request->get('password');
        $data['email'] = $request->get('email');
        $data['telephone'] = $request->get('telephone');
        $data['mobile'] = $request->get('mobile');
        $data['registration_number'] = $request->get('registration_number');
        $data['registration_year'] = $request->get('registration_year');
        $data['description'] = $request->get('description');
        $data['practice_time'] = $request->get('practice_time');
        $data['gender'] = $request->get('gender');

        if($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            $extension = $image->getClientOriginalExtension();
            $fileName = "doctor_".date('Ymd_Hsi').'.'.$extension;
            $file->move($this->path,$fileName);
            $img = Image::make($this->path.$fileName);
            $img->save($this->path.$fileName, 60);
            $data['photo'] = $fileName;
        }
        
        $hasil = \App\Doctor::create($data);
        $hasil->clinics()->attach(Auth::user()->clinic->id);
        foreach ($request->practice_day as $key => $value) {
            $hasil->day()->attach($value);
        }
        Session::flash('success', "Data dokter berhasil ditambahkan");
        return redirect()->route('clinic.doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DoctorClinic::where( 'doctor_id', $id )
                    ->where( 'clinic_id', Auth::user()->clinic->id )
                    ->delete();
        return redirect()->back();
    }
}
