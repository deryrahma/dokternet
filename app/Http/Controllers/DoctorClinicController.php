<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Doctor;
use App\DoctorClinic;
use App\ArticleCategory;

use Auth;
use Input;
use Response;

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
        $data['content'] = DoctorClinic::with( [ 'doctor' => function ( $q ) {
            $q->with( 'city', 'specialization' );
        } ] )->get();

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
        $data['content'] = Doctor::with( 'city', 'specialization' )->get();

        return view( 'frontend.pages.clinic.doctor-add', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( $request->ajax() ) {
            DoctorClinic::create( [
                'doctor_id' => Input::get( 'doctor_id' ),
                'clinic_id' => Auth::user()->clinic->id,
            ] );
            return Response::json();
        }
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
