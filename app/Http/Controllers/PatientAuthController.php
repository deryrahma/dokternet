<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRegRequest;
use Mail;
use Session;

class PatientAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        //
        $data = array();
        $data['content'] = null;

        $data['list_gender'][0] = 'L';
        $data['list_gender'][1] = 'P';

        $data['article'] = \App\ArticleCategory::with( 'articles')->get();

        return view('pages.patient.register')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        //
    }

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
    public function post_register(PatientRegRequest $request)
    {
        //
        $input = $request->all();
        $password = bcrypt($request->input('password'));
        $input['password'] = $password;
        $input['activation_code'] = str_random(60) . $request->input('email');
        $register = \App\Patient::create($input);
         
        $data = [
           'first_name' => $input['first_name'],
           'last_name' => $input['last_name'],
           'code' => $input['activation_code']
        ];
        $this->sendEmail($data, $input);
        Session::flash('success', "Cek email untuk mengaktivasi akun");
        return redirect()->route('patient.register');
    }

    public function sendEmail($data, $input)
    {

        Mail::send('pages.patient.register-email', $data, function($message) use ($input) {

            $message->from('deryrahma@yahoo.com', 'DokterNet-Indonesia');
            $message->to($input['email'], $input['first_name'])->subject('Please verify your account registration!');

        });
    }

    public function activate($code, Patient $patient)
    {
        if ($patient->activateAccount($code)) {
            return 'Akun pasien Anda berhasil diaktivasi';
        }
        return 'Akun pasien Anda gagal diaktivasi';
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
