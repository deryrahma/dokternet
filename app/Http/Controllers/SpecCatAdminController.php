<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Hash;
use Session;
use App\Http\Requests\SpecCatAdminRequest;

class SpecCatAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = array();
        $data['content'] = \App\SpecializationCategory::all();
        return view('pages.admin.spec-cat.index')->with('data',$data);
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
        return view( 'pages.admin.spec-cat.create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecCatRequest $request)
    {
        //
        SpecializationCategory::create($request->all());
        Session::flash( 'success', "Kategori spesialisasi berhasil ditambahkan!" );
        return redirect()->route('admin.spec-cat.index');
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
        $data['content'] = SpecializationCategory::find($id);

        return view('pages.admin.spec-cat.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecCatRequest $request, $id)
    {
        //
        SpecializationCategory::find($id)->update($request->all());
        Session::flash( 'success', "Kategori spesialisasi berhasil diubah!" );
        return redirect()->route( 'admin.spec-cat.index' );
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
        $data = \App\SpecializationCategory::find($id);
        $data->delete();
        Session::flash('success', "Kategori spesialisasi berhasil dihapus");
        return redirect()->route('admin.spec-cat.index');
    }
}
