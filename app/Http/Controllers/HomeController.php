<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ArticleCategory;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles')->get();
        $data['city'] = \App\City::all();
        $data['specialization'] = \App\Specialization::all();

        return view( 'frontend.pages.home.index', compact( 'data' ) );
    }

    public function search(Request $request)
    {
        $data = array();
        $data['article'] = ArticleCategory::with( 'articles')->get();
        $data['city'] = \App\City::all();
        $data['specialization'] = \App\Specialization::all();

        $data['city_k'] = urldecode($request->input('city'));
        $data['specialization_k'] = urldecode($request->input('specialization'));
        $data['keyword'] = urldecode($request->input('keyword'));

        $data['city_obj'] = \App\City::where('name','like','%'.$data['city_k'].'%')->lists('id');

        $result = \App\Specialization::where('name','like','%'.$data['specialization_k'].'%')
            ->whereHas('doctors', function($query) use($data){
                $query->whereIn('city_id', $data['city_obj'])
                    ->where('name','like', '%'.$data['keyword'].'%');
            })->with('doctors')->get();
        
        $data['article'] = ArticleCategory::with( 'articles')->get();
        $data['content'] = $result;
        return view('frontend.pages.home.search-result', compact('data'));
    }
    public function searchProfile($name)
    {
        $name = urldecode($name);
        $data = array();
        $data['content'] = \App\Doctor::where('name','like', '%'.$name.'%')->first();
        if(empty($data['content']))
            return redirect()->route('home');
        return view('frontend.pages.home.search-profile', compact('data'));
    }
}
