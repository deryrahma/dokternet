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
        $city = $request->input('city');
        $specialization = $request->input('specialization');
        $keyword = $request->input('keyword');
        
    }
}
