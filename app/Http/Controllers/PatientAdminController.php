<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use Session;
use App\Http\Requests\PatientAdminRequest;


class PatientAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $gender = Input::get('gender');
        //dd($gender);
        $verified = Input::get('verified');

        $data = array();

        if(empty($gender) && empty($verified))
        {
            //menampilkan semua gender
            $data['content'] = \App\Patient::all();
            $data['gender'] = null;
            $data['verified'] = null;
            //dd($data['content']);
            
        } else
        {
            $data['content'] = \App\Patient::where('gender',$gender)->where('verified',$verified)->get();
            $data['gender'] = $gender;
            $data['verified'] = $verified;
            //dd($verified);
        } 

        $data['list_gender'][0] = 'L';
        $data['list_gender'][1] = 'P';
        return view('pages.admin.patient.index')->with('data',$data);
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

        $data['list_gender'][0] = 'L';
        $data['list_gender'][1] = 'P';
        
        return view('pages.admin.patient.create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientAdminRequest $request)
    {
        //
        $data = array();
        
        $data['user_id'] = 3;
        $data['first_name'] = $request->get('first_name');
        $data['last_name'] = $request->get('last_name');
        $data['gender'] = $request->get('gender');
        $data['birth_date'] = $request->get('birth_date');
        $data['email'] = $request->get('email');
        $data['password'] = $request->get('password');
        $data['mobile'] = $request->get('mobile');
        $data['telephone'] = $request->get('telephone');
        
        $hasil = \App\Patient::create($data);
        Session::flash('success', "Data berhasil ditambahkan");
        return redirect()->route('admin.patient.index');
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
        $data = array();
        $data['content'] = \App\Patient::find($id);
        $data['list_gender'][0] = 'L';
        $data['list_gender'][1] = 'P';
        return view('pages.admin.patient.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientAdminRequest $request, $id)
    {
        //
        $data = array();

        $data['user_id'] = 3;
        $data['first_name'] = $request->get('first_name');
        $data['last_name'] = $request->get('last_name');
        $data['gender'] = $request->get('gender');
        $data['birth_date'] = $request->get('birth_date');
        $data['email'] = $request->get('email');
        $data['password'] = $request->get('password');
        $data['mobile'] = $request->get('mobile');
        $data['telephone'] = $request->get('telephone');
        
        $hasil = \App\Patient::find($id);
        $hasil->update($data);
        Session::flash('success', "Data berhasil diperbarui");
        return redirect()->route('admin.patient.index');
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
        $data = \App\Patient::find($id);
        //$data->users()->detach();
        $data->delete();
        Session::flash('success', "Data berhasil dihapus");
        return redirect()->route('admin.patient.index');
    }
}
