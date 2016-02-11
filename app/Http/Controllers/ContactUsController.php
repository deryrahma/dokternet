<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactUsRequest;
use App\Http\Controllers\Controller;
use Session;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['article'] = \App\ArticleCategory::with( 'articles')->get();

        return view('frontend.pages.home.contact-us', compact('data'));
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
    public function store(ContactUsRequest $request)
    {
        \App\ContactUs::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'website' => $request->input('website'),
            'title' => $request->input('title'),
            'description' => $request->input('description')
            ]);
        Session::flash('success', 'Terima kasih atas masukkan yang anda kirim');
        return redirect()->route('contact-us.index');
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

    public function adminIndex(){
        $data = \App\ContactUs::orderBy('created_at','desc')->get();
        return view( 'pages.admin.contact-us.index', compact( 'data' ) );
    }
    public function adminShow($id){
        $data = \App\ContactUs::find($id);
        return view( 'pages.admin.contact-us.show', compact( 'data' ) );
    }
    public function adminDelete($id){

        $data = \App\ContactUs::find($id);
        $data->delete();
        Session::flash('success', 'Data pesan masuk berhasil dihapus');
        return redirect()->route('admin.contact-us');
    }
}