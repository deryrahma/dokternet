<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use Session;
use App\Specialization;
use App\SpecializationCategory;
use App\Http\Requests\SpecAdminRequest;

class SpecAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Specialization::with( 'specializationCategory' )->get();
        return view( 'pages.admin.spec.index', compact( 'data' ) );
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [];
        $data['content'] = null;
        $data['spec-cat'] = SpecializationCategory::lists( 'name', 'id' );

        return view( 'pages.admin.spec.create', compact( 'data' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecAdminRequest $request)
    {
        //
        $data = [];

        $data['specialization_category_id'] = $request->get( 'specialization_category_id' );
        $data['name'] = $request->get( 'name' );
        

        Specialization::create( $data );
        Session::flash( 'success', "Spesialisasi baru berhasil disimpan!" );
        return redirect()->route( 'admin.spec.index' );
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
        /*$data = [];
        $data['content'] = Specialization::with( 'specializationCategory' )
                                  ->where( 'id', $id )
                                  ->first();

        return view( 'pages.admin.spec.show', compact( 'data' ) );*/
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
        $data = [];
        $data['content'] = Specialization::find( $id );
        $data['spec-cat'] = SpecializationCategory::lists( 'name', 'id' );

        return view( 'pages.admin.spec.edit', compact( 'data' ) );
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
        $data = [];
        $spec = Specialization::find( $id );

        $data['specialization_category_id'] = $request->get( 'specialization_category_id' );
        $data['name'] = $request->get( 'name' );

        $spec->update( $data );
        Session::flash( 'success', "Spesialisasi baru berhasil diubah!" );
        return redirect()->route( 'admin.spec.index' );
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
        $spec = Specialization::find( $id );
        $spec->delete();

        Session::flash( 'success', "Spesialisasi berhasil dihapus!" );
        return redirect()->route( 'admin.spec.index' );
    }
}
