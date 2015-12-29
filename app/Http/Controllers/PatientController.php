<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PatientRequest;
use App\Http\Controllers\Controller;
use App\ArticleCategory;

use Auth;
use Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    public function login()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles')->get();

        return view('pages.patient.login.index', compact('data'));
    }

    public function postLogin(Request $request){

        $email = $request->get('email');
        $password = $request->get('password');
        $remember_me = true;
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)){
            return redirect()->route('patient.dashboard');
        }
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('patient.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }
}
