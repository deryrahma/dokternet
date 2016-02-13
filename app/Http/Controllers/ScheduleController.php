<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ScheduleCreateRequest;
use App\Http\Requests\ScheduleUpdateRequest;

use App\Doctor;
use App\Schedule;
use App\ArticleCategory;

use Auth;
use Session;

class ScheduleController extends Controller
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
        $data['content'] = Schedule::with( 'doctor' )
                                   ->where( 'date', '>', date( "Y-m-d", time() ) )
                                   ->orderBy( 'date', 'asc' )
                                   ->orderBy( 'schedule_start', 'asc' )
                                   ->get();

        return view( 'frontend.pages.clinic.schedule', compact( 'data' ) );
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
        $data['doctor'] = Doctor::whereHas( 'clinics', function( $q ) {
            $q->where( 'clinic.id', Auth::user()->clinic->id );
        } )->orderBy( 'name' )->get();

        return view( 'frontend.pages.clinic.schedule-create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleCreateRequest $request)
    {
        $data = [
            'clinic_id'         => Auth::user()->clinic->id,
            'doctor_id'         => $request->input( 'doctor_id' ),
            'schedule_start'    => date( "H:i", strtotime( $request->input( 'schedule_start' ) ) ),
            'schedule_end'      => date( "H:i", strtotime( $request->input( 'schedule_end' ) ) ),
            'date'              => $request->input( 'date' ),
            'quota'             => $request->input( 'quota' ),
            'status_batal'      => '0',
        ];

        Schedule::create( $data );
        if ( $request->input( 'repeat' )  == '2' ) {
            $iter = strtotime( "+1 week", strtotime( $data['date'] ) );
            while ( $iter <= strtotime( $request->input( 'max_date' ) ) ) {
                $data['date'] = date( "Y-m-d", $iter );
                Schedule::create( $data );
                $iter = strtotime( "+1 week", strtotime( $data['date'] ) );
            }
        }

        Session::flash('success', "Jadwal baru dokter berhasil ditambahkan");
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];

        $data['article'] = ArticleCategory::with( 'articles' )->get();
        $data['content'] = Schedule::find( $id );
        $data['doctor'] = Doctor::whereHas( 'clinics', function( $q ) {
            $q->where( 'clinic.id', Auth::user()->clinic->id );
        } )->orderBy( 'name' )->get();

        return view( 'frontend.pages.clinic.schedule-update', compact( 'data' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleUpdateRequest $request, $id)
    {
        $schedule = Schedule::find( $id )->update( [
            'doctor_id'         => $request->input( 'doctor_id' ),
            'schedule_start'    => date( "H:i", strtotime( $request->input( 'schedule_start' ) ) ),
            'schedule_end'      => date( "H:i", strtotime( $request->input( 'schedule_end' ) ) ),
            'date'              => $request->input( 'date' ),
            'quota'             => $request->input( 'quota' ),
        ] );

        Session::flash('success', "Jadwal dokter berhasil diubah");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::find( $id )->delete();
        Session::flash('success', "Jadwal dokter berhasil dihapus");
        return redirect()->back();
    }

    public function cancel( $id )
    {
        $schedule = Schedule::find( $id );

        if ( $schedule->status_batal == '0' ) {
            $schedule->update( ['status_batal' => '1'] );
        }
        else if ( $schedule->status_batal == '1' ) {
            $schedule->update( ['status_batal' => '0'] );
        }

        Session::flash('success', "Jadwal dokter dibatalkan");
        return redirect()->back();
    }
}
